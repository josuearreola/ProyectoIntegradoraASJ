<?php
include("conexionBD.php");
require "configPPrin.php";

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

$sql = "SELECT id_tel,nom_mod, prec_tel, img_tel, col_tel, cam_tel, alm_tel, pan_tel FROM modelo INNER JOIN telefono ON modelo.id_mod = telefono.id_mod";
$result = mysqli_query($conexion, $sql);

if ($id == '' || $token == '') {
    echo 'Error al procesar la peticion';
    exit;
} else {
    $token_temp = hash_hmac('sha1', $id, KEY_TOKEN);
    if ($token == $token_temp) {
        $sql = $conexion->prepare("SELECT id_tel,nom_mod, prec_tel, img_tel, col_tel, cam_tel, alm_tel, pan_tel,proc_tel,ram_tel FROM modelo INNER JOIN telefono ON modelo.id_mod = telefono.id_mod where id_tel=? and estatus=1 LIMIT 1");
        $sql->bind_param("i", $id);
        $sql->execute();
        $sql->bind_result($id_tel, $nom_mod, $prec_tel, $img_tel, $col_tel, $cam_tel, $alm_tel, $pan_tel, $proc_tel, $ram_tel);

        if ($sql->fetch()) {
            $nombre = $nom_mod;
            $precio = $prec_tel;
            $imagen = $img_tel;
            $color = $col_tel;
            $camara = $cam_tel;
            $almacenamiento = $alm_tel;
            $pantalla = $pan_tel;
            $procesador = $proc_tel;
            $ram = $ram_tel;
        }
    } else {
        echo 'Error al procesar la peticion';
        exit;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/pag_principal.css">
    <link rel="icon" href="img/logo.ico">
</head>

<body>
    <nav class="navbar bg-secondary navbar-expand-lg border-top border-bottom border-3 border-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../salir.php">
                <a href="#" class="enlace">
                    <img src="img/logo.jpg" alt="" class="logo">
                </a>
                <div class="div-sesion ">
                    <i class="fa-regular fa-user"></i>
                    <div class="menu-Sesion">
                        <ul class="ul-sesion">
                            <li class="li-sesion"><a class="a-sesion" href="iniciosesion/iniciosesion.php">Iniciar sesion</a></li>
                            <li class="li-sesion"><a class="a-sesion" href="CreacionCuenta/crearCuenta.php">Crear cuenta</a></li>
                        </ul>
                    </div>
                </div>
            </a>
            <a href="#" style="color:black; margin-top:18px; margin-left:10px">
                <i class="fa-solid fa-cart-plus fa-2x"></i>
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
                            <a class="nav-link active lh-lg" aria-current="page" href="pagPrincipal.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lh-lg" href="productosPrin.php">Productos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Categorias </a>
                            <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                <li><a class="dropdown-item border-0" href="categoriaPrin1.php">$6000-$12000</a></li>
                                <li><a class="dropdown-item border-0" href="categoriaPrin2.php">$12000-$18000</a></li>
                                <li><a class="dropdown-item border-0" href="categoriaPrin3.php">Mas de $18000</a></li>
                            </ul>
                        </li>
                        <form class="form-inline ml-3" action="productosPrin.php">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar bg-dark-subtle" type="search" placeholder="Buscar" aria-label="Search" name="busqueda" value="<?php echo $_REQUEST['busqueda'] ?? ''; ?>">
                                <input type="hidden" name="modulo" value="productos">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-1">
                    <img src="<?php echo 'img/'.$img_tel ?>" alt="producto" style="max-width: 100%; height: auto;">
                </div>
                <div class="col-md-7 order-md-2">
                    <h4 style="color:#fff"><?php echo $nombre; ?></h4>
                    <h4 style="color:#fff"><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></h4>
                    <p class="lead">
                    <h5 style="color:#fff">Descripcion:</h5>
                    <h6 style="color:#fff">Color: <?php echo $color ?></h6>
                    <h6 style="color:#fff">Camara: <?php echo $camara ?></h6>
                    <h6 style="color:#fff">Almacenamiento: <?php echo $almacenamiento ?></h6>
                    <h6 style="color:#fff">Pantalla: <?php echo $pantalla ?></h6>
                    <h6 style="color:#fff">Procesador: <?php echo $procesador ?></h6>
                    <h6 style="color:#fff">RAM: <?php echo $ram ?></h6>
                    </p>
                    <div class="d-grip gap-3 col-10 mx-auto">
                        <button class="btn btn-primary" type="button" onclick="location.href='inicioSesion/iniciosesion.php';">Comprar ahora</button>
                        <button class="btn btn-outline-primary" type="button" onclick="location.href='inicioSesion/iniciosesion.php';">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        </div>
    </main>


    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>