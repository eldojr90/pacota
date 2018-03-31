<?php

require_once '../../vendor/autoload.php';

use App\Model\DAO\UsuarioDAO,
    App\Model\Usuario;

$id = null;

if(isset($_POST["idUsuario"])){
    $id = $_POST["idUsuario"];
}

if(isset($_GET["idUsuario"])){
    $id = $_GET["idUsuario"];
}
    
$ud = new UsuarioDAO();

if(isset($_POST["upUs"])){

    if(isset($_POST["usname"]) && isset($_POST["email"]) && 
    isset($_POST["cpwd"])){

        $usname = $_POST["usname"]; // -5
        $email = $_POST["email"]; // -4
        $cpwd = encryptMD5($_POST["cpwd"]);// -3
        $npwd = encryptMD5($_POST["cpwd"]);
        $rpwd = encryptMD5($_POST["cpwd"]);

        if(isset($_POST["npwd"]) && isset($_POST["rpwd"])){
        
            $npwd = encryptMD5($_POST["npwd"]); // -1 len -2 re
            $rpwd = encryptMD5($_POST["rpwd"]);// 0 or 1

        }

        if(!$ud->existsUserName($id,$usname)){

            if(!$ud->existsEmail($id,$email)){

                if($ud->verifyPassword($id,$cpwd)){

                    if($npwd == $rpwd){

                        if(strlen($npwd) >= 6){

                            echo $ud->updateUser((new Usuario($id,null,$usname,$email,$npwd)))?1:0;
                        
                        }else{

                            echo -1;

                        }

                    }else{

                        echo -2;

                    }

                }else{

                    echo -3;

                }

            }else{

                echo -4;

            }

        }else{

            echo -5;

        }
        



    }

}

if(isset($_POST["exUs"])){

    if(isset($_POST["usname"])){
     
        $username = $_POST["usname"];

        echo $ud->existsUserName($id,$username);
        
    }

}

if(isset($_POST["exEm"])){

    if(isset($_POST["email"])){
     
        $email = $_POST["email"];

        echo $ud->existsEmail($id,$email);
        
    }

}

if(isset($_POST["vPw"])){

    if(isset($_POST["pwd"])){
     
        $pwd = encryptMD5($_POST["pwd"]);

        echo $ud->verifyPassword($id,$pwd);
        
    }

}

function encryptMD5($str){
    return strtoupper(md5(trim($str)));
}