
<?php
require "../conexionBD.php";
include "FPDF/html_table.php";

if (isset($_GET['precioMin']) && isset($_GET['precioMax'])) {
    $precioMin = $_GET['precioMin'];
    $precioMax = $_GET['precioMax'];
} else {
    // Manejar el caso en que no se han enviado los datos
    header('location:reportesProcuto.php');
    exit;
}

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',11);
$pdf->Image('../factura/img/logo.jpg', 15, 4, 12); // Logo
$pdf->Cell(275,10,'REPORTE DE PRODUCTOS x PRECIO',0,0,'C');

$pdf->Ln(); //salto de línea
//impresión de encabezado
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,10,"Marca      Modelo         Color          Camara       Almacenamiento      RAM       Pantalla     Bateria           Procesador       Precio      Costo");
$pdf->SetX(165);
$pdf->Ln();
$pdf->Cell(275,2,'',0,0,'',true);
$pdf->Ln(1);
$pdf->SetFont('Arial','',7);

$sql="SELECT nom_marc,nom_mod,col_tel,cam_tel,alm_tel,ram_tel,pan_tel,bat_tel,proc_tel,prec_tel,costo_tel,img_tel from marca inner join modelo on marca.id_marca=modelo.id_marca inner join telefono on modelo.id_mod=telefono.id_mod where prec_tel between $precioMin and $precioMax order by prec_tel asc";
$resultado=mysqli_query($conexion,$sql);

while ($fila = mysqli_fetch_array($resultado)){
   $pdf->Cell(10,10,$fila["nom_marc"]);
   $pdf->SetX(25);
   $pdf->Cell(40,10,strtoupper(substr($fila["nom_mod"],0,27)));
   $pdf->SetX(55);
   $pdf->Cell(40,10,strtoupper(substr($fila["col_tel"],0,27)));
   $pdf->SetX(80);
   $pdf->Cell(10,10,strtoupper($fila["cam_tel"]));
   $pdf->SetX(107);
   $pdf->Cell(10,10,strtoupper($fila["alm_tel"]));
   $pdf->SetX(144);
   $pdf->Cell(10,10,strtoupper($fila["ram_tel"]));
   $pdf->SetX(160);
   $pdf->Cell(10,10,strtoupper($fila["pan_tel"]));
   $pdf->SetX(185);
   $pdf->Cell(10,10,strtoupper($fila["bat_tel"]));
   $pdf->SetX(213);
   $pdf->Cell(10,10,strtoupper($fila["proc_tel"]));
   $pdf->SetX(243);
   $pdf->Cell(10,10,strtoupper($fila["prec_tel"]));
   $pdf->SetX(263);
   $pdf->Cell(10,10,strtoupper($fila["costo_tel"]));
   
   $pdf->Ln();
   
}

$pdf->Output(); //envia a pantalla