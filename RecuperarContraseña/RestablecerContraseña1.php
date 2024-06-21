<?php
session_start();
$alert = '';
    if (!empty($_POST)) {
        if (empty($_POST['datoVinc'])) {
            $alert = 'Complete todos los campos';
        }else{
            if (empty($_POST["email"])) {
            require_once("../conexionBD.php");
            $email = $_POST['datoVinc'];
            $consulta = "select email_clie from cliente where email_clie='$email' LIMIT 1";
            $f = mysqli_query($conexion, $consulta);
            $a = mysqli_fetch_array($f);
            if ( ! $a ) {
                $alert = "No existe ese correo";
            } else {
                $_SESSION['email'] = $email;
                header('location:RestablecerContraseña2.php');
                exit;
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
    <title>Restablecer contraseña</title>
    <link rel="stylesheet" href="../css/restContra.css">
    <link rel="icon" href="../img/logo.ico">
</head>

<body>
    <header>
        <div class="info-usua">
            <label class="nameEmp">A S J Technology</label>
        </div>
        <div class="regresar">
            <a class="regPag" href="../iniciosesion/iniciosesion.php">Iniciar sesión</a>
        </div>
    </header>
    <section>
        <div class="div-rest">
            <form action="RestablecerContraseña1.php" method="post" class="form-Rest">
                <p class="p-prinRest">Restablecer contraseña</p>
                <p class="p-Rest">Introduce un correo vinculado a tu cuenta</p>
                <input type="text" class="form-Dato" name="datoVinc" id="datoVinc" placeholder="Correo electrónico">
                <div class="alert" id="alert">
                    <?php echo isset($alert) ? '<div class="alert-style">' . $alert . '</div>'  : ''; ?>
                    
                </div>
                <input type="submit" value="Siguiente" class="btn-rest1">
            </form>
        </div>
    </section>
    <footer class="footerRest">
        <div class="boton-modal1">
            <label class="footer-r" for="btn-modal1">Terminos y condiciones</label>
        </div>
        <div>
            <label class="footer-r" for="btn-modal2">Atencion al cliente</label>
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