<?php
ob_start();
include("../denegacion.php");
include "../conexionBD.php";

if (!empty($_POST)) {
    if (empty($_POST('existencia'))) {
        echo "<script>alert('El campo de existencia no puede estar vacío.'); window.location.href = 'listaSuc.php';</script>";
    } else {
        $existencia = $_POST['existencia'];
        $id_tel = $_POST['telefono'];
        $sucursal = $_POST['sucursal'];

        if ($sucursal == 'all') {
            // Inserta un registro para cada sucursal
            $queryInsertInv = mysqli_query($conexion, "INSERT INTO inventario (exist_inv, id_suc, id_tel) SELECT '$existencia', sucursal.id_suc, '$id_tel' FROM sucursal WHERE sucursal.estatus = 1");
        } else {
            // Inserta un registro para la sucursal seleccionada
            $queryInsertInv = mysqli_query($conexion, "INSERT INTO inventario (exist_inv, id_suc, id_tel) VALUES ('$existencia', '$sucursal', '$id_tel')");
        }
    }
}


if (empty($_SESSION['idUsua'])) {
    header('location:../inicioSesion/iniciosesion.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="icon" href="../img/logo.ico">
    <link rel="stylesheet" href="../css/styleadministrador.css">
    <style>
        #agregarProductoModal .modal-content {
            background-color: #171717;
        }

        #agregarProductoModal .modal-content label {
            color: #fff;
        }

        #agregarProductoModal .modal-content select,
        #agregarProductoModal .modal-content input {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 5px;
            border-radius: 5px;
        }

        #agregarProductoModal .modal-content select option {
            background-color: #333;
            color: #fff;
        }

        #agregarProductoModal .modal-content .btn-primary {
            background-color: #333;
            border: none;
        }

        #agregarProductoModal .modal-content .btn-secondary {
            background-color: #666;
            border: none;
        }
    </style>
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
                            <ul class="navbar-nav justify-content flex-grow-1 pe-3">
                                <li class="nav-item">
                                    <a class="nav-link active lh-lg" aria-current="page" href="administrador.php">Inicio</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Usuarios</a>
                                    <ul class="dropdown-menu bg-secondary" aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="registrousuario.php">Nuevo usuario</a></li>
                                        <li><a class="dropdown-item border-0" href="listausuarios.php">Lista de usuarios</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Facturas</a>
                                    <ul class="dropdown-menu bg-secondary" aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="listaFacturas.php">Lista de facturas</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Productos</a>
                                    <ul class="dropdown-menu bg-secondary" aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="regProd.php">Nuevos productos</a></li>
                                        <li><a class="dropdown-item border-0" href="listaProd.php">Lista de productos</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Sucursales</a>
                                    <ul class="dropdown-menu bg-secondary" aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="regSuc.php">Nueva sucursal</a></li>
                                        <li><a class="dropdown-item border-0" href="listaSuc.php">Lista de sucursales</a></li>
                                    </ul>
                                </li>
                            </ul>
                           
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <section></section>
    </header>

    <section id="container">
        <h1 class="text_prin">Lista de facturas</h1>

        <div class="container">
            <div class="table-responsive">
                <table class="table table-sm table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Venta</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <?php
                    //paginador//
                    $sql_register = mysqli_query($conexion, "SELECT count(*) as total_registro from factura inner join venta ON factura.id_vta = venta.id_vta JOIN cliente ON cliente.id_clie = venta.id_clie inner join pago on venta.id_vta=pago.id_vta");
                    $result_register = mysqli_fetch_array($sql_register);
                    $total_registro = $result_register['total_registro'];
                    $por_pagina = 8;
                    if (empty($_GET['pagina'])) {
                        $pagina = 1;
                    } else {
                        $pagina = $_GET['pagina'];
                    }
                    $desde = ($pagina - 1) * $por_pagina;
                    $total_paginas = ceil($total_registro / $por_pagina);

                    $query = mysqli_query($conexion, "SELECT id_fact,fec_fact,factura.id_vta,nom_clie,cant_pago FROM factura JOIN venta ON factura.id_vta = venta.id_vta JOIN cliente ON cliente.id_clie = venta.id_clie inner join pago on venta.id_vta=pago.id_vta order by id_fact asc limit $desde,$por_pagina");
                    $result = mysqli_num_rows($query);
                    if ($result > 0) {
                        while ($data = mysqli_fetch_array($query)) {
                    ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $data["id_fact"] ?></td>
                                    <td><?php echo $data["nom_clie"] ?></td>
                                    <td><?php echo $data["fec_fact"] ?></td>
                                    <td><?php echo $data["id_vta"] ?></td>
                                    <td><?php echo $data["cant_pago"] ?></td>
                                    <td>
                                        <a class="link_edit" href="reporteFact.php?idFact=<?php print($data["id_vta"]) ?>" target="_blank"><i class="fas fa-file-invoice"></i> Generar factura</a>

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