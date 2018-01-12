<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
$proceso = $_POST['pro'];
$numeroEmbarque = $_POST['numeroEmbarque'];
$numeroPoliza = $_POST['numeroPoliza'];
$fechaPoliza = $_POST['fechaPoliza'];
$observacion = $_POST['observacion'];
$tasaCambio = $_POST['tasaCambio'];
$otrosGastos = $_POST['otrosGastos'];
$ajustes = $_POST['ajustes'];
$cifImponibles = $_POST['cifImponibles'];
$fecha=date('Y-m-d');

$Usuario = $_POST['usuario'];


if($proceso=='Registro'){

 mysqli_query($conexion,"INSERT INTO Declaraciones (Embarque,Poliza,FechaPoliza,Observacion,TasaCambio,OtrosGastos,Ajustes,CIF,CreadoPor,FechaRegistro)
 VALUES ('$numeroEmbarque','$numeroPoliza','$fechaPoliza','$observacion','$tasaCambio','$otrosGastos','$ajustes','$cifImponibles','$Usuario','$fecha')") 
 or die('Error:'.mysqli_error($conexion));
echo "1";
}
	
if($proceso=='Edicion'){
mysqli_query($conexion, "UPDATE Declaraciones SET Embarque = '$numeroEmbarque', Poliza = '$numeroPoliza', Observacion = '$observacion',
TasaCambio='$tasaCambio', OtrosGastos='$otrosGastos', Ajustes='$ajustes',CIF='$cifImponibles', ModificadoPor='$Usuario'
WHERE DeclaracionId = '$id'") or die('Error: '.mysqli_error($conexion));
echo "2";
} 



?>