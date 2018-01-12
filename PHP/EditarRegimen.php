<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM Regimen WHERE RegimenId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['CAI'],  	
				1 => $valores2['CorrelativoDesde'],  
				2 => $valores2['CorrelativoHasta'],  
				3 => $valores2['FechaAutorizacion'],  
				4 => $valores2['Comprobante'],  
				5 => $valores2['NoComprobante'],  
				);
echo json_encode($datos);
?>