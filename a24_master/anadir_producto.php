<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir producto</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
    <form method="post" action="anadir.php" class="form">
        <label for="p_nombre">Nombre:</label><br>
        <input type="text" id="p_nombre" name="p_nombre" required><br>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" required></textarea><br>
        <label for="fotos1">Foto 1:</label><br>
        <input type="text" id="fotos1" name="fotos1" required><br>
        <label for="fotos2">Foto 2:</label><br>
        <input type="text" id="fotos2" name="fotos2" required><br>
        <label for="precio">Precio:</label><br>
        <input type="number" id="precio" name="precio" required><br>
        <label for="inventario">Inventario:</label><br>
        <input type="number" id="inventario" name="inventario" required><br>
        <label for="categoria">Categoría:</label><br>
        <input type="text" id="categoria" name="categoria" required><br>
        <input type="submit" value="Añadir">
    </form>
    <br><a href="index.html">Regresar a inicio</a>
</div>
</body>
</html>