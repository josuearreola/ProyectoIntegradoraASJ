
<?php
require "../conexionBD.php";
include "FPDF/html_table.php";
if (empty($_GET['id'])) {
    header('Location:listaSuc.php');
}
$idSuc = $_GET['id'];

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 25, 'REPORTE DE INVENTARIO', 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 7, "          ID                Sucursal                        Modelo del telefono                          Existencia");
$pdf->SetX(165);
$pdf->Ln();
$pdf->Cell(190, 2, '', 0, 0, '', true);
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 7);


$sql = "SELECT id_inv,nom_suc,nom_mod,exist_inv from sucursal inner join inventario on sucursal.id_suc=inventario.id_suc inner join telefono on telefono.id_tel=inventario.id_tel inner join modelo on modelo.id_mod=telefono.id_mod where inventario.id_suc=$idSuc order by id_inv asc";
$resultado = mysqli_query($conexion, $sql);

while ($fila = mysqli_fetch_array($resultado)) {
    $pdf->SetX(23);
    $pdf->Cell(10, 10, $fila["id_inv"]);
    $pdf->SetX(45);
    $pdf->Cell(40, 10, strtoupper(substr($fila["nom_suc"], 0, 27)));
    $pdf->SetX(95);
    $pdf->Cell(40, 10, strtoupper(substr($fila["nom_mod"], 0, 27)));
    $pdf->SetX(170);
    $pdf->Cell(10, 10, strtoupper($fila["exist_inv"]));

    $pdf->Ln();
}

$pdf->Output();
