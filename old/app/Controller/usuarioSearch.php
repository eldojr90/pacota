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

if(isset($_GET["usLog"])){

    $usuario = $ud->findUser($id);

    if(isset($usuario)){

        session_start();

        $_SESSION["usLogUpd"] = serialize($usuario);

        header("location: ../../minhaConta.php");

    }

}

if(isset($_POST["nomeUs"])){
    
    $usuario = $ud->findUser($id);
    
    if(isset($usuario)){
        
        echo $usuario->getNome();
        
    }
    
}

if(isset($_POST["usemail"])){

    $usemail = $_POST["usemail"];

    echo $ud->verifyUserEmail($usemail);

}