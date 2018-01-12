<?php
include('../conexion/conexion.php');


$id = $_POST['id'];
$proceso = $_POST['pro'];
$donanteId = $_POST['donanteId'];
$descripcion = $_POST['descripcionDonacion'];
$fecha = $_POST['fechaDonacion'];
$po = $_POST['poDonacion'];
$cantidad = $_POST['cantidadContenedores'];
$tamano = $_POST['tamanoContenedores'];
$Usuario = $_POST['usuario'];
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



//INSERT Y UPDATE A LA TABLA DONACIONES

 switch($proceso){
 case 'Registro': 
 mysqli_query($conexion,"INSERT INTO Donaciones (DonanteId,Descripcion,Fecha,PO,CantidadC,Tamano,CreadoPor,ModificadoPor)
 VALUES ('$donanteId','$descripcion','$fecha','$po','$cantidad','$tamano','$Usuario','')") or die('Error:'.mysqli_error($conexion));
 echo "1";
 break;
	
case 'Edicion':
mysqli_query($conexion, "UPDATE Donaciones SET Descripcion = '$descripcion', Fecha = '$fecha', PO='$po', CantidadC='$cantidad',
Tamano='$tamano',ModificadoPor='$Usuario' 	
WHERE DonacionId = '$id'") or die('Error:'.mysqli_error($conexion));
echo "2";
	break; 
} 


