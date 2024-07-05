<?php 
require '../conexionBD.php';

if (isset($_POST['id_est'])) {
    $idEstado = mysqli_real_escape_string($conexion, $_POST['id_est']);
    $sql = "SELECT id_ciu, nom_ciu FROM ciudad WHERE id_est = $idEstado ORDER BY nom_ciu ASC";
    $resultado = mysqli_query($conexion, $sql);

    $respuesta = "<option value=''>Seleccionar</option>";
    while ($row = $resultado->fetch_assoc()) {
        $respuesta .= "<option value='" . $row['id_ciu'] . "'>" . $row['nom_ciu'] . "</option>";
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode("<option value=''>Error en el envío de datos</option>", JSON_UNESCAPED_UNICODE);
}
?>
