<?php
  include('../conexion/conexion.php');

$Id = $_POST['id'];
$tabla = '';
$Contador=0;

$registro = mysqli_query($conexion,"SELECT * FROM VerEntregaDetalle where EntregaId='$Id'");


    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="100">Entrega</th>
                 <th width="100">Contenedor</th>
                 <th width="200">Producto</th>
                 <th width="200">Presentacion</th>
                 <th width="100">Cantidad</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){
    $Contador++;
    $tabla = $tabla.'<tr>
                      <td>'.$registro2['EntregaId'].'</td>
                      <td>'.$registro2['Contenedor'].'</td>
                      <td>'.$registro2['Descripcion'].'</td>
                      <td>'.$registro2['Presentacion'].'</td>
                      <td>'.$registro2['Cantidad'].'</td>     
                    </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla);

    echo json_encode($array);   
?>        
        
        
