<?php
include('../conexion/conexion.php');


$id = $_POST['id'];

$Verfica = mysqli_query($conexion,"SELECT EstadoIngreso from InventarioContenedor where InventarioContenedorId = '$id' ")
			or die('Error: '.mysqli_error($conexion));
$Verfica2 =  mysqli_fetch_array($Verfica);
$Estado = $Verfica2['EstadoIngreso'];

if($Estado != 'APLICADO'){

	  mysqli_query($conexion,"UPDATE InventarioContenedor set EstadoIngreso='APLICADO' where InventarioContenedorId='$id' ") or die('Error:'.mysqli_error($conexion));

	  echo "1";
  }else{
	echo "Este Ingreso Ya fue aplicado";
}
?>

