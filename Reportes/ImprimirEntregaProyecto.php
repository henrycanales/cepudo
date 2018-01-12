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

$registro = mysqli_query($conexion,"SELECT * FROM VerEntregaProyectos where EntregaProyectoId= '$Id' ");
$registro2 = mysqli_fetch_array($registro);

$Beneficiario = $registro2['Beneficiario'];
$Proyecto = $registro2['Proyecto'];
$DireccionCliente = $registro2['Direccion'];
$Fecha = $registro2['FechaEntrega'];

if($Fecha == '0000-00-00 00:00:00')
{
  $Mensaje= "NO ENTREGADA";
}else{
  $Mensaje = '';
}


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
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(190, 5,'COMPROBANTE DE ENTREGA # '.$Id,0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(18, 5,'Proyecto:',0);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(150, 5,$Proyecto,0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(13, 8,'Fecha:',0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(35, 8,$Fecha,0);
$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(10, 8,$Mensaje,0);
$pdf->Ln(7);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(38, 5,'Nombre De Beneficiario:',0);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(150, 5,$Beneficiario,0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 8,'Direccion:',0);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(160, 8,$DireccionCliente,0);

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190,0,'',1,0,'',1);
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 5, 'Item', 0,0,'C');
$pdf->Cell(120, 5, 'Descripcion', 0,0,'C');
$pdf->Cell(40, 5, 'Cantidad', 0,0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(190,0,'',1,0,'',1);
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(2);

//CONSULTA
$registro = mysqli_query($conexion,"SELECT * FROM VerEntregaProyectosDetalle where EntregaProyectoId='$Id'"); 

$pdf->SetAligns(array('C','C','C'));
$pdf->SetWidths(array(20,120,40));

$Item=0;
while($registro2 = mysqli_fetch_array($registro)){
  $Item++;
	 $pdf->Row(array($Item,$registro2['Descripcion'],$registro2['Cantidad']));
}

$pdf->Ln(5);
$pdf->Cell(190, 8, '--------------- ULTIMA LINEA --------------- ', 0,0,'C');


$pdf->Output();
//$pdf->Output('Factura No. '.$Fac.$NoFactura.'.pdf','D');
?>