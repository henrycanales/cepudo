<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$InventarioContenedor = $_POST['InventarioContenedorId'];

$Verfica = mysqli_query($conexion,"SELECT EstadoIngreso from InventarioContenedor where InventarioContenedorId = '$InventarioContenedor' ")
			or die('Error: '.mysqli_error($conexion));
$Verfica2 =  mysqli_fetch_array($Verfica);

$Estado = $Verfica2['EstadoIngreso'];

if($Estado != 'APLICADO'){

		$verificar= mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM InventarioContenedorDetalle where InventarioContenedorId='$InventarioContenedor'"));

		if($verificar > 1){
		mysqli_query($conexion, "DELETE FROM InventarioContenedorDetalle where InventarioContenedorDetalleId='$Id'") or die('Error:'.mysqli_error($conexion));
		echo "1";
		}else{
			  echo "-) Ingreso no puede quedar sin productos.!";

		}
}else{
	echo "Este Ingreso Ya fue aplicado";
}
?>