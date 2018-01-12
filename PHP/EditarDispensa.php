<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
session_start();

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM Dispensas WHERE DispensaId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['Embarque'], 
				1 => $valores2['FechaDispensa'], 	
				2 => $valores2['NumeroDispensa'], 	
				3 => $valores2['FechaRecepcion'], 
				4 => $valores2['Imagen'], 			
				);
$_SESSION['foto']=$valores2['Imagen'];
echo json_encode($datos);
?>