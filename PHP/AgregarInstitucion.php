<?php
include('../conexion/conexion.php');

$id = $_POST['id'];
$proceso = $_POST['pro'];
$codigo = $_POST['codigoInst'];
$nombre = $_POST['nombreInst'];
$tipo = $_POST['tipoInst'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$rtn = $_POST['rtn'];
$contacto = $_POST['contacto'];
$email = $_POST['email'];
$categoria = $_POST['categoria'];
$proyecto = $_POST['proyecto'];
$fecha=date('Y-m-d');




if($proceso=='Registro'){

 mysqli_query($conexion,"INSERT INTO Instituciones (Codigo,Nombre,TipoInstitucionId,Direccion,Telefono,RTN,Contacto,Correo,Estado,Fecha,CategoriaId,Proyecto)
 VALUES ('$codigo','$nombre','$tipo','$direccion','$telefono','$rtn','$contacto','$email','A','$fecha','$categoria','$proyecto')") 
 or die('Error:'.mysqli_error($conexion));
echo "1";
}
	
if($proceso=='Edicion'){
mysqli_query($conexion, "UPDATE Instituciones SET Codigo = '$codigo', Nombre = '$nombre', TipoInstitucionId = '$tipo' ,Direccion = '$direccion',
Telefono='$telefono', RTN='$rtn', Contacto='$contacto',Correo='$email', CategoriaId = '$categoria', Proyecto  = '$proyecto'
WHERE InstitucionId = '$id'") or die('Error: '.mysqli_error($conexion));
echo "2";
} 



?>