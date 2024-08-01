<?php
require "../conexionBD.php";
include "FPDF/html_table.php";

if (empty($_GET['id'])) {
    header('Location:listaSuc.php');
}
$idSuc = $_GET['id'];

$pdf = new FPDF();
$pdf->AddPage();
$sql = "SELECT id_inv,nom_suc,nom_mod,exist_inv from sucursal inner join inventario on sucursal.id_suc=inventario.id_suc inner join telefono on telefono.id_tel=inventario.id_tel inner join modelo on modelo.id_mod=telefono.id_mod where inventario.id_suc=$idSuc and inventario.estatus=1 order by id_inv asc";
$resultado = mysqli_query($conexion, $sql);
$fila = $resultado->fetch_assoc();

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 10, 'REPORTE DE INVENTARIO', 0, 0, 'C');
$pdf->Ln();
$pdf->Cell(190, 1, $fila['nom_suc'] , 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12); 
$pdf->SetTextColor(0, 0, 255); 
$pdf->Cell(190, 15, "                    ID                                       Modelo del telefono                              Existencia");
$pdf->SetTextColor(0, 0, 0); 
$pdf->SetX(165);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0, '', true);
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 7);

$resultado = mysqli_query($conexion, $sql);
while ($fila = mysqli_fetch_array($resultado)) {
    $pdf->SetX(33);
    $pdf->Cell(10, 10, $fila["id_inv"]);
    $pdf->SetX(85);
    $pdf->Cell(40, 10, strtoupper(substr($fila["nom_mod"], 0, 27)));
    $pdf->SetX(168);
    $pdf->Cell(10, 10, strtoupper($fila["exist_inv"]));

    $pdf->Ln();
}

$pdf->Output();