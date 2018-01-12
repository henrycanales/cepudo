<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];

$Verficar = mysqli_query($conexion,"SELECT EstadoIngreso from InventarioContenedor where InventarioContenedorId = '$Id' ")
			or die('Error: '.mysqli_error($conexion));
$Verficar2 =  mysqli_fetch_array($Verficar);

$Estado = $Verficar2['EstadoIngreso'];

if($Estado != 'APLICADO'){

mysqli_query($conexion, "DELETE FROM InventarioContenedorDetalle where InventarioContenedorId='$Id'") or die('Error:'.mysqli_error($conexion));
mysqli_query($conexion, "DELETE FROM InventarioContenedor where InventarioContenedorId='$Id'") or die('Error:'.mysqli_error($conexion));



echo "1";
}else{
	echo "Este Ingreso Ya fue aplicado";
}
?>