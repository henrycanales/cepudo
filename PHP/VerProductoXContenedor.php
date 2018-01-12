<?php
  include('../conexion/conexion.php');

$Id = $_POST['id'];
$tabla = '';
$Contador=0;

$registro = mysqli_query($conexion,"SELECT * FROM InventarioContenedorDetalle where InventarioContenedorId='$Id'");


    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="400">Descripcion</th>
                 <th width="200">Lote</th>
                 <th width="150">Vencimiento</th>
                 <th width="100">Cantidad</th>
                 <th width="150">Presentacion</th>
                 <th width="100">CantidadXPresentacion</th>
                 <th width="100">CantidadXBote</th>
                 <th width="150">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){
    $Contador++;
    $tabla = $tabla.'<tr>
              <td><input type="text" name="DesD'.$Contador.'" id="DesD'.$Contador.'" value="'.$registro2['Descripcion'].'" class="form-control" readonly </td>
              <td><input type="text" name="LotD'.$Contador.'" id="LotD'.$Contador.'" value="'.$registro2['Lote'].'" class="form-control"</td>
              <td><input type="month" name="VenceD'.$Contador.'" id="VenceD'.$Contador.'" value="'.$registro2['Vencimiento'].'" class="form-control"</td>
              <td><input type="number" name="CantD'.$Contador.'" id="CantD'.$Contador.'" value="'.$registro2['Cantidad'].'" class="form-control"</td>
              <td><input type="text" name="PresD'.$Contador.'" id="PresD'.$Contador.'" value="'.$registro2['Presentacion'].'" class="form-control" readonly </td>
              <td><input type="text" name="cpD'.$Contador.'" id="cpD'.$Contador.'" value="'.$registro2['CantidadXPresentacion'].'" class="form-control" readonly </td>
              <td><input type="number" name="cbD'.$Contador.'" id="cbD'.$Contador.'" value="'.$registro2['CantidadXBote'].'" class="form-control"</td>
              <td>
              <a <button onclick="editarRegistroD('.$registro2['InventarioContenedorDetalleId'].','.$Contador.');"class="btn glyphicon glyphicon-refresh" alt="Actualizar Registro" title="Actualizar Registro"></button></a>
              <a <button onclick="eliminarRegistroD('.$registro2['InventarioContenedorDetalleId'].','.$registro2['InventarioContenedorId'].');"class="btn glyphicon glyphicon-trash" alt="Eliminar Registro" title="Eliminar Registro"></button></a>

              </td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla);

    echo json_encode($array);   
?>        
        
        
