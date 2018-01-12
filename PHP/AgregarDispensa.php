<?php
include('../conexion/conexion.php');
error_reporting(1);
session_start();


$id = $_POST['id'];
$proceso = $_POST['pro'];
$Embarque = $_POST['NEmbarque'];
$FechaDispensa = $_POST['fechaDispensa'];
$NDispensa = $_POST['NDispensa'];
$FechaRecepcion = $_POST['fechaRecepcion'];

$Usuario = $_POST['usuario'];
$foto=$_SESSION['foto'];


if($proceso=='Registro'){

 mysqli_query($conexion,"INSERT INTO Dispensas (Embarque,FechaDispensa,NumeroDispensa,CreadoPor,Estado)
 VALUES ('$Embarque','$FechaDispensa','$NDispensa','$Usuario','Abierta')") or die('Error:'.mysqli_error($conexion));
echo "1";
}
	
if($proceso=='Edicion'){
mysqli_query($conexion, "UPDATE Dispensas SET Embarque = '$Embarque', FechaDispensa = '$FechaDispensa', FechaRecepcion = '$FechaRecepcion',
NumeroDispensa='$NDispensa', ModificadoPor='$Usuario', Imagen='$foto'
WHERE DispensaId = '$id'") or die('Error: '.mysqli_error($conexion));

if($FechaRecepcion!='000-00-00' && $FechaRecepcion!=''){
mysqli_query($conexion, "UPDATE Dispensas SET Estado = 'Recibida'
WHERE DispensaId = '$id'") or die('Error: '.mysqli_error($conexion));  

mysqli_query($conexion, "UPDATE Embarque SET Estado = 'Dispensa Entregada Agente Aduanero'
WHERE Embarque = '$Embarque'") or die('Error: '.mysqli_error($conexion)); 
}

echo "2";
} 



?>