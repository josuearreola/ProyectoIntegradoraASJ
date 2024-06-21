<?php
    $server="localhost";
    $user="root";
    $pass="";
    $db= "asjtechnology";
    $conexion=new mysqli($server,$user,$pass,$db);
    if ($conexion->connect_error) {
        die("Conexion fallida". $conexion->connect_error);
    }
?>