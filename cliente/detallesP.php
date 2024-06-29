<?php
include("../conexionBD.php");
require "config.php";

$id=isset($_GET['id']) ? $_GET['id'] : '';
$token=isset($_GET['token']) ? $_GET['token'] : '';

$sql="SELECT id_tel,nom_mod, prec_tel, img_tel, col_tel, cam_tel, alm_tel, pan_tel FROM modelo INNER JOIN telefono ON modelo.id_mod = telefono.id_mod";
$result=mysqli_query($conexion,$sql);

if($id == '' || $token == ''){
    echo'Error al procesar la peticion';
    exit;
}else{
    $token_temp=hash_hmac('sha1',$id,KEY_TOKEN);
    if($token == $token_temp){
        $sql= $conexion ->prepare("SELECT id_tel,nom_mod, prec_tel, img_tel, col_tel, cam_tel, alm_tel, pan_tel,proc_tel,ram_tel,nom_marc FROM modelo INNER JOIN telefono ON modelo.id_mod = telefono.id_mod INNER JOIN marca on marca.id_marca = modelo.id_marca where id_tel=? and estatus=1 LIMIT 1");
        $sql->bind_param("i", $id);
        $sql->execute();
        $sql->bind_result($id_tel, $nom_mod, $prec_tel, $img_tel, $col_tel, $cam_tel, $alm_tel, $pan_tel,$proc_tel,$ram_tel,$nom_marc); 

        if($sql->fetch()){
            $modelo=$nom_mod;
            $precio=$prec_tel;
            $imagen=$img_tel;
            $color=$col_tel;
            $camara=$cam_tel;
            $almacenamiento=$alm_tel;
            $pantalla=$pan_tel;
            $procesador=$proc_tel;
            $ram=$ram_tel;
            $nomMarca=$nom_marc;

        }
    }else{
        echo'Error al procesar la peticion';
        exit;
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
            <a href="checkout.php" style="color:black; margin-top:5px; margin-left:10px">
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
                            <a class="nav-link active lh-lg" href="productos.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active lh-lg" aria-current="page" href="checkout.php">
                                Mi carrito<span id="num_cart" class="badge bd-danger"><?php echo $num_cart;?></span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  active lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Categorias </a>
                            <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                <li><a class="dropdown-item border-0" href="#">$1000-$3500</a></li>
                                <li><a class="dropdown-item border-0" href="#">$3500-$7000</a></li>
                                <li><a class="dropdown-item border-0" href="#">Mas de $7000</a></li>
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
                <div class="col-md-4 order-md-1">
                    <img src="<?php echo '../img/'.$img_tel?>" alt="producto"  style="max-width: 100%; height: auto;">
                </div>
                <div class="col-md-7 order-md-2">
                    <h4 style="color:#fff"><?php echo $modelo;?></h4>
                    <h4 style="color:#fff"><?php echo MONEDA . number_format($precio,2, '.',',');?></h4>
                    <p class="lead">
                        <h5 style="color:#fff">Descripcion:</h5>
                        <h6 style="color:#fff">Marca: <?php echo $nomMarca ?></h6>
                        
                        <h6 style="color:#fff">Color: <?php echo $color ?></h6>
                        <h6 style="color:#fff">Camara: <?php echo $camara ?></h6>
                        <h6 style="color:#fff">Almacenamiento: <?php echo $almacenamiento ?></h6>
                        <h6 style="color:#fff">Pantalla: <?php echo $pantalla ?></h6>
                        <h6 style="color:#fff">Procesador: <?php echo $procesador ?></h6>
                        <h6 style="color:#fff">RAM: <?php echo $ram ?></h6>
                        <h6 style="color:#fff">Cantidad:<input style=" width:60px" type="number" name="cantidad" id="cantidad" min="1" max="35" value="1" ></h6>
                    </p>
                    <div class="d-grip gap-3 col-10 mx-auto">
                        <button class="btn btn-primary" type="button">Comprar ahora</button>
                        <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id;?>, '<?php  echo $token_temp ?>')">Agregar al carrito</button>
                    </div>
                </div>
            </div>
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

    <script>
        function addProducto(id, token){
            let url = 'carrito.php';
            let formData = new FormData();
            let cantidad =document.getElementById('cantidad').value;
            formData.append('id',id);
            formData.append('token',token);
            formData.append('cantidad',cantidad);

            fetch(url,{
                method: 'POST',
                body:formData,
                mode:'cors'
            }).then(response => response.json())
            .then(data =>{
                if(data.ok){
                    let elemento=document.getElementById("num_cart")
                    elemento.innerHTML = data.numero
                }
            })
        }

    </script>
</body>

</html>