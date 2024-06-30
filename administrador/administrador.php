<?php
ob_start();
include("../denegacion.php");

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
    <link rel="icon" href="../img/logo.ico">
    <link rel="stylesheet" href="../css/styleadministrador.css">
</head>

<body>
<header class="header">
        <div >
            
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
                            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
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
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Facturas </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="#">Nueva factura</a></li>
                                        <li><a class="dropdown-item border-0" href="#">Lista de facturas</a></li>
                                        <li><a class="dropdown-item border-0" href="#">Facturas eliminadas</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Productos </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="regProd.php">Nuevos productos</a></li>
                                        <li><a class="dropdown-item border-0" href="listaProd.php">Lista de productos</a></li>
                                        <li><a class="dropdown-item border-0" href="#">Productos eliminados</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Sucursales </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="#">Nueva sucursal</a></li>
                                        <li><a class="dropdown-item border-0" href="#">Lista de sucursales</a></li>
                                        <li><a class="dropdown-item border-0" href="#">Sucursales eliminadas</a></li>
                                    </ul>
                                </li>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <section></section>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
<?php ob_end_flush(); ?>