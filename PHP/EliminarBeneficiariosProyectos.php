<?php
  include('../conexion/conexion.php');

  
 $id = $_POST['id'];


  mysqli_query($conexion,"UPDATE BeneficiariosProyectos SET Estado='Inactivo' where BeneficiarioId='$id'") or die('Error:'.mysqli_error($conexion));
  echo "1";

?>        
        
        
