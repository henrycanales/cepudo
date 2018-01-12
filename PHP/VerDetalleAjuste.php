<?php
  include('../conexion/conexion.php');

$Id = $_POST['id'];
$tabla = '';
$Contador=0;

$registro = mysqli_query($conexion,"SELECT * FROM verdetalleajuste where AjusteId='$Id'");


    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="100">Codigo</th>
                 <th width="500">Descripcion</th>
                 <th width="100">Cantidad</th>
                 <th width="150">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){
    $Contador++;
    $tabla = $tabla.'<tr>
              <td><input type="text" name="AjusteIdD'.$Contador.'" id="AjusteIdD'.$Contador.'" value="'.$registro2['AjusteId'].'" class="form-control" readonly </td>
              <td><input type="text" name="ProD'.$Contador.'" id="ProD'.$Contador.'" value="'.$registro2['Descripcion'].'" class="form-control" readonly </td>
              <td><input type="number" name="CantD'.$Contador.'" id="CantD'.$Contador.'" value="'.$registro2['Cantidad'].'" class="form-control" </td>
              <td>
              <a <button onclick="editarRegistroD('.$registro2['AjusteDetalleId'].','.$Contador.');"class="btn glyphicon glyphicon-refresh" alt="Actualizar Registro" title="Actualizar Registro"></button></a>
              <a <button onclick="eliminarRegistroD('.$registro2['AjusteDetalleId'].','.$registro2['AjusteId'].');"class="btn glyphicon glyphicon-trash" alt="Eliminar Registro" title="Eliminar Registro"></button></a>

              </td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla);

    echo json_encode($array);   
?>        
        
        
