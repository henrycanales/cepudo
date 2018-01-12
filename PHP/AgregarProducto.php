<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
$proceso = $_POST['pro'];
$Producto = $_POST['nombreProducto'];


$Usuario = $_POST['usuario'];


if($proceso=='Registro'){

 mysqli_query($conexion,"INSERT INTO Productos (Descripcion,CreadoPor,Estado)
 VALUES ('$Producto','$Usuario','Activo')") or die('Error:'.mysqli_error($conexion));
echo "1";
}
	
if($proceso=='Edicion'){
mysqli_query($conexion, "UPDATE Productos SET Descripcion = '$Producto', ModificadoPor='$Usuario'
WHERE ProductoId = '$id'") or die('Error: '.mysqli_error($conexion));
echo "2";
} 




?>