<?php

require_once '../../vendor/autoload.php';

use App\Aux\Connection,
    App\Model\DAO\UsuarioDAO,
    App\Util\Crypt;

$ud = new UsuarioDAO();

if(isset($_REQUEST)){
    
    if(isset($_POST["login"])&&isset($_POST["senha"])){
        
        $usemail = $_POST["login"];
        $pwd = Crypt::encryptMD5($_POST["senha"]);

        $ps = $ud->login($usemail,$pwd);
        
        if($rs = $ps->fetch(PDO::FETCH_OBJ)){
                       
            session_start();
            
            $_SESSION["idUsuario"] =  $rs->u_id;
            
            echo 1;
                
        }
        
    }
    
    if(isset($_POST["token"])){
        
        $token = $_POST["token"];
        
        $u = $ud->findUserBytoken($token);
            
        if(isset($u)){
                       
            session_start();
            
            $_SESSION["idUsuario"] =  $u->getId();
            
            header("location: ../../home.php");
                
        }else{

            echo "usuário não encontrado para login via token!";

        }
        
    }

    if(isset($_GET["logout"])){
        if($_GET["logout"]==true){
            session_start();
            session_destroy();
            header("location: ../../login.php");
        }
    }

}

