<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Ventas</title>
</head>
<body>
    <div class="container">
        <h1>Inventario</h1>
        <p>Total de ventas hechas</p>
        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=final_ppi', 'root', '');

        $sql = "SELECT * FROM compras";
        $resultado = $pdo->query($sql);
        $compras = $resultado->fetchAll(PDO::FETCH_ASSOC);

        echo "<table class=\"table\">";
        echo "<tr><th>ID Compra</th><th>ID Usuario</th><th>ID Producto</th><th>Cantidad Producto</th><th>Fecha</th><th>Total</th></tr>";

        foreach ($compras as $compra) {
            echo "<tr>";
            echo "<td>{$compra['id_compra']}</td>";
            echo "<td>{$compra['id_usuario']}</td>";
            echo "<td>{$compra['id_producto']}</td>";
            echo "<td>{$compra['cantidad_producto']}</td>";
            echo "<td>{$compra['fecha']}</td>";
            echo "<td>{$compra['total']}</td>";
            echo "</tr>";
        }

        echo "</table>";
    ?>
    <br><a href="admin.php">Regresar a inicio</a>
    </div>
</body>
</html>
