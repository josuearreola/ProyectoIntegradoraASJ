<?php
ob_start();
include("../denegacion.php");
include("functions.php");
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
    <?php include "header.php";?>
    <section class="container">
        <div class="form_registerClie">
            <h1>Registro cliente</h1>
            <hr>
            <div class="alert"></div>
            <form action="" method="post" >
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre">

                <label for="nombre">Apellido paterno</label>
                <input type="text" name="nombre" id="nombre" placeholder="Apellido p">

                <label for="nombre">Apelldio Materno</label>
                <input type="text" name="nombre" id="nombre" placeholder="Apellido M">

                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" id="telefono" placeholder="Telefono">

                <label for="rfc">RFC</label>
                <input type="text" name="rfc" id="rfc" placeholder="RFC">

                <label for="direccion" id="direccion">Direccion</label>
                <input type="checkbox" id="direccion">
                <div class="direccion">
                        <label for="colonia">Colonia</label>
                        <input type="text" name="colonia" id="colonia" placeholder="Colonia">
                        <label for="calle">Calle</label>
                        <input type="text" name="calle" id="calle" placeholder="calle">
                        <label for="cp">CP</label>
                        <input type="text" name="cp" id="cp" placeholder="Codigo Postal">
                        <label for="ni">Numero de interior</label>
                        <input type="text" name="ni" id="ni" placeholder="Numero de exterior">
                        <label for="ne">Numero de exterior</label>
                        <input type="text" name="ne" id="ne" placeholder="Numero de exterior">
                </div>
                <input type="submit" class="btn_save" value="Crear cliente">
            </form>
        </div>
    </section>

    <?php include "footer.php";?>
</body>

</html>
<?php ob_end_flush(); ?>