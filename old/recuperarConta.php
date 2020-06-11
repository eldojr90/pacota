<?php

session_start();

$token = "";

if(!isset($_SESSION["token"])){
    
    header("location: login.php?login=other");
    
}else{

    $token = $_SESSION["token"];

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="./assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Pacota - Alterar Senha</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="./assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="./assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <link href="./assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <link href="./assets/css/login.css" rel="stylesheet" />

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

    <script src="./assets/js/repassword.js"></script>

</head>
<body>
    
    <?php echo "<script> console.log('$token'); </script>" ?>


    <div class='col-md-4'></div>
    <div class='col-md-4'>
        
        <div align="center">
        
            <h3>Altere sua senha!</h3>
            
            <hr/>

            <form id="fracc">
                
                <input type="text" id="token" value="<?php echo $token; ?>" hidden>

                <div class="form-group">
                    <input class="form-control" type="password" id="npwd" placeholder="Nova senha" required>
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" id="cnpwd" placeholder="Confirme sua nova senha" required>
                </div>

                <div class="form-group">
                    <input class="btn btn-primary btn-lg" type="submit" value="Recuperar">
                </div>
            </form>
        </div>

    <div class='col-md-4'></div>

</body>

</html>