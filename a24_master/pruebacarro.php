<?php 
  session_start(); 
  //determinar a donde lleva el boton de usuario
  if (!isset($_SESSION['u_nombre'])) {
		$_SESSION['linkusuario']="login/login.php";
  }
  if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['u_nombre']);
  }

  //conexion pdo a la base de datos
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'final_ppi';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}

$pdo = pdo_connect_mysql();


// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['id_producto'], $_POST['cantidad']) && is_numeric($_POST['id_producto']) && is_numeric($_POST['cantidad'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
    $id_producto = (int)$_POST['id_producto'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $pdo->prepare('SELECT * FROM producto WHERE id_producto = ?');
    $stmt->execute([$_POST['id_producto']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if ($product && $cantidad > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($id_producto, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$id_producto] += $cantidad;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$id_producto] = $cantidad;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($id_producto => $cantidad);
        }
    }
    // Prevent form resubmission...
    header('location: shopping-cart.php');
    exit;
}
// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'cantidad') !== false && is_numeric($v)) {
            $id = str_replace('cantidad-', '', $k);
            $cantidad = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $cantidad > 0) {
                // Update new cantidad
                $_SESSION['cart'][$id] = $cantidad;
            }
        }
    }
    // Prevent form resubmission...
    header('location: shopping-cart.php');
    exit;
}
// Send the user to the place order page if they click the Place Order button, also the cart should not be empty
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    header('Location: shopping-cart.php');
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba carro</title>
</head>
<body>
<?php if (empty($products)): ?>
    <p>Esta vacio! </p>
    <?php else: ?>
    <p>LOCASS : <?=$subtotal?><p>
    <?php endif; ?>
</body>
</html>