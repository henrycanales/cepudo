<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$Fecha = date("Y-m-d H:i:s");

$Verificar = mysqli_query($conexion,"SELECT Estado from Entrega where EntregaId = '$Id' ");
$Verificar2 = mysqli_fetch_array($Verificar);
$Estado = $Verificar2['Estado'];

if($Estado != "ENTREGADA"){

$verRegimen = mysqli_query($conexion,"SELECT Regimenid,NoComprobante,CorrelativoHasta,FechaAutorizacion from Regimen where Estado = 'Activo'");
$verRegimen2 = mysqli_fetch_array($verRegimen);

$Regimenid = $verRegimen2['Regimenid'];
$Comprobante = $verRegimen2['NoComprobante'];
$Limite = $verRegimen2['CorrelativoHasta'];
$FechaLimite = $verRegimen2['FechaAutorizacion'];
$FechaActual = date("Y-m-d");

$Regimen=$Comprobante+1;
$NoRegimen=str_pad($Regimen, 8, "0", STR_PAD_LEFT);

	if($FechaActual <= $FechaLimite && $Regimen <= $Limite){
	mysqli_query($conexion,"UPDATE Entrega set RegimenId= '$Regimenid', Estado = 'ENTREGADA', FechaEntrega = '$Fecha',GuiaRemision = '$NoRegimen' where EntregaId='$Id'") 
	or die('Error: '.mysqli_error($conexion));
	mysqli_query($conexion,"UPDATE Regimen set NoComprobante = '$Regimen' where Estado = 'Activo' ") or die('Error: '.mysqli_error($conexion));
	echo "1";
	}else{

		if($FechaActual > $FechaLimite){
		echo "No se puede aplicar ya que la fecha de autorizacion termino.!";
		}
		if($Regimen > $Limite){
		echo "No se puede aplicar ya que se termino el rango autorizado.!";
		}
	}

}else{
  echo "Ya esta entregada esta donacion.!";
}

      
        
        
