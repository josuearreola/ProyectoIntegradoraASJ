<?php
session_start(); // Asegúrate de que la sesión esté iniciada

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

if (is_array($datos)) {
    $_SESSION['id_prom'] = $datos['id_prom']; // Guarda el id_prom en la sesión
    // Realiza otras acciones si es necesario
    echo json_encode(['ok' => true]);
} else {
    echo json_encode(['ok' => false, 'message' => 'Datos no válidos']);
}
?>
