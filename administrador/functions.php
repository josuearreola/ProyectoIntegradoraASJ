<?php 
ob_start();
date_default_timezone_set('America/Mexico_City');
function FechaC(){
    $mes= array("","Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre");
    return date('d')." de ".$mes[date('n')]. " de " . date('Y');
}
ob_end_flush();
?>