<?php
include('../conexion/conexion.php');

$valores = mysqli_query($conexion,"SELECT * FROM InformacionEmpresa");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['Nombre'], 
				1 => $valores2['RTN'], 
				2 => $valores2['Direccion'], 
				3 => $valores2['Telefono'], 
				4 => $valores2['Correo'], 
				5=> $valores2['Web'], 				
				);
echo json_encode($datos);
?>