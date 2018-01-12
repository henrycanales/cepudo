<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$Cantidad = $_POST['cantidad'];
$EntregaId = $_POST['entregaId'];

$Verificar = mysqli_query($conexion,"SELECT Estado FROM Entrega where EntregaId = '$EntregaId' ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Estado'];

if($Estado == 'PENDIENTE DE ENTREGA'){
	if($Cantidad > 0 || $Cantidad !=''){

		 $Codigo = mysqli_query($conexion,"SELECT ProductoId from EntregaDetalle where EntregaDetalleId = '$Id'") or die('Error:'.mysqli_error($conexion));
		 $Codigo2 = mysqli_fetch_array($Codigo);
		 $CodigoProducto = $Codigo2['ProductoId'];
		 
		 $Inven = mysqli_query($conexion,"SELECT Stock from InventarioContenedorDetalle where InventarioContenedorDetalleId = '$CodigoProducto'") or die('Error:'.mysqli_error($conexion));
         $Inven = mysqli_fetch_array($Inven);

         if ($Inven['Stock'] < $Cantidad) {
              echo "Error, La Cantidad del producto es mayor a la cantidad en inventario.! \n";
         }else{

			mysqli_query($conexion, "UPDATE EntregaDetalle SET Cantidad = '$Cantidad', Stock = '$Cantidad'	
			WHERE EntregaDetalleId = '$Id'") or die('Error:'.mysqli_error($conexion));

			echo "1";
		}
	}else{
		echo "No puede Dejar en cero la cantidad.!";
	}
}else{
	echo "No se puede actualizar producto porque ya fue entregada esta orden.!";
}
