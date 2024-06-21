<?php
session_start();
$alert = '';
if (!empty($_SESSION['active'])) {
    if ($rol == 'administrador') {
        header('Location: ../administrador/administrador.php');
        exit();
    } elseif ($rol == 'cliente') {
        header('Location: ../cliente/cliente.php');
        exit();
    }
} else {
    if (!empty($_POST)) {
        if (empty($_POST['usuario']) || empty($_POST['contraseña'])) {
            $alert = 'Complete todos los campos';
        } else {
            require_once "../conexionBD.php";
            $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
            $pass = md5(mysqli_real_escape_string($conexion, $_POST['contraseña']));

            $query = mysqli_query($conexion, "select * from usuario where nom_usua = '$user' and pass_usua='$pass'");
            mysqli_close($conexion);
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                $data = mysqli_fetch_assoc($query);
                $_SESSION['active'] = true;
                $_SESSION['idUsua'] = $data['nom_usua'];
                $_SESSION['tipUsua'] = $data['tip_usua'];
                $_SESSION['passUsua'] = $data['pass_usua'];
                header('location: ..\roles.php');
            } else {
                $alert = 'El usuario o la clave son incorrectos';
                session_destroy();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/styleIndex.css">
    <link rel="icon" href="../img/logo.ico">
</head>

<body>
    <header>
        <div class="info_usua">
            <label class="nameEmp">A S J Technology</label>

        </div>
        <div class="regresar">
            <a class="regPag" href="../pagPrincipal.php">Pagina principal</a>
        </div>
    </header>
    <section>
        <div class="div-Inicio">
            <form class="Form-InicioSesion" action="iniciosesion.php" method="POST" id="formulario">
                <p class="text-prinInicio">Accede</p>
                <p class="text-Inicio">Inicia sesión para continuar</p>
                <div class="div-usuario">
                    <label class="text-Info" for="usuario">USUARIO </label>
                    <input class="form-Inicio" type="text" name="usuario" id="usuario" placeholder="Usuario">
                    <p class="formulario__input-error" id="error-usuario">El usuario tiene que ser de 4 a 16 digitos y solo puede contener numeros,letras y guion bajo</p>
                </div>
                <div class="div-contr">
                    <label class="text-Info" for="contraseña">CONTRASEÑA</label>
                    <input class="form-Inicio" type="password" name="contraseña" id="contraseña" placeholder="*******"><br>
                    <p class="formulario__input-error" id="error-contraseña">La contraseña tiene que ser de 4 a 12 digitos</p>
                </div>

                <div class="alert" id="alert">
                    <?php echo isset($alert) ? '<div class="alert-style">' . $alert . '</div>'  : ''; ?>
                    <p class="formulario__input-error">Completa el formulario completo</p>
                </div>
                <a class="opciones" href="../CreacionCuenta/crearCuenta.php">Crear cuenta</a>
                <a class="opciones" href="../RecuperarContraseña/RestablecerContraseña1.php">¿Olvidaste tu contraseña?</a>
                <input class="btn-Inicio" type="submit" value="Acceder" id="submit">
            </form>
        </div>
    </section>
    <footer class="footerInicio">
        <div class="boton-modal1">
            <label class="footer-i" for="btn-modal1">Terminos y condiciones</label>
        </div>
        <div>
            <label class="footer-i" for="btn-modal2">Atencion al cliente</label>
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
    <script src="../javascript/validacion.js"></script>
</body>

</html>