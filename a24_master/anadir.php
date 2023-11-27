<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto añadido</title>
</head>
<body>
    <?php
        $pdo = new PDO('mysql:host=localhost;dbname=final_ppi', 'root', '');

        $p_nombre = $_POST['p_nombre'];
        $descripcion = $_POST['descripcion'];
        $fotos1 = $_POST['fotos1'];
        $fotos2 = $_POST['fotos2'];
        $precio = $_POST['precio'];
        $inventario = $_POST['inventario'];
        $categoria = $_POST['categoria'];

        try {
            $sql = "INSERT INTO productos (p_nombre, descripcion, fotos1, fotos2, precio, inventario, categoria) VALUES ('$p_nombre', '$descripcion', '$fotos1', '$fotos2', $precio, $inventario, '$categoria')";
            $pdo->query($sql);
            echo "El producto se ha añadido correctamente.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>
    <br><a href="anadir_producto.php">Regresar</a>
</body>
</html>

