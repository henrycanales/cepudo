<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];

$Verificar = mysqli_query($conexion,"SELECT Estado FROM Entrega where EntregaId = '$Id' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Estado'];

if($Estado == 'PENDIENTE DE ENTREGA'){

mysqli_query($conexion,"DELETE FROM EntregaDetalle where EntregaId= '$Id'") or die('Error:'.mysqli_error($conexion));
mysqli_query($conexion,"DELETE FROM Entrega where EntregaId= '$Id'") or die('Error:'.mysqli_error($conexion));

echo "1";

}else{
	echo "No se puede eliminar porque ya fue entregada al beneficiario.!";
}


?>