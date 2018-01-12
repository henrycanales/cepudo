<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM Instituciones WHERE InstitucionId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['Codigo'],  	
				1 => $valores2['Nombre'],  
				2 => $valores2['Direccion'],  
				3 => $valores2['Telefono'],  
				4 => $valores2['RTN'],  
				5 => $valores2['Contacto'],  
				6 => $valores2['Correo'],  
				7 => $valores2['TipoInstitucionId'], 
				8 => $valores2['CategoriaId'],   	
				9 => $valores2['Proyecto'],   	
				);
echo json_encode($datos);
?>