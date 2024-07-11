<?php
ob_start();
include "../conexionBD.php";
include("../denegacion.php");
if(empty($_SESSION['idUsua'])){
    header('location:../inicioSesion/iniciosesion.php');
}
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['nom_usua']) || empty($_POST['email']) || empty($_POST['rol'])) {
        $alert = '<p class="msj_error">Todos los campos son obligatorios</p>';
    } else {
        $idUsuario=$_POST['idUsuario'];
        $nombre = $_POST['nombre'];
        $nombreusua = $_POST['nom_usua'];
        $email = $_POST['email'];
        $rol = $_POST['rol'];
        $query = mysqli_query($conexion, "select * from usuario inner join cliente on usuario.id_usua = cliente.id_usua where (nom_usua='$nombreusua' and usuario.id_usua != $idUsuario) or (email_clie='$email' and usuario.id_usua !=$idUsuario)");
        $resultado = mysqli_fetch_array($query);
        if ($resultado > 0) {
            $alert = '<p class="msj_error">El correo o usuario ya existen</p>';
        } else {
            if (empty($_POST['pass_usua'])) {
                $sql = mysqli_query($conexion, "update usuario set nom_usua='$nombreusua', tip_usua='$rol' where id_usua='$idUsuario'");
                $sql1 = mysqli_query($conexion, "update cliente set nom_clie='$nombre', email_clie='$email' where id_clie='$idUsuario'");
            } else {
                $contraseña = md5(mysqli_real_escape_string($conexion, $_POST['pass_usua']));
                $sql = mysqli_query($conexion, "update usuario set nom_usua='$nombreusua', tip_usua='$rol', pass_usua='$contraseña' where id_usua='$idUsuario'");
                $sql1 = mysqli_query($conexion, "update cliente set nom_clie='$nombre', email_clie='$email' where id_clie='$idUsuario'");
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
    header('Location:listaSuc.php');
}
$idSuc = $_GET['id'];
$sql = mysqli_query($conexion, "SELECT sucursal.id_suc,nom_suc,col_suc,cp_suc,ni_suc,ne_suc,call_suc,nom_ciu FROM sucursal inner join ciudad ON ciudad.id_ciu=sucursal.id_ciu where sucursal.id_suc=$idSuc");
$result = mysqli_num_rows($sql);
if ($result == 0) {
    header('Location:listaSuc.php');
}else{
    $option='';
    while($data=mysqli_fetch_array($sql)){
        $idSuc=$data['id_suc'];
        $nombre=$data['nom_suc'];
        $colonia=$data['col_suc'];
        $cp=$data['cp_suc'];
        $ni=$data['ni_suc'];
        $ne=$data['ne_suc'];
        $calle=$data['call_suc'];
        $ciudad=$data['nom_ciu'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="icon" href="../img/logo.ico">
    <link rel="stylesheet" href="../css/styleadministrador.css">
</head>

<body>
<header class="header">
        <div>
            <nav class="navbar bg-secondary navbar-expand-lg border-top border-bottom border-3 border-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="../salir.php">
                        <img src="../img/logo.jpg" class="logo">
                        <img class="imgses" src="../img/cerrarses.jpg" alt="Cerrar sesion" title="salir">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="offcanvas offcanvas-end bg-secondary" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav justify-content flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link active lh-lg" aria-current="page" href="administrador.php">Inicio</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Usuarios </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="registrousuario.php">Nuevo usuario</a></li>
                                        <li><a class="dropdown-item border-0" href="listausuarios.php">Lista de usuarios</a></li>
                                        <li><a class="dropdown-item border-0" href="ListaUsuElimin.php">Usuarios eliminados</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Facturas</a>
                                    <ul class="dropdown-menu bg-secondary" aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="registrousuario.php">Nueva facturas</a></li>
                                        <li><a class="dropdown-item border-0" href="listausuarios.php">Lista de facturas</a></li>
                                        <li><a class="dropdown-item border-0" href="#">Facturas eliminadas</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Productos </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="regProd.php">Nuevos productos</a></li>
                                        <li><a class="dropdown-item border-0" href="listaProd.php">Lista de productos</a></li>
                                        <li><a class="dropdown-item border-0" href="ListaProdElimin.php">Productos eliminados</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Sucursales </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="regSuc.php">Nueva sucursal</a></li>
                                        <li><a class="dropdown-item border-0" href="listaSuc.php">Lista de sucursales</a></li>
                                        <li><a class="dropdown-item border-0" href="listaSucElimin.php">Sucursales eliminadas</a></li>
                                    </ul>
                                </li>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <section></section>
    </header>
    <section class="container">
        <div class="form_register">
            <h1 class="text-prin">Actualizar usuario</h1>
            <hr>
            <?php if (!empty($alert)): ?>
                <div class="alert"><?php echo $alert; ?></div>
            <?php endif; ?>
            <form action="editarSuc.php" method="post">
                <input type="hidden" name="idSuc" value="<?php echo $iduser; ?>">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre de la sucursal" value="<?php echo $nombre?>" required>
                <label for="colonia">Colonia</label>
                <input type="text" name="colonia" id="colonia" placeholder="Colonia" value="<?php echo $colonia?>" required>
                <label for="calle">Calle</label>
                <input type="text" name="calle" id="calle" placeholder="Calle" value="<?php echo $calle?>" required>
                <label for="cp">CP</label>
                <input type="text" name="cp" id="cp" placeholder="CP" value="<?php echo $cp?>" required>
                <label for="numi"># Interior</label>
                <input type="text" name="numi" id="numi" placeholder="# Interior" value="<?php echo $ni?>">
                <label for="nume"># Exterior</label>
                <input type="text" name="nume" id="nume" placeholder="nume" value="<?php echo $ne?>" required>

                <input type="submit" class="btn_save" value="Actualizar sucursal">
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
<?php ob_end_flush(); ?>