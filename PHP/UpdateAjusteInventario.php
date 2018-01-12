<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$Cantidad = $_POST['cantidad'];
$AjusteId = $_POST['ajusteId'];

$Verificar = mysqli_query($conexion,"SELECT Estado FROM AjusteInventario where AjusteId = '$AjusteId' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Estado'];

if($Estado == 'PENDIENTE APLICAR'){
	if($Cantidad > 0 || $Cantidad !=''){
	mysqli_query($conexion, "UPDATE AjusteInventarioDetalle SET Cantidad = '$Cantidad'
	WHERE AjusteDetalleId = '$Id'") or die('Error:'.mysqli_error($conexion));

	echo "1";
	}else{
		echo "No puede Dejar en cero la cantidad.!";
	}
}else{
	echo "No se puede actualizar producto porque ya fue aplicado este ajuste.!".$AjusteId;
}
?>