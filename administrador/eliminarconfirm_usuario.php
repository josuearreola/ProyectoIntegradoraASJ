<?php
ob_start();
include("../denegacion.php");
include("functions.php");
include "../conexionBD.php";
    if(!empty($_POST)){
        if($_POST['usuario']==1){
            header('location:listausuarios.php');
            exit;
        }
        $idusuario=$_POST['usuario'];
        //$query_delete1=mysqli_query($conexion,"delete from cliente where id_clie = $idusuario");//
        $query_delete1=mysqli_query($conexion,"UPDATE cliente SET estatus = 0 where id_clie=$idusuario ");
        if($query_delete1){
            //$query_delete2=mysqli_query($conexion,"delete from usuario where id_usua = $idusuario");//
            $query_delete2=mysqli_query($conexion,"UPDATE usuario SET estatus = 0 where id_usua=$idusuario ");
            if($query_delete2){
                header("location:listausuarios.php");
            }
        }else{
            echo"Error al eliminar";
        }
    }

    if (empty($_REQUEST['id']) || $_REQUEST['id'] ==1 ) {
        header('location:listausuarios.php');
    }else{
        
        $idUsuario = $_REQUEST['id'];
        $query=mysqli_query($conexion,"select nom_clie,nom_usua,tip_usua from usuario inner join cliente on usuario.id_usua=cliente.id_usua where usuario.id_usua='$idUsuario'");
        $result=mysqli_num_rows( $query );
        if($result> 0){
            while($data=mysqli_fetch_array($query)){
                $nombre=$data['nom_clie'];
                $usuario=$data['nom_usua'];
                $rol=$data['tip_usua'];
            }
        }else{
            header('location:listausuarios.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASJ Technology</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="icon" href="../img/logo.ico">
    <link rel="stylesheet" href="../css/styleadministrador.css">
</head>

<body>
    <?php include "header.php";?>
    <section id="container">
        
        <div class="data_delete">
            <h2 class="h2preg">¿Esta seguro de elimara el siguiente registro?</h2>
            <p class="p-text">Usuario :   <span><?php echo$usuario?></span></p>
            <p class="p-text">Nombre :   <span><?php echo$nombre?></span></p>
            <p class="p-text">Tipo de usuario :   <span><?php echo$rol?></span></p>
            <form class="formdelete" action="" method="post">
                <input type="hidden" name="usuario" value="<?php echo $idUsuario; ?>">
                <a href="listausuarios.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
    </section>
    <?php include "footer.php";?>
</body>

</html>
<?php ob_end_flush(); ?>