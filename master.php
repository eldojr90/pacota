<?php

$idUsuario = null;

if(isset($_SESSION["idUsuario"])){
    
    $idUsuario = $_SESSION["idUsuario"];
    
}else{
    
    session_destroy();
    header("location: login.php?login=false");
    
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
        <link rel="icon" type="image/png" href="./assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title><?php if(isset($title)){echo "Pacota&nbsp-&nbsp".$title;}?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="./assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="./assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="./assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <link href="./assets/css/master.css" rel="stylesheet" />

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

    <script src="./assets/js/el-master.js"></script>


</head>
<body>

<script><?php

    if(isset($_GET["rpwdsuccess"])=="true"){
        echo "noticao('like2','Senha alterada com sucesso!','success')";
    }

    ?></script>

<div class="wrapper">
    
    <div class="sidebar" data-color="purple">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="home.php" class='simple-text'>
                    <input type="number" id="idUsuario" value="<?php if(isset($idUsuario)){echo $idUsuario;}?>" hidden>
                    <span id="nomeUsuario"></span>
                </a>
            </div>

            <ul class="nav">
                <li <?php if(strpos($_SERVER["PHP_SELF"],"home.php")){echo 'class="active"';}?>>
                    <a href="home.php">
                        <i class="pe-7s-monitor"></i>
                        <p>Meus Lançamentos</p>
                    </a>
                </li>
                <li <?php if(strpos($_SERVER["PHP_SELF"],"mensal.php")){echo 'class="active"';}?>>
                    <a href="mensal.php">
                        <i class="pe-7s-date"></i>
                        <p>Mensal</p>
                    </a>
                </li>
                <li <?php if(strpos($_SERVER["PHP_SELF"],"anual.php")){echo 'class="active"';}?>>
                    <a href="anual.php">
                        <i class="pe-7s-global"></i>
                        <p>Anual</p>
                    </a>
                </li>
                <li class='<?php if(strpos($_SERVER["PHP_SELF"],"minhaConta.php")){echo 'active';}?>'>
                    <a href='app/Controller/usuarioSearch.php?usLog=true&idUsuario=<?php echo $idUsuario; ?>'
                    >
                        <i class="pe-7s-user"></i>
                        <p>Minha Conta</p>
                    </a>
                </li>
                <li class = 'hidden <?php if(strpos($_SERVER["PHP_SELF"],"configs.php")){echo "active";}?>'>
                    <a href="#">
                        <i class="pe-7s-settings"></i>
                        <p>Configurações</p>
                    </a>
                </li>
                <li>
                    <a href="./app/Controller/validaLogin.php?logout=true">
                        <i class="pe-7s-safe"></i>
                        <p>Sair</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
    
    <div class="main-panel">
        
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php if(isset($title)){ echo $title;}?></a>
                </div>
                
            </div>
            
        </nav>
        
        <div class="content">
            <div class="container-fluid">
                <?php if(isset($content)){echo $content;}?>
            </div>
        </div>

    </div>
</div>


</body>

</html>