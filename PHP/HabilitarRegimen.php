<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
$condicion = $_POST['condicion'];

$Registro = mysqli_query($conexion,"SELECT Estado from Regimen where RegimenId='$id'");
$Registro2 = mysqli_fetch_array($Registro);

if($condicion == 1){

		if($Registro2['Estado'] == 'Inactivo'){

			mysqli_query($conexion, "UPDATE Regimen SET Estado = 'Inactivo' WHERE Estado = 'Activo'") or die('Error: '.mysqli_error($conexion));
			mysqli_query($conexion, "UPDATE Regimen SET Estado = 'Activo' WHERE RegimenId = '$id'") or die('Error: '.mysqli_error($conexion));
			echo "Se ha Activo este Regimen.!";
		}else{
			if($Registro2['Estado'] == 'Elimado'){
			echo "Este Regimen no se puede habilitar porque ya fue Elimado.!";
			}else{
		    echo "Regimen ya esta Activo.!";
			}
		}

}
