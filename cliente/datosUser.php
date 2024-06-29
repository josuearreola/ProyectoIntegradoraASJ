<?php 
include "../conexionBD.php";

if(!empty($_POST)){
    if(empty($_POST['nombre']) || empty($_POST['nom_usua']) || empty($_POST['email'])){
        $alert = '<p class="msj_error">Los campos Nombre, Nombre del usuario y Correo electrónico son obligatorios </p>';
    }else{
        $idUsuario = $_POST['idUsuario'];
        $nombre = $_POST['nombre'];
        $nombreusua = $_POST['nom_usua'];
        $email = $_POST['email'];
        $ap = $_POST['ap_clie'];
        $am = $_POST['am_clie'];
        $rfc = $_POST['rfc'];
        $telefono = $_POST['telefono'];
        $col = $_POST['col'];
        $calle = $_POST['calle'];
        $numI = $_POST['numI'];
        $numE = $_POST['numE'];
        
        // Si se proporciona una nueva contraseña
        if(!empty($_POST['pass_usua'])){
            $contraseña = md5(mysqli_real_escape_string($conexion, $_POST['pass_usua']));
            $sql = mysqli_query($conexion, "UPDATE usuario SET nom_usua='$nombreusua', pass_usua='$contraseña' WHERE id_usua='$idUsuario'");
        } else {
            $sql = mysqli_query($conexion, "UPDATE usuario SET nom_usua='$nombreusua' WHERE id_usua='$idUsuario'");
        }

        $sql1 = mysqli_query($conexion, "UPDATE cliente SET 
                                        nom_clie='$nombre', 
                                        email_clie='$email',
                                        ap_clie='$ap',
                                        am_clie='$am',
                                        rfc_clie='$rfc',
                                        tel_clie='$telefono',
                                        col_clie='$col',
                                        calle_clie='$calle',
                                        ni_clie='$numI',
                                        ne_clie='$numE'
                                        WHERE id_usua='$idUsuario'");
        
        if($sql && $sql1){
            $alert = '<p class="msj_ok">Usuario actualizado correctamente.</p>';
        }else{
            $alert = '<p class="msj_error">Error al actualizar el usuario.</p>';
        }
    }
}



if (empty($_GET['idUsua'])) {
    header('Location:cliente.php');
}
$iduser = $_GET['idUsua'];
$sql = mysqli_query($conexion, "select usuario.id_usua,nom_clie,email_clie,nom_usua,ap_clie,am_clie,tel_clie,rfc_clie,col_clie,calle_clie,cp_clie,ni_clie,ne_clie from usuario inner join cliente on usuario.id_usua=cliente.id_usua where usuario.id_usua='$iduser'");
$result = mysqli_num_rows($sql);
if ($result == 0) {
    header('Location:cliente.php');
}else{
    while($data=mysqli_fetch_array($sql)){
        $nombre=$data['nom_clie'];
        $email=$data['email_clie'];
        $usuario=$data['nom_usua'];
        $apClie=$data['ap_clie'];
        $amClie=$data['am_clie'];
        $rfc=$data['rfc_clie'];
        $col=$data['col_clie'];
        $calle=$data['calle_clie'];
        $cp=$data['cp_clie'];
        $NumI=$data['ni_clie'];
        $NumE=$data['ne_clie'];
        $telefono=$data['tel_clie'];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleDatosUser.css">
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
            <a href="datosUser.php" style="color:black; margin-top:5px; margin-left:5px;">
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
                            <a class="nav-link active lh-lg" aria-current="page" href="cliente.php">Inicio</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link lh-lg" href="productos.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active lh-lg" aria-current="page" href="#">Mi carrito</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Categorias </a>
                            <ul class="dropdown-menu bg-secondary" aria-labelledby="menucategoria">
                                <li><a class="dropdown-item border-0" href="#">$1000-$3500</a></li>
                                <li><a class="dropdown-item border-0" href="#">$3500-$7000</a></li>
                                <li><a class="dropdown-item border-0" href="#">Mas de $7000</a></li>
                            </ul>
                        </li>
                </div>
            </div>
        </div>
    </nav>

    <section class="container">
        <div class="form_registerUsua">
            <h1 class="text-prin">Mis datos</h1>
            <hr>
            <?php if (!empty($alert)): ?>
                <div class="alert"><?php echo $alert; ?></div>
            <?php endif; ?>
            <form action="datosUser.php" method="post">
                <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <label for="nombre">Nombre:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nom_usua">Nombre del usuario:</label>
                        <input class="form-control" type="text" name="nom_usua" id="nom_usua" placeholder="Nombre de usuario" value="<?php echo $usuario?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Correo electronico:</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Correo electronico" value="<?php echo $email?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="ap_clie">Apellido Paterno:</label>
                        <input class="form-control" type="text" name="ap_clie" id="ap_clie" placeholder="Apellido Paterno" value="<?php echo $apClie?>">
                    </div>
                    <div class="col-md-6">
                        <label for="am_clie">Apellido Materno:</label>
                        <input class="form-control" type="text" name="am_clie" id="am_clie" placeholder="Apellido Materno" value="<?php echo $amClie?>">
                    </div>
                    <div class="col-md-6">
                        <label for="rfc">RFC:</label>
                        <input class="form-control" type="text" name="rfc" id="rfc" placeholder="RFC" value="<?php echo $rfc?>">
                    </div>
                    <div class="col-md-6">
                        <label for="Telefono">Telefono:</label>
                        <input class="form-control" type="text" name="telefono" id="Telefono" placeholder="Telefono" value="<?php echo $telefono?>">
                    </div>
                    <div class="col-md-6">
                        <label for="pass_usua">Contraseña:</label>
                        <input class="form-control" type="password" name="pass_usua" id="pass_usua" placeholder="Contraseña">
                    </div>
                    <div class="col-md-12">
                        <a href="#" id="mostrarDireccion"  class="toggle-direccion">Editar Dirección</a>
                    </div>
                    <div class="col-md-12 direccion-campos">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="col">Colonia:</label>
                                <input class="form-control datosDir" type="text" name="col" id="col" placeholder="Colonia" value="<?php echo $col?>">
                            </div>
                            <div class="col-md-6">
                                <label for="calle">Calle:</label>
                                <input class="form-control datosDir" type="text" name="calle" id="calle" placeholder="Calle" value="<?php echo $calle?>">
                            </div>
                            <div class="col-md-6">
                                <label for="numE">Número exterior:</label>
                                <input class="form-control datosDir" type="text" name="numE" id="numE" placeholder="# Exterior" value="<?php echo $NumE?>">
                            </div>
                            <div class="col-md-6">
                                <label for="numI">Número interior:</label>
                                <input class="form-control datosDir" type="text" name="numI" id="numI" placeholder="# Interior" value="<?php echo $NumI?>">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn_save btn btn-primary mt-3" value="Actualizar mis datos">
            </form>
        </div>
    </section>




    
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
    <script>
        document.getElementById('mostrarDireccion').addEventListener('click', function(e) {
            e.preventDefault();
            var direccionCampos = document.querySelector('.direccion-campos');
            var direccionInputs = document.querySelectorAll('.datosDir');
            if (direccionCampos.style.display === 'none' || direccionCampos.style.display === '') {
                direccionCampos.style.display = 'block';
                direccionInputs.forEach(function(input) {
                    input.style.background = '#6d6a6a';
                    input.style.border = 'none';
                });
                this.textContent = 'Ocultar Dirección';
            } else {
                direccionCampos.style.display = 'none';
                this.textContent = 'Editar Dirección';
            }
        });
    </script>
</body>

</html>