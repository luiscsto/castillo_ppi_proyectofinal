<?php
session_start();

// initializing variables
$nombre="";
$correo="";
$nacimiento="";
$contrasena="";
$direccion="";
$tarjeta="";  
$errors = array(); 

//vamos a ver si se mando el formulario con el boton submit
if(isset($_POST['register'])){  
    //checamos que todos los valores esten llenos
if(!empty($_POST['nombre']) && !empty($_POST['correo']) && !empty($_POST['nacimiento']) && !empty($_POST['contrasena']) && !empty($_POST['direccion'])&& !empty($_POST['tarjeta'])){  
    $nombre=$_POST['nombre'];  
    $correo=$_POST['correo'];
    $nacimiento=$_POST['nacimiento'];
    $contrasena=$_POST['contrasena'];
    $direccion=$_POST['direccion'];
    $tarjeta=$_POST['tarjeta'];  
    $con=mysqli_connect('localhost','root',"",'final_ppi');
    //checamos si se logro la conexion
    if (mysqli_connect_errno()) {
        echo "Fallo al conectarse a la base: " . mysqli_connect_error();
      }

    $query=mysqli_query($con,"SELECT * FROM usuario WHERE correo='".$correo."'");  
    $numrows=mysqli_num_rows($query);  
    if($numrows==0)  
    {  
        $sql="INSERT INTO usuario (u_nombre, correo, contrasena, tarjeta, direccion, nacimiento) VALUES('$nombre','$correo','$contrasena','$tarjeta','$direccion','$nacimiento');";  
    
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
?>  