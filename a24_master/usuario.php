<?php 
  session_start(); 

  if (!isset($_SESSION['u_nombre'])) {
        $_SESSION['msg'] = "Tienes que iniciar sesion primero";
	  }
  if (isset($_GET['logout'])) {
        unset($_SESSION['u_nombre']);
		unset($_SESSION['cart']);
		session_destroy();
	  }
	 /* Nos conectaremos a la base de datos y agarraremos los datos de compras*/
       $DATABASE_HOST = 'localhost';
	   $DATABASE_USER = 'root';
	   $DATABASE_PASS = '';
	   $DATABASE_NAME = 'final_ppi';
	   try {
		   $pdo= new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
	   } catch (PDOException $e) {
		   // If there is an error with the connection, stop the script and display the error.
		   die("Error de conexión: " . $e->getMessage());
		}		
	   //agarramos los datos de compras y las guardamos en $datosCompras
		$sqlAgarrarCompras = "SELECT * FROM compras WHERE id_usuario = '{$_SESSION['id_usuario']}'";
		$stmtAgarrarCompras = $pdo->query($sqlAgarrarCompras);
		$datosCompras = $stmtAgarrarCompras->fetchAll(PDO::FETCH_ASSOC);
		?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Usuario</title>
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
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
							<i class="zmdi zmdi-account-circle"></i>
						</div>
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
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
					<i class="zmdi zmdi-account-circle"></i>
				</div>
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



	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Inicio
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<span class="stext-109 cl4">
				Usuario
			</span>
		</div>
	</div>


	<!-- Compras de usuario -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
		<h4 class="mtext-109 cl2 p-b-30">Tus pedidos </h4>
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
						<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-2">NO. Orden</th>
									<th class="column-5">Producto</th>
									<th class="column-2"></th>
									<th class="column-3">Cantidad</th>
									<th class="column-2">Total</th>
									<th class="column-5">Fecha</th>
								</tr>
								<?php if (empty($datosCompras)): ?>
								<tr>
									<td colspan="5" style="text-align:center;">¡No haz hecho ninguna compra! <br> <a href="product.php">Echale un vistazo a nuestros productos<a> </td>
								</tr>
								<?php else: ?>
								<?php foreach ($datosCompras as $articulo): 
									$sqlAgarrarDatosProdcucto = "SELECT p_nombre, fotos1 FROM productos WHERE id_producto = '{$articulo['id_producto']}'";
									$stmtAgarrarDatosProdcucto = $pdo->query($sqlAgarrarDatosProdcucto);
									$datosProducto = $stmtAgarrarDatosProdcucto->fetch(PDO::FETCH_ASSOC);
								?>
								<tr class="table_row">
								<td class="column-1">
											<?=$articulo['id_compra']?>
									</td>
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="<?=$datosProducto['fotos1']?>" alt="IMG">
										</div>
									</td>
									<td class="column-5">
										<?=$datosProducto['p_nombre']?>
									</td>
									<td class="column-5">
									<?=$articulo['cantidad_producto']?>	
								</td>
									<td class="column-2">
										$<?=$articulo['total']?>
									</td>
									<td class="column-5" style="font-size:10px">
										<?=$articulo['fecha']?>
									</td>
								</tr>
								<?php endforeach; ?>
                				<?php endif; ?>
							</table>
						</div>
					</div>
				</div>
			<!--Informacion de usuario-->
				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Hola <?php echo $_SESSION['u_nombre']?>
						</h4>
						<a class="header-cart-item-name m-b-18 hov-cl1 trans-04">
							Correo: <?php echo $_SESSION['correo']?>
						</a>
						<a class="header-cart-item-name m-b-18 hov-cl1 trans-04">
							Direccion: <?php echo $_SESSION['direccion']?>
						</a>
						<a class="header-cart-item-name m-b-18 hov-cl1 trans-04">
							Fecha de cumpleaños: <?php echo $_SESSION['nacimiento']?>
						</a>
						<a class="header-cart-item-name m-b-18 hov-cl1 trans-04">
							No. de tarjeta:<?php echo $_SESSION['tarjeta']?>
						</a>
						<a href="index.php?logout='1'" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								CERRAR SESIÓN
						</a>

					</div>
				</div>
			</div>
		</div>
	</form>
		
	<!-- Footer -->
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
					<a class="m-all-1">
						<img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a class="m-all-1">
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

				<p class="stext-107 cl6 txt-center">
					Programación para internet | Luis Eduardo Castillo Ortiz | Template de Colorlib | 
				</p>
			</div>
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
	<script src="js/main.js"></script>

</body>
</html>