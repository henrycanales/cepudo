<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$beneficiario = $_POST['beneficiario'];

$Verificar = mysqli_query($conexion,"SELECT Estado FROM EntregasProyectos where EntregaProyectoId = '$Id' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Estado'];

if($Estado == 'PENDIENTE DE ENTREGA'){

	mysqli_query($conexion, "UPDATE EntregasProyectos SET BeneficiarioId = '$beneficiario'	
	WHERE EntregaProyectoId = '$Id'") or die('Error:'.mysqli_error($conexion));

	echo "1";

}else{
	echo "No se puede actualizar orden de entrega porque ya fue entregada.!";
}
?>