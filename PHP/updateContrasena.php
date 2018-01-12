<?php
session_start();
include('../conexion/conexion.php');

$usuario = $_SESSION['session_id_cepudo'];
$passAnterior = $_POST['passAnterior'];
$nuevaPass = $_POST['passNew'];

$Verificar = mysqli_query($conexion,"SELECT COUNT(Usuario) as Cantidad from Usuarios where Usuario = '$usuario' and Pass = '$passAnterior' and Estado = 'Activo'  ")or die('Error:'.mysqli_error($conexion));

$Verificar2 = mysqli_fetch_array($Verificar);

$Estado = $Verificar2['Cantidad'];

if ($Estado == 1 ){
	mysqli_query($conexion,"UPDATE Usuarios set pass = '$nuevaPass' where Usuario = '$usuario' ") or die('Error:'.mysqli_error($conexion));
	echo "1";
}else{
	echo "Contrasena anterior no es correcta.!";
	 echo $usuario;
	 echo $passAnterior;
	 echo $Estado;
}
