<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM VerEntregaProyectos WHERE EntregaProyectoId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['Proyecto'],  	
				1 => $valores2['Beneficiario'], 		
				);
echo json_encode($datos);
?>