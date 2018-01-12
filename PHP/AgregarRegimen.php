<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
$proceso = $_POST['pro'];
$CAI = $_POST['cai'];
$CorrelativoD = $_POST['correlativod'];
$CorrelativoH = $_POST['correlativoh'];
$FechaAutorizacion = $_POST['fecha'];
$Comprobante = $_POST['comprobanteRegimen'];
$NoComprobante = $_POST['noComprobante'];
$fecha=date('Y-m-d');

if($proceso=='Registro'){

 mysqli_query($conexion,"UPDATE Regimen set Estado='Inactivo' where Estado = 'Activo' ") or die('Error: '.mysqli_error($conexion));
 mysqli_query($conexion,"INSERT INTO Regimen (CAI,CorrelativoDesde,CorrelativoHasta,FechaAutorizacion,Comprobante,NoComprobante,Estado,Fecha)
 VALUES ('$CAI','$CorrelativoD','$CorrelativoH','$FechaAutorizacion','$Comprobante','$NoComprobante','Activo','$fecha')") 
 or die('Error: '.mysqli_error($conexion));
 echo "1";
}
	
if($proceso=='Edicion'){

$Registro = mysqli_query($conexion,"SELECT Estado from Regimen where RegimenId='$id'");
$Registro2 = mysqli_fetch_array($Registro);

	if($Registro2['Estado'] == 'Activo'){
		mysqli_query($conexion, "UPDATE Regimen SET CAI = '$CAI', CorrelativoDesde = '$CorrelativoD', CorrelativoHasta = '$CorrelativoH',
		FechaAutorizacion='$FechaAutorizacion', Comprobante='$Comprobante', NoComprobante='$NoComprobante'
		WHERE RegimenId = '$id'") or die('Error: '.mysqli_error($conexion));
		echo "2";
	}else{
		echo "No se puede Actualizar ya que este regimen fue Eliminado";
	}

} 



?>