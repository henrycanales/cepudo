<?php
  include('../conexion/conexion.php');

  
 $id = $_POST['id'];


  mysqli_query($conexion,"UPDATE Categorias SET Estado='Inactivo' where CategoriaId='$id'") or die('Error:'.mysqli_error($conexion));
  echo "1";

?>        
        
        
