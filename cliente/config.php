<?php 
define("CLIENT_ID","AYlQ3G9Bmy4ppXmk_hASies1i9N0oNBwjq0E2ETydHDfkha9cACKoBevC01jWr4YJ66z8wuR8fj2CaG9");
define("CURRENCY","MXN");
define ("KEY_TOKEN","APR.wqc-354*");
define ("MONEDA","$");
session_start();

$num_cart =0;
if (isset($_SESSION['carrito']['productos'])) {
    $num_cart=count($_SESSION['carrito']['productos']);
}
?>