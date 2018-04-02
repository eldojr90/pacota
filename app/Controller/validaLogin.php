<?php

require_once '../../vendor/autoload.php';

use App\Aux\Connection,
    App\Model\DAO\UsuarioDAO;

$ud = new UsuarioDAO();

if(isset($_REQUEST)){
    
    if(isset($_POST["login"])&&isset($_POST["senha"])){
        
        $login = $_POST["login"];
        $email2 = $login.".br";
        $senha = strtoupper(md5($_POST["senha"]));
        $con = Connection::getConnection();
        $sql = "select u_id from usuario where ( u_nome_de_usuario = ? or (u_email = ? or u_email = ?) ) and u_senha = ?";
        $ps = $con->prepare($sql);
        $ps->bindParam(1, $login);
        $ps->bindParam(2, $login);
        $ps->bindParam(3, $email2);
        $ps->bindParam(4, $senha);
        $ps->execute();
        
        $usuario = null;
            
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

