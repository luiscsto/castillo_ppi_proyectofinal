<?php 
  //determinar a donde lleva el boton de usuario
  if (!isset($_SESSION['u_nombre'])) {
		$_SESSION['linkusuario']="../login/login.php";
  }
  if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['u_nombre']);
  }

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['id_producto'], $_POST['cantidad']) && is_numeric($_POST['id_producto']) && is_numeric($_POST['cantidad'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $id_producto = (int)$_POST['id_producto'];
	$cantidad = (int)$_POST['cantidad'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM productos WHERE id_producto = ?');
    $stmt->execute([$_POST['id_producto']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $cantidad > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($id_producto, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
				//actualizamos la tabla del carrito
                $_SESSION['cart'][$id_producto] += $cantidad;
				$elprecio=(float)$product['precio'] * (int)$_SESSION['cart'][$id_producto];
				$sql = "UPDATE carritos SET cantidad = '{$_SESSION['cart'][$id_producto]}', total = '$elprecio' WHERE id_usuario = '{$_SESSION['id_usuario']}' AND id_producto = '$id_producto'";
				$actualizacion=$pdo->exec($sql);
				if ($actualizacion !== false) {
					echo "Cambio exitoso";
				} else {
					echo "Error al cambiar datos: " . $pdo->errorInfo()[2];
				}
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$id_producto] = $cantidad;
				//insertamos el producto en el carrito
				$elprecio=(float)$product['precio'] * (int)$cantidad;
				$sql="INSERT INTO carritos (id_usuario, id_producto, cantidad, total) VALUES ('{$_SESSION['id_usuario']}', '$id_producto', '$cantidad','$elprecio')";
				$insercion=$pdo->exec($sql);
				if ($insercion !== false) {
					echo "Inserción exitosa";
				} else {
					echo "Error al insertar datos: " . $pdo->errorInfo()[2];
				}
            }
        } else {
            // There are no products in cart, this will add the first product to cart
			//insertamos el producto en el carrito
            $_SESSION['cart'] = array($id_producto => $cantidad);
			$elprecio=(float)$product['precio'] * (int)$cantidad;
			$sql="INSERT INTO carritos (id_usuario, id_producto, cantidad, total) VALUES ('{$_SESSION['id_usuario']}', '$id_producto', '$cantidad','$elprecio')";
			$insercion=$pdo->exec($sql);
			if ($insercion !== false) {
				echo "Inserción exitosa";
			} else {
				echo "Error al insertar datos: " . $pdo->errorInfo()[2];
			}
        }

    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
	//lo eliminamos de la base de datos
	$sql = "DELETE FROM carritos WHERE id_usuario = '{$_SESSION['id_usuario']}' AND id_producto = '{$_GET['remove']}'";
    $pdo->exec($sql);
    unset($_SESSION['cart'][$_GET['remove']]);
}
// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'cantidad') !== false && is_numeric($v)) {
            $id_producto = str_replace('cantidad-', '', $k);
            $cantidad = (int)$v;
            // Always do checks and validation
            if (is_numeric($id_producto) && isset($_SESSION['cart'][$id_producto]) && $cantidad > 0) {
                // Update new cantidad
				//primero recuperamos el precio consultandolo en la base de datos
				$con=mysqli_connect('localhost','root',"",'final_ppi');
				$query = "SELECT precio FROM productos WHERE id_producto='$id_producto'";
				//guardamos el query que trae los datos del precio del producto
				$result = mysqli_query($con, $query);
				//obtenemos la row que nos dio para recuperar el precio
				$row= mysqli_fetch_row($result);
				if (mysqli_num_rows($result) == 1) {
					$precio =(int)$row[0];
				}
				//asignamos el nuevo valor de cantidad 
                $_SESSION['cart'][$id_producto] = $cantidad;
				$elprecio= $precio * (int)$cantidad;
				$sql = "UPDATE carritos SET cantidad = '{$_SESSION['cart'][$id_producto]}', total = '$elprecio' WHERE id_usuario = '{$_SESSION['id_usuario']}' AND id_producto = '$id_producto'";
				$actualizacion=$pdo->exec($sql);
				if ($actualizacion !== false) {
					echo "Cambio exitoso";
				} else {
					echo "Error al cambiar datos: " . $pdo->errorInfo()[2];
				}
            }
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}
// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: index.php?page=placeorder');
    exit;

}
// Check the session variable for products in cart
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM productos WHERE id_producto IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float)$product['precio'] * (int)$products_in_cart[$product['id_producto']];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shoping Cart</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../images/icons/a24-logo.svg"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
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
					<a href="../index.php" class="logo">
						<img src="../images/icons/a24-logo.svg" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href="../product.php">Productos</a>
							</li>

							<li>
								<a href="../about.php">Nosotros</a>
							</li>

							<li>
								<a href="../contact.php">Contacto</a>
							</li>
						</ul>
					</div>		

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
						<?php  if (isset($_SESSION['u_nombre'])) : ?>
							<a href="../usuario.php">
								<?php else :?>
							<a href="../login/login.php">
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
				<a href="../index.php"><img src="../images/icons/a24-logo.svg" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10  js-show-cart">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>
						<?php  if (isset($_SESSION['u_nombre'])) : ?>
					<a href="../usuario.php">
						<?php else :?>
					<a href="../login/login.php">
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
					<a href="../product.php">Productos</a>
				</li>


				<li>
					<a href="../about.php">Nosotros</a>
				</li>

				<li>
					<a href="../contact.php">Contacto</a>
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
				Carrito de compras
			</span>
		</div>
	</div>


	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85" action="index.php?page=cart" method="post">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Producto</th>
									<th class="column-2"></th>
									<th class="column-3">Precio</th>
									<th class="column-4">Cantidad</th>
									<th class="column-5">Total</th>
								</tr>
								<?php if (empty($products)): ?>
								<tr>
									<td colspan="5" style="text-align:center;">No hay productos en tu carrito! <br> <a href="../product.php">Echales un vistazo<a> </td>
								</tr>
								<?php else: ?>
								<?php foreach ($products as $product): ?>
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="../<?=$product['fotos1']?>" alt="IMG">
										</div>
									</td>
									<td class="column-2">
										<?=$product['p_nombre']?> <br>
										<a href="index.php?page=cart&remove=<?=$product['id_producto']?>" class="remove" style="color:#B91515">Eliminar</a>
									</td>
									<td class="column-3">$<?=$product['precio']?></td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="cantidad-<?=$product['id_producto']?>" value="<?=$products_in_cart[$product['id_producto']]?>" min="1" max="<?=$product['inventario']?>" required>

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5 precio">$<?=$product['precio'] * $products_in_cart[$product['id_producto']]?></td>
								</tr>
								<?php endforeach; ?>
                				<?php endif; ?>
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
						<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" type="submit" name="update">
							Actualizar carrito
						</button>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cuenta del carrito
						</h4>
						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1 subtotal">
								<span class="mtext-110 cl2 precio">
									$<?=$subtotal?>
								</span>
							</div>
						</div>

						<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" name="placeorder" type="submit">
							Pagar
						</button>
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
						<img src="../images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a class="m-all-1">
						<img src="../images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a class="m-all-1">
						<img src="../images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a class="m-all-1">
						<img src="../images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a class="m-all-1">
						<img src="../images/icons/icon-pay-05.png" alt="ICON-PAY">
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
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="../vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
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
	<script src="../js/main.js"></script>

</body>
</html>