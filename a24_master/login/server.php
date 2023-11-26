<?php
session_start();

// initializing variables
$id_usuario="";
$u_nombre="";
$correo="";
$nacimiento="";
$contrasena="";
$direccion="";
$tarjeta="";  
$errors = array(); 

$con=mysqli_connect('localhost','root',"",'final_ppi');

//vamos a ver si se mando el formulario con el boton submit
if(isset($_POST['register'])){  
    //checamos que todos los valores esten llenos
if(!empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['nacimiento']) && !empty($_POST['contrasena']) && !empty($_POST['direccion'])&& !empty($_POST['tarjeta'])){  
    $u_nombre=$_POST['nombre'];  
    $correo=$_POST['correo'];
    $nacimiento=$_POST['nacimiento'];
    $contrasena=$_POST['contrasena'];
    $direccion=$_POST['direccion'];
    $tarjeta=$_POST['tarjeta'];  
    //checamos si se logro la conexion
    if (mysqli_connect_errno()) {
        echo "Fallo al conectarse a la base: " . mysqli_connect_error();
      }

    $query=mysqli_query($con,"SELECT * FROM usuario WHERE correo='".$correo."'");  
    $numrows=mysqli_num_rows($query);  
    if($numrows==0)  
    {  
        $sql="INSERT INTO usuario (u_nombre, correo, contrasena, tarjeta, direccion, nacimiento) VALUES('$u_nombre','$correo','$contrasena','$tarjeta','$direccion','$nacimiento');";  
    
        $result=mysqli_query($con,$sql);  
            if($result){  
        echo "Account Successfully Created";
        } else {  
        echo "Failure!";
        }  
    } else {  
    echo "Ese correo ya fue tomado.";  
    }  

} else {
    echo "Se requieren todos los campos.";  
}
}


// LOGIN USER
if (isset($_POST['login_user'])) {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
  
    if (empty($correo)) {
          array_push($errors, "Se requiere un correo");
    }
    if (empty($contrasena)) {
          array_push($errors, "Se requiere una contraseña");
    }
  
    if (count($errors) == 0) {
          $query = "SELECT * FROM usuario WHERE correo='$correo' AND contrasena='$contrasena'";
          //guardamos el query que trae los datos del usuario
          $result = mysqli_query($con, $query);
       
          //obtenemos las distintas rows para sacar datos del query,
          //iniciamos sesion y redirigimos a la pagina de inicio
          $row= mysqli_fetch_row($result);
          if (mysqli_num_rows($result) == 1) {
            $_SESSION['id_usuario'] = $row[0];
            $_SESSION['u_nombre'] = $row[1];
            $_SESSION['correo'] = $row[2];
            $_SESSION['contrasena'] = $row[3];
            $_SESSION['tarjeta'] = $row[4];
            $_SESSION['direccion'] = $row[5];
            $_SESSION['nacimiento'] = $row[6];
            $_SESSION['success'] = "¡Inicio de sesion exitoso!";
            $_SESSION['linkusuario'] = "usuario.php";
            header('location: ../usuario.php');
          }else {
                  array_push($errors, "Verifique sus datos de acceso");
          }
    }
  }  
?>  