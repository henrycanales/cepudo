<?php

$dato=$_POST['dato'];

//$usuario='AdminCepudo';
//$contrasena = 'AdminCepudo#2017';

//$dato=1487878;

$Verificar = '';
include('../conexion/conexion.php');
/*
$pdo = new PDO('mysql:host=localhost;dbname=cepudo', $usuario, $contrasena);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
*/
$stmt = $pdo->prepare("SELECT * FROM vistareportecontenedordetalle where Contenedor=? ");
$stmt->execute([$dato]);
$query = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($query as $key => $campos) {
  $Verificar = $campos['Contenedor'];
}

if($Verificar == ''){
	echo "Contenedor no tiene detalle o no existe.!";
}else{
	echo "Ok";
}

?>
