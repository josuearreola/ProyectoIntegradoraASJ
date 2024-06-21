<?php
ob_start();
include("../denegacion.php");
include("functions.php");
include "../conexionBD.php";


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
    <?php include "header.php"; ?>
    <section id="container">
        <?php 
            $busqueda= strtolower($_REQUEST['busqueda']);
            if (empty($busqueda)) {
                header('Location:listausuarios.php');
            }
        ?>
        <h1 class="text_prin">Lista de usuarios</h1>
        <a href="registrousuario.php" class="btn_new">Crear usuario</a>
        <form action="buscar_usuario.php" method="get" class="form_search">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda ;?>">
            <input type="submit" value="Buscar" class="btn_search">
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo electronico</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php 
                //paginador//
                $sql_register=mysqli_query($conexion,"SELECT count(*) as total_registro from usuario inner join cliente on usuario.id_usua=cliente.id_usua 
                                                    where ( usuario.id_usua LIKE '%$busqueda%' OR  
                                                            cliente.id_clie LIKE '%$busqueda%' OR 
                                                            cliente.email_clie LIKE '%$busqueda%' OR 
                                                            usuario.nom_usua LIKE '%$busqueda%' OR 
                                                            usuario.tip_usua LIKE '%$busqueda%' ) 
                                                    AND usuario.estatus=1 AND cliente.estatus=1");
                $result_register=mysqli_fetch_array($sql_register);
                $total_registro=$result_register['total_registro'];
                $por_pagina =5;
                if (empty($_GET['pagina'])) {
                    $pagina=1;
                }else{
                    $pagina=$_GET['pagina'];
                }
                $desde=($pagina-1)* $por_pagina;
                $total_paginas = ceil($total_registro / $por_pagina);

                $query=mysqli_query($conexion,"SELECT usuario.id_usua,nom_clie,nom_usua,email_clie,tip_usua FROM usuario inner join cliente ON usuario.id_usua=cliente.id_usua 
                                                where 
                                                    ( usuario.id_usua LIKE '%$busqueda%' OR  
                                                    cliente.id_clie LIKE '%$busqueda%' OR 
                                                    cliente.email_clie LIKE '%$busqueda%' OR 
                                                    usuario.nom_usua LIKE '%$busqueda%' OR 
                                                    usuario.tip_usua LIKE '%$busqueda%') 
                                                AND usuario.estatus=1 AND cliente.estatus=1 ORDER by id_usua asc limit $desde,$por_pagina");
                $result=mysqli_num_rows($query);
                if($result> 0){
                    while($data = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $data["id_usua"]?></td>
                            <td><?php echo $data["nom_clie"]?></td>
                            <td><?php echo $data["email_clie"]?></td>
                            <td><?php echo $data["nom_usua"]?></td>
                            <td><?php echo $data["tip_usua"]?></td>
                            <td>
                                <a class="link_edit" href="editar_usuario.php?id=<?php print($data["id_usua"])?>">Editar</a>
                                <?php 
                                if ($data["id_usua"] !=1) {?>
                                |
                                <a class="link_delete" href="eliminarconfirm_usuario.php?id=<?php print($data["id_usua"])?>">Eliminar</a>
                                <?php }?>
                            </td>
                        </tr>
            <?php
                    }
                }
            ?>
        </table>
        <?php if ($total_registro!=0) {
        ?>
        <div class="paginador">
            <ul>
            <?php if ($pagina !=1) {
            ?>
                    <li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda;?>">|<<</a></li>
                    <li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php  echo $busqueda;?>"><<<</a></li>
                    <?php 
            }
                    for ($i=1; $i <= $total_paginas; $i++) { 
                        if ($i==$pagina) {
                            echo '<li class="pageSelected">'.$i.'</li>';
                        }else{
                            echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
                        }
                    }
                    if ($pagina!=$total_paginas) {
                    ?>
                    <li><a href="?pagina=<?php echo $pagina+1;?>&busqueda=<?php  echo $busqueda;?>">>>></a></li>
                    <li><a href="?pagina=<?php echo $total_paginas;?>&busqueda=<?php  echo $busqueda;?>">>>|</a></li>
                    <?php }?>
            </ul>
        </div>
        <?php }?>
    </section>
    <?php include "footer.php";?>
</body>

</html>
<?php ob_end_flush(); ?>