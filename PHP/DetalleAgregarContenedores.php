<?php
include('../conexion/conexion.php');

$Embarque = $_POST['embarque'];
$Contenedor = $_POST['contenedor'];
$Comentario = $_POST['comentario'];
$Detalle = $_POST['detalle'];

if($Embarque == '' || $Contenedor == ''){
	echo "Error, No se puede dejar vacio el campo contenedor.!";
}else{

mysqli_query($conexion,"INSERT into EmbarqueDetalle (Embarque, Contenedor, ObservacionContenedor, ComentarioContenedor, Estado) 
values ('$Embarque', '$Contenedor','$Detalle','$Comentario', 'Esperando Ingreso Bodega')") or die('Error: '.mysqli_error($conexion));
echo "Ok";
}
