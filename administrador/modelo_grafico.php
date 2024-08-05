<?php
class Modelo_Grafico
{

    private $conexion;
    function __construct()
    {
        require_once('../conexionBD.php');
        $this->conexion = new mysqli("localhost", "root", "", "asjtechnology");
        if ($this->conexion->connect_error) {
            die("Conexion fallida". $this->conexion->connect_error);
        }
    }


    function TraerDatosGraficoBar()
    {
        $sql = "SELECT nom_mod,prec_tel from modelo inner join telefono on modelo.id_mod=telefono.id_mod";
        $arreglo = array();
        if ($consulta = $this->conexion->query($sql)) {

            while ($consulta_VU = mysqli_fetch_array($consulta)) {
                $arreglo[] = $consulta_VU;
            }
            $this->conexion->close();
            return $arreglo;
        }
    }
}