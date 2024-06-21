<?php 
    session_start();
    session_destroy();
    header('Location: iniciosesion/iniciosesion.php');
    exit();
?>