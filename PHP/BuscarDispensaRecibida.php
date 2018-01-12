<?php
include('../conexion/conexion.php');

$id = $_POST['id'];


//OBTENEMOS LOS VALORES 

$valores = mysqli_query($conexion,"SELECT * FROM verdispensasrecibidas WHERE Embarque = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['NumeroDispensa'], 
				1 => $valores2['FechaRecepcion'], 	
				2 => $valores2['Observacion'], 	
				3 => $valores2['ValorFactura'], 
				4 => $valores2['ValorFlete'], 
				5 => $valores2['ValorSeguro'], 		

				);
echo json_encode($datos);
?>