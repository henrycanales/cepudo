<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$Producto = $_POST['producto'];
$Cantidad = $_POST['cantidad'];


$Verificar = mysqli_query($conexion,"SELECT Estado FROM EntregasProyectos where EntregaProyectoId = '$Id' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Estado'];

if($Estado == 'PENDIENTE DE ENTREGA'){
	if($Cantidad > 0 ){
	mysqli_query($conexion,"INSERT INTO EntregasProyectosDetalle (EntregaProyectoId,ProductoId,Cantidad) VALUES ('$Id','$Producto','$Cantidad')") 
	or die('Error:'.mysqli_error($conexion));
	echo "1";
	}
	else{
		echo "No puede dejar en cero o vacio el campo Cantidad.";
	}
}else{
	echo "No se puede agregar producto porque ya fue entregada esta orden.!";
}
?>