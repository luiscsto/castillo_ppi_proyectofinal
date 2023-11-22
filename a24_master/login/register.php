<?php include ('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Registrarse</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../images/icons/a24-logo.svg"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="register.php" method="post">
					<span class="login100-form-title p-b-26">
						Unete a la familia
					</span>
					<span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-account-circle"></i>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Ingresa un nombre">
						<input class="input100" type="text" name="nombre">
						<span class="focus-input100" data-placeholder="Nombre"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Un email valido es: a@b.c">
						<input class="input100" type="text" name="correo">
						<span class="focus-input100" data-placeholder="E-mail"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Ingrese una fecha">
						<input class="input100" type="date" name="nacimiento">
						<span class="focus-input100" data-placeholder="Fecha de nacimiento"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Ingrese una contraseña">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="contrasena">
						<span class="focus-input100" data-placeholder="Contraseña"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Ingrese una direccion">
						<input class="input100" type="text" name="direccion">
						<span class="focus-input100" data-placeholder="Direccion"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Ingrese un numero de tarjeta">
						<input class="input100" type="number" name="tarjeta">
						<span class="focus-input100" data-placeholder="Tarjeta"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" name="register">
								Registrarse
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							¿Ya tienes cuenta?
						</span>

						<a class="txt2" href="signup.php">
							Inicia sesion
						</a>
						<br>
						<a class="txt2" href="../index.php">
							Regresar al Inicio
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>