<?php 
require 'config.php';

$datos = array('ok' => true);
if (isset($_POST['id'])) {
    $id=$_POST['id'];
    $token=$_POST['token'];
    $cantidad=intval($_POST['cantidad']);
    $token_temp=hash_hmac('sha1',$id,KEY_TOKEN);
    if($token == $token_temp){
        if(isset($_SESSION['carrito']['productos'][$id] )){
            $_SESSION['carrito']['productos'][$id] = $cantidad;
        }else{
            $_SESSION['carrito']['productos'][$id] = $cantidad;
        }
        $datos['numero'] = count($_SESSION['carrito']['productos']);
        $datos['ok'] = true;
    }else{
        $datos['ok'] = false;
    }
}else{ 
    $datos['ok'] = false;
}
echo json_encode($datos);
?>