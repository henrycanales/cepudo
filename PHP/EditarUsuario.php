<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM usuarios WHERE UsuarioId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['Usuario'], 
				1 => $valores2['Pass'], 	
				2 => $valores2['Nombre'], 	
				3 => $valores2['Nivel'], 			
				);
echo json_encode($datos);
?>