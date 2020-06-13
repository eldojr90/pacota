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

    <script src="./assets/js/el-login.js"></script>
	
    

</head>
<body>
    <div class='col-md-4'></div>
    <div class='col-md-4'>
        
        <div id="dp" class="dprincipal" align="center">
        
            <h3>Bem vindo a Pacota!</h3>
            <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input id="email" type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            placeholder="E-mail"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            placeholder="Senha"
                            name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                    {{ __('Entrar') }}
                                </button>
                        </div>
                    </form>
            <hr/>

        </div>

        <div class='col-md-4'></div>

</body>

</html>
