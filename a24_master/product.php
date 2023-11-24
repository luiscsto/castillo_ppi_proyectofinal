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
	<title>Product</title>
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
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<?php
	// Start the session
    session_start();

	//creo la variable de conexion a la base de datos 
	$con=mysqli_connect("localhost","root","","final_ppi");

        // Check connection
        if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
		//guardamos en la variable resultdequery la query de la conexiona la base de datos
		$resultdequery = mysqli_query($con,"SELECT * FROM productos;");
	?>
<body class="animsition">
	
	<!-- Header -->
	<header class="header-v2">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop">
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
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2"> <!-- aquí pondremos el counter del carrito -->
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
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
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>
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
	<!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Tu carrito
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-01.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								White Shirt Pleat
							</a>

							<span class="header-cart-item-info">
								1 x $19.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-02.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Converse All Star
							</a>

							<span class="header-cart-item-info">
								1 x $39.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-03.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Nixon Porter Leather
							</a>

							<span class="header-cart-item-info">
								1 x $17.00
							</span>
						</div>
					</li>
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $75.00
					</div>

					<div class="header-cart-buttons flex-w w-full">

						<a href="shoping-cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 cl6 hov-cl2 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						Todos los productos
					</button>

					<button class="stext-106 cl6 hov-cl2 bor3 trans-04 m-r-32 m-tb-5" data-filter=".ropa">
						Ropa
					</button>

					<button class="stext-106 cl6 hov-cl2 bor3 trans-04 m-r-32 m-tb-5" data-filter=".coleccionables">
						Coleccionables
					</button>

					<button class="stext-106 cl6 hov-cl2 bor3 trans-04 m-r-32 m-tb-5" data-filter=".libros">
						Libros
					</button>

					<button class="stext-106 cl6 hov-cl2 bor3 trans-04 m-r-32 m-tb-5" data-filter=".hogar">
						Hogar
					</button>
				</div>
				
			</div>

			<div class="row isotope-grid">
				<?php
					//vamos a recorrer los resultados que obtuvimos de la busqueda por rows 
					while($row = mysqli_fetch_array($resultdequery)) {
						//guardamos lo resultados en diferentes variables
						$id_producto = $row['id_producto'];
						$p_nombre = $row['p_nombre'];
						$descripcion = $row['descripcion'];
						$fotos1 = $row['fotos1'];
						$fotos2 = $row['fotos2'];
						$precio = $row['precio'];
						$inventario = $row['inventario'];
						$categoria = $row['categoria'];
						echo "<div class=\"col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ".$categoria."\">";
							echo "<!-- Block2 -->";
							echo "<div class=\"block2\">";
								echo "<div class=\"block2-pic hov-img0\">";
									echo "<img src=\"".$row['fotos1']."\" alt=\"IMG-PRODUCT\">";

									echo "<a href=\"#\" class=\"block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1\">";
										echo "Vistazo";
									echo "</a>";
								echo "</div>";

								echo "<div class=\"block2-txt flex-w flex-t p-t-14\">";
									echo "<div class=\"block2-txt-child1 flex-col-l\">";
										echo "<a href=\"product-detail.php?id=".$row['id_producto']."\" class=\"stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6\">";
											echo "".$row['p_nombre']."";
										echo "</a>";

										echo "<span class=\"stext-105 cl3\">";
											echo "$".$row['precio']."";
										echo "</span>";
									echo "</div>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
						
						echo "<!-- Modal1 -->
							<div class=\"wrap-modal1 js-modal1 p-t-60 p-b-20\">
								<div class=\"overlay-modal1 js-hide-modal1\"></div>

								<div class=\"container\">
									<div class=\"bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent\">
										<button class=\"how-pos3 hov3 trans-04 js-hide-modal1\">
											<img src=\"images/icons/icon-close.png\" alt=\"CLOSE\">
										</button>

										<div class=\"row\">
											<div class=\"col-md-6 col-lg-7 p-b-30\">
												<div class=\"p-l-25 p-r-30 p-lr-0-lg\">
													<div class=\"wrap-slick3 flex-sb flex-w\">
														<div class=\"wrap-slick3-dots\"></div>
														<div class=\"wrap-slick3-arrows flex-sb-m flex-w\"></div>

														<div class=\"slick3 gallery-lb\">
															<div class=\"item-slick3\" data-thumb=\"$fotos1\">
																<div class=\"wrap-pic-w pos-relative\">
																	<img src=\"$fotos1\" alt=\"IMG-PRODUCT\">

																	<a class=\"flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04\" href=\"$fotos1\">
																		<i class=\"fa fa-expand\"></i>
																	</a>
																</div>
															</div>

															<div class=\"item-slick3\" data-thumb=\"$fotos2\">
																<div class=\"wrap-pic-w pos-relative\">
																	<img src=\"$fotos2\" alt=\"IMG-PRODUCT\">

																	<a class=\"flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04\" href=\"$fotos2\">
																		<i class=\"fa fa-expand\"></i>
																	</a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<div class=\"col-md-6 col-lg-5 p-b-30\">
												<div class=\"p-r-50 p-t-5 p-lr-0-lg\">
													<h4 class=\"mtext-105 cl2 js-name-detail p-b-14\">
														Lightweight Jacket
													</h4>

													<span class=\"mtext-106 cl2\">
														$58.79
													</span>

													<p class=\"stext-102 cl3 p-t-23\">
														Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
													</p>
													
													<!--  -->
													<div class=\"p-t-33\">
														<div class=\"flex-w flex-r-m p-b-10\">
															<div class=\"size-203 flex-c-m respon6\">
																Size
															</div>

															<div class=\"size-204 respon6-next\">
																<div class=\"rs1-select2 bor8 bg0\">
																	<select class=\"js-select2\" name=\"time\">
																		<option>Choose an option</option>
																		<option>Size S</option>
																		<option>Size M</option>
																		<option>Size L</option>
																		<option>Size XL</option>
																	</select>
																	<div class=\"dropDownSelect2\"></div>
																</div>
															</div>
														</div>

														<div class=\"flex-w flex-r-m p-b-10\">
															<div class=\"size-203 flex-c-m respon6\">
																Color
															</div>

															<div class=\"size-204 respon6-next\">
																<div class=\"rs1-select2 bor8 bg0\">
																	<select class=\"js-select2\" name=\"time\">
																		<option>Choose an option</option>
																		<option>Red</option>
																		<option>Blue</option>
																		<option>White</option>
																		<option>Grey</option>
																	</select>
																	<div class=\"dropDownSelect2\"></div>
																</div>
															</div>
														</div>

														<div class=\"flex-w flex-r-m p-b-10\">
															<div class=\"size-204 flex-w flex-m respon6-next\">
																<div class=\"wrap-num-product flex-w m-r-20 m-tb-10\">
																	<div class=\"btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m\">
																		<i class=\"fs-16 zmdi zmdi-minus\"></i>
																	</div>

																	<input class=\"mtext-104 cl3 txt-center num-product\" type=\"number\" name=\"num-product\" value=\"1\">

																	<div class=\"btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m\">
																		<i class=\"fs-16 zmdi zmdi-plus\"></i>
																	</div>
																</div>

																<button class=\"flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail\">
																	Add to cart
																</button>
															</div>
														</div>	
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>";
					}
				?>
			</div>
		</div>
	</div>
		

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
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

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
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	
	</script>
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