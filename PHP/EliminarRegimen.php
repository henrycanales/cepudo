<?php
include('../conexion/conexion.php');

$id = $_POST['id'];


$Registro = mysqli_query($conexion,"SELECT Estado from Regimen where RegimenId='$id'");
$Registro2 = mysqli_fetch_array($Registro);


if($Registro2['Estado'] == 'Inactivo' ){

	mysqli_query($conexion, "UPDATE Regimen SET Estado = 'Eliminado' WHERE RegimenId = '$id'") or die('Error: '.mysqli_error($conexion));
	echo "Se ha elimanado este Regimen.!";
}else{
		if($Registro2['Estado'] == 'Activo'){
		echo "No se puede Eliminar este Regimen porque esta Activo, tiene que desactivarlo.!";
		}else{
			    echo "Regimen ya esta Elimado.!";
	         }
	}


