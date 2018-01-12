<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];

$Verificar = mysqli_query($conexion,"SELECT Estado FROM AjusteInventario where AjusteId = '$Id' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Estado'];

if($Estado == 'PENDIENTE APLICAR'){

mysqli_query($conexion,"DELETE FROM AjusteInventarioDetalle where AjusteId= '$Id'") or die('Error:'.mysqli_error($conexion));
mysqli_query($conexion,"DELETE FROM AjusteInventario where AjusteId= '$Id'") or die('Error:'.mysqli_error($conexion));

echo "1";

}else{
	echo "No se puede eliminar porque ya fue aplicado este ajuste.!";
}


?>