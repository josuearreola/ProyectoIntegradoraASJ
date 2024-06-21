<?php 
    $alert="";
    if(!empty($_POST)){
        if(empty($_POST["nombre"])||empty($_POST["usuario"])||empty($_POST["email"])||empty($_POST["contraseña"])){
            $alert="Ingrese todos los campos";
        }else{
        require_once("../conexionBD.php");
        $nombre=$_POST["nombre"];
        $usuario=$_POST["usuario"];
        $email=$_POST["email"];
        $contraseña=$_POST["contraseña"];
        $nombre=mysqli_real_escape_string($conexion,$_POST["nombre"]);
        $user=mysqli_real_escape_string($conexion,$_POST["usuario"]);
        $email=mysqli_real_escape_string($conexion,$_POST["email"]);
        $pass=md5($_POST["contraseña"]);
        $tip_usua="cliente";
        $consulta1="insert into usuario (nom_usua,tip_usua,pass_usua) values ('$usuario','$tip_usua',MD5('$contraseña'))";
        $query1=mysqli_query($conexion,$consulta1);
        if($query1===true){
            $id_usua=$conexion->insert_id;
            $consulta2="insert into cliente (nom_clie,email_clie,id_usua) values ('$nombre','$email','$id_usua')";
            $query3=mysqli_query($conexion,$consulta2);
            header("../inicioSesion/iniciosesion.php");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear una cuenta</title>
    <link rel="stylesheet" href="../css/styleCrearCuenta.css">
    <link rel="icon" href="../img/logo.ico">
</head>
<body>
    <header>
        <div class="info_usua">
            <label class="nameEmp">A S J Technology</label>
        </div>
    </header>
    <section>
        <div class="div-Creacion">
            <form action="crearCuenta.php" method="post" class="Form-CreacionCuenta" id="formulario">
                <p class="text-prinCreacion">Crear una cuenta nueva</p>
                <p class="text-Creacion">¿Ya tienes cuenta? <a class="envInicio" href="../iniciosesion/iniciosesion.php">Inicia sesión</a></p>
                <div class="div-usua">
                    <label class="text-Info" for="nombre">Nombre</label>
                    <input class="form-Creacion" type="text" name="nombre" id="nombre" placeholder="Nombre">
                    <p class="formulario__input-error" id="error-usuario">El nombre tiene que ser de 4 a 16 digitos y solo puede contener numer,letras y guion bajo</p>
                </div>
                <div class="div-usua">
                    <label class="text-Info" for="usuario">USUARIO</label>
                    <input class="form-Creacion" type="text" name="usuario" id="usuario" placeholder="Usuario">
                    <p class="formulario__input-error" id="error-usuario">El usuario tiene que ser de 4 a 16 digitos y solo puede contener numer,letras y guion bajo</p>
                </div>
                <div class="div-correo">
                    <label class="text-Info" for="email">CORREO ELECTRÓNICO</label>
                    <input class="form-Creacion" type="email" name="email" id="email" placeholder="Ejemplo@gmail.com">
                    <p class="formulario__input-error" id="error-email">El correo solo puede contener letras,numeros,puntos,guiones y guion bajo</p>
                </div>
                <div class="div-contraseña">
                    <label class="text-Info" for="contraseña">CONTRASEÑA</label>
                    <input class="form-Creacion" type="password" name="contraseña" id="contraseña" placeholder="Contraseña">
                    <p class="formulario__input-error" id="error-contraseña">La contraseña tiene que ser de 4 a 12 digitos</p>
                </div>
                <div class="alert"> 
                    <?php echo isset($alert)? '<div class="alert-style">'. $alert . '</div>' : '';?>
                </div>
                <input type="submit" value="Crear Cuenta" class="btn-Creacion" id="btn-Creacion">
            </form>
        </div>
    </section>
    <footer class="footerCreacion">
        <div class="boton-modal1">
            <label class="footer-c" for="btn-modal1">Terminos y condiciones</label>
        </div>
        <div>
            <label class="footer-c" for="btn-modal2">Atencion al cliente</label>
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