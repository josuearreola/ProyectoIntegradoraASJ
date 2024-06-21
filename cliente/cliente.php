<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASJ Technology</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <a href="#" style="color:black; margin-top:5px; margin-left:10px" >
                    <i class="fa-solid fa-cart-plus fa-2x"></i>
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
                            <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                <li><a class="dropdown-item border-0" href="#">$1000-$3500</a></li>
                                <li><a class="dropdown-item border-0" href="#">$3500-$7000</a></li>
                                <li><a class="dropdown-item border-0" href="#">Mas de $7000</a></li>
                            </ul>
                        </li>
                        <form form class="d-flex mt-2" role="search">
                            <input class="form-control me-2 " type="search" placeholder="Buscar productos" aria-label="Search">
                            <button class="btn bg-success" type="submit">Buscar</button>
                        </form>
                </div>
            </div>
        </div>
    </nav>

    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true" style="padding-top:5px">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../img/carrusel2.jpg" class="d-block w-100 img-fluid" alt="...">
                <div class="carousel-caption" style="position:absolute; top: 50%; transform: translateY(-50%); left: -40%; color:black;">
                    <h5>¡Conócenos más!</h5>
                    <button class="btn bg-blag">Más información</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../img/carrusel3.jpeg" class="d-block w-100 img-fluid" alt="...">
                <div class="carousel-caption" style="position:absolute; top: 50%; transform: translateY(-50%); left: -40%; color:black;">
                    <h5>¡Descubre nuestras ofertas!</h5>
                    <button class="btn bg-blag">Más información</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="../img/carrusel4.jpg" class="d-block w-100 img-fluid" alt="...">
                <div class="carousel-caption" style="position:absolute; top: -40%; transform: translateY(50%); right: -40%; color:black;">
                    <h5>¡La mejor calidad!</h5>
                    <button class="btn bg-blag">Más información</button>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <p class="text-center fs-1" style="color:#fff;">Ofertas especiales</p>

    <main>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="../img/pro1.jpg" alt="Promocion-1" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">¡Oferta especial "Mi Fans"!</h5>
                            <p class="card-text">$500 de descuento</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-primary">Más información</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="../img/pro2.jpg" alt="Promocion-2" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Mi zona de fans</h5>
                            <p class="card-text">15% de descuento</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-primary">Más información</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="../img/pro3.jpg" alt="Promocion-3" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Tu regalo de cumpleaños</h5>
                            <p class="card-text">$800 de descuento</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-primary">Más información</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <p class="text-center fs-1" style="color:#fff;">Productos estrella</p>
    <main>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-5">
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="../img/tel1.jpg" alt="ProEstre-1" class="card-img-top img">
                        <div class="card-body">
                            <h5 class="card-title">Redmi note 12S</h5>
                            <p class="card-text">Cámara principal de 108MP</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group" style="width:40px;padding:10px">
                                    <a href="" class="btn btn-primary">Detalles</a>
                                </div>
                                <a href="" class="btn btn-success">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="../img/img2.png" alt="Promocion-2" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">iPhone 15</h5>
                            <p class="card-text">Todo para sorprenderte.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group" style="width:40px;padding:10px">
                                    <a href="" class="btn btn-primary">Detalles</a>
                                </div>
                                <a href="" class="btn btn-success">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="../img/img3.avif" alt="ProEstre-1" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Samsung Note 24</h5>
                            <p class="card-text">El mejor precio</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group" style="width:40px;padding:10px">
                                    <a href="" class="btn btn-primary">Detalles</a>
                                </div>
                                <a href="" class="btn btn-success">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="../img/tel4.avif" alt="Promocion-2" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Galaxy S24+</h5>
                            <p class="card-text">Todo para sorprenderte.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group" style="width:40px;padding:10px">
                                    <a href="" class="btn btn-primary">Detalles</a>
                                </div>
                                <a href="" class="btn btn-success">Comprar</a>
                            </div>
                        </div>
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
</body>

</html>