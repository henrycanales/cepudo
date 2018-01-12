<?php
include('../conexion/conexion.php');

$Id = $_POST['id'];
$Contenedor = $_POST['contenedor'];
$Observacion = $_POST['observacion'];
$Comentario = $_POST['comentario'];
$FechaBodega = $_POST['fechaBodega'];
$FechaRetorno = $_POST['fechaRetorno'];
$Estado='';

if($FechaBodega!='0000-00-00' && $FechaBodega!=''){
$Estado="Ingreso a Bodega";
}else{
$Estado="Esperando Ingreso Bodega";
}

$verificar= mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM EmbarqueDetalle WHERE Contenedor='$Contenedor'"));

mysqli_query($conexion, "UPDATE EmbarqueDetalle SET Contenedor = '$Contenedor', ObservacionContenedor = '$Observacion', 
ComentarioContenedor = '$Comentario', FechaBodega = '$FechaBodega', FechaRetorno = '$FechaRetorno', Estado = '$Estado'	
WHERE EmbarqueDetalleId = '$Id'") or die('Error:'.mysqli_error($conexion));

echo "1";
?>