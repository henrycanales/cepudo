<?php
  include('../conexion/conexion.php');

  
 $id = $_POST['id'];


  mysqli_query($conexion,"UPDATE Instituciones SET Estado='Inactivo' where InstitucionId='$id'") or die('Error:'.mysqli_error($conexion));
  echo "1";

?>        
        
        
