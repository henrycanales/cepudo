<?php
//error_reporting(0);
$Servidor="localhost";
$Usuario="AdminCepudo";
$Pass="AdminCepudo#2017";
$BD="cepudo";


$conexion= mysqli_connect($Servidor, $Usuario, $Pass, $BD);

if (mysqli_connect_error())
  {
  echo "Conexion Fallidad a MySQL: " . mysqli_connect_error();
  }

//$usuario='AdminCepudo';
//$contrasena = 'AdminCepudo#2017';

$pdo = new PDO('mysql:host=localhost;dbname=cepudo', $Usuario, $Pass);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
