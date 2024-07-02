<?php
ob_start();
include("../denegacion.php");
include "../conexionBD.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASJ Technology</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                        <img class="imgses" src="../img/cerrarses.jpg" alt="Cerrar sesión" title="salir">
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
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Usuarios</a>
                                    <ul class="dropdown-menu bg-secondary" aria-labelledby="menucategoria">
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
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Productos</a>
                                    <ul class="dropdown-menu bg-secondary" aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="regProd.php">Nuevos productos</a></li>
                                        <li><a class="dropdown-item border-0" href="listaProd.php">Lista de productos</a></li>
                                        <li><a class="dropdown-item border-0" href="ListaProdElimin.php">Productos eliminados</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Sucursales</a>
                                    <ul class="dropdown-menu bg-secondary" aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="registrousuario.php">Nueva sucursal</a></li>
                                        <li><a class="dropdown-item border-0" href="listausuarios.php">Lista de sucursales</a></li>
                                        <li><a class="dropdown-item border-0" href="#">Sucursales eliminadas</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <form action="buscar_producto.php" method="get" class="form_search ms-auto">
                                <input class="busqueda" type="text" name="buscarProd" id="buscarProd" placeholder="Buscar">
                                <input type="submit" value="Buscar" class="btn_search">
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <section></section>
    </header>

    <section id="container">
        <h1 class="text_prin">Lista de productos</h1>
        <a href="regProd.php"  class="btn_new">Registrar producto</a>

        <div class="container">
            <div class="table-responsive">
                <table class="table table-sm table-dark table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Color</th>
                            <th>Camara</th>
                            <th>Almacenamiento</th>
                            <th>RAM</th>
                            <th>Pantalla</th>
                            <th>Bateria</th>
                            <th>Procesador</th>
                            <th>Precio</th>
                            <th>Costo</th>
                            <th>Imagen</th>
                            <th class="acciones">Acciones</th>
                        </tr>
                    </thead>
                    <?php
                    $sql_register = mysqli_query($conexion, "select count(*) as total_registro from marca inner join modelo on marca.id_marca = modelo.id_marca inner join telefono on modelo.id_mod=telefono.id_mod where estatus=0");
                    $result_register = mysqli_fetch_array($sql_register);
                    $total_registro = $result_register['total_registro'];
                    $por_pagina = 5;
                    if (empty($_GET['pagina'])) {
                        $pagina = 1;
                    } else {
                        $pagina = $_GET['pagina'];
                    }
                    $desde = ($pagina - 1) * $por_pagina;
                    $total_paginas = ceil($total_registro / $por_pagina);
                    $query = mysqli_query($conexion, "SELECT nom_marc,nom_mod,id_tel,col_tel,cam_tel,alm_tel,ram_tel,pan_tel,bat_tel,proc_tel,prec_tel,costo_tel,img_tel from marca inner join modelo on marca.id_marca = modelo.id_marca inner join telefono on modelo.id_mod=telefono.id_mod where estatus=0 ORDER BY id_tel asc limit $desde,$por_pagina");
                    $result = mysqli_num_rows($query);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_array($query)) {
                            if($data['img_tel']!='img_producto.png'){
                                $foto='../img/'.$data['img_tel'];
                            }else{
                                $foto='img'.$data['img_tel'];
                            }
                    ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $data['id_tel'] ?></td>
                                    <td><?php echo $data['nom_marc'] ?></td>
                                    <td><?php echo $data['nom_mod'] ?></td>
                                    <td><?php echo $data['col_tel'] ?></td>
                                    <td><?php echo $data['cam_tel'] ?></td>
                                    <td><?php echo $data['alm_tel'] ?></td>
                                    <td><?php echo $data['ram_tel'] ?></td>
                                    <td><?php echo $data['pan_tel'] ?></td>
                                    <td><?php echo $data['bat_tel'] ?></td>
                                    <td><?php echo $data['proc_tel'] ?></td>
                                    <td><?php echo $data['prec_tel'] ?></td>
                                    <td><?php echo $data['costo_tel'] ?></td>
                                    <td class="img_producto"><img src="<?php echo $foto ?>" alt="producto"></td>
                                    <td>
                                        <a class="link_edit" href="RecuperarProd.php?id=<?php print($data["id_tel"]) ?>">Recuperar</a>
                                        
                                    </td>
                                </tr>
                            </tbody>
                    <?php
                        }
                    }
                    ?>

                </table>
            </div>
        </div>
        <?php if ($total_paginas > 0) { ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php if ($pagina != 1) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php for ($i = 1; $i <= $total_paginas; $i++) { ?>
                        <li class="page-item <?php echo ($pagina == $i) ? " active " : " "; ?>">
                            <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>

                    <?php if ($pagina != $total_paginas) { ?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        <?php } ?>
    </section>









    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
<?php ob_end_flush(); ?>