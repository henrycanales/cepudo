<?php
include('../conexion/conexion.php');


$id = $_POST['id'];
$proceso = $_POST['pro'];
$nombre = $_POST['nombreDonante'];
$direccion = $_POST['direccionDonante'];
$telefono = $_POST['telefonoDonante'];
$fax = $_POST['faxDonante'];
$contacto = $_POST['contactoDonante'];
$correo = $_POST['correoDonante'];
$Usuario = $_POST['usuario'];
$fecha = date("Y/m/d");
$items = $_POST['items'];


/*
$proceso = "Registro";
$nombre = "Juan";
$direccion = "gdfgdgdgd";
$telefono = "jsdjgkfdg";
$fax = "jkdfjgkdfjgd";
$contacto = "jsdkgjdkfgdf";
$correo = "jkdjfkgjdkgd";
$Usuario = "juam";
$fecha = date("Y/m/d");
$items = 10;
*/



//VERIFICAMOS EL PROCESO

 switch($proceso){
 case 'Registro': 

 mysqli_query($conexion,"INSERT INTO Donantes (Nombre,Direccion,Telefono,Fax,Contacto,Correo,FechaCreacion,CreadoPor,ModificadoPor,Estado)
 VALUES ('$nombre','$direccion','$telefono','$fax','$contacto','$correo','$fecha','$Usuario','','Activo')") or die('Error:'.mysqli_error($conexion));
 echo "1";
 break;
	
case 'Edicion':
mysqli_query($conexion, "UPDATE Donantes SET Nombre = '$nombre', Direccion = '$direccion', Telefono='$telefono', Fax='$fax', Contacto='$contacto',
Correo='$correo', ModificadoPor='$Usuario', FechaModificado='$fecha' 	
WHERE DonanteId = '$id'") or die('Error:'.mysqli_error($conexion));
echo "2";
	break; 
} 


?>