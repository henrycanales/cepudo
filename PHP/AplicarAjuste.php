<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$Fecha = date("Y-m-d H:i:s");

$Verificar = mysqli_query($conexion,"SELECT Estado,Autorizacion from AjusteInventario where AjusteId = '$Id' ");
$Verificar2 = mysqli_fetch_array($Verificar);
$Estado = $Verificar2['Estado'];
$Autorizacion = $Verificar2['Autorizacion'];

if($Estado != "APLICADO" && $Autorizacion == 'Si' ){

mysqli_query($conexion,"UPDATE AjusteInventario set Estado = 'APLICADO' where AjusteId='$Id'") or die('Error: '.mysqli_error($conexion));

echo "1";

}else{
	if($Autorizacion == 'No'){
		echo "No se puede aplicar porque no ha sido autorizado.!";
	}else{
  		echo "Ya esta aplicado el ajuste.!";
	}
}

?>     