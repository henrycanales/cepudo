<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$AjusteId = $_POST['ajusteId'];

$Verificar = mysqli_query($conexion,"SELECT Estado FROM AjusteInventario where AjusteId = '$AjusteId' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Estado'];

if($Estado == 'PENDIENTE APLICAR'){

mysqli_query($conexion,"DELETE FROM AjusteInventarioDetalle where AjusteDetalleId = '$Id'") or die('Error:'.mysqli_error($conexion));
echo "1";

}else{
	echo "No se puede eliminar producto porque ya fue aplicado este ajuste.!";

}


?>