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
                 <th width="150">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){
    $Contador++;
    $tabla = $tabla.'<tr>
              <td><input type="text" name="EntregaD'.$Contador.'" id="EntregaD'.$Contador.'" value="'.$registro2['EntregaId'].'" class="form-control" readonly </td>
              <td><input type="text" name="ContD'.$Contador.'" id="ContD'.$Contador.'" value="'.$registro2['Contenedor'].'" class="form-control" readonly </td>
              <td><input type="text" name="ProD'.$Contador.'" id="ProD'.$Contador.'" value="'.$registro2['Descripcion'].'" class="form-control" readonly </td>
              <td><input type="text" name="PreD'.$Contador.'" id="PreD'.$Contador.'" value="'.$registro2['Presentacion'].'" class="form-control" readonly </td>
              <td><input type="number" name="CantD'.$Contador.'" id="CantD'.$Contador.'" value="'.$registro2['Cantidad'].'" class="form-control" </td>
              <td>
              <a <button onclick="editarRegistroD('.$registro2['EntregaDetalleId'].','.$Contador.');"class="btn glyphicon glyphicon-refresh" alt="Actualizar Registro" title="Actualizar Registro"></button></a>
              <a <button onclick="eliminarRegistroD('.$registro2['EntregaDetalleId'].','.$registro2['EntregaId'].');"class="btn glyphicon glyphicon-trash" alt="Eliminar Registro" title="Eliminar Registro"></button></a>

              </td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla);

    echo json_encode($array);   
?>        
        
        
