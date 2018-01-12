<?php
  include('../conexion/conexion.php');

$Id = $_POST['id'];
$tabla = '';
$Contador=0;

$registro = mysqli_query($conexion,"SELECT * FROM EmbarqueDetalle where Embarque='$Id' Order By Contenedor Desc");


    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="250">Embarque</th>
                 <th width="200">Contenedor</th>
                 <th width="200">ObservacionContenedor</th>
                 <th width="200">ComentarioContenedor</th>
                 <th width="150">FechaBodega</th>
                 <th width="150">FechaRetorno</th>
                 <th width="250">Estado</th>
                 <th width="150">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){
    $Contador++;
    $tabla = $tabla.'<tr>
              <td><input type="text" name="EmbarqueD'.$Contador.'" id="EmbarqueD'.$Contador.'" value="'.$registro2['Embarque'].'" class="form-control" readonly </td>
              <td><input type="text" name="ContenedorD'.$Contador.'" id="ContenedorD'.$Contador.'" value="'.$registro2['Contenedor'].'" class="form-control"</td>
              <td><input type="text" name="ObservacionContenedorD'.$Contador.'" id="ObservacionContenedorD'.$Contador.'" value="'.$registro2['ObservacionContenedor'].'" class="form-control"</td>
              <td><input type="text" name="ComentarioContenedorD'.$Contador.'" id="ComentarioContenedorD'.$Contador.'" value="'.$registro2['ComentarioContenedor'].'" class="form-control"</td>
              <td><input type="date" name="FechaBodegaD'.$Contador.'" id="FechaBodegaD'.$Contador.'" value="'.$registro2['FechaBodega'].'" class="form-control"</td>
              <td><input type="date" name="FechaRetornoD'.$Contador.'" id="FechaRetornoD'.$Contador.'" value="'.$registro2['FechaRetorno'].'" class="form-control"</td>
              <td><input type="text" name="EstadoD'.$Contador.'" id="EstadoD'.$Contador.'" value="'.$registro2['Estado'].'" class="form-control" readonly </td>
              <td>
              <a <button onclick="editarRegistroD('.$registro2['EmbarqueDetalleId'].','.$Contador.');"class="btn glyphicon glyphicon-refresh" alt="Actualizar Registro" title="Actualizar Registro"></button></a>
              <a <button onclick="eliminarRegistroD('.$registro2['EmbarqueDetalleId'].','.$registro2['Embarque'].');"class="btn glyphicon glyphicon-trash" alt="Eliminar Registro" title="Eliminar Registro"></button></a>

              </td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla);

    echo json_encode($array);   
?>        
        
        
