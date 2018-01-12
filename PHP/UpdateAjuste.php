<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$Comentario = $_POST['comentario'];

$Verificar = mysqli_query($conexion,"SELECT Estado FROM AjusteInventario where AjusteId = '$Id' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Estado'];

if($Estado == 'PENDIENTE APLICAR'){

	mysqli_query($conexion, "UPDATE AjusteInventario SET Comentarios = '$Comentario'	
	WHERE AjusteId = '$Id'") or die('Error:'.mysqli_error($conexion));

	echo "1";

}else{
	echo "No se puede actualizar porque ya fue aplicado el ajuste.!";
}
?>