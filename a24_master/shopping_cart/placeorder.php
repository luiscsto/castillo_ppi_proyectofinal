<?php
    //recuperamos los datos del carrito del usuario a través del id del usuario
    $sqlAgarrarCarrito = "SELECT * FROM carritos WHERE id_usuario = '{$_SESSION['id_usuario']}'";
    $stmtAgarrarCarrito = $pdo->query($sqlAgarrarCarrito);
    $datosCarrito = $stmtAgarrarCarrito->fetchAll(PDO::FETCH_ASSOC);
    //agarramos la fecha de la orden
    $fecha = date('Y-m-d H:i:s');
    if ($datosCarrito) {
        //recorreremos todo nuestro arreglo $datosCarrito
        foreach ($datosCarrito as $elementoCarrito) {
            $id_usuario = $_SESSION['id_usuario'];
            $id_producto = $elementoCarrito['id_producto'];
            $cantidad = $elementoCarrito['cantidad'];
            $total = $elementoCarrito['total'];
        
            //Insertar en la tabla de compras
            $sqlInsert = "INSERT INTO compras (id_usuario, id_producto, cantidad_producto, total, fecha) VALUES (?, ?, ?, ?, '$fecha')";
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->execute([$id_usuario, $id_producto, $cantidad, $total]);
            
            //Reducir el inventario
			$sql = "UPDATE productos SET inventario = inventario - $cantidad WHERE id_producto = '$id_producto'";
			$actualizacion=$pdo->exec($sql);
            if ($actualizacion !== false) {
                echo "Cambio exitoso";
            } else {
                echo "Error al cambiar datos: " . $pdo->errorInfo()[2];
            }

            //Verificar el resultado de la inserción
            if ($stmtInsert !== false) {
                echo "Inserción exitosa para el producto con ID $id_producto<br>";
            } else {
                echo "Error al insertar datos para el producto con ID $id_producto: " . $stmtInsert->errorInfo()[2] . "<br>";
            }
        }
        // Eliminar datos del carrito del usuario
        $sqlBorrarCarrtio = "DELETE FROM carritos WHERE id_usuario = '{$_SESSION['id_usuario']}'";
        $pdo->exec($sqlBorrarCarrtio);
    }    
    unset($_SESSION['cart']);
    header('location: ../usuario.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden realizada</title>
</head>
<body>
<div class="placeorder content-wrapper">
    <h1>Your Order Has Been Placed</h1>
    <p>Thank you for ordering with us! We'll contact you by email with your order details.</p>
</div>
</body>
</html>




