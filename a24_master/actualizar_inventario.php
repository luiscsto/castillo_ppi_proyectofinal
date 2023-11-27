<?php
    $pdo = new PDO('mysql:host=localhost;dbname=final_ppi', 'root', '');

    $sql = "SELECT * FROM productos";
    $resultado = $pdo->query($sql); 
    $productos = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar inventario</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <form method="post" action="actualizar.php" class="form">
            <label for="producto">Producto:</label><br>
            <select id="producto" name="producto">
                <?php foreach ($productos as $producto): ?>
                    <option value="<?php echo $producto['id_producto']; ?>"><?php echo $producto['p_nombre']; ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre"><br>
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion"></textarea><br>
            <label for="fotos1">Foto 1:</label><br>
            <input type="text" id="fotos1" name="fotos1"><br>
            <label for="fotos2">Foto 2:</label><br>
            <input type="text" id="fotos2" name="fotos2"><br>
            <label for="precio">Precio:</label><br>
            <input type="number" id="precio" name="precio"><br>
            <label for="inventario">Inventario:</label><br>
            <input type="number" id="inventario" name="inventario"><br>
            <label for="categoria">Categoría:</label><br>
            <input type="text" id="categoria" name="categoria"><br>
            <input type="submit" value="Actualizar">
        </form>
        <a href="index.php">Regresar a inicio</a>
    </div>
</body>
</html>


