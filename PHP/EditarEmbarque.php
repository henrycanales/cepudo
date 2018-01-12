<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT * FROM Embarque WHERE EmbarqueId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['Embarque'], 
				1 => $valores2['Naviera'], 	
				2 => $valores2['FechaEstimada'], 	
				3 => $valores2['Agente'], 	
				4 => $valores2['Aduana'],
				5 => $valores2['Estado'],
				6 => $valores2['ValorFlete'],
				7 => $valores2['ValorFactura'],
				8 => $valores2['ValorSeguro'],
				9 => $valores2['FechaLlegada'],
				10 => $valores2['Vencimiento'],
				11 => $valores2['Observacion'],
				12 => $valores2['NumeroBL'],
				13 => $valores2['TipoDonacion'],
				14 => $valores2['PO'],

				);
echo json_encode($datos);
?>