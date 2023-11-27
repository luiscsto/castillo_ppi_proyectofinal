<?php
    $pdo = new PDO('mysql:host=localhost;dbname=final_ppi', 'root', '');

    $campos = [];
    if (!empty($_POST['nombre'])) {
        $campos[] = "p_nombre = '{$_POST['nombre']}'";
    }
    if (!empty($_POST['descripcion'])) {
        $campos[] = "descripcion = '{$_POST['descripcion']}'";
    }
    if (!empty($_POST['fotos1'])) {
        $campos[] = "fotos1 = '{$_POST['fotos1']}'";
    }
    if (!empty($_POST['fotos2'])) {
        $campos[] = "fotos2 = '{$_POST['fotos2']}'";
    }
    if (!empty($_POST['precio'])) {
        $campos[] = "precio = {$_POST['precio']}";
    }
    if (!empty($_POST['inventario'])) {
        $campos[] = "inventario = {$_POST['inventario']}";
    }
    if (!empty($_POST['categoria'])) {
        $campos[] = "categoria = '{$_POST['categoria']}'";
    }

    $id_producto = $_POST['producto']; // Este es el ID del producto que se va a actualizar

    try {
        $sql = "UPDATE productos SET " . implode(', ', $campos) . " WHERE id_producto = $id_producto";
        $pdo->query($sql);
        echo "Los datos se han actualizado correctamente.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizacion</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
    <br><a href="actualizar_inventario.php">Regresar</a>
</body>
</html>
