<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Inventario</h1>
        <p>Lista de productos registrados</p>
        <?php
        $con=mysqli_connect("localhost","root","","final_ppi");

        // Check connection
        if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $result= mysqli_query($con,"SELECT * FROM productos;");
        echo "<table class=\"table\">
        <tr>
        <th>id_producto</th>
        <th>p_nombre</th>
        <th>fotos1</th>
        <th>fotos2</th>
        <th>precio</th>
        <th>inventario</th>
        <th>categoria</th>
        </tr>";

        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id_producto'] . "</td>";
            echo "<td>" . $row['p_nombre'] . "</td>";
            echo "<td><img src=\"". $row['fotos1']."\" width=70 height=50></img></td>";
            echo "<td> <img src=\"". $row['fotos2']."\" width=70 height=50></img></td>";
            echo "<td>" . $row['precio'] . "</td>";
            echo "<td>" . $row['inventario'] . "</td>";
            echo "<td>" . $row['categoria'] . "</td>";
            echo "</tr>";
        }
    
        echo "</table>";

        mysqli_close($con);
    ?>
    <a href="index.php">Regresar a la pagina de inicio</a>
  </div>
</body>
</html>