<?php
include('../conexion/conexion.php');


$id = $_POST['id'];
$proceso = $_POST['pro'];
$Contenedor = $_POST['numeroContenedor'];
$Estado = $_POST['estadoContenedor'];
$Fecha = $_POST['fecha'];
$Tamano = $_POST['tamano'];


$Palet = $_POST['paletD'];
$Codigo = $_POST['codigoD'];
$Descripcion = $_POST['productoD'];
$Lote = $_POST['loteD'];
$Vencimiento = $_POST['vencimientoD'];
$Cantidad = $_POST['cantidadD'];
$Presentacion = $_POST['presentacionD'];
$CantidadP = $_POST['cantidadPD'];
$CXB = $_POST['cxbD'];

$Usuario = $_POST['usuario'];
$items = $_POST['items'];



$Bandera=0;


 foreach ($Descripcion as $p=>$Des){

  if($Des == '' || $Cantidad[$p]== '' || $Cantidad[$p]== 0 || $Codigo[$p] == '' || $CantidadP[$p] == '' || $CantidadP[$p] < 1 ){
  $Bandera++;
  }

}

if($Bandera > 0){
      echo "0";
    }else{
     if($proceso=='Registro'){
      
      $Ultimo = mysqli_query($conexion,"SELECT MAX(InventarioContenedorId) AS Id FROM InventarioContenedor");
      $row = mysqli_fetch_array($Ultimo); 
      $id = $row['Id'];
      $id = $id + 1;
      

     mysqli_query($conexion,"INSERT INTO InventarioContenedor (InventarioContenedorId,Contenedor,Fecha,Tamano,Estado,CreadoPor,EstadoIngreso)
     VALUES ('$id','$Contenedor','$Fecha','$Tamano','$Estado','$Usuario','SIN APLICAR')") or die('Error:'.mysqli_error($conexion));

     foreach ($Palet as $p=>$palet){

      $Total = ($Cantidad[$p]) * ($CantidadP[$p]);

      mysqli_query($conexion,"INSERT INTO InventarioContenedorDetalle (InventarioContenedorId,Palet,Codigo,Descripcion,Lote,Vencimiento,Cantidad,Stock,
      Presentacion,CantidadXPresentacion,CantidadXBote,TotalUnidades ) VALUES
      ('$id','$palet','$Codigo[$p]','$Descripcion[$p]','$Lote[$p]','$Vencimiento[$p]','$Cantidad[$p]','$Total','$Presentacion[$p]','$CantidadP[$p]','$CXB[$p]','$Total')") 
      or die('Error:'.mysqli_error($conexion));
    }

    echo "1"; //Insertar
    }

}

?>




