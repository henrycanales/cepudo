<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM AgenteAduanero WHERE AgenteId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['Nombre'],  			
				);
echo json_encode($datos);
?>