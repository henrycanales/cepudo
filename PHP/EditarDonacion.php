<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM Donaciones WHERE DonacionId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['Descripcion'], 
				1 => $valores2['Fecha'], 	
				2 => $valores2['PO'], 	
				3 => $valores2['CantidadC'], 	
				4 => $valores2['Tamano'], 			
				);
echo json_encode($datos);
?>