<?php
  include('../conexion/conexion.php');

  
 $id = $_POST['id'];


  mysqli_query($conexion,"UPDATE TiposInstituciones SET Estado='Inactivo' where TipoInstitucionId='$id'") or die('Error:'.mysqli_error($conexion));
  echo "1";

?>        
        
        
