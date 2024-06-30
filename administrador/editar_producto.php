<?php
ob_start();
include "../conexionBD.php";
include "../denegacion.php";


if (!empty($_POST)) {
    $alert = '';
    
    if (empty($_POST['id'])|| empty($_POST['precio']) || empty($_POST['costo']) || empty($_POST['color']) || empty($_POST['camara']) || empty($_POST['almacenamiento']) || empty($_POST['ram']) || empty($_POST['pantalla']) || empty($_POST['bateria']) || empty($_POST['procesador']) || empty($_POST['foto_actual']) || empty($_POST['foto_remove'])) {
        $alert = '<p class="msj_error">Todos los campos son obligatorios </p>';
    } else {
        $id_tel=$_POST['id'];
        $precio = $_POST['precio'];
        $costo = $_POST['costo'];
        $color = $_POST['color'];
        $camara = $_POST['camara'];
        $almacenamiento = $_POST['almacenamiento'];
        $ram = $_POST['ram'];
        $pantalla = $_POST['pantalla'];
        $bateria = $_POST['bateria'];
        $procesador = $_POST['procesador'];
        $imgProducto=$_POST['foto_actual'];
        $imgRemove=$_POST['foto_remove'];

        $foto = $_FILES['foto']; 
        $nombre_foto = $foto['name'];
        $type = $foto['type'];
        $url_temp = $foto['tmp_name'];

        $upd='';



        if($nombre_foto != ''){
            $destino ='../img/';
            $img_nombre='img_'.md5(date('d-m-Y H:m:s'));
            $imgProd=$img_nombre.'.jpg';
            $src=$destino.$imgProd;
        }else{
            if ($_POST['foto_actual'] != $_POST['foto_remove']) {
                $imgProducto='../img/img_producto.png';
            }
        }

     

       
            $queryUpdateTelefono = "UPDATE telefono SET col_tel='$color', cam_tel='$camara', alm_tel='$almacenamiento', ram_tel='$ram', pan_tel='$pantalla', bat_tel='$bateria', proc_tel='$procesador', prec_tel='$precio', costo_tel='$costo', img_tel='$imgProducto' WHERE id_tel='$id_tel'";
            $resultadoUpdateTelefono = mysqli_query($conexion, $queryUpdateTelefono);
        
            if ($resultadoUpdateTelefono) {
                if (($nombre_foto != '' && ($_POST['foto_actual'] != '../img/img_producto.png')) || ($_POST['foto_actual'] != $_POST['foto_remove'])) {
                    unlink('../img/'.$_POST['foto_actual']);
                }
                if ($nombre_foto != '') {
                    move_uploaded_file($url_temp,$src);
                }
                $alert='<p class="msg_save">Producto actualizado correctamente</p>';
            
        }
    }
}

//validar prod//

if(empty($_REQUEST['id'])){
    header("location:listaProd.php");
}else{
    $id_producto=$_REQUEST['id'];
    if (!is_numeric($id_producto)) {
        header("location:listaProd.php");
    }
    $query_producto=mysqli_query($conexion,"SELECT nom_marc,nom_mod,id_tel,col_tel,cam_tel,alm_tel,ram_tel,pan_tel,bat_tel,proc_tel,prec_tel,costo_tel,img_tel from marca inner join modelo on marca.id_marca = modelo.id_marca inner join telefono on modelo.id_mod=telefono.id_mod where id_tel='$id_producto' and estatus=1");
    $result_producto=mysqli_num_rows($query_producto);

    $foto= '';
    $classRemove='notBlock';

    if ($result_producto>0) {
        $data_producto=mysqli_fetch_assoc($query_producto);
        if ($data_producto['img_tel'] != '../img/img_producto.png') {
           $classRemove='';
           $foto='<img id="img" src="../img/'.$data_producto['img_tel'].'" alt="producto">';
        }
    }else{
        header("location:listaProd.php");
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
                                        <li><a class="dropdown-item border-0" href="#">Productos eliminados</a></li>
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
            <h1 class="text-prin">Actualizar producto</h1>
            <hr>
            <?php if (!empty($alert)) : ?>
                <div class="alert"><?php echo $alert; ?></div>
            <?php endif; ?>
            <form class="formProd" action="editar_producto.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $data_producto['id_tel']; ?>">
                <input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_producto['img_tel'];?>">
                <input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_producto['img_tel'];?>">
                <div class="row">
                    <div class="col-md-6">
                        <label for="marca">Marca del telefono:</label>
                        <input type="text" name="marca" id="marca" placeholder="Marca del telefono" value="<?php echo $data_producto['nom_marc']?>" readonly required>
                    </div>
                    <div class="col-md-6">
                        <label for="modelo">Modelo del telefono:</label>
                        <input type="text" name="modelo" id="modelo" placeholder="Modelo del telefono"value="<?php echo $data_producto['nom_mod']?>" readonly required>
                    </div>
                    <div class="col-md-6">
                        <label for="precio">Precio del telefono:</label>
                        <input type="text" name="precio" id="precio" placeholder="Precio del telefono" value="<?php echo $data_producto['prec_tel']?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="costo">Costo del telefono:</label>
                        <input type="text" name="costo" id="costo" placeholder="Costo del telefono" value="<?php echo $data_producto['costo_tel']?>" required>
                    </div>
                    <div class="col-md-12">
                        <a href="#" id="mostrarDatosTel" class="toggle-direccion">Datos generales</a>
                    </div>
                    <div class="col-md-12 telefonos-campos">
                        <div class=" row">
                            <div class="col-md-6">
                                <label for="color">Color:</label>
                                <input type="text" name="color" id="color" class="form-control datosTel" placeholder="Color" value="<?php echo $data_producto['col_tel']?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="camara">Camara:</label>
                                <input type="text" name="camara" id="camara" class="form-control datosTel" placeholder="Camara" value="<?php echo $data_producto['cam_tel']?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="almacenamiento">Almacenamiento:</label>
                                <input type="text" name="almacenamiento" id="almacenamiento" class="form-control datosTel" placeholder="Almacenamiento" value="<?php echo $data_producto['alm_tel']?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="ram">RAM:</label>
                                <input type="text" name="ram" id="ram" class="form-control datosTel" placeholder="RAM" value="<?php echo $data_producto['ram_tel']?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="pantalla">Pantalla:</label>
                                <input type="text" name="pantalla" id="pantalla" class="form-control datosTel" placeholder="Pantalla" value="<?php echo $data_producto['pan_tel']?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="bateria">Bateria:</label>
                                <input type="text" name="bateria" id="bateria" class="form-control datosTel" placeholder="Bateria" value="<?php echo $data_producto['bat_tel']?>" required>
                            </div>
                            <div class="col-md-12">
                                <label for="procesador">Procesador:</label>
                                <input type="text" name="procesador" id="procesador" class="form-control datosTel" placeholder="Procesador" value="<?php echo $data_producto['proc_tel']?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="photo">
                        <label for="foto">Foto</label>
                        <div class="prevPhoto">
                            <span class="delPhoto <?php echo $classRemove;?>">X</span>
                            <label for="foto"></label>
                            <?php echo $foto;?>
                        </div>
                        <div class="upimg">
                            <input type="file" name="foto" id="foto">
                        </div>
                        <div id="form_alert"></div>
                    </div>
                </div>
                <input type="submit" class="btn_save" value="Actualizar producto">
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