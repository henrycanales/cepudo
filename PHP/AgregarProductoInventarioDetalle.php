<?php
include('../conexion/conexion.php');


$id = $_POST['id'];

$Palet = $_POST['palet'];
$Codigo = $_POST['producto'];
$Descripcion = $_POST['descripcion'];
$Lote = $_POST['lote'];
$Vencimiento = $_POST['vencimiento'];
$Cantidad = $_POST['cantidad'];
$Presentacion = $_POST['presentacion'];
$CXP = $_POST['cxp'];
$CXB = $_POST['cxb'];
$Usuario = $_POST['usuario'];
$Total = $Cantidad * $CXP;


$Verfica = mysqli_query($conexion,"SELECT EstadoIngreso from InventarioContenedor where InventarioContenedorId = '$id' ")
			or die('Error: '.mysqli_error($conexion));
$Verfica2 =  mysqli_fetch_array($Verfica);
$Estado = $Verfica2['EstadoIngreso'];

if($Estado != 'APLICADO'){

	  mysqli_query($conexion,"INSERT INTO InventarioContenedorDetalle (InventarioContenedorId,Palet,Codigo,Descripcion,Lote,Vencimiento,Cantidad,Stock,
      Presentacion,CantidadXPresentacion,CantidadXBote,TotalUnidades) VALUES
	  ('$id','$Palet','$Codigo','$Descripcion','$Lote','$Vencimiento','$Cantidad','$Total','$Presentacion','$CXP','$CXB','$Total')") 
	  or die('Error:'.mysqli_error($conexion));


	  mysqli_query($conexion,"UPDATE InventarioContenedor set ModificadoPor='$Usuario' where InventarioContenedorId='$id' ") or die('Error:'.mysqli_error($conexion));

	  echo "1";
  }else{
	echo "Este Ingreso Ya fue aplicado";
}
?>




