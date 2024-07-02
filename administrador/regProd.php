<?php
ob_start();
include "../conexionBD.php";
include "../denegacion.php";


if (!empty($_POST)) {
    $alert = '';
    
    if (empty($_POST['marca']) || empty($_POST['modelo']) || empty($_POST['precio']) || empty($_POST['costo']) || empty($_POST['color']) || empty($_POST['camara']) || empty($_POST['almacenamiento']) || empty($_POST['ram']) || empty($_POST['pantalla']) || empty($_POST['bateria']) || empty($_POST['procesador'])) {
        $alert = '<p class="msj_error">Todos los campos son obligatorios </p>';
    } else {
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $precio = $_POST['precio'];
        $costo = $_POST['costo'];
        $color = $_POST['color'];
        $camara = $_POST['camara'];
        $almacenamiento = $_POST['almacenamiento'];
        $ram = $_POST['ram'];
        $pantalla = $_POST['pantalla'];
        $bateria = $_POST['bateria'];
        $procesador = $_POST['procesador'];
        $foto = $_FILES['foto']; 

        $nombre_foto = $foto['name'];
        $type = $foto['type'];
        $url_temp = $foto['tmp_name'];

        $imgProd='../img/img_producto.png';



        if($nombre_foto != ''){
            $destino ='../img/';
            $img_nombre='img_'.md5(date('d-m-Y H:m:s'));
            $imgProd=$img_nombre.'.jpg';
            $src=$destino.$imgProd;
        }

        $queryMarca = "SELECT id_marca FROM marca WHERE nom_marc='$marca'";
        $resultadoMarca = mysqli_query($conexion, $queryMarca);

        if ($resultadoMarca && mysqli_num_rows($resultadoMarca) > 0) {
            $rowMarca = mysqli_fetch_assoc($resultadoMarca);
            $id_marca = $rowMarca['id_marca'];
        } else {
            $queryInsertMarca = "INSERT INTO marca (nom_marc) VALUES ('$marca')";
            $resultadoInsertMarca = mysqli_query($conexion, $queryInsertMarca);

            if ($resultadoInsertMarca) {
                $id_marca = mysqli_insert_id($conexion);
            } else {
                $alert = 'Error al insertar la marca: ' . mysqli_error($conexion);
            }
        }

        $queryModelo = "SELECT id_mod FROM modelo WHERE nom_mod='$modelo'";
        $resultadoModelo = mysqli_query($conexion, $queryModelo);

        if ($resultadoModelo && mysqli_num_rows($resultadoModelo) > 0) {
            $rowModelo = mysqli_fetch_assoc($resultadoModelo);
            $id_mod = $rowModelo['id_mod'];
        } else {
            $queryInsertModelo = "INSERT INTO modelo (nom_mod, id_marca) VALUES ('$modelo', '$id_marca')";
            $resultadoInsertModelo = mysqli_query($conexion, $queryInsertModelo);

            if ($resultadoInsertModelo) {
                $id_mod = mysqli_insert_id($conexion);
                $queryInsertTelefono = "INSERT INTO telefono (col_tel, cam_tel, alm_tel, ram_tel, pan_tel, bat_tel, proc_tel, prec_tel, costo_tel,img_tel, id_mod) 
                                        VALUES ('$color', '$camara', '$almacenamiento', '$ram', '$pantalla', '$bateria', '$procesador', '$precio', '$costo','$imgProd', '$id_mod')";
                $resultadoInsertTelefono = mysqli_query($conexion, $queryInsertTelefono);

                if ($resultadoInsertTelefono) {
                    if($nombre_foto != ''){
                        move_uploaded_file($url_temp,$src);
                    }
                    $alert = 'Producto registrado correctamente';
                } else {
                    $alert = 'Error al guardar el producto';
                }
            } else {
                $alert = 'Error al insertar el modelo';
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
    <title>ASJ Technology</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="../img/logo.ico">
    <link rel="stylesheet" href="../css/styleDatosTel.css">
</head>

<body>
    <header class="header">
        <div>
            <nav class="navbar bg-secondary navbar-expand-lg border-top border-bottom border-3 border-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="../salir.php">
                        <img src="../img/logo.jpg" class="logo">
                        <img class="imgses" src="../img/cerrarses.jpg" alt="Cerrar sesion" title="salir">
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
                                    <a class="nav-link active lh-lg" aria-current="page" href="administrador.php">Inicio</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Usuarios </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="registrousuario.php">Nuevo usuario</a></li>
                                        <li><a class="dropdown-item border-0" href="listausuarios.php">Lista de usuarios</a></li>
                                        <li><a class="dropdown-item border-0" href="ListaUsuElimin.php">Usuarios eliminados</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Facturas</a>
                                    <ul class="dropdown-menu bg-secondary" aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="registrousuario.php">Nueva facturas</a></li>
                                        <li><a class="dropdown-item border-0" href="listausuarios.php">Lista de facturas</a></li>
                                        <li><a class="dropdown-item border-0" href="#">Facturas eliminadas</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Productos </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="regProd.php">Nuevos productos</a></li>
                                        <li><a class="dropdown-item border-0" href="listaProd.php">Lista de productos</a></li>
                                        <li><a class="dropdown-item border-0" href="ListaProdElimin.php">Productos eliminados</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Sucursales </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="#">Nueva sucursal</a></li>
                                        <li><a class="dropdown-item border-0" href="#">Lista de sucursales</a></li>
                                        <li><a class="dropdown-item border-0" href="#">Sucursales eliminadas</a></li>
                                    </ul>
                                </li>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <section></section>
    </header>
    <div class="container">
        <div class="form_register mt-4">
            <h1 class="text-prin">Registro de productos</h1>
            <hr>
            <?php if (!empty($alert)) : ?>
                <div class="alert"><?php echo $alert; ?></div>
            <?php endif; ?>
            <form class="formProd" action="regProd.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <label for="marca">Marca del telefono:</label>
                        <input type="text" name="marca" id="marca" placeholder="Marca del telefono" required>
                    </div>
                    <div class="col-md-6">
                        <label for="modelo">Modelo del telefono:</label>
                        <input type="text" name="modelo" id="modelo" placeholder="Modelo del telefono" required>
                    </div>
                    <div class="col-md-6">
                        <label for="precio">Precio del telefono:</label>
                        <input type="text" name="precio" id="precio" placeholder="Precio del telefono" required>
                    </div>
                    <div class="col-md-6">
                        <label for="costo">Costo del telefono:</label>
                        <input type="text" name="costo" id="costo" placeholder="Costo del telefono" required>
                    </div>
                    <div class="col-md-12">
                        <a href="#" id="mostrarDatosTel" class="toggle-direccion">Datos generales</a>
                    </div>
                    <div class="col-md-12 telefonos-campos">
                        <div class=" row">
                            <div class="col-md-6">
                                <label for="color">Color:</label>
                                <input type="text" name="color" id="color" class="form-control datosTel" placeholder="Color" required>
                            </div>
                            <div class="col-md-6">
                                <label for="camara">Camara:</label>
                                <input type="text" name="camara" id="camara" class="form-control datosTel" placeholder="Camara" required>
                            </div>
                            <div class="col-md-6">
                                <label for="almacenamiento">Almacenamiento:</label>
                                <input type="text" name="almacenamiento" id="almacenamiento" class="form-control datosTel" placeholder="Almacenamiento" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ram">RAM:</label>
                                <input type="text" name="ram" id="ram" class="form-control datosTel" placeholder="RAM" required>
                            </div>
                            <div class="col-md-6">
                                <label for="pantalla">Pantalla:</label>
                                <input type="text" name="pantalla" id="pantalla" class="form-control datosTel" placeholder="Pantalla" required>
                            </div>
                            <div class="col-md-6">
                                <label for="bateria">Bateria:</label>
                                <input type="text" name="bateria" id="bateria" class="form-control datosTel" placeholder="Bateria" required>
                            </div>
                            <div class="col-md-12">
                                <label for="procesador">Procesador:</label>
                                <input type="text" name="procesador" id="procesador" class="form-control datosTel" placeholder="Procesador" required>
                            </div>
                        </div>
                    </div>
                    <div class="photo">
                        <label for="foto">Foto</label>
                        <div class="prevPhoto">
                            <span class="delPhoto notBlock">X</span>
                            <label for="foto"></label>
                        </div>
                        <div class="upimg">
                            <input type="file" name="foto" id="foto">
                        </div>
                        <div id="form_alert"></div>
                    </div>
                </div>
                <input type="submit" class="btn_save" value="Registrar producto">
            </form>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        document.getElementById('mostrarDatosTel').addEventListener('click', function(e) {
            e.preventDefault();
            var telefonocampos = document.querySelector('.telefonos-campos');
            var telefonoinputs = document.querySelectorAll('.datosTel');
            if (telefonocampos.style.display === 'none' || telefonocampos.style.display === '') {
                telefonocampos.style.display = 'block';
                telefonoinputs.forEach(function(input) {
                    input.style.background = '#6d6a6a';
                    input.style.border = 'none';
                    input.style.color = '#09b0f2';
                });
                this.textContent = 'Ocultar datos generales';
            } else {
                telefonocampos.style.display = 'none';
                this.textContent = 'Datos generales';
            }
        });
    </script>
    <script src="../javascript/jquery.min.js"></script>
    <script src="../javascript/regProd.js"></script>
</body>