<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$Embarque = $_POST['Embarque'];

$verificar= mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM EmbarqueDetalle where Embarque='$Embarque'"));

$registro = mysqli_query($conexion,"SELECT Estado FROM EmbarqueDetalle where EmbarqueDetalleId='$Id' ");

$registro2=mysqli_fetch_array($registro);

$Estado=$registro2['Estado'];

if($verificar > 1 && $Estado!='Ingreso a Bodega' ){
mysqli_query($conexion, "DELETE FROM EmbarqueDetalle where EmbarqueDetalleId='$Id'") or die('Error:'.mysqli_error($conexion));
echo "1";
}else{
	if($verificar == 1  ){
	echo "-) No puede quedar el embarque sin contenedor.! ";
	}
	if($Estado=='Ingreso a Bodega' ){

	echo "-) Contenedor ya fue ingresado no se puede borrar.";
	}
}
?>