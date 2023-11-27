<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desplegar</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Usuarios registrados</h1>
        <p>Lista de usuarios registrados</p>
        <?php
        $con=mysqli_connect("localhost","root","","final_ppi");

        // Check connection
        if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $result= mysqli_query($con,"SELECT * FROM usuario;");
        echo "<table class=\"table\">
        <tr>
        <th>id_usuario</th>
        <th>u_nombre</th>
        <th>correo</th>
        <th>contrasena</th>
        <th>tarjeta</th>
        <th>direccion</th>
        <th>nacimiento</th>
        </tr>";

        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id_usuario'] . "</td>";
            echo "<td>" . $row['u_nombre'] . "</td>";
            echo "<td>" . $row['correo'] . "</td>";
            echo "<td>" . $row['contrasena'] . "</td>";
            echo "<td>" . $row['tarjeta'] . "</td>";
            echo "<td>" . $row['direccion'] . "</td>";
            echo "<td>" . $row['nacimiento'] . "</td>";
            echo "</tr>";
        }
    
        echo "</table>";

        mysqli_close($con);
    ?>
    <a href="admin.php">Regresar a la pagina de inicio</a>
  </div>
</body>
</html>