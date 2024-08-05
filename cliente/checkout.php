<?php
include("../conexionBD.php");
require "config.php";
if (empty($_SESSION['idUsua'])) {
    header('location:../inicioSesion/iniciosesion.php');
}

$producto = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : NULL;
$idUsua = $_SESSION['idUsua'];
$lista_carrito = array();
$total = 0;

if (!empty($_SESSION['pago_completado'])) {
    unset($_SESSION['carrito']);
    unset($_SESSION['carrito_total']);
    $clearLocalStorageScript = "<script>localStorage.removeItem('carrito_" . $_SESSION['idUsua'] . "');</script>";
    echo $clearLocalStorageScript;
    unset($_SESSION['pago_completado']);
} else {
    if ($producto != NULL) {
        foreach ($producto as $clave => $cantidad) {
            $sql = $conexion->prepare("SELECT telefono.id_tel,nom_mod,prec_tel,exist_inv,sucursal.id_suc,inventario.id_inv,nom_suc FROM modelo INNER JOIN telefono ON modelo.id_mod = telefono.id_mod inner join inventario on telefono.id_tel=inventario.id_tel inner join sucursal on sucursal.id_suc =inventario.id_suc where inventario.id_inv=? and inventario.estatus=1 LIMIT 1");
            $sql->bind_param("i", $clave);
            $sql->execute();
            $sql->bind_result($id_tel, $nom_mod, $prec_tel, $exist_inv, $id_suc, $id_inv, $nom_suc);
            $sql->fetch();
            $sql->close();
            $producto_info = [
                'id_tel' => $id_tel,
                'nom_tel' => $nom_mod,
                'prec_tel' => $prec_tel,
                'exist_inv' => $exist_inv,
                'cantidad' => $cantidad,
                'id_suc' => $id_suc,
                'id_inv' => $id_inv,
                'nom_suc' => $nom_suc
            ];
            $lista_carrito[] = $producto_info;
        }
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
            <a href="checkout.php" style="color:black; margin-top:5px; margin-left:10px">
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
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Sucursal</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($lista_carrito == null) {
                            echo '<tr><td colspan="6" class="text-center"><b>Lista vacia</b></td></tr>';
                        } else {
                            $total = 0;
                            foreach ($lista_carrito as $producto) {
                                $_id = $producto['id_tel'];
                                $id_inv = $producto['id_inv'];
                                $nomSuc = $producto['nom_suc'];
                                $nombre = $producto['nom_tel'];
                                $precio = $producto['prec_tel'];
                                $cantidad = $producto['cantidad'];
                                $subtotal = $cantidad * $precio;
                                $total += $subtotal;
                        ?>
                            <?php } ?>
                    </tbody>

                    <tr>
                        <td colspan="3" style="font-weight: bold">Envío: $120</td>
                        <td colspan="2"></td>
                        <td colspan="1">
                            
                            <p class="h5" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                        </td>

                    </tr>
                <?php } ?>
                </table>
            </div>

            <div class="row">
                <div class="col-md-5 offset-md-7 d-grid gap-2">
                    <?php if (!empty($lista_carrito)) { ?>
                        <a class="btn btn-primary btn-lg" href="datosEnvio.php?id=<?php echo $idUsua ?>">Realizar pago</a>
                    <?php } ?>
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
    <footer class="footerpagprinc footer-fixed">
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
        let eliminaModal = document.getElementById('eliminaModal')
        eliminaModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
            buttonElimina.value = id
        })

        

        function eliminar() {
            let botonElimina = document.getElementById('btn-elimina');
            let id = botonElimina.value;

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

                        let listaCarrito = JSON.parse(localStorage.getItem(`carrito_${idUsua}`));
                        listaCarrito = listaCarrito.filter(producto => producto.id_inv != id);
                        localStorage.setItem(`carrito_${idUsua}`, JSON.stringify(listaCarrito));

                        location.reload();
                    }
                });
        }
    </script>
    <?php $lista_carrito_json = json_encode($lista_carrito); ?>

    <script>
        const idUsua = "<?php echo $idUsua; ?>";
        const listaCarrito = <?php echo json_encode($lista_carrito); ?>;
        localStorage.setItem(`carrito_${idUsua}`, JSON.stringify(listaCarrito));
        document.addEventListener("DOMContentLoaded", function() {

            function formatearMoneda(valor) {
                return '<?php echo MONEDA; ?>' + new Intl.NumberFormat('es-ES', {
                    minimumFractionDigits: 2
                }).format(valor);
            }
            const idUsua = "<?php echo $idUsua; ?>";
            const listaCarrito = JSON.parse(localStorage.getItem(`carrito_${idUsua}`));
            const tbody = document.querySelector("table tbody");

            if (listaCarrito && tbody) {
                let total = 0;

                listaCarrito.forEach(producto => {
                    const tr = document.createElement("tr");

                    const nombreTd = document.createElement("td");
                    nombreTd.textContent = producto.nom_tel;
                    tr.appendChild(nombreTd);

                    const nombresucTd = document.createElement("td");
                    nombresucTd.textContent = producto.nom_suc;
                    tr.appendChild(nombresucTd);

                    const precioTd = document.createElement("td");
                    precioTd.textContent = formatearMoneda(producto.prec_tel);
                    tr.appendChild(precioTd);

                    const cantidadTd = document.createElement("td");
                    cantidadTd.textContent = producto.cantidad
                    tr.appendChild(cantidadTd);

                    const subtotalTd = document.createElement("td");
                    const subtotal = producto.cantidad * producto.prec_tel;
                    total += subtotal;
                    subtotalTd.id = `subtotal_${producto.id_tel}`;
                    subtotalTd.name = "subtotal[]";
                    subtotalTd.textContent = formatearMoneda(subtotal);
                    tr.appendChild(subtotalTd);


                    const eliminarTd = document.createElement("td");
                    const eliminarBtn = document.createElement("a");
                    eliminarBtn.href = "#";
                    eliminarBtn.id = "eliminar";
                    eliminarBtn.className = "btn btn-warning btn-sm";
                    eliminarBtn.dataset.bsId = producto.id_inv;
                    eliminarBtn.dataset.bsToggle = "modal";
                    eliminarBtn.dataset.bsTarget = "#eliminaModal";
                    eliminarBtn.textContent = "Eliminar";
                    eliminarTd.appendChild(eliminarBtn);
                    tr.appendChild(eliminarTd);

                    tbody.appendChild(tr);
                });


                const {
                    totalConDescuento,
                    descuento
                } = calcularDescuento(total);
                const totalElement = document.getElementById("total");
                totalElement.innerHTML = `
                
                ${descuento > 0 ? `<del style="color: #666; font-size: 14px; text-decoration: line-through;">$${total.toFixed(2)}</del> ` : ''}
                <span style="color: #000; font-size: 18px;">$${totalConDescuento.toFixed(2)}</span>
                ${descuento > 0 ? `<small style="color: #666;"> (Descuento: $${descuento.toFixed(2)})</small>` : ''}
                `;
            }
        });


        function actualizaCantidad(cantidad, id) {
            const idUsua = "<?php echo $idUsua; ?>";
            let listaCarrito = JSON.parse(localStorage.getItem(`carrito_${idUsua}`));

            listaCarrito = listaCarrito.map(producto => {
                if (producto.id_tel == id) {
                    producto.cantidad = parseInt(cantidad, 10);
                    const nuevoSubtotal = producto.cantidad * producto.prec_tel;
                    document.getElementById(`subtotal_${id}`).textContent = nuevoSubtotal.toFixed(2);
                }
                return producto;
            });

            localStorage.setItem(`carrito_${idUsua}`, JSON.stringify(listaCarrito));
            actualizarSesion(id, cantidad);

            // Actualizar el total
            let total = 0;
            const subtotales = document.getElementsByName('subtotal[]');
            for (let i = 0; i < subtotales.length; i++) {
                total += parseFloat(subtotales[i].textContent.replace(/[$,]/g, ''));
            }
            total = new Intl.NumberFormat('es-ES', {
                minimumFractionDigits: 2
            }).format(total);
            document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total;

            const {
                totalConDescuento,
                descuento
            } = calcularDescuento(total);
            enviarTotalConDescuento(totalConDescuento);
        }

        function calcularDescuento(total) {
            let descuento = 0;
            let envio = 120;
            let totalConDescuento = total;

            if (total > 40000) {
                descuento = 800;
                totalConDescuento -= descuento;
                totalConDescuento += envio
            } else if (total > 30000) {
                descuento = total * 0.15;
                totalConDescuento -= descuento;
                totalConDescuento += envio
            } else if (total > 20000) {
                descuento = 500;
                totalConDescuento -= descuento;
                totalConDescuento += envio
            }else if(total <=20000){
                totalConDescuento += envio
            }

            return {
                totalConDescuento,
                descuento
            };
        }

        // ...

        let total = listaCarrito.reduce((acc, producto) => acc + (producto.cantidad * producto.prec_tel), 0);
        const {
            totalConDescuento,
            descuento
        } = calcularDescuento(total);

        enviarTotalConDescuento(totalConDescuento);

        function enviarTotalConDescuento(totalConDescuento) {
            fetch('actualizar_total.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        totalConDescuento
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.ok) {
                        console.log('Total con descuento actualizado en el servidor');
                    } else {
                        console.error('Error al actualizar el total con descuento en el servidor');
                    }
                })
                .catch(error => {
                    console.error('Error en la petición AJAX:', error);
                });
        }


       
    </script>
</body>

</html>