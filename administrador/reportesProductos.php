<?php
ob_start();
include("../denegacion.php");
if (empty($_SESSION['idUsua'])) {
    header('location:../inicioSesion/iniciosesion.php');
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
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="icon" href="../img/logo.ico">
    <link rel="stylesheet" href="../css/stylereportesAdmin.css">
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
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Facturas </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="listaFacturas.php">Lista de facturas</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Productos </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="regProd.php">Nuevos productos</a></li>
                                        <li><a class="dropdown-item border-0" href="listaProd.php">Lista de productos</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle lh-lg" id="menucategoria" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">Sucursales </a>
                                    <ul class="dropdown-menu bg-secondary " aria-labelledby="menucategoria">
                                        <li><a class="dropdown-item border-0" href="regSuc.php">Nueva sucursal</a></li>
                                        <li><a class="dropdown-item border-0" href="listaSuc.php">Lista de sucursales</a></li>
                                    </ul>
                                </li>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <section></section>
    </header>

    <div class="container mt-2 reporte-form">
        <div class="row mb-5 form-inline align-items-center">
            <div class="col-md-3">
                <label for="general" class="form-label fs-5">Reporte general:</label>
            </div>
            <div class="col-md-4">
                <a href="reporteProd.php" class="btn btn-primary ms-6" name="general" target="_blank">Generar reporte</a>
            </div>
        </div>
        <div class="row mb-5 form-inline align-items-center">
            <div class="col-md-3">
                <label for="general" class="form-label fs-5">Grafico de barras:</label>
            </div>
           
            <div class="col-md-4">
                <a class="btn btn-primary ms-6" name="general" target="_blank" onclick="cargarDatosGraficoBar()" data-bs-toggle="modal" data-bs-target="#graficoModal">Generar grafico</a>
            </div>
        </div>
        <form action="reporteProdPrecio.php" method="GET" target="_blank" class="no-border">
            <div class="row mb-3 form-inline align-items-center">
                <div class="col-md-3">
                    <label for="precio" class="form-label fs-5">Reporte por precio:</label>
                </div>
                <div class="col-md-2">
                    <label for="precioMin" class="form-label fs-6">Precio mínimo:</label>
                    <input type="number" class="form-control mb-2" id="precioMin" name="precioMin" min="1000" step="1" value="1000" pattern="\d+" required>
                </div>
                <div class="col-md-2">
                    <label for="precioMax" class="form-label fs-6">Precio máximo:</label>
                    <input type="number" class="form-control mb-2" id="precioMax" name="precioMax" min="1000" step="1" value="1000" pattern="\d+" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" id="generarReporte" class="btn btn-primary mt-2">Generar reporte</button>
                </div>
            </div>
        </form>

        <form action="reporteProdCosto.php" method="GET" target="_blank" class="no-border">
            <div class="row mb-3 form-inline align-items-center">
                <div class="col-md-3">
                    <label for="costo" class="form-label fs-4">Reporte por costo:</label>
                </div>
                <div class="col-md-2">
                    <label for="costoMin" class="form-label fs-6">Costo mínimo:</label>
                    <input type="number" class="form-control mb-2" id="costoMin" name="costoMin" min="1000" step="1" value="1000" pattern="\d+" required>
                </div>
                <div class="col-md-2">
                    <label for="costoMax" class="form-label fs-6">Costo máximo:</label>
                    <input type="number" class="form-control mb-2" id="costoMax" name="costoMax" min="1000" step="1" value="1000" pattern="\d+" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" id="generarReporteCosto" class="btn btn-primary mt-2">Generar reporte</button>
                </div>
            </div>
        </form>
        <!-- Modal para el gráfico -->
        <div class="modal fade" id="graficoModal" tabindex="-1" aria-labelledby="graficoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="graficoModalLabel">Gráfico de barras</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
    <script src="chart.js"></script>
    <script>
        document.getElementById("generarReporte").addEventListener("click", function(event) {
            var precioMin = document.getElementById("precioMin").value;
            var precioMax = document.getElementById("precioMax").value;

            if (precioMin >= precioMax) {

                alert("El precio mínimo debe ser menor que el precio máximo.");
                document.getElementById("precioMin").value = 1000;
                document.getElementById("precioMax").value = 1000;
                event.preventDefault();
            }
        });

        document.getElementById("generarReporteCosto").addEventListener("click", function(event) {

            var costoMin = document.getElementById("costoMin").value;
            var costoMax = document.getElementById("costoMax").value;

            if (costoMin >= costoMax) {
                alert("El costo mínimo debe ser menor que el precio máximo.");
                document.getElementById("costoMin").value = 1000;
                document.getElementById("costoMax").value = 1000;
                event.preventDefault();
            }
        });

        function verificarValor(input) {
            if (input.value == "") {
                input.value = 1000; // Valor por defecto
            }
        }

        // Agregamos un evento de cambio a los inputs
        document.getElementById("precioMin").addEventListener("change", function() {
            verificarValor(this);
        });

        document.getElementById("precioMax").addEventListener("change", function() {
            verificarValor(this);
        });

        document.getElementById("costoMin").addEventListener("change", function() {
            verificarValor(this);
        });

        document.getElementById("costoMax").addEventListener("change", function() {
            verificarValor(this);
        });
    </script>
</body>

</html>


<script>
    function cargarDatosGraficoBar() {
        $.ajax({
            url: 'controlador_grafico.php',
            type: 'POST'
        }).done(function(resp) {
            var titulo = [];
            var cantidad = [];
            var data = JSON.parse(resp);
            for (var i = 0; i < data.length; i++) {
                titulo.push(data[i][0]);
                cantidad.push(data[i][1]);
            }

            // Mostrar el modal
            $('#graficoModal').modal('show');

            // Cargar los datos del gráfico
            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: titulo,
                    datasets: [{
                        label: '# of Votes',
                        data: cantidad,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
    }
    $.ajax({
        url: 'controlador_grafico.php',
        type: 'POST'
    }).done(function(resp) {
        var titulo = [];
        var cantidad = [];
        var data = JSON.parse(resp);
        for (var i = 0; i < data.length; i++) {
            titulo.push(data[i][0]);
            cantidad.push(data[i][1]);
        }
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: titulo,
                datasets: [{
                    label: 'PRODUCTOS x PRECIO ',
                    data: cantidad,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
</script>
<?php ob_end_flush(); ?>