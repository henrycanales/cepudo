<?php
  include('../conexion/conexion.php');

  
 $id = $_POST['id'];


  mysqli_query($conexion,"UPDATE Productos SET Estado='Inactivo' where ProductoId='$id'") or die('Error:'.mysqli_error($conexion));
  echo "1";

?>        
        
        
