<?php

require "config.php";

$productoId = $_POST['productoId'];
$cantidad = $_POST['cantidad'];

// Actualizar la sesión con la nueva cantidad
$_SESSION['carrito']['productos'][$productoId] = $cantidad;

// Devolver una respuesta al cliente
$response = array('success' => true);
echo json_encode($response);
?>