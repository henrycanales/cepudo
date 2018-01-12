<?php
session_start();
// error_reporting(0);
include('../conexion/conexion.php');
if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "../recursos/";
    $Nom = $_POST['NEmbarque'].".PDF";
    $Embarque = $_POST['NEmbarque'];

    if ( !(strpos($tipo, "pdf") ))
    {
      echo "Error, el archivo no es PDF"; 
    }
    else if ($size > 5120*5120)
    {
      echo "Error, el tamaño máximo permitido es un 2MB";
    }
    else
    {
        $src = $carpeta.$Nom;
        move_uploaded_file($ruta_provisional, $src);
        echo "PDF SE ACTUALIZO";
        mysqli_query($conexion,"UPDATE Dispensas set Imagen='$src' where Embarque = '$Embarque' ");
        $_SESSION['foto']=$src;
    }
    if($tipo==''){
       "No ha seleccionado  el archivo PDF";  
    }
}
else{
    "No ha seleccionado el archivo PDF";
}
