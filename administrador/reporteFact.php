<?php
require "../conexionBD.php";
require('fpdf/fpdf.php');
require "../cliente/config.php";
session_start();

date_default_timezone_set('America/Mexico_City');
$idVta = $_GET['idFact'];
if ($idVta == null) {
    header('location:cliente.php');
}

$sqlCompra = mysqli_query($conexion, "SELECT id_fact,venta.id_vta, fec_vta, cant_pago, tip_pago FROM venta INNER JOIN pago ON venta.id_vta = pago.id_vta inner join factura on venta.id_vta=factura.id_vta WHERE venta.id_vta = $idVta");
$rowCompra = $sqlCompra->fetch_assoc();
$idCompra = $rowCompra['id_vta'];

$sqlDetalle = mysqli_query($conexion, "SELECT venta_inv.id_vta, inventario.id_inv, cant_inv, prec_tel, nom_mod, nom_marc, nom_suc, col_suc, cp_suc, call_suc,fec_pago,tip_pago  FROM inventario INNER JOIN venta_inv ON inventario.id_inv = venta_inv.id_inv INNER JOIN telefono ON telefono.id_tel = inventario.id_tel INNER JOIN modelo ON modelo.id_mod = telefono.id_mod INNER JOIN marca ON marca.id_marca = modelo.id_marca INNER JOIN sucursal ON sucursal.id_suc = inventario.id_suc inner join venta on venta.id_vta=venta_inv.id_vta inner join pago on venta.id_vta =pago.id_vta WHERE venta.id_vta = $idVta");
$rowDetalle = $sqlDetalle->fetch_assoc();

$sqlDetalle2 = mysqli_query($conexion, "SELECT venta_inv.id_vta, inventario.id_inv, cant_inv, prec_tel, nom_mod, nom_marc, nom_suc, col_suc, cp_suc, call_suc FROM inventario INNER JOIN venta_inv ON inventario.id_inv = venta_inv.id_inv INNER JOIN telefono ON telefono.id_tel = inventario.id_tel INNER JOIN modelo ON modelo.id_mod = telefono.id_mod INNER JOIN marca ON marca.id_marca = modelo.id_marca INNER JOIN sucursal ON sucursal.id_suc = inventario.id_suc WHERE id_vta = $idVta");

$sqlCliente = mysqli_query($conexion, "SELECT cliente.id_clie, nom_clie, ap_clie, am_clie, rfc_clie, col_clie, calle_clie, ne_clie, tel_clie FROM cliente INNER JOIN venta ON cliente.id_clie = venta.id_clie WHERE venta.id_vta = $idVta");
$rowCliente = $sqlCliente->fetch_assoc();



$fechaFact = date('Y-m-d');

$horaActual = date('H:i:s');

$pdf = new FPDF('P', 'mm', 'A4'); // Orientación 'P' para vertical
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 12);

// Agregar información de la empresa
$pdf->Image('../factura/img/logo.jpg', 15, 15, 18); // Logo
$pdf->SetXY(10, 10);
$pdf->Cell(0, 10, 'ASJ TECHNOLOGY', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 7, iconv('UTF-8', 'ISO-8859-1', 'Tipo de pago: ' . $rowDetalle['tip_pago']), 0, 1, 'C');
$pdf->Cell(0, 7, iconv('UTF-8', 'ISO-8859-1', 'Fecha de pago: ' . $rowDetalle['fec_pago']), 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFillColor(0, 0, 139); // Azul para 'Factura'
$pdf->SetTextColor(255, 255, 255); // Blanco

// Ajusta el tamaño y la posición del rectángulo
$pdf->SetFont('Arial', 'B', 16);
$pdf->Rect(140, 10, 60, 12, 'F'); // Rectángulo azul (x, y, ancho, alto)
$pdf->SetXY(140, 12);
$pdf->Cell(60, 8, 'Factura', 0, 1, 'C', true);

$pdf->SetTextColor(0, 0, 0); // Restablece el color del texto a negro
$pdf->SetFont('Arial', '', 10);

// Dibuja el cuadro alrededor de la información de la factura
$pdf->Rect(140, 22, 60, 25); // Ajusta las coordenadas y tamaño según tu diseño
$pdf->SetXY(142, 24);
$pdf->Cell(0, 10, 'No. Factura: ' . $rowCompra['id_fact'], 0, 1);
$pdf->SetXY(142, 30);
$pdf->Cell(0, 10, 'Fecha: ' . $rowCompra['fec_vta'], 0, 1);
$pdf->SetXY(142, 36);
$pdf->Cell(0, 10, 'Hora: ' . $horaActual, 0, 1);

$pdf->Ln(10);

// Información del cliente
$pdf->SetFillColor(0, 0, 139); // Azul más oscuro para 'Cliente'
$pdf->SetTextColor(255, 255, 255); // Blanco
$pdf->SetFont('Arial', 'B', 12);

// Dibuja el cuadro azul oscuro alrededor del título 'Cliente'
$pdf->Rect(10, 60, 190, 5, 'F'); // Ajusta las coordenadas y tamaño del rectángulo azul oscuro
$pdf->SetXY(10, 60);
$pdf->Cell(190, 10, 'Cliente', 0, 1, 'C', true);

$pdf->SetTextColor(0, 0, 0); // Restablece el color del texto a negro
$pdf->SetFont('Arial', '', 10);

$pdf->Rect(10, 70, 190, 20); // Ajusta las coordenadas y tamaño según tu diseño

$pdf->SetXY(10, 70); // Posición inicial para la información del cliente
$pdf->Cell(0, 10, 'RFC: ' . $rowCliente['rfc_clie'], 0, 1);
$pdf->SetXY(10, 75);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Teléfono: ' . $rowCliente['tel_clie']), 0, 1);
$pdf->SetXY(60, 70);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Nombre: ' . $rowCliente['nom_clie'] . ' ' . $rowCliente['ap_clie'] . ' ' . $rowCliente['am_clie']), 0, 1);
$pdf->SetXY(60, 75);
$pdf->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Dirección: ' . $rowCliente['calle_clie']) . ' Colonia. ' . $rowCliente['col_clie'], 0, 1);
$pdf->Ln(10);

// Detalle de los productos
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, 'Producto', 1);
$pdf->Cell(40, 10, 'Vendedor', 1);
$pdf->Cell(40, 10, 'Precio', 1);
$pdf->Cell(36, 10, 'Cantidad', 1);
$pdf->Cell(35, 10, 'Subtotal', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$total = 0;
$subtotal = 0;

// Inicializa la variable de posición Y
$posY = $pdf->GetY();

while ($row = $sqlDetalle2->fetch_assoc()) {
    $precio = $row['prec_tel'];
    $cantidad = $row['cant_inv'];
    $subtotal = $precio * $cantidad;
    $total += $subtotal;
    $totalDesc = $total; // Asigna el valor total original a totalDesc

    if ($total > 40000) {
        $totalDesc = $total - 800; // Aplica el descuento mayor primero
    } elseif ($total > 30000) {
        $totalD = $total * 0.15; // Calcula el 15% de descuento
        $totalDesc = $total - $totalD;
    } elseif ($total > 20000) {
        $totalDesc = $total - 500; // Aplica el descuento menor si los anteriores no se aplicaron
    }

    $pdf->Cell(40, 10, $row['nom_mod'], 1);
    $pdf->Cell(40, 10, $row['nom_suc'], 1);
    $pdf->Cell(40, 10, MONEDA . ' ' . number_format($precio, 2, '.', ','), 1, 0, 'R');
    $pdf->Cell(36, 10, $cantidad, 1, 0, 'R');
    $pdf->Cell(35, 10, MONEDA . ' ' . number_format($subtotal, 2, '.', ','), 1, 0, 'R');
    $pdf->Ln();

    // Actualiza la posición Y
    $posY = $pdf->GetY();
}

// ...

$totalSession = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
$totalDescSession = isset($_SESSION['totalDesc']) ? $_SESSION['totalDesc'] : 0;

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(130, $posY + 2); // Ajusta la posición Y
$pdf->Cell(36, 10, 'Total: ', 1);
$pdf->Cell(35, 10, MONEDA . ' ' . number_format($total, 2, '.', ','), 1, 0, 'R');

if ($total != $totalDesc) {
    $pdf->SetXY(130, $posY + 12); // Ajusta la posición Y
    $pdf->Cell(36, 10, 'Total con descuento:', 1);
    $pdf->Cell(35, 10, MONEDA . ' ' . number_format($totalDesc, 2, '.', ','), 1, 0, 'R');
    $pdf->SetLineWidth(0.6);
    $pdf->Line(180, $posY + 7, 198, $posY + 7); // Ajusta la posición Y
    $pdf->SetLineWidth(0.2);
}

$pdf->Output();
