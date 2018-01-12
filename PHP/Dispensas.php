<?php
  include('../conexion/conexion.php');

  $paginaActual = $_POST['pag'];
  $dato = $_POST['dato'];
  $items = $_POST['items'];


    if($dato!="Todo"){   
    $nroProductos = mysqli_num_rows(mysqli_query(
            $conexion,"SELECT * FROM Dispensas where Embarque LIKE '%$dato%' or NumeroDispensa LIKE '%$dato%'"));
    }else{
    $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM Dispensas"));
    }
    $nroLotes = $items;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';


    if($paginaActual > 1){
    $lista = $lista.'<li><a href="javascript:pagination('.(1).');"> Primero </a></li>';
        $lista = $lista.'<li><a href="javascript:pagination('.($paginaActual-1).');">Anterior</a></li>';
    }
    $pag = 10;
    for($i=1; $i<= $nroPaginas; $i++){
        if(($paginaActual+1)>$pag){
            if($nroPaginas == $paginaActual){
                 $a = ($paginaActual)-$pag;  
            }else{
                 $a = ($paginaActual+1)-$pag;           
            }
        }else{
            $a = 0;
        }
        if($i<=$pag){
            if(($i+$a) == $paginaActual){
                $lista = $lista.'<li class="active"><a href="javascript:pagination('.($i+$a).');">'.($i+$a).'</a></li>';
            }else{
                $lista = $lista.'<li><a href="javascript:pagination('.($i+$a).');">'.($i+$a).'</a></li>';
            }
             }


    }
    if($paginaActual < $nroPaginas){
        
        $lista = $lista.'<li><a href="javascript:pagination('.($paginaActual+1).');">Siguiente >></a></li>';
        $lista = $lista.'<li><a href="javascript:pagination('.$nroPaginas.');"> Ultimo </a></li>';
    }
  
    if($paginaActual <= 1){
      $limit = 0;
    }else{
      $limit = $nroLotes*($paginaActual-1);
    }

 if($dato!="Todo"){

$registro = mysqli_query(
            $conexion,"SELECT * FROM Dispensas where Embarque LIKE '%$dato%' or NumeroDispensa LIKE '%$dato%' Order By DispensaId Desc LIMIT $limit, $nroLotes ");


}else
{
$registro = mysqli_query($conexion,"SELECT * FROM Dispensas Order By DispensaId Desc LIMIT $limit, $nroLotes ");
}

    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="100">Embarque</th>
                 <th width="100">FechaDispensa</th>
                 <th width="200">NumeroDispensa</th>
                 <th width="100">FechaRecepcion</th>
                 <th width="100">Estado</th>
                 <th width="150">CreadoPor</th>
                 <th width="150">ModificadoPor</th>
                 <th width="150">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){

    $tabla = $tabla.'<tr>
              <td>'.$registro2['Embarque'].'</td>
              <td>'.$registro2['FechaDispensa'].'</td>
              <td>'.$registro2['NumeroDispensa'].'</td>
              <td>'.$registro2['FechaRecepcion'].'</td>
              <td>'.$registro2['Estado'].'</td>
              <td>'.$registro2['CreadoPor'].'</td>
              <td>'.$registro2['ModificadoPor'].'</td>
              <td>
              &nbsp;
              <a <button id="'.$registro2['Imagen'].'" onclick="VerImagen(this.id);" class="btn glyphicon glyphicon-eye-open" alt="Ver PDF" title="Ver PDF"></button></a>
              <a <button onclick="editarRegistro('.$registro2['DispensaId'].');" class="btn glyphicon glyphicon-refresh" alt="Actualizar Registro" title="Actualizar Registro"></button></a>
              <a <button onclick="eliminarRegistro('.$registro2['DispensaId'].');" class="btn glyphicon glyphicon-trash" alt="Eliminar Registro" title="Eliminar Registro"></button></a>

              </td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
                   1 => $lista);

    echo json_encode($array);   
?>        
        
        
