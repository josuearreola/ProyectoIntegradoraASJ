<?php
ob_start();
include "../conexionBD.php";
include("../denegacion.php");
if(empty($_SESSION['idUsua'])){
    header('location:../inicioSesion/iniciosesion.php');
}
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['ciudades']) || empty($_POST['colonia']) || empty($_POST['calle']) || empty($_POST['cp']) || empty($_POST['numi']) || empty($_POST['nume'])) {
        $alert = '<p class="msj_error">Todos los campos son obligatorios</p>';
    } else {
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        
        $colonia =  mysqli_real_escape_string($conexion, $_POST['colonia']);
        $calle =  mysqli_real_escape_string($conexion, $_POST['calle']);
        $cp =  mysqli_real_escape_string($conexion, $_POST['cp']);
        $numi =  mysqli_real_escape_string($conexion, $_POST['numi']);
        $nume =  mysqli_real_escape_string($conexion, $_POST['nume']);
        $id_ciudad = isset($_POST['id_ciudad']) ? mysqli_real_escape_string($conexion, $_POST['id_ciudad']) : '';
        if($id_ciudad != ''){

            $queryCount=mysqli_query($conexion,"SELECT COUNT(*) as count FROM sucursal  WHERE nom_suc = '$nombre' AND col_suc = '$colonia' AND cp_suc = '$cp' AND ni_suc = '$numi' AND ne_suc = '$nume' AND call_suc = '$calle' AND id_ciu = '$id_ciudad'");
            $row=mysqli_fetch_assoc($queryCount);
            if ($row ['count']>0) {
                $alert="Ya existe una sucursal con esos datos";
            }else{
                $query = mysqli_query($conexion, "insert into sucursal (nom_suc,col_suc,cp_suc,ni_suc,ne_suc,call_suc,id_ciu) values ('$nombre','$colonia','$cp','$numi','$nume','$calle','$id_ciudad')");
                if ($query === true) {
                    $alert = "Sucursal registrada exitosamente";
                    header("regSuc.php");
                    
                } else {
                    $alert = "Fallo al registrar la sucursal";
                    header("regSuc.php");
                    
                }
            }
        }
    }
}
$estados = mysqli_query($conexion, "SELECT id_est,nom_est from estado");
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
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="icon" href="../img/logo.ico">
    <link rel="stylesheet" href="../css/styleadministrador.css">
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
                            <ul class="navbar-nav justify-content flex-grow-1 pe-3">
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
                                        <li><a class="dropdown-item border-0" href="regSuc.php">Nueva sucursal</a></li>
                                        <li><a class="dropdown-item border-0" href="listaSuc.php">Lista de sucursales</a></li>
                                        <li><a class="dropdown-item border-0" href="listaSucElimin.php">Sucursales eliminadas</a></li>
                                    </ul>
                                </li>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <section></section>
    </header>
    <section class="container">
        <div class="form_register">
            <h1 class="text-prin">Registro de sucursales</h1>
            <hr>
            <?php if (!empty($alert)) : ?>
                <div class="alert"><?php echo $alert; ?></div>
            <?php endif; ?>
            <form class="formregUsua" action="regSuc.php" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <label for="nombre">Nombre de la sucursal</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        <label for="estados">Estados: </label>
                        <select name="estados" id="estados">
                            <option value="">Seleccionar</option>
                            <?php while ($row = $estados->fetch_assoc()) { ?>
                                <option value="<?php echo $row['id_est']; ?>"><?php echo $row['nom_est']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        <label for="ciudades">Ciudades: </label>
                        <select name="ciudades" id="ciudades">
                            <option value="">Seleccionar</option>
                        </select>
                    </div>
                    <input type="hidden" name="id_ciudad" id="id_ciudad">
                    <div class="col-md-12">
                        <a href="#" id="mostrarDirSuc" class="toggle-direccion">Direccion de la sucursal</a>
                    </div>

                    <div class="col-md-12 dirSuc-campos">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="colonia">Colonia</label>
                                <input type="text" name="colonia" id="colonia" class="form-control datosDirSuc" placeholder="Colonia" required>
                            </div>
                            <div class="col-md-12">
                                <label for="calle">Calle</label>
                                <input type="text" name="calle" id="calle" class="form-control datosDirSuc" placeholder="Calle" required>
                            </div>
                            <div class="col-md-12">
                                <label for="cp"># CP</label>
                                <input type="text" name="cp" id="cp" class="form-control datosDirSuc" placeholder="# CP" required>
                            </div>
                            <div class="col-md-12">
                                <label for="numi"># de interior</label>
                                <input type="text" name="numi" id="numi" class="form-control datosDirSuc" placeholder="# de interior">
                            </div>
                            <div class="col-md-12">
                                <label for="nume"># de exterior</label>
                                <input type="text" name="nume" id="nume" class="form-control datosDirSuc" placeholder="# de exterior" required>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn_save" value="Registrar sucursal">
            </form>
        </div>
    </section>
    <script src="../javascript/peticiones.js"></script>
    <script>
        document.getElementById('mostrarDirSuc').addEventListener('click', function(e) {
            e.preventDefault();
            var dirCampos = document.querySelector('.dirSuc-campos');
            var dirInputs = document.querySelectorAll('.datosDirSuc');
            if (dirCampos.style.display === 'none' || dirCampos.style.display === '') {
                dirCampos.style.display = 'block';
                dirInputs.forEach(function(input) {
                    input.style.background = '#6d6a6a';
                    input.style.border = 'none';
                    input.style.color = '#bce4f4';
                });
                this.textContent = 'Ocultar datos generales';
            } else {
                dirCampos.style.display = 'none';
                this.textContent = 'Datos generales';
            }
        });
    </script>
    <script>
         document.addEventListener('DOMContentLoaded', function() {
            var estadosSelect = document.getElementById('estados');
            var ciudadesSelect = document.getElementById('ciudades');
            var idCiudadInput = document.getElementById('id_ciudad');

            estadosSelect.addEventListener('change', function() {
                var estadoId = this.value;
                ciudadesSelect.innerHTML = '<option value="">Seleccionar</option>';

                if (!estadoId) return;
                fetch(`cargar_ciudades.php?id_estado=${estadoId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function(ciudad) {
                            var option = document.createElement('option');
                            option.value = ciudad.id_ciudad;
                            option.textContent = ciudad.nom_ciudad;
                            ciudadesSelect.appendChild(option);
                        });
                    });
            });

            ciudadesSelect.addEventListener('change', function() {
                idCiudadInput.value = this.value;
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>