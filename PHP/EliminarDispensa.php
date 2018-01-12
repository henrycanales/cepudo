<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$ver=mysqli_query($conexion,"SELECT Estado FROM Dispensas where DispensaId='$id'")
or die (mysqli_error($conexion));

$ver2=mysqli_fetch_array($ver);

$verificar=$ver2['Estado'];

if($verificar=='Abierta'){
mysqli_query($conexion,"DELETE FROM Dispensas where DispensaId='$id'")
or die(mysqli_error($conexion));

echo "1";
}else{
	echo "Dispensa ya esta cerrada";
	}



?>