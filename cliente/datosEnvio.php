<?php
include "../conexionBD.php";
require "config.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombrerec']) || empty($_POST['apellidoprec']) || empty($_POST['apellidomrec']) || empty($_POST['emailrec']) || empty($_POST['callerec']) || empty($_POST['coloniarec']) || empty($_POST['cprec'])  || empty($_POST['numerec'])) {
        $alert = '<p class="msj_error">Campos incompletos</p>';
    } else {
        $nombreRec = $_POST['nombrerec'];
        $apellidopRec = $_POST['apellidoprec'];
        $apellidomRec = $_POST['apellidomrec'];
        $emailRec = $_POST['emailrec'];
        $calleRec = $_POST['callerec'];
        $coloniaRec = $_POST['coloniarec'];
        $cpRec = $_POST['cprec'];
        $numiRec = !empty($_POST['numirec']) ? $_POST['numirec'] : 'NULL';
        $numeRec = $_POST['numerec'];
        $result = mysqli_query($conexion, "SELECT MAX(id_env) AS max_id FROM envio");
        $row = mysqli_fetch_assoc($result);
        $idEnvio = $row['max_id'] + 1;

        $sqlEnv = mysqli_query($conexion, "INSERT INTO envio(id_env,n1_env,ap_env,am_env,call_env,col_env,numi_env,nume_env,cp_env) VALUES($idEnvio,'$nombreRec','$apellidopRec','$apellidomRec','$calleRec','$coloniaRec',$numiRec,$numeRec,$cpRec)");
        if ($sqlEnv === true) {
            header('Location: metodoPago.php?id= echo $idUsua');
            exit;
        } else {
            $alert = '<p class="msj_error">Error al insertar los datos</p>';
        }
    }
}




$idUsua = $_SESSION['idUsua'];
if (empty($_SESSION['idUsua'])) {
    header('location:../inicioSesion/iniciosesion.php');
}
$idEnv = $_GET['id'];
$sql = mysqli_query($conexion, "select usuario.id_usua,nom_clie,email_clie,nom_usua,ap_clie,am_clie,tel_clie,rfc_clie,col_clie,calle_clie,cp_clie,ni_clie,ne_clie from usuario inner join cliente on usuario.id_usua=cliente.id_usua where usuario.nom_usua='$idEnv'");
$result = mysqli_num_rows($sql);
if ($result == 0) {
    header('Location:checkout.php');
} else {
    while ($data = mysqli_fetch_array($sql)) {
        $nombre = $data['nom_clie'];
        $email = $data['email_clie'];
        $usuario = $data['nom_usua'];
        $apClie = $data['ap_clie'];
        $amClie = $data['am_clie'];
        $rfc = $data['rfc_clie'];
        $col = $data['col_clie'];
        $calle = $data['calle_clie'];
        $cp = $data['cp_clie'];
        $NumI = $data['ni_clie'];
        $NumE = $data['ne_clie'];
        $telefono = $data['tel_clie'];
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
            <a href="datosUser.php?idUsua=<?php echo $_SESSION['Id_usua']; ?>" style="color:black; margin-top:5px; margin-left:5px;">
                <i class="fa-solid fa-user fa-2x"></i>
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
                            <a class="nav-link active lh-lg" aria-current="page" href="checkout.php">Inicio</a>
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
    <?php if (!empty($alert)) : ?>
        <div class="alert"><?php echo $alert; ?></div>
    <?php endif; ?>
    <form method="post" action="datosEnvio.php?id=<?php echo $idUsua; ?>">
        <div class="container mt-3">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h3 style="color: #ffffff;">Datos del cliente</h3>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="nombreclie" style="color: #ffffff;">Nombre</label>
                                <input type="text" name="nombreclie" id="nombreclie" class="form-control" placeholder="Nombre" value="<?php echo $nombre ?>" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="apellidopclie" style="color: #ffffff;">Apellido P</label>
                                <input type="text" name="apellidopclie" id="apellidopclie" class="form-control" placeholder="Apellido P" value="<?php echo $apClie ?>" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="apellidomclie" style="color: #ffffff;">Apellido M</label>
                                <input type="text" name="apellidomclie" id="apellidomclie" class="form-control" placeholder="Apellido M" value="<?php echo $amClie ?>" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emailclie" style="color: #ffffff;">Email</label>
                        <input type="text" name="emailclie" id="emailclie" class="form-control" placeholder="Email" value="<?php echo $email ?>" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="direccion-toggle-cliente" class="toggle-link" style="color: #ffffff;">Dirección</label>
                        <div id="direccion-cliente" class="d-none">
                            <div class="row mb-2">
                                <div class="col-12 col-sm-6 mb-2">
                                    <input type="text" name="calleclie" id="calleclie" class="form-control" placeholder="Calle" value="<?php echo $calle ?>" disabled="disabled">
                                </div>
                                <div class="col-12 col-sm-6  mb-2">
                                    <input type="text" name="coloniaclie" id="coloniaclie" class="form-control" placeholder="Colonia" value="<?php echo $col ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4  mb-2">
                                    <input type="text" name="cpclie" id="cpclie" class="form-control" placeholder="CP" value="<?php echo $cp ?>" disabled="disabled">
                                </div>
                                <div class="col-12 col-sm-4  mb-2">
                                    <input type="text" name="numeclie" id="numeclie" class="form-control" placeholder="# Exterior" value="<?php echo $NumE ?>" disabled="disabled">
                                </div>
                                <div class="col-12 col-sm-4  mb-2">
                                    <input type="text" name="numiclie" id="numiclie" class="form-control" placeholder="# Interior" value="<?php echo $NumI ?>" disabled="disabled">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <h3 style="color: #ffffff;">Datos del que recibe</h3>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="nombrerec" style="color: #ffffff;">Nombre</label>
                                <input type="text" name="nombrerec" id="nombrerec" class="form-control" placeholder="Nombre" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="apellidoprec" style="color: #ffffff;">Apellido P</label>
                                <input type="text" name="apellidoprec" id="apellidoprec" class="form-control" placeholder="Apellido P" required>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="form-group">
                                <label for="apellidomrec" style="color: #ffffff;">Apellido M</label>
                                <input type="text" name="apellidomrec" id="apellidomrec" class="form-control" placeholder="Apellido M " required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="emailrec" style="color: #ffffff;">Email</label>
                        <input type="text" name="emailrec" id="emailrec" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion-toggle-recibe" class="toggle-link" style="color: #ffffff;">Dirección</label>
                        <div id="direccion-recibe" class="d-none">
                            <div class="row mb-2">
                                <div class="col-12 col-sm-6 mb-2">
                                    <input type="text" name="callerec" id="callerec" class="form-control" placeholder="Calle" required>
                                </div>
                                <div class="col-12 col-sm-6 mb-2">
                                    <input type="text" name="coloniarec" id="coloniarec" class="form-control" placeholder="Colonia" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-4 mb-2">
                                    <input type="text" name="cprec" id="cprec" class="form-control" placeholder="CP" required>
                                </div>
                                <div class="col-12 col-sm-4 mb-2">
                                    <input type="text" name="numerec" id="numerec" class="form-control" placeholder="# Exterior" required>
                                </div>
                                <div class="col-12 col-sm-4 mb-2">
                                    <input type="text" name="numirec" id="numirec" class="form-control" placeholder="# Interior">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="jalar">
                            <P style="color: #ffffff;">Para mi</P>
                        </label>
                    </div>
                    <div class="row mt-3">
                        <div class="col text-end">
                            <input class="btn btn-primary" type="submit" name="guardar" value="Pagar"></input>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>





    <footer class="footerpagprinc">
        <div class="container">
            <div>
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

    <script>
        document.querySelectorAll('.toggle-link').forEach(function(toggleLink) {
            toggleLink.addEventListener('click', function() {
                var target = this.nextElementSibling;
                if (target.classList.contains('d-none')) {
                    target.classList.remove('d-none');
                } else {
                    target.classList.add('d-none');
                }
            });
        });

        document.getElementById('jalar').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('nombrerec').value = document.getElementById('nombreclie').value;
                document.getElementById('apellidoprec').value = document.getElementById('apellidopclie').value;
                document.getElementById('apellidomrec').value = document.getElementById('apellidomclie').value;
                document.getElementById('emailrec').value = document.getElementById('emailclie').value;
                document.getElementById('callerec').value = document.getElementById('calleclie').value;
                document.getElementById('coloniarec').value = document.getElementById('coloniaclie').value;
                document.getElementById('cprec').value = document.getElementById('cpclie').value;
                document.getElementById('numirec').value = document.getElementById('numiclie').value;
                document.getElementById('numerec').value = document.getElementById('numeclie').value;
            } else {
                document.getElementById('nombrerec').value = '';
                document.getElementById('apellidoprec').value = '';
                document.getElementById('apellidomrec').value = '';
                document.getElementById('emailrec').value = '';
                document.getElementById('callerec').value = '';
                document.getElementById('coloniarec').value = '';
                document.getElementById('cprec').value = '';
                document.getElementById('numirec').value = '';
                document.getElementById('numerec').value = '';
            }
        });
    </script>


</body>

</html>