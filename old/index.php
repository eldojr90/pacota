<?php

if(isset($_GET["token"])){
    
    $token = $_GET["token"];

    session_start();
     
    header("location: app/Controller/usuarioUpdate.php?tk_rq=$token");

}else{

    header("location: login.php");

}