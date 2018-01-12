<?php
include('../conexion/conexion.php');



$InstitucionId = $_POST['Institucion'];
$Fecha = $_POST['fecha'];
$Usuario = $_POST['usuario'];

$Hora = date("H:i:s");

$Codigo = $_POST['codigoD'];
$Cantidad = $_POST['cantidadD'];

$Fecha= $Fecha." ".$Hora;

$Bandera=0;


 foreach ($Codigo as $p=>$Cod){

  if($Cod == '' || $Cantidad[$p]== '' || $Cantidad[$p] < 1){
  $Bandera++;
  }
  
}
for ($i=0;$i<count($Codigo);$i++){

    for ($j=$i+1; $j<count($Codigo);$j++){

         if ($Codigo[$i] == $Codigo[$j]){
            
            $Cantidad = $Cantidad[$i]+$Cantidad[$j];
            $Inventario = mysqli_query($conexion,"SELECT Stock from InventarioContenedorDetalle where InventarioContenedorDetalleId = '$Codigo[$i]'") or die('Error:'.mysqli_error($conexion));
            $Inventario = mysqli_fetch_array($Inventario);
            if ($Inventario['Stock'] < $Cantidad) {
                echo "Error, La Cantidad producto con codigo: ".$Codigo[$i]." es mayor a la cantidad en inventario.!";
		$Bandera = 1;
            }else{
		$Bandera = 1;
		echo "Error, tiene productos repetidos.!";
	    }

         }       
    }

            $Inven = mysqli_query($conexion,"SELECT Stock from InventarioContenedorDetalle where InventarioContenedorDetalleId = '$Codigo[$i]'") or die('Error:'.mysqli_error($conexion));
            $Inven = mysqli_fetch_array($Inven);

            if ($Inven['Stock'] < $Cantidad[$i]) {
                        echo "Error, La Cantidad producto con codigo: ".$Codigo[$i]." es mayor a la cantidad en inventario.! \n";
            $Bandera = 1;
	     }
     
}


if($Bandera > 0 ){
  //echo "0";
}else{

  
    $Ultimo = mysqli_query($conexion,"SELECT MAX(EntregaId) AS Id FROM Entrega");
    $row = mysqli_fetch_array($Ultimo); 
    $id = $row['Id'];
    $id = $id + 1;
    

    mysqli_query($conexion,"INSERT INTO Entrega (EntregaId,InstitucionId,Fecha,UsuarioId,Estado)
    VALUES ('$id','$InstitucionId','$Fecha','$Usuario', 'PENDIENTE DE ENTREGA')") or die('Error:'.mysqli_error($conexion));

    foreach ($Codigo as $p=>$Cod){

    $CXP = mysqli_query($conexion,"SELECT CantidadXPresentacion from InventarioContenedorDetalle where InventarioContenedorDetalleId = '$Cod'") or die('Error:'.mysqli_error($conexion));
    $CXP2 = mysqli_fetch_array($CXP);

    $Can = $CXP2['CantidadXPresentacion'];
 
    $Stock = $Can * $Cantidad[$p];


    mysqli_query($conexion,"INSERT INTO EntregaDetalle (EntregaId,ProductoId,Cantidad,Stock) VALUES
    ('$id','$Cod','$Cantidad[$p]','$Stock')") 
    or die('Error:'.mysqli_error($conexion));

    } 
    echo "1"; //Insertar



}




