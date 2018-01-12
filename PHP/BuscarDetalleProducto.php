<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM verproductos WHERE InventarioContenedorDetalleId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['Contenedor'],  	
				1 => $valores2['Descripcion'], 
				2 => $valores2['Presentacion'], 
				3 => $valores2['InventarioContenedorDetalleId'], 				
				4 => $valores2['Stock'], 
				);
echo json_encode($datos);
