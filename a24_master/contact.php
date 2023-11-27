<?php 
  session_start(); 
  if (!isset($_SESSION['u_nombre'])) {
        $_SESSION['msg'] = "Tienes que iniciar sesion primero";
		$_SESSION['linkusuario']="login/login.php";
  }
  if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['u_nombre']);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/a24-logo.svg"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">
	
	<!-- Header -->
	<header class="header-v2">
		<!-- Header desktop -->
		<div class="container-menu-desktop">

			<div class="wrap-menu-desktop how-shadow1">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="index.php" class="logo">
						<img src="images/icons/a24-logo.svg" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href="product.php">Productos</a>
							</li>

							<li>
								<a href="about.php">Nosotros</a>
							</li>

							<li>
								<a href="contact.php">Contacto</a>
							</li>
						</ul>
					</div>		

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
					<?php  if (isset($_SESSION['u_nombre'])) : ?>
							<a href="shopping_cart/index.php?page=cart">
								<?php else :?>
									<a href="login/login.php">
								<?php endif ?>
								<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
									<i class="zmdi zmdi-shopping-cart"></i>
								</div>
							</a>
						<?php  if (isset($_SESSION['u_nombre'])) : ?>
							<a href="usuario.php">
								<?php else :?>
							<a href="login/login.php">
								<?php endif ?>
								<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
									<i class="zmdi zmdi-account-circle"></i>
								</div>
							</a>
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="index.php"><img src="images/icons/a24-logo.svg" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
			<?php  if (isset($_SESSION['u_nombre'])) : ?>
							<a href="shopping_cart/index.php?page=cart">
								<?php else :?>
									<a href="login/login.php">
								<?php endif ?>
								<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
									<i class="zmdi zmdi-shopping-cart"></i>
								</div>
							</a>
						<?php  if (isset($_SESSION['u_nombre'])) : ?>
					<a href="usuario.php">
							<?php else :?>
					<a href="login/login.php">
							<?php endif ?>
								<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
									<i class="zmdi zmdi-account-circle"></i>
								</div>
					</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
		<ul class="main-menu-m">
				<li>
					<a href="product.php">Productos</a>
				</li>
				<li>
					<a href="about.php">Nosotros</a>
				</li>

				<li>
					<a href="contact.php">Contacto</a>
				</li>
			</ul>
		</div>
	</header>



	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/a24-contacto.jpg');">
		<h2 class="ltext-105 cl0 txt-center">
			Contacto
		</h2>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form>
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Mándanos un mensaje
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Tu correo">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="¿Cómo podemos ayudarte?"></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Enviar
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Dirección
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								A24 Headquarters 31 West 27th Street, Manhattan, New York City, United States
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Hablemos
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								(+1)78 91 32 4062
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Soporte
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								info@a24.com
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
	
	
	<!-- Map -->
	<div class="map">
		<div class="size-303" id="google_map" data-map-x="40.691446" data-map-y="-73.886787" data-pin="images/icons/pin.png" data-scrollwhell="0" data-draggable="1" data-zoom="11"></div>
	</div>

	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<footer class="bg3 p-t-75 p-b-32">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-lg-3 p-b-50">
						<h4 class="stext-301 cl0 p-b-30">
							Categorias
						</h4>
	
						<ul>
							<li class="p-b-10">
								<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
									Ropa
								</a>
							</li>
	
							<li class="p-b-10">
								<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
									Libros
								</a>
							</li>
	
							<li class="p-b-10">
								<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
									Colleccionables
								</a>
							</li>
	
							<li class="p-b-10">
								<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
									Hogar
								</a>
							</li>
						</ul>
					</div>
	
	
					<div class="col-sm-6 col-lg-3 p-b-50">
						<h4 class="stext-301 cl0 p-b-30">
							¿Dudas?
						</h4>
	
						<p class="stext-107 cl7 size-201">
							Si te quedaron dudas sobre nuestros productos, por favor no dudes contactarnos al (+1)78 91 32 4062
						</p>
	
						<div class="p-t-27">
						<a href="https://www.facebook.com/a24/?locale=es_LA" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="https://www.instagram.com/a24/" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-instagram"></i>
						</a>

						<a href="https://www.pinterest.com.mx/a24films/" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="fa fa-pinterest-p"></i>
						</a>
					</div>
					</div>
	
					<div class="col-sm-6 col-lg-3 p-b-50">
						<h4 class="stext-301 cl0 p-b-30">
							Registra tu contacto
						</h4>
	
						<form>
							<div class="wrap-input1 w-full p-b-4">
								<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
								<div class="focus-input1 trans-04"></div>
							</div>
	
							<div class="p-t-18">
								<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
									Compartir
								</button>
							</div>
						</form>
					</div>
				</div>
	
				<div class="p-t-40">
					<div class="flex-c-m flex-w p-b-18">
						<a  class="m-all-1">
							<img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
						</a>
	
						<a  class="m-all-1">
							<img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
						</a>
	
						<a class="m-all-1">
							<img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
						</a>
	
						<a class="m-all-1">
							<img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
						</a>
	
						<a class="m-all-1">
							<img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
						</a>
					</div>
					</div>
					<p class="stext-107 cl6 txt-center">
					Programación para internet | Luis Eduardo Castillo Ortiz | Template de Colorlib | 
				</p>
			</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>