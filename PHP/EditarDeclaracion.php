<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
session_start();

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM verDeclaraciones WHERE DeclaracionId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['Embarque'], 
				1 => $valores2['NumeroDispensa'], 	
				2 => $valores2['FechaDispensa'], 	
				3 => $valores2['TipoDonacion'], 
				4 => $valores2['ValorFactura'],
				5 => $valores2['ValorFlete'], 
				6 => $valores2['ValorSeguro'], 
				7 => $valores2['OtrosGastos'],  			
				8 => $valores2['Poliza'], 
				9 => $valores2['FechaPoliza'], 
				10 => $valores2['Observacion'], 
				11 => $valores2['TasaCambio'], 
				12 => $valores2['Ajustes'], 
				13 => $valores2['CIF'], 

				);

echo json_encode($datos);
?>