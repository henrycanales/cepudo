<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$Fecha = date("Y-m-d H:i:s");

$Verificar = mysqli_query($conexion,"SELECT Estado from EntregasProyectos where EntregaProyectoId = '$Id' ");
$Verificar2 = mysqli_fetch_array($Verificar);
$Estado = $Verificar2['Estado'];

if($Estado != "ENTREGADA"){

mysqli_query($conexion,"UPDATE EntregasProyectos set Estado = 'ENTREGADA',FechaEntrega = '$Fecha' where EntregaProyectoId='$Id'") or die('Error: '.mysqli_error($conexion));

echo "1";

}else{
  echo "Ya esta entregada esta donacion.!";
}

?>        
        
        
