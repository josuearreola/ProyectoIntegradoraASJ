<?php
ob_start();
include "../conexionBD.php";
include("../denegacion.php");
include("functions.php");
if (!empty($_POST)) {
    $alert='';
    if (empty($_POST['nom_usua']) || empty($_POST['pass_usua']) || empty($_POST['email']) || empty($_POST['rol'])) {
        $alert= '<p class="msj_error">Todos los campos son obligatorios</p>';
    }else{
        $nombre=$_POST['nombre'];
        $nombreusua=$_POST['nom_usua'];
        $contraseña=md5(mysqli_real_escape_string($conexion,$_POST['pass_usua']));
        $email=$_POST['email'];
        $rol=$_POST['rol'];
        $query=mysqli_query($conexion,"select * from usuario inner join cliente on usuario.id_usua = cliente.id_usua where nom_usua='$nombreusua' or email_clie='$email'");
        $resultado=mysqli_fetch_array($query);
        if ($resultado>0) {
            $alert='<p class="msj_error">El correo o usuario ya existen</p>';
        }else{
        $query_insert=mysqli_query($conexion,"insert into usuario (nom_usua,tip_usua,pass_usua) values('$nombreusua','$rol','$contraseña')");
        if ($query_insert ===true) {
            $id_usua=$conexion->insert_id;
            $query_insert2=mysqli_query($conexion,"insert into cliente (nom_clie,email_clie,id_usua) values('$nombre','$email','$id_usua')");
            if ($query_insert2) {
                $alert='<p class="msj_save">Usuario creado correctamente</p>';
            }
        }else{
            $alert='<p class="msj_error">Error al crear el usuario</p>';
        }
        }
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
            <h1 class="text-prin">Registro usuario</h1>
            <hr>
            <div class="alert"><?php print(isset($alert) ? $alert : '')?></div>
            <form action="registrousuario.php" method="post">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre">
                <label for="nom_usua">Nombre del usuario</label>
                <input type="text" name="nom_usua" id="nom_usua" placeholder="Nombre de usuario">
                <label for="pass_usua">Contraseña</label>
                <input type="password" name="pass_usua" id="pass_usua" placeholder="Contraseña">
                <label for="email">Correo electronico</label>
                <input type="email" name="email" id="email" placeholder="Correo electronico">
                <label for="tip_usua">Tipo de usuario</label>
                <select name="rol" id="rol">
                    <option value="administrador">Administrador</option>
                    <option value="cliente">Cliente</option>
                </select>
                <input type="submit" class="btn_save" value="Crear usuario">
            </form>
        </div>
    </section>
    <?php include "footer.php";?>
</body>