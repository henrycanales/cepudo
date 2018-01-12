<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
$proceso = $_POST['pro'];
$NumeroEmbarque = $_POST['numeroEmbarque'];
$Naviera = $_POST['naviera'];
$FechaEstimada = $_POST['fechaEstimada'];
$Agente = $_POST['agente'];
$Aduana = $_POST['aduana'];
$EstadoDispensa = $_POST['estadoDispensa'];
$ValorFlete = $_POST['valorFlete'];
$ValorFactura = $_POST['valorFactura'];
$ValorSeguro = $_POST['valorSeguro'];
$FechaLlegada = $_POST['fechaLlegada'];
$Vencimiento = $_POST['vencimiento'];
$Observacion = $_POST['observacion'];
$NumeroBL = $_POST['numeroBL'];
$PO = $_POST['po'];
$TipoDonacion = $_POST['tipoDonacion'];
$NumeroContenedor = $_POST['numeroContenedor'];
$ObservacionContenedor = $_POST['observacionContenedor'];
$ComentarioContenedor = $_POST['comentarioContenedor'];

$Usuario = $_POST['usuario'];
$items = $_POST['items'];
$fecha = date("Y/m/d");


$Bandera=0;
$Bandera2=0;

 foreach ($NumeroContenedor as $p=>$Contenedor){

  if($Contenedor == '' || $ObservacionContenedor[$p]== ''){
  $Bandera++;
  }

  $verContenedor= mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM EmbarqueDetalle WHERE Contenedor='$Contenedor'"));
  if($verContenedor >=1){
    $Bandera2++;
  }

}


if($Bandera==0 || $proceso=='Edicion'){

if($Bandera2 > 0){
  echo "3";
}
else{
//INSERT Y UPDATE A LA TABLA DONACIONES

$verificar= mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM Embarque WHERE Embarque='$NumeroEmbarque'"));

if($verificar==1 && $proceso=='Registro'){
  echo "1";
}else{


 switch($proceso){
 case 'Registro': 

 mysqli_query($conexion,"INSERT INTO Embarque (Embarque,Naviera,FechaEstimada,Agente,Aduana,Estado,ValorFlete,ValorFactura,ValorSeguro,
  FechaLlegada,Vencimiento,Observacion,NumeroBL,PO,TipoDonacion,CreadoPor,FechaRegistro)
 VALUES ('$NumeroEmbarque','$Naviera','$FechaEstimada','$Agente','$Aduana','$EstadoDispensa','$ValorFlete','$ValorFactura',
  '$ValorSeguro','$FechaLlegada','$Vencimiento','$Observacion','$NumeroBL','$PO','$TipoDonacion','$Usuario','$fecha')") or die('Error:'.mysqli_error($conexion));

 foreach ($NumeroContenedor as $p=>$Contenedor){
  mysqli_query($conexion,"INSERT INTO EmbarqueDetalle (Embarque,Contenedor,ObservacionContenedor,ComentarioContenedor,Estado) VALUES
  ('$NumeroEmbarque','$Contenedor','$ObservacionContenedor[$p]','$ComentarioContenedor[$p]','Esperando Ingreso a Bodega')") 
   or die('Error:'.mysqli_error($conexion));

  }

  echo "INGRESO OK";

break;
	
case 'Edicion':
mysqli_query($conexion, "UPDATE Embarque SET Naviera = '$Naviera', FechaEstimada='$FechaEstimada', 
Agente = '$Agente', Aduana = '$Aduana', Estado = '$EstadoDispensa', ValorFlete = '$ValorFlete', ValorFactura = '$ValorFactura',
ValorSeguro = '$ValorSeguro', FechaLlegada = '$FechaLlegada', Vencimiento = '$Vencimiento', Observacion = '$Observacion',
NumeroBL = '$NumeroBL', PO='$PO', TipoDonacion = '$TipoDonacion', ModificadoPor='$Usuario' 	
WHERE EmbarqueId = '$id'") or die('Error:'.mysqli_error($conexion));

echo "MODIFICADO OK";
	break; 
} 

}
}
}
else{
  echo "2";
 
}
?>