<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM BeneficiariosProyectos WHERE BeneficiarioId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['BeneficiarioId'],  	
				1 => $valores2['Nombre'],  
				2 => $valores2['Direccion'],  
				3 => $valores2['Telefono'],  
				4 => $valores2['Contacto'],  
				5 => $valores2['Correo'],  
 		
				);
echo json_encode($datos);
?>