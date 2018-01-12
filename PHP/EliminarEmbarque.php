<?php
include('../conexion/conexion.php');

$Embarque = $_POST['Embarque'];


mysqli_query($conexion, "DELETE FROM Embarque where Embarque='$Embarque'") or die('Error:'.mysqli_error($conexion));

mysqli_query($conexion, "DELETE FROM EmbarqueDetalle where Embarque='$Embarque'") or die('Error:'.mysqli_error($conexion));

echo "1";
?>