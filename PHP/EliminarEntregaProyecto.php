<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];

$Verificar = mysqli_query($conexion,"SELECT Estado FROM EntregasProyectos where EntregaProyectoId = '$Id' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Estado'];

if($Estado == 'PENDIENTE DE ENTREGA'){

mysqli_query($conexion,"DELETE FROM EntregasProyectosDetalle where EntregaProyectoId= '$Id'") or die('Error:'.mysqli_error($conexion));
mysqli_query($conexion,"DELETE FROM EntregasProyectos where EntregaProyectoId= '$Id'") or die('Error:'.mysqli_error($conexion));

echo "1";

}else{
	echo "No se puede eliminar porque ya fue entregada al beneficiario.!";
}


?>