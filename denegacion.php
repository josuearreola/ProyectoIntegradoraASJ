<?php 
ob_start();
session_start();
include("conexionBD.php");
$sesion = $_SESSION['idUsua'];
$datos= mysqli_query($conexion,"select * from usuario where nom_usua='$sesion'");
while($consulta=mysqli_fetch_array($datos)){
    $rol=$consulta['tip_usua'] ?? '';
}
if($rol == "cliente"){
    print('<script>
    alert("No tienes acceso");
    location.href= "../cliente/cliente.php";
    </script>');
   
    exit();  
}
ob_end_flush();
?>
