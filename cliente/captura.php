<?php
include '../conexionBD.php';
require 'config.php';

$json = file_get_contents('php://input');
$datos = json_decode($json, true);
print_r($datos);

if (is_array($datos)) {
    $id_transaccion = $datos['detalles']['id'];
    $total = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fecha_nueva = date('Y-m-d', strtotime($fecha));
    $fecha2 = $datos['detalles']['create_time'];
    $fecha_create = date('Y-m-d', strtotime($fecha2));

    $email = $datos['detalles']['payer']['email_address'];
    $id_cliente = $datos['detalles']['payer']['payer_id'];

    $idClie = $_SESSION['Id_clie'];

    // Insertar en la tabla venta
    $insertVenta = $conexion->prepare("INSERT INTO venta (fec_vta, id_clie) VALUES (?, ?)");
    $insertVenta->bind_param("si", $fecha_create, $idClie);
    
    if ($insertVenta->execute()) {
        $idVta = $conexion->insert_id;

        // Actualizar en la tabla venta
        $updateVenta = $conexion->prepare("UPDATE venta SET fec_vta = ?, id_clie = ? WHERE id_vta = ?");
        $updateVenta->bind_param("ssi", $fecha_create, $idClie, $idVta);
        
        if ($updateVenta->execute()) {
            // Insertar en la tabla pago
            $insertPago = $conexion->prepare("INSERT INTO pago (fec_pago, id_vta) VALUES (?, ?)");
            $insertPago->bind_param("si", $fecha_nueva, $idVta);
            
            if ($insertPago->execute()) {
                $idPago = $conexion->insert_id;
                
                if ($idPago) {
                    $tipPago = "Tarjeta";
                    $costoEnv = "120.00";
                    $result = mysqli_query($conexion, "SELECT MAX(id_env) AS max_id FROM envio");
                    $row = mysqli_fetch_assoc($result);
                    $idEnvio = $row['max_id'];

                    $updatePago = $conexion->prepare("UPDATE pago SET fec_pago = ?, cant_pago = ?, tip_pago = ?, id_vta = ?, costo_env = ?, id_env = ? WHERE id_pago = ?");
                    $updatePago->bind_param("ssssssi", $fecha_nueva, $total, $tipPago, $idVta, $costoEnv, $idEnvio, $idPago);
                    
                    if ($updatePago->execute()) {
                        echo "Pago actualizado correctamente.";
                        $EstatusEnv="Pagado";
                        $updateEnv=$conexion->prepare("UPDATE envio SET estatus_env = ? WHERE id_env = ?");
                        $updateEnv->bind_param("si", $EstatusEnv,$idEnvio);
                        $updateEnv->execute();
                    } else {
                        echo "Error al actualizar el pago: " . $updatePago->error;
                    }
                }
            } else {
                echo "Error al insertar en la tabla pago: " . $insertPago->error;
            }
        } else {
            echo "Error al actualizar la venta: " . $updateVenta->error;
        }
    } else {
        echo "Error al insertar en la tabla venta: " . $insertVenta->error;
    }
}
?>
