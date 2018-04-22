<?php

require_once '../../vendor/autoload.php';

use App\Model\DAO\UsuarioDAO,
    App\Model\Usuario,
    App\PHPMailer\PHPMailer;

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

if(isset($_POST["rAcc"])){

    if(isset($_POST["usemail"])){

        $usemail = $_POST["usemail"];

        if($ud->verifyUserEmail($usemail)){

            $usuario = $ud->findUserByUsEmail($usemail);

            $token = $ud->genTokenByUser($usuario);

            $dns = $_SERVER['SERVER_NAME'];

            $mensagem = 
                "<meta charset='utf-8' />
                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css'>"
                ."Olá ".$usuario->getNome().",
                <br />solicitou recuperação de senha? 
                <br />Acesse: 
                <br />
                <br />
                <a href='http://$dns/index.php?token=$token' 
                    align='center'>"
                ."Recuperar Conta"         
                ."</a>";

            $mail = new PHPMailer();
            
            $mail->isSMTP();
            $mail->isHTML();
            $mail->addAddress($usuario->getEmail());

            $mail->CharSet = "utf-8";
            $mail->Host = "smtp.gmail.com";
            $mail->From = "eldojr90@gmail.com";
            $mail->FromName = "Admin Pacota";
            $mail->SMTPAuth = true;
            $mail->Username = 'eldojr90';
            $mail->Password = 'eldo010612';
            
            $mail->Subject = "Pacota - Recuperação de Conta";
            $mail->Body = $mensagem;

            if($mail->send()){

                echo $usuario->getEmail();

            }else{

                echo $mail->ErrorInfo;

            }

            $mail->ClearAllRecipients();
            $mail->ClearAttachments();

        }else{

            echo -1;

        }

    }

}

if(isset($_POST["upAcc"])){

    if(isset($_POST["token"]) && isset($_POST["npwd"])){

        $token = $_POST["token"];
        $npwd = encryptMD5($_POST["npwd"]);

        $u = $ud->findUserBytoken($token);

        if(isset($u)){

            $u->setSenha($npwd);

            if($ud->updateUser($u)){

                session_start();

                $_SESSION["idUsuario"] = $u->getId();

                echo true;
            
            }else{

                echo "ERRO NA ALTERAÇÃO DA SENHA DO USUÁRIO. (C/ TOKEN)";

            }

        }

    }

}


if(isset($_GET["tk_rq"])){
    
    $token = $_GET["tk_rq"];

    $u = $ud->findUserBytoken($token);
        
        $redirect = "location: ../../";

        if(isset($u)){

            session_start();

            $_SESSION["token"] = $token;

            $redirect .= "recuperarConta.php";

        }else{

            $redirect .= "login.php?login=other";

        }

        header($redirect);

}

function encryptMD5($str){
    return strtoupper(md5(trim($str)));
}
