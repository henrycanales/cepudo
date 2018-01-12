<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM BeneficiariosProyectos WHERE BeneficiarioId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(	
				0 => $valores2['Direccion'], 		
				);
echo json_encode($datos);
?>