<?php 
include '../conexionBD.php';
require 'config.php';
$json=file_get_contents('php://input');
$datos=json_decode($json,true);
print_r($datos);
if (is_array($datos)) {
    $id_transaccion=$datos['detalles']['id'];
    $total=$datos['detalles']['purchase_units'][0]['amount']['value'];
    $status=$datos['detalles']['status'];
    $fecha=$datos['detalles']['update_time'];
    $fecha_nueva=date('Y-m-d H:i:s',strtotime($fecha));
    $fecha2=$datos['detalles']['create_time'];
    $fecha_create=date('Y-m-d H:i:s',strtotime($fecha2));

    $email=$datos['detalles']['payer']['email_address'];
    $id_cliente=$datos['detalles']['payer']['payer_id'];

    $sql=$conexion->prepare("INSERT INTO pago(id_pago,fec_pago,cant_pago) VALUES(?,?,?)");
    $sql->execute([$id_transaccion,$fecha_nueva,$total]);
    $id=$conexion->insert_id;
}
?>