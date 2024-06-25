<?php
require 'config.php';
require '../conexionBD.php';
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    if ($action == 'agregar') {
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
        $respuesta = agregar($id, $cantidad);
        if ($respuesta>0) {
            $datos['ok']=true;
        }else{
            $datos['ok']=false;
        }
        $datos['sub']= MONEDA . number_format($respuesta, 2, '.', ',');
    } else if($action == 'eliminar') {
        $datos['ok']=eliminar($id);
    }else{
        $datos['ok']=false;
    }
}else{
    $datos['ok']=false;
}

echo json_encode($datos);

function agregar($id, $cantidad)
{
    $res = 0;
    if ($id > 0 && $cantidad > 0 && is_numeric(($cantidad))) {
        if (isset($_SESSION['carrito']['productos'][$id])) {
            $_SESSION['carrito']['productos'][$id] = $cantidad;
            global $conexion;
            $sql = $conexion->prepare("SELECT prec_tel FROM telefono  where id_tel=? and estatus=1 LIMIT 1");
            $sql->bind_param("i", $id);
            $sql->execute();
            $sql->bind_result($precio);
            $sql->fetch();
            $res=$cantidad*$precio;
            return $res;
        }
    }else{
        return $res;
    }

}

function eliminar($id){
    if($id>0){
        if (isset($_SESSION['carrito']['productos'][$id])) {
            unset($_SESSION['carrito']['productos'][$id]);
            return true;
        }
    }else{
        return false;
    }
}