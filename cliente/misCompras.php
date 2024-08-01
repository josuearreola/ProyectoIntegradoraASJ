<?php
include "../conexionBD.php";
require "config.php";
$idUsua = $_SESSION['idUsua'];
if (empty($_SESSION['idUsua'])) {
    header('location:../inicioSesion/iniciosesion.php');
}
$idClie = $_SESSION['Id_clie'];
$idCl = $_GET['idUsua'];
$cliente = mysqli_query($conexion, "SELECT id_clie from cliente where id_clie=$idCl");
$result = mysqli_num_rows($cliente);
if ($result == 0 || $idCl == null) {
    header('location:cliente.php');
}


$sqlQuery = $conexion->prepare("SELECT venta.id_vta,fec_vta,tip_pago,cant_pago from venta inner join pago on venta.id_vta=pago.id_vta where id_clie =? ORDER by date(fec_vta) asc;");
$sqlQuery->bind_param("i", $idClie);
$sqlQuery->execute();
$result = $sqlQuery->get_result();


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
                            <a class="nav-link active lh-lg" aria-current="page" href="cliente.php">Inicio</a>
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

                </div>
            </div>
        </div>
    </nav>

    <main>

        <div class="container">
            <h4 style="color:#ffffff">Mis compras "<?php echo $idUsua ?>"</h4>
            <hr style="color:#ffffff">

            <?php
            while ($row = $result->fetch_assoc()) { ?>
                <div class="card mb-3 bg-light border-secondary">
                    <div class="card-header">
                        <?php echo $row['fec_vta']    ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Folio: <?php echo $row['id_vta'] ?></h5>
                        <p class="card-text">Total: <?php echo $row['cant_pago'] ?> </p>
                        <a href="detalle_compra.php?orden=<?php echo $row['id_vta']; ?>" class="btn btn-primary">Ver compra</a>
                    </div>
                </div>

            <?php } ?>

        </div>

    </main>












    <footer class="footerpagprinc">
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