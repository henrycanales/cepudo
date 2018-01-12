<?php
include('../conexion/conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($conexion,"SELECT NumeroDispensa,Imagen FROM Dispensas WHERE DispensaId = '$id'");
$valores2 = mysqli_fetch_array($valores);

$Imagen=$valores2['Imagen'];
if($Imagen==null){
	echo "NO HAY IMAGEN";
	echo "<br>";
}else{
echo "DISPENSA: ".$valores2['NumeroDispensa'];
echo "<br>"; echo "<br>";
echo "<img src='$Imagen' WIDTH=400 HEIGHT=400>";
}
?>