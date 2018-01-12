<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
$Contenedor = $_POST['numeroContenedor'];
$Estado = $_POST['estado'];
$Fecha = $_POST['fecha'];
$Tamano = $_POST['tamano'];
$Usuario = $_POST['usuario'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$Verficar = mysqli_query($conexion,"SELECT EstadoIngreso from InventarioContenedor where InventarioContenedorId = '$id' ")
			or die('Error: '.mysqli_error($conexion));
$Verficar2 =  mysqli_fetch_array($Verficar);

$Estado = $Verficar2['EstadoIngreso'];

if($Estado != 'APLICADO'){

	mysqli_query($conexion,"UPDATE InventarioContenedor set Contenedor = '$Contenedor', Fecha = '$Fecha', Tamano = '$Tamano', Estado = '$Estado',
	             ModificadoPor = '$Usuario' where InventarioContenedorId = '$id' ") or die('Error: '.mysqli_error($conexion));

	echo "Ok";
}else{
	echo "Este Ingreso Ya fue aplicado";
}

?>