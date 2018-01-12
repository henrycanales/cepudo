<?php
  include('../conexion/conexion.php');

  $paginaActual = $_POST['pag'];
  $dato = $_POST['dato'];
  $items = $_POST['items'];


    if($dato!="Todo"){   
    $nroProductos = mysqli_num_rows(mysqli_query(
            $conexion,"SELECT * FROM Regimen where CAI LIKE '%$dato%'"));
    }else{
    $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM Regimen"));
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
            $conexion,"SELECT * FROM Regimen where CAI LIKE '%$dato%' Order By Estado Asc LIMIT $limit, $nroLotes ");


}else
{
$registro = mysqli_query($conexion,"SELECT * FROM Regimen Order By Estado Asc LIMIT $limit, $nroLotes ");
}

    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="300">CAI</th>
                 <th width="100">CorrelativoDesde</th>
                 <th width="100">CorrelativoHasta</th>
                 <th width="100">FechaAutorizacion</th>
                 <th width="100">Comprobante</th>
                 <th width="100">NoComprobante</th>
                 <th width="100">Estado</th>
                 <th width="200">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){    

    if($registro2['Estado'] == 'Activo'){
      $Bandera = 'form-control success';
    }
    if($registro2['Estado'] == 'Inactivo'){
      $Bandera = 'form-control warning';
    }
    if($registro2['Estado'] == 'Eliminado'){
      $Bandera = 'form-control danger';
    }


    $tabla = $tabla.'<tr>
              <td>'.$registro2['CAI'].'</td>
              <td>'.$registro2['CorrelativoDesde'].'</td>
              <td>'.$registro2['CorrelativoHasta'].'</td>
              <td>'.$registro2['FechaAutorizacion'].'</td>
              <td>'.$registro2['Comprobante'].'</td>
              <td>'.$registro2['NoComprobante'].'</td>
              <td class="'.$Bandera.'" >'.$registro2['Estado'].'</td>
              <td>
              &nbsp;
              <a <button onclick="editarRegistro('.$registro2['RegimenId'].');" class="btn glyphicon glyphicon-refresh" alt="Actualizar Regimen" title="Actualizar Registro"></button></a>
              <a <button onclick="habilitarRegistro('.$registro2['RegimenId'].',1);" class="btn glyphicon glyphicon-ok" alt="Habilitar Regimen" title="Habilitar Regimen"></button></a>
              <a <button onclick="eliminarRegistro('.$registro2['RegimenId'].');" class="btn glyphicon glyphicon-trash" alt="Eliminar Regimen" title="Eliminar Regimen"></button></a>
              
              </td>
              
             </tr>';   
  }
    
  //<a <button onclick="habilitarRegistro('.$registro2['RegimenId'].',2);" class="btn glyphicon glyphicon-remove" alt="Deshabilitar Regimen" title="Deshabilitar Regimen"></button></a>    

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
                   1 => $lista);

    echo json_encode($array);   
?>        
        
        
