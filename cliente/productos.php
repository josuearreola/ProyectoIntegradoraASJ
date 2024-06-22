<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASJ Technology</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/stylecliente.css">
    <link rel="icon" href="../img/logo.ico">
</head>

<body>
    <nav class="navbar bg-secondary navbar-expand-lg border-top border-bottom border-3 border-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../salir.php">
                <img src="../img/logo.jpg" class="logo">
                <img class="imgses" src="../img/cerrarses.jpg" alt="Cerrar sesion" title="salir">
            </a>
            <a href="#" style="color:black; margin-top:5px; margin-left:10px" >
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
                            <a class="nav-link active lh-lg" aria-current="page" href="cliente.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active lh-lg" href="#">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active lh-lg" aria-current="page" href="#">Mi carrito</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  active lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Categorias </a>
                            <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                <li><a class="dropdown-item border-0" href="#">$1000-$3500</a></li>
                                <li><a class="dropdown-item border-0" href="#">$3500-$7000</a></li>
                                <li><a class="dropdown-item border-0" href="#">Mas de $7000</a></li>
                            </ul>
                        </li>
                        <form class="form-inline ml-3" action="productos.php" >
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar bg-dark-subtle" type="search" placeholder="Buscar" aria-label="Search" name="busqueda" value="<?php echo $_REQUEST['busqueda']??'';?>">
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

    <p class="text-center fs-1" style="color:#fff;">NUESTROS PRODUCTOS</p>
    <main>
    <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4  row-cols-lg-5 g-5">
                <?php
                include("../conexionBD.php");
                $where = " where 1=1 ";
                $busqueda = mysqli_real_escape_string($conexion, $_REQUEST['busqueda'] ?? '');
                if (empty($busqueda) == false) {
                    $where .= " AND (nom_mod LIKE '%$busqueda%' OR prec_tel LIKE '%$busqueda%' OR col_tel LIKE '%$busqueda%' OR cam_tel LIKE '%$busqueda%' OR alm_tel LIKE '%$busqueda%' OR pan_tel LIKE '%$busqueda%')";
                }
                $queryCuenta = "SELECT count(*) as cuenta FROM modelo INNER JOIN telefono ON modelo.id_mod = telefono.id_mod $where ;";
                $rescuenta = mysqli_query($conexion, $queryCuenta);
                $rowcuenta = mysqli_fetch_assoc($rescuenta);
                $total_registro = $rowcuenta['cuenta'];

                $elementosPorPag = 10;
                $totalPaginas = ceil($total_registro / $elementosPorPag);
                $paginaSel = $_REQUEST['pagina']??false;
                if ($paginaSel==false) {
                    $inicioLimite=0;
                    $paginaSel=1;
                } else {
                    $inicioLimite=($paginaSel-1)*$elementosPorPag;
                }
                $limite = " limit $inicioLimite,$elementosPorPag";

                $query = "SELECT nom_mod, prec_tel, img_tel, col_tel, cam_tel, alm_tel, pan_tel FROM modelo INNER JOIN telefono ON modelo.id_mod = telefono.id_mod $where $limite";

                $res = mysqli_query($conexion, $query);
                while ($row = mysqli_fetch_array($res)) {
                ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="<?php echo $row['img_tel']; ?>" alt="ProEstre-1" class="card-img-top img-thumbnail">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nom_mod']; ?></h5>
                                <p class="card-text"></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group" style="width:40px;padding:10px">
                                        <a href="" class="btn btn-success">Comprar</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
           <?php if ($totalPaginas > 0) { ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php if ($paginaSel != 1) { ?>
                            <li class="page-item">
                                <a class="page-link" href="productos.php?modulo=productos&pagina=<?php echo ($paginaSel - 1); ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                        <?php } ?>
                        
                        <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>
                            <li class="page-item <?php echo ($paginaSel == $i) ? " active " : " "; ?>">
                                <a class="page-link" href="productos.php?modulo=productos&pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                        
                        <?php if ($paginaSel != $totalPaginas) { ?>
                            <li class="page-item">
                                <a class="page-link" href="productos.php?modulo=productos&pagina=<?php echo ($paginaSel + 1); ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } ?>
        </div>
    </main>





    
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>