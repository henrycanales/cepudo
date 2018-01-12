<?php
session_start();

$Id=$_GET['Id'];
require('mc_table.php');
include('../conexion/conexion.php');
define('FPDF_FONTPATH', 'font/');

$Informacion = mysqli_query($conexion,"SELECT * FROM InformacionEmpresa");
$Informacion2 = mysqli_fetch_array($Informacion);

$NombreEmpresa=$Informacion2['Nombre'];
$RTNEmpresa=$Informacion2['RTN'];
$DireccionEmpresa=$Informacion2['Direccion'];
$TelefonoEmpresa=$Informacion2['Telefono'];
$CorreoEmpresa=$Informacion2['Correo']; 
$WebEmpresa=$Informacion2['Web']; 

$registro = mysqli_query($conexion,"SELECT * FROM VerEntrega where EntregaId= '$Id' ");
$registro2 = mysqli_fetch_array($registro);

$RegimenId = $registro2['RegimenId'];
$NombreCliente = $registro2['Nombre'];
$RTNCliente = $registro2['RTN'];
$DireccionCliente = $registro2['Direccion'];
$Fecha = $registro2['FechaEntrega'];
$Remision = $registro2['GuiaRemision'];


$Regimen = mysqli_query($conexion,"SELECT * FROM Regimen where RegimenId='$RegimenId'");
$Regimen2 = mysqli_fetch_array($Regimen);

$CAI=$Regimen2['CAI'];
$NoComprobante=$Regimen2['NoComprobante'];
$Comprobante=$Regimen2['Comprobante'];
$FechaAutorizacion=$Regimen2['FechaAutorizacion'];
$CorrelativoDesde=$Regimen2['CorrelativoDesde'];
$CorrelativoHasta=$Regimen2['CorrelativoHasta'];


class PDF extends PDF_Mc_Table
{
   //Cabecera de página
   function Header()
   {

   }


  function Footer()
  {
    $this->SetY(-20);
    $this->SetFont('Arial', '', 8);
    $this->Cell(190,0,'',1,0,'',1);
    $this->Ln(10);
    $this->Cell(10,0,' ',0);
    $this->Cell(50,0,'',1,0,'',1);
    $this->Cell(10,0,' ',0);
    $this->Cell(50,0,'',1,0,'',1);
    $this->Cell(10,0,' ',0);
    $this->Cell(50,0,'',1,0,'',1);
    $this->Ln(5);
    $this->SetFont('Arial', 'B', 8);
    $this->Cell(10,0,' ',0);
    $this->Cell(50,0,'Autorizado Por',0,0,'C');
    $this->Cell(10,0,' ',0);
    $this->Cell(50,0,'Recibido Por (Firma y Sello)',0,0,'C');
    $this->Cell(10,0,' ',0);
    $this->Cell(50,0,'Entregado Por',0,0,'C');
  }
}

$pdf = new PDF('P','mm','Letter');

$pdf->AddPage();
$pdf->Image('../recursos/CEPUDO2.png', 10 ,8, 30 , 25,'PNG');
$pdf->Image('../recursos/food.jpeg', 175,8, 30 , 25,'JPEG');

$pdf->SetFont('Arial', 'B', 14);
$pdf->Ln(7);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(60, 8, $NombreEmpresa, 0,0,'C');
$pdf->Cell(24, 8, '', 0);
$pdf->Ln(7);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190, 8,'Capacitacion, Educacion, Produccion, Unificacion, Desarrollo, Organizacion', 0,0,'C');
$pdf->Ln(7);
$pdf->Cell(50, 8, '', 0);
$pdf->MultiCell(90, 4, $DireccionEmpresa, 0,'C');
$pdf->Cell(90, 5, '', 0);
$pdf->Cell(10, 5,'Tel: '.$TelefonoEmpresa, 0,0,'C');
$pdf->Ln(3);
$pdf->Cell(90, 8, '', 0);
$pdf->Cell(10, 8,$CorreoEmpresa, 0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 8,'RTN: '.$RTNEmpresa, 0,0,'L');
$pdf->Ln(4);
$pdf->Cell(115, 8,'',0);
$pdf->Cell(90, 8,'GUIA DE REMISION',0);
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(115, 8,'HOJA DE ENTREGA DE DONACION',0);
$pdf->Cell(90, 8,'No. '.$Comprobante.$Remision,0);
$pdf->Ln(7);
$pdf->Cell(8, 8,'',0);
$pdf->Cell(102, 8,'(PROHIBIDA LA VENTA)',0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->MultiCell(76, 4, 'CAI: '.$CAI.' Rango Autorizado: '.$Comprobante.$CorrelativoDesde.' al '.$Comprobante.$CorrelativoHasta.
                ' Fecha Limite de Emision: '.$FechaAutorizacion, 1,'L');

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(13, 8,'Fecha:',0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 8,$Fecha,0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(38, 5,'Nombre De Institucion:',0);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(150, 5,utf8_decode($NombreCliente),0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 8,'RTN:',0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(10, 8,$RTNCliente,0);
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 8,'Direccion:',0);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(160, 8,utf8_decode($DireccionCliente),0);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190,0,'',1,0,'',1);
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(35, 5, 'Descripcion', 0,0,'C');
$pdf->Cell(25, 5, 'Cantidad', 0,0,'C');
$pdf->Cell(20, 5, 'Presentacion', 0,0,'C');
$pdf->Cell(30, 5, 'Cant X Pres', 0,0,'C');
$pdf->Cell(30, 5, 'Contenedor', 0,0,'C');
$pdf->Cell(25, 5, 'No Embarque', 0,0,'C');
$pdf->Cell(25, 5, 'Lote', 0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190,0,'',1,0,'',1);
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(2);

//CONSULTA
$registro = mysqli_query($conexion,"SELECT * FROM VerEntregaDetalle where EntregaId='$Id'"); 

$pdf->SetAligns(array('C','C','C','C','C','C','C'));
$pdf->SetWidths(array(35,25,20,30,30,25,25));


while($registro2 = mysqli_fetch_array($registro)){
	 $pdf->Row(array(utf8_decode($registro2['Descripcion']),$registro2['Cantidad'],$registro2['Presentacion'],$registro2['CXP'],$registro2[Contenedor],$registro2['Embarque'],$registro2['Lote']));
}

$pdf->Ln(5);
$pdf->Cell(190, 8, '--------------- ULTIMA LINEA --------------- ', 0,0,'C');


$pdf->Output();
//$pdf->Output('Factura No. '.$Fac.$NoFactura.'.pdf','D');
?>
