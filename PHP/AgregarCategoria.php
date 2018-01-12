<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
$proceso = $_POST['pro'];
$Nombre = $_POST['nombreCategoria'];
$Fecha =  date("Y-m-d");


$Usuario = $_POST['usuario'];


if($proceso=='Registro'){

 mysqli_query($conexion,"INSERT INTO Categorias (Nombre,Estado, Fecha)
 VALUES ('$Nombre','Activo','$Fecha')") or die('Error:'.mysqli_error($conexion));
echo "1";
}
	
if($proceso=='Edicion'){
mysqli_query($conexion, "UPDATE Categorias SET Nombre = '$Nombre' WHERE CategoriaId = '$id'") or die('Error: '.mysqli_error($conexion));
echo "2";
} 




?>