<?php
ob_start();
include "../conexionBD.php";
include("../denegacion.php");
include("functions.php");
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['nom_usua']) || empty($_POST['email']) || empty($_POST['rol'] || empty($_POST['nombre']))) {
        $alert = '<p class="msj_error">Todos los campos son obligatorios</p>';
    } else {
        $idUsuario=$_POST['idUsuario'];
        $nombre = $_POST['nombre'];
        $nombreusua = $_POST['nom_usua'];
        $contraseña = md5(mysqli_real_escape_string($conexion, $_POST['pass_usua']));
        $email = $_POST['email'];
        $rol = $_POST['rol'];
        $query = mysqli_query($conexion, "select * from usuario inner join cliente on usuario.id_usua = cliente.id_usua where (nom_usua='$nombreusua' and usuario.id_usua != $idUsuario) or (email_clie='$email' and usuario.id_usua !=$idUsuario)");
        $resultado = mysqli_fetch_array($query);
        if ($resultado > 0) {
            $alert = '<p class="msj_error">El correo o usuario ya existen</p>';
        } else {
            if (empty($_POST[$contraseña])) {
                $sql=mysqli_query($conexion,"update usuario set nom_usua='$nombreusua', tip_usua='$rol' where id_usua='$idUsuario'");
                $sql1=mysqli_query($conexion,"update cliente set nom_clie='$nombre', email_clie='$email' where id_clie='$idUsuario'");
            }else{
                $sql=mysqli_query($conexion,"update usuario set nom_usua='$nombreusua', tip_usua='$rol',pass_usua='$contraseña' where id_usua='$idUsuario'");
                $sql1=mysqli_query($conexion,"update cliente set nom_clie='$nombre', email_clie='$email' where id_clie='$idUsuario'");
            }
            if ($sql=== true) {
                if ($sql1) {
                    $alert = '<p class="msj_save">Usuario autorizado correctamente</p>';
                }
            } else {
                $alert = '<p class="msj_error">Error al actualizar el usuario</p>';
            }
        }
    }
}

//Mostrar datos//
if (empty($_GET['id'])) {
    header('Location:listausuarios.php');
}
$iduser = $_GET['id'];
$sql = mysqli_query($conexion, "select usuario.id_usua,nom_clie,email_clie,nom_usua,tip_usua from usuario inner join cliente on usuario.id_usua=cliente.id_usua where usuario.id_usua=$iduser");
$result = mysqli_num_rows($sql);
if ($result == 0) {
    header('Location:listausuarios.php');
}else{
    $option='';
    while($data=mysqli_fetch_array($sql)){
        $iduser=$data['id_usua'];
        $nombre=$data['nom_clie'];
        $email=$data['email_clie'];
        $usuario=$data['nom_usua'];
        $rol=$data['tip_usua'];
    }
    if ($rol=="administrador") {
        $option = '<option value="'.$rol.'" select>Administrador</option>';
    }else if ($rol=="cliente") {
        $option = '<option value="'.$rol.'" select>Cliente</option>';  
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASJ Technology</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="icon" href="../img/logo.ico">
    <link rel="stylesheet" href="../css/styleadministrador.css">
</head>

<body>
    <?php include "header.php"; ?>
    <section class="container">
        <div class="form_registerUsua">
            <h1 class="text-prin">Actualizar usuario</h1>
            <hr>
            <div class="alert"><?php print(isset($alert) ? $alert : '') ?></div>
            <form action="editar_usuario.php" method="post">
                <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre?>">
                <label for="nom_usua">Nombre del usuario</label>
                <input type="text" name="nom_usua" id="nom_usua" placeholder="Nombre de usuario" value="<?php echo $usuario?>">
                <label for="pass_usua">Contraseña</label>
                <input type="password" name="pass_usua" id="pass_usua" placeholder="Contraseña">
                <label for="email">Correo electronico</label>
                <input type="email" name="email" id="email" placeholder="Correo electronico" value="<?php echo $email?>">
                <label for="tip_usua">Tipo de usuario</label>
                <select name="rol" id="rol" class="notItemOne ">
                    <?php 
                        echo $option; 
                    ?>
                    <option value="administrador">Administrador</option>
                    <option value="cliente">Cliente</option>
                </select>
                <input type="submit" class="btn_save" value="Actualizar usuario">
            </form>
        </div>
    </section>
    <?php include "footer.php"; ?>
</body>
<?php ob_end_flush(); ?>