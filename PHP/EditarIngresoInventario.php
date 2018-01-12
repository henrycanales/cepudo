<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM InventarioContenedor WHERE InventarioContenedorId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['Contenedor'], 
				1 => $valores2['Fecha'], 	
				2 => $valores2['Tamano'], 	
				3 => $valores2['Estado'], 	
				);
echo json_encode($datos);
?>