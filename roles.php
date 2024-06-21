<?php 
session_start();
ob_start();
include("conexionBD.php");
if (isset($_SESSION["idUsua"])) {
$sesion = $_SESSION['idUsua'];
$datos= mysqli_query($conexion,"select * from usuario where nom_usua='$sesion'");

while($consulta=mysqli_fetch_array($datos)){
    $rol=$consulta['tip_usua'];

}
mysqli_close($conexion);
if($rol== 'administrador'){
    include('administrador/administrador.php');
    include('cliente/cliente.php');
    header('location: administrador/administrador.php');
    exit();
}elseif($rol == 'cliente'){
    include('cliente/cliente.php');
    header('location: cliente/cliente.php');
    exit();
}
}

session_destroy();
ob_end_flush();
?>