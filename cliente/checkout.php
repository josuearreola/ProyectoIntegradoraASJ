<?php
include("../conexionBD.php");
require "config.php";

$producto = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : NULL;

$lista_carrito = array();
if ($producto != NULL) {
    foreach ($producto as $clave => $cantidad) {
        $sql = $conexion->prepare("SELECT telefono.id_tel,nom_mod,prec_tel FROM modelo INNER JOIN telefono ON modelo.id_mod = telefono.id_mod where telefono.id_tel=? and estatus=1 LIMIT 1");
        $sql->bind_param("i", $clave);
        $sql->execute();
        $sql->bind_result($id_tel, $nom_mod, $prec_tel);
        $sql->fetch();
        $producto_info = [
            'id_tel' => $id_tel,
            'nom_tel' => $nom_mod,
            'prec_tel' => $prec_tel,
            'cantidad' => $cantidad
        ];
        $lista_carrito[] = $producto_info;
        $sql->close();
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
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($lista_carrito == null) {
                            echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
                        } else {
                            $total = 0;
                            foreach ($lista_carrito as $producto) {
                                $_id = $producto['id_tel'];
                                $nombre = $producto['nom_tel'];
                                $precio = $producto['prec_tel'];
                                $cantidad = $producto['cantidad'];
                                $subtotal = $cantidad * $precio;
                                $total += $subtotal;
                        ?>
                                <tr>
                                    <td><?php echo $nombre; ?></td>
                                    <td><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></td>
                                    <td>
                                        <input type="number" min="1" max="35" step="1" value="<?php echo $cantidad; ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value,<?php echo $_id; ?>)">
                                    </td>
                                    <td>
                                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?></div>
                                    </td>
                                    <td><a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a></td>
                                </tr>
                            <?php } ?>
                    </tbody>

                    <tr>
                        <td colspan="3"></td>
                        <td colspan="2">
                            <p class="h5" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                        </td>
                    </tr>
                <?php } ?>
                </table>
            </div>
            <div class="row">
                <div class="col-md-5 offset-md-7 d-grid gap-2">
                    <button class="btn btn-primary btn-lg">Realizar pago</button>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="eliminaModalLabel">Alerta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Desea eliminar el producto de la lista?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btn-elimina" type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <footer class="footerpagprinc">
    <div class="container">
        <div>
            <label class="footer-p" for="btn-modal1">Terminos y condiciones</label>
        </div>
        <div >
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
        let eliminaModal = document.getElementById('eliminaModal')
        eliminaModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
            buttonElimina.value = id
        })

        function actualizaCantidad(cantidad, id) {
            let url = 'actualizarCarrito.php';
            let formData = new FormData();
            formData.append('action', 'agregar');
            formData.append('id', id);
            formData.append('cantidad', cantidad);


            fetch(url, {
                    method: 'POST',
                    body: formData,
                    mode: 'cors'
                }).then(response => response.json())
                .then(data => {
                    if (data.ok) {
                        let divsubtotal = document.getElementById('subtotal_' + id)
                        divsubtotal.innerHTML = data.sub

                        let total = 0.00
                        let list = document.getElementsByName('subtotal[]')

                        for (let i = 0; i < list.length; i++) {
                            total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
                        }
                        total = new Intl.NumberFormat('en-US', {
                            minimumFractionDigits: 2
                        }).format(total)
                        document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total
                    }
                })
        }

        function eliminar() {
            let botonElimina = document.getElementById('btn-elimina')
            let id = botonElimina.value

            let url = 'actualizarCarrito.php';
            let formData = new FormData();
            formData.append('action', 'eliminar');
            formData.append('id', id);


            fetch(url, {
                    method: 'POST',
                    body: formData,
                    mode: 'cors'
                }).then(response => response.json())
                .then(data => {
                    if (data.ok) {
                        location.reload()
                    }
                })
        }
    </script>
</body>

</html>