<?php
include('../conexion/conexion.php');

$TipoAjuste = $_POST['tipoAjuste'];
$Comentario = $_POST['Comentario'];
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

if($Bandera > 0 ){
  echo "0";
}else{

  
    $Ultimo = mysqli_query($conexion,"SELECT MAX(AjusteId) AS Id FROM AjusteInventario");
    $row = mysqli_fetch_array($Ultimo); 
    $id = $row['Id'];
    $id = $id + 1;
    

    mysqli_query($conexion,"INSERT INTO AjusteInventario (AjusteId,TipoAjuste,Comentarios,Fecha,Usuario,Estado,Autorizacion)
    VALUES ('$id','$TipoAjuste','$Comentario','$Fecha', '$Usuario' ,'PENDIENTE APLICAR','No')") or die('Error:'.mysqli_error($conexion));

    foreach ($Codigo as $p=>$Cod){
    mysqli_query($conexion,"INSERT INTO AjusteInventarioDetalle (AjusteId,Producto,Cantidad) VALUES
    ('$id','$Cod','$Cantidad[$p]')") 
    or die('Error:'.mysqli_error($conexion));

    } 
    echo "1"; //Insertar

}

