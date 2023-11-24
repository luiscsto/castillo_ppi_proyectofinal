<?php 
  session_start(); 

  if (!isset($_SESSION['u_nombre'])) {
        $_SESSION['msg'] = "Tienes que iniciar sesion primero";
/*         header('location: sesiones.php');
*/  }
  if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['u_nombre']);
/*         header("location: sesiones.php");
 */  }
?>
<!DOCTYPE html>
<html>
<head>
        <title>Sesion</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
        <h2>Pagina de sesiones</h2>
</div>
<div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
          ?>
        </h3>
      </div>
        <?php 
        else :
            echo $_SESSION['msg'];
        endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['u_nombre'])) : ?>
        <p>Bienvenidx <strong><?php echo $_SESSION['u_nombre']; ?></strong></p>
        <p> <a href="sesiones.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
      <a href="../index.php">Regresar a inicio</a>          
</body>
</html>