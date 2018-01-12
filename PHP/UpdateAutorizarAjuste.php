<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];

$Verificar = mysqli_query($conexion,"SELECT Autorizacion FROM AjusteInventario where AjusteId = '$Id' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Autorizacion'];

if($Estado == 'No'){

	mysqli_query($conexion, "UPDATE AjusteInventario SET Autorizacion = 'Si'
	WHERE AjusteId = '$Id'") or die('Error:'.mysqli_error($conexion));

	echo "1";
}else{
		echo "Ya esta autorizado este ajuste.!";
}

?>