$sqlprod = "SELECT * FROM
      productos p, categorias c
	  where p.ca_clave = c.ca_clave";
   $resprod = mysqli_query($conn,$sqlprod);
   
   //codigo para generar un archivo en PDF
   //define('FPDF_FONTPATH','font/');
   //require('nada_pdftable.php');   
   $pdf=new FPDF("P","mm","Letter");
   $pdf->AddPage();
   //$pdf->SetAutoPageBreak(false);
   //$pdf->AliasNbPages();
   //$pdf->SetXY(10,26);
   $pdf->SetFont('Arial','B',10);
   $pdf->Cell(100,4,"EJEMPLO DE REPORTE",0,1);
   $pdf->SetLeftMargin(10);
   $tcabeza = '<table cellspacing="50" cellpadding="5" cellspacing="0" height=4>
      <tr><td  width=7 >CLAVE</td>
	      <td>Producto</td>
          <td>Precio</td>
          <td>Unidad</td>
          <td>Contenido</td>
          <td>Categorias</td>
	  </tr><tr></table>';
   //$pdf->SetFont('Arial','',10);
   //$pdf->Ln();

   $tpie  = '<table cellspacing="50" cellpadding="5" cellspacing="0" height=4 >
      <tr><td width=55</td>
	      <td width=85 align=center>Proyecto Integradora</td>
		  <td width=55</td>
	  </tr></table>';
	  $filas=mysqli_fetch_array($resprod);   
   $tdetalle = '<table cellspacing="50" cellpadding="5" cellspacing="0" height=4>
      <tr><td  width=7 align=right >'.$filas["pr_clave"].'</td>
	  	  <td  width=64 >'.$filas["pr_descrip"].'</td>
	  </tr></table>';
   $tcabeza = array("clave","producto");
   $tdetalle = array("hola","mundo");
   //$pdf->Basictable($tcabeza,$tdetalles);
   