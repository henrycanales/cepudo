<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
$proceso = $_POST['pro'];
$Descripcion = $_POST['nombreTipo'];
$Fecha = date("Y-m-d");


$Usuario = $_POST['usuario'];


if($proceso=='Registro'){

 mysqli_query($conexion,"INSERT INTO TiposInstituciones (Descripcion,Estado,Fecha)
 VALUES ('$Descripcion','Activo','$Fecha')") or die('Error:'.mysqli_error($conexion));
echo "1";
}
	
if($proceso=='Edicion'){
mysqli_query($conexion, "UPDATE TiposInstituciones SET Descripcion = '$Descripcion' WHERE TipoInstitucionId = '$id'") or die('Error: '.mysqli_error($conexion));
echo "2";
} 




?>