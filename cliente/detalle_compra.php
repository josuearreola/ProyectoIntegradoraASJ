<?php
include "../conexionBD.php";
require "config.php";
$idUsua = $_SESSION['idUsua'];
if (empty($_SESSION['idUsua'])) {
    header('location:../inicioSesion/iniciosesion.php');
}
$orden = $_GET['orden'];
$resulquery = mysqli_query($conexion, "SELECT id_vta from venta where id_vta=$orden");
$resul = mysqli_num_rows($resulquery);
if ($orden == null || $resul == 0) {
    header("location:cliente.php");
}

$sqlCompra = mysqli_query($conexion, "SELECT venta.id_vta,fec_vta,cant_pago,tip_pago from venta inner join pago on venta.id_vta = pago.id_vta where venta.id_vta=$orden");
$rowCompra = $sqlCompra->fetch_assoc();
$idCompra = $rowCompra['id_vta'];

$sqlDetalle = mysqli_query($conexion, "SELECT venta_inv.id_vta,inventario.id_inv,cant_inv,prec_tel,nom_mod,nom_marc,nom_suc from inventario inner join venta_inv on inventario.id_inv = venta_inv.id_inv inner join telefono on telefono.id_tel=inventario.id_tel inner join modelo on modelo.id_mod = telefono.id_mod inner join marca on marca.id_marca=modelo.id_marca inner join sucursal on sucursal.id_suc =inventario.id_suc where id_vta=$idCompra");
$total = 0;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASJ Technology</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
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
            <a href="checkout.php" style="color:black; margin-top:5px; margin-left:-2px">
                <i class="fa-solid fa-cart-plus fa-2x"></i>
            </a>
            <div class="div-sesion">
                <i class="fa-solid fa-user fa-2x" style="color:black"></i>
                <div class="menu-Sesion">
                    <ul class="ul-sesion">
                        <li class="li-sesion"><a href="datosUser.php?idUsua=<?php echo $_SESSION['Id_usua']; ?>">Mi perfil</a></li>
                        <li class="li-sesion"><a href="misCompras.php?idUsua=<?php echo $_SESSION['Id_clie']; ?>">Mis compras</a></li>
                    </ul>
                </div>
            </div>

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
                            <a class="nav-link active lh-lg" aria-current="page"  href="cliente.php">Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active lh-lg" id="menusucursales" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Sucursales</a>
                            <ul class="dropdown-menu bg-secondary" aria-labelledby="menusucursales">
                                <li><a class="nav-link active lh-lg" href="productos.php?id=200">Sucursal CDMX</a></li>
                                <li><a class="nav-link active lh-lg" href="productos.php?id=201">Sucursal Monterrey</a></li>
                                <li><a class="nav-link active lh-lg" href="productos.php?id=202">Sucursal Querétaro</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active lh-lg" aria-current="page" href="checkout.php">
                                Mi carrito<span id="num_cart" class="badge bd-danger"><?php echo $num_cart; ?></span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  active lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Categorias </a>
                            <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                <li><a class="dropdown-item border-0" href="categoria1.php">$6000-$12000</a></li>
                                <li><a class="dropdown-item border-0" href="categoria2.php">$12000-$18000</a></li>
                                <li><a class="dropdown-item border-0" href="categoria3.php">Mas de $18000</a></li>
                            </ul>
                        </li>
                        <form class="form-inline ml-3" action="productos.php">
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
                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <strong>DETALLE DE LA COMPRA</strong>
                        </div>
                        <div class="card-body">
                            <p><strong>Fecha: </strong> <?php echo $rowCompra['fec_vta'] ?></p>
                            <p><strong>Orden: </strong> <?php echo $rowCompra['id_vta'] ?></p>
                            <p><strong>Total: </strong> <?php echo MONEDA . ' ' . number_format($rowCompra['cant_pago'], 2, '.', ','); ?></p>
                            <a href="factura.php?idFact=<?php echo $orden ?>" class="btn btn-success"  target="_blank">Factura</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>

                                </tr>
                            <tbody>
                                <?php while ($row = $sqlDetalle->fetch_assoc()) {
                                    $precio = $row['prec_tel'];
                                    $cantidad = $row['cant_inv'];
                                    $subtotal = $precio * $cantidad;
                                    $total += $subtotal;
                                    $totalDesc = $total; // Asigna el valor total original a totalDesc

                                    if ($total > 40000) {
                                        $totalDesc = $total - 800; // Aplica el descuento mayor primero
                                    } elseif ($total > 30000) {
                                        $totalD = $total * 0.15; // Calcula el 15% de descuento
                                        $totalDesc = $total - $totalD;
                                    } elseif ($total > 20000) {
                                        $totalDesc = $total - 500; // Aplica el descuento menor si los anteriores no se aplicaron
                                    }
                                    $_SESSION['total'] = $total;
                                    $_SESSION['totalDesc'] = $totalDesc;
                                ?>

                                    <tr>
                                        <td><?php echo $row['nom_mod'] ?></td>
                                        <td><?php echo MONEDA . ' ' . number_format($precio, 2, '.', ',') ?></td>
                                        <td><?php echo $cantidad ?></td>
                                        <td><?php echo  MONEDA . ' ' . number_format($subtotal, 2, '.', ',') ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td>
                                        <?php if ($totalDesc < $total) : ?>
                                            <span style="text-decoration: line-through;"><?php echo MONEDA . ' ' . number_format($_SESSION['total'], 2, '.', ','); ?></span>
                                            <br>
                                            <strong><?php echo MONEDA . ' ' . number_format($_SESSION['totalDesc'], 2, '.', ','); ?></strong>
                                        <?php else : ?>
                                            <strong><?php echo MONEDA . ' ' . number_format($_SESSION['total'], 2, '.', ','); ?></strong>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tfoot>

                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>











    <footer class="footerpagprinc footer-fixed">
        <div class="boton-modal1">
            <label class="footer-p" for="btn-modal1">Terminos y condiciones</label>
        </div>
        <div>
            <label class="footer-p" for="btn-modal2">Atencion al cliente</label>
        </div>
        <input type="checkbox" id="btn-modal1">
        <div class="container-modal1">
            <div class="content-modal1">
                <h3>Términos y Condiciones</h3>
                <p class="p1">1. Aceptación de los Términos
                    Al acceder y utilizar nuestro sitio web, usted acepta estar sujeto a estos términos y condiciones y a todas las leyes y regulaciones aplicables. Si no está de acuerdo con alguno de estos términos, le pedimos que no utilice nuestro sitio.</p>
                <p>2. Propiedad Intelectual
                    Todos los contenidos presentes en este sitio, incluidos, entre otros, textos, gráficos, logotipos, iconos, imágenes y software, son propiedad de ASJ Technology o de sus proveedores de contenido y están protegidos por las leyes de propiedad intelectual.</p>
                <p>3. Ley Aplicable
                    Estos términos y condiciones se regirán e interpretarán de acuerdo con las leyes de [País], sin dar efecto a sus disposiciones sobre conflicto de leyes. Usted acepta someterse a la jurisdicción exclusiva de los tribunales de [País] para la resolución de cualquier disputa que surja de estos términos y condiciones o del uso del sitio.</p>
                <p>4. Contacto
                    Si tiene alguna pregunta o comentario acerca de estos términos y condiciones, no dude en contactarnos a través de ASJtechnology@gmail.com.</p>
                <p>5. Confirmación
                    Al hacer clic en "Aceptar", usted confirma que ha leído, entendido y aceptado estos términos y condiciones.</p>
                <div class="btn-cerrar">
                    <label for="btn-modal1">Aceptar</label>
                </div>
            </div>
            <label for="btn-modal1" class="cerrar-modal"></label>
        </div>

        <input type="checkbox" id="btn-modal2">
        <div class="container-modal2">
            <div class="content-modal2">
                <h3>¡Bienvenido a ASJ Technology!</h3>
                <p class="p2">Nos complace atenderle y ofrecerle la mejor experiencia de servicio posible. Nuestro equipo de atención al cliente está aquí para ayudarle con cualquier consulta, problema o inquietud que pueda tener.</p>
                <p>Teléfono:
                    Llámenos al 4424530036 durante nuestro horario de atención, de lunes a viernes, de 9:00 a 18:00.</p>
                <p>Correo Electrónico:
                    Puede enviarnos un correo electrónico a ASJtechnology@gmail.com y responderemos a su consulta en un plazo de 24 horas hábiles.</p>
                <p>Garantías y Devoluciones:
                    Para consultas relacionadas con garantías, devoluciones o reemplazos, póngase en contacto con nosotros y le guiaremos a través del proceso de manera rápida y sencilla.</p>
                <p>Facturación y Pagos:
                    Para cualquier pregunta relacionada con facturas, pagos o información de cuentas, nuestro equipo de atención al cliente le proporcionará la asistencia necesaria para resolver su consulta de manera eficiente.</p>
                <div class="btn-cerrar2">
                    <label for="btn-modal2">Aceptar</label>
                </div>
            </div>
            <label for="btn-modal2" class="cerrar-modal"></label>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>