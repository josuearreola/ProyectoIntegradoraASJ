<?php
include '../conexionBD.php';
require 'config.php';

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

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

    // Asignar id_prom basado en el total
    $id_prom = NULL;
    if ($total > 40000) {
        $id_prom = 702;
    } elseif ($total > 30000) {
        $id_prom = 701;
    } elseif ($total > 20000) {
        $id_prom = 700;
    }

    // Insertar en la tabla venta
    $insertVenta = $conexion->prepare("INSERT INTO venta (fec_vta, id_clie, id_prom) VALUES (?, ?, ?)");
    $insertVenta->bind_param("sii", $fecha_create, $idClie, $id_prom);

    if ($insertVenta->execute()) {
        $idVta = $insertVenta->insert_id;

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
                    $EstatusEnv = "Pagado";
                    $updateEnv = $conexion->prepare("UPDATE envio SET estatus_env = ? WHERE id_env = ?");
                    $updateEnv->bind_param("si", $EstatusEnv, $idEnvio);
                    $updateEnv->execute();
                    $carrito = $_SESSION['carrito']['productos'];
                    
                    // Insertar cada producto en la tabla venta_inv
                    foreach ($carrito as $clave => $cantidad) {
                        $sql = $conexion->prepare("SELECT id_inv FROM inventario WHERE id_inv = ?");
                        $sql->bind_param("i", $clave);
                        $sql->execute();
                        $sql->bind_result($id_inv);
                        $sql->fetch();
                        $sql->close();

                        $insertVentaInv = $conexion->prepare("INSERT INTO venta_inv (id_inv, id_vta, cant_inv) VALUES (?, ?, ?)");
                        $insertVentaInv->bind_param("iii", $id_inv, $idVta, $cantidad);

                        if (!$insertVentaInv->execute()) {
                            echo "Error al insertar en la tabla venta_inv: " . $insertVentaInv->error;
                            break;
                        } else {
                            header('Location:checkout.php');
                        }
                    }

                } else {
                    echo "Error al actualizar el pago: " . $updatePago->error;
                }
            }
        } else {
            echo "Error al insertar en la tabla pago: " . $insertPago->error;
        }
    } else {
        echo "Error al insertar en la tabla venta: " . $insertVenta->error;
    }
}
?>
