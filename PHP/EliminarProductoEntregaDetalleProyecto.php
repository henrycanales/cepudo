<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$EntregaId = $_POST['entregaId'];

$Verificar = mysqli_query($conexion,"SELECT Estado FROM EntregasProyectos where EntregaProyectoId = '$EntregaId' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Estado'];

if($Estado == 'PENDIENTE DE ENTREGA'){

mysqli_query($conexion,"DELETE FROM EntregasProyectosDetalle where EntregasProyectosDetalleId = '$Id'") or die('Error:'.mysqli_error($conexion));
echo "1";

}else{
	echo "No se puede eliminar producto porque ya fue entregada esta orden.!";

}


?>
