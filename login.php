<?php

session_start();

if(isset($_SESSION["idUsuario"])){
    
    header("location: home.php");
    
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="./assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Pacota - Login</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="./assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="./assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <link href="./assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

        <!--   Core JS Files   -->
        <script src="./assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="./assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="./assets/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="./assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <script src="./assets/js/pacota.js"></script>

    <script src="./assets/js/el-login.js"></script>
	
    

</head>
<body>
    <?php
        if(isset($_REQUEST)){
            if(isset($_GET["login"])){
                if($_GET["login"]=="false"){
                    echo    "<script>
                                    notificao('key','Faça o login','info');
                            </script>";
                }
            }
        }
        
    ?>
    <div class='col-md-4'></div>
    <div class='col-md-4'>
    <div class="dprincipal" align="center">

        <h3>Bem vindo a Pacota!</h3>
        <hr/>
        <form id="flogin" action='home.php' method="POST">
            <div class="form-group">
                <input class="form-control" type="text" id="usuario" name="usuario" 
                       placeholder="Usuário ou e-mail" required autofocus align="center">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" id="pwd" name="pwd" placeholder="Senha" required>
            </div>
            <div class="form-group">
                <input class="btn btn-success btn-lg" type="submit" value="Entrar">
            </div>
        </form>

        </div>
        <div class='col-md-4'></div>

</body>



</html>