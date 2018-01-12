<?php
include('../conexion/conexion.php');

$proceso = $_POST['Proceso'];
$Nombre = $_POST['nombreInformacion'];
$RTN = $_POST['rtnInformacion'];
$Direccion = $_POST['direccionInformacion'];
$Telefono = $_POST['telefonoInformacion'];
$Correo = $_POST['correo'];
$Web = $_POST['Sitioweb'];

if($proceso=='Agregar'){

 mysqli_query($conexion,"INSERT INTO InformacionEmpresa (Nombre,RTN,Direccion,Telefono,Correo,Web)
 VALUES ('$Nombre','$RTN','$Direccion','$Telefono','$Correo','$Web')") 
 or die('Error: '.mysqli_error($conexion));
 echo "1";
}
	
if($proceso=='Editar'){
mysqli_query($conexion, "UPDATE InformacionEmpresa SET Nombre = '$Nombre', RTN = '$RTN', Direccion = '$Direccion',
Telefono='$Telefono', Correo='$Correo', Web='$Web' ") or die('Error: '.mysqli_error($conexion));
echo "2";
} 



?>