<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$Lote = $_POST['lote'];
$Vencimiento = $_POST['vencimiento'];
$Cantidad = $_POST['cantidad'];
$id = $_POST['inventarioId'];
$CP= $_POST['cp'];
$CB= $_POST['cb'];
$Total = $Cantidad * $CP;


$Verficar = mysqli_query($conexion,"SELECT EstadoIngreso from InventarioContenedor where InventarioContenedorId = '$id' ")
			or die('Error: '.mysqli_error($conexion));
$Verficar2 =  mysqli_fetch_array($Verficar);

$Estado = $Verficar2['EstadoIngreso'];

if($Estado != 'APLICADO'){

	if($Cantidad !=0){
	mysqli_query($conexion, "UPDATE InventarioContenedorDetalle SET Lote = '$Lote', Vencimiento = '$Vencimiento', 
	Cantidad = '$Cantidad', CantidadXPresentacion = '$CP', CantidadXBote = '$CB', Stock = '$Total', TotalUnidades = '$Total'	
	WHERE InventarioContenedorDetalleId = '$Id'") or die('Error:'.mysqli_error($conexion));

	echo "1";
	}else{
		echo "No puede Dejar en cero la cantidad.!";
	}
}else{
	echo "Este Ingreso Ya fue aplicado";
}
?>