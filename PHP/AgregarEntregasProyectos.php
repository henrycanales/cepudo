<?php
include('../conexion/conexion.php');



$Beneficiario = $_POST['beneficiario'];
$Proyecto = $_POST['proyecto'];
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

  
    $Ultimo = mysqli_query($conexion,"SELECT MAX(EntregaProyectoId) AS Id FROM EntregasProyectos");
    $row = mysqli_fetch_array($Ultimo); 
    $id = $row['Id'];
    $id = $id + 1;
    

    mysqli_query($conexion,"INSERT INTO EntregasProyectos (EntregaProyectoId,ProyectoId,BeneficiarioId,Fecha,Estado,UsuarioId)
    VALUES ('$id','$Proyecto','$Beneficiario','$Fecha', 'PENDIENTE DE ENTREGA' ,'$Usuario')") or die('Error:'.mysqli_error($conexion));

    foreach ($Codigo as $p=>$Cod){

    mysqli_query($conexion,"INSERT INTO EntregasProyectosDetalle (EntregaProyectoId,ProductoId,Cantidad) VALUES
    ('$id','$Cod','$Cantidad[$p]')") 
    or die('Error:'.mysqli_error($conexion));

    } 
    echo "1"; //Insertar



}

?>




