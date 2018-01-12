<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
$proceso = $_POST['pro'];
$nombre = $_POST['nombreBeneficiario'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$contacto = $_POST['contacto'];
$email = $_POST['email'];
$fecha=date('Y-m-d');




if($proceso=='Registro'){

 mysqli_query($conexion,"INSERT INTO BeneficiariosProyectos (Nombre,Direccion,Telefono,Contacto,Correo,Estado,Fecha)
 VALUES ('$nombre','$direccion','$telefono','$contacto','$email','A','$fecha')") 
 or die('Error:'.mysqli_error($conexion));
echo "1";
}
	
if($proceso=='Edicion'){
mysqli_query($conexion, "UPDATE BeneficiariosProyectos SET Nombre = '$nombre',Direccion = '$direccion',
Telefono='$telefono', Contacto='$contacto',Correo='$email'
WHERE BeneficiarioId = '$id'") or die('Error: '.mysqli_error($conexion));
echo "2";
} 



?>