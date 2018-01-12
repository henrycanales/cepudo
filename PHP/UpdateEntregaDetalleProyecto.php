<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$Cantidad = $_POST['cantidad'];
$EntregaId = $_POST['entregaId'];

$Verificar = mysqli_query($conexion,"SELECT Estado FROM EntregasProyectos where EntregaProyectoId = '$EntregaId' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Estado'];

if($Estado == 'PENDIENTE DE ENTREGA'){
	if($Cantidad > 0 || $Cantidad !=''){
	mysqli_query($conexion, "UPDATE EntregasProyectosDetalle SET Cantidad = '$Cantidad'
	WHERE EntregasProyectosDetalleId = '$Id'") or die('Error:'.mysqli_error($conexion));

	echo "1";
	}else{
		echo "No puede Dejar en cero la cantidad.!";
	}
}else{
	echo "No se puede actualizar producto porque ya fue entregada esta orden.!";
}
?>