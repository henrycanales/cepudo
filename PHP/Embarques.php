<?php
  include('../conexion/conexion.php');

  $paginaActual = $_POST['pag'];
  $dato = $_POST['dato'];
  $items = $_POST['items'];


    if($dato!="Todo"){   
    $nroProductos = mysqli_num_rows(mysqli_query(
            $conexion,"SELECT * FROM verEmbarque where Embarque LIKE '%$dato%' or Naviera LIKE '%$dato%' or Agente LIKE '%$dato%' or Aduana LIKE '%$dato%' or Observacion LIKE '%$dato%' "));
    }else{
    $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM verEmbarque"));
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
            $conexion,"SELECT * FROM verEmbarque where Embarque LIKE '%$dato%' or Naviera LIKE '%$dato%' or Agente LIKE '%$dato%' or Aduana LIKE '%$dato%' or Observacion LIKE '%$dato%'
            Order By EmbarqueId Desc LIMIT $limit, $nroLotes ");


}else
{
$registro = mysqli_query($conexion,"SELECT * FROM verEmbarque Order By EmbarqueId Desc LIMIT $limit, $nroLotes ");
}

    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="100">Embarque</th>
                 <th width="100">Naviera</th>
                 <th width="100">FechaEstimada</th>
                 <th width="100">Agencia</th>
                 <th width="100">Aduana</th>
                 <th width="100">Estado</th>
                 <th width="100">Flete</th>
                 <th width="100">Factura</th>
                 <th width="100">Seguro</th>
                 <th width="100">FechaLlegada</th>
                 <th width="100">Vencimiento</th>
                 <th width="100">Observacion</th>
                 <th width="100">NumeroBL</th>
                 <th width="100">PO</th>
                 <th width="150">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){

    $tabla = $tabla.'<tr>
              <td>'.$registro2['Embarque'].'</td>
              <td>'.$registro2['Naviera'].'</td>
              <td>'.$registro2['FechaEstimada'].'</td>
              <td>'.$registro2['Agente'].'</td>
              <td>'.$registro2['Aduana'].'</td>
              <td>'.$registro2['Estado'].'</td>
              <td>$ '.number_format($registro2['ValorFlete'], 2, '.', ',').'</td>
              <td>$ '.number_format($registro2['ValorFactura'], 2, '.', ',').'</td>
	      <td>$ '.number_format($registro2['ValorSeguro'], 2, '.', ',').'</td>
              <td>'.$registro2['FechaLlegada'].'</td>
              <td>'.$registro2['Vencimiento'].'</td>
              <td>'.$registro2['Observacion'].'</td>
              <td>'.$registro2['NumeroBL'].'</td>
              <td>'.$registro2['PO'].'</td>
              <td>
              <a <button id="'.$registro2['Embarque'].'" onclick="verDetalle(this.id);" class="glyphicon glyphicon-list-alt" alt="Ver Detalle" title="Ver Detalle"></button></a>
              <a <button onclick="editarRegistro('.$registro2['EmbarqueId'].');"class="glyphicon glyphicon-refresh" alt="Actualizar Registro" title="Actualizar Registro"></button></a>
              <a <button id="'.$registro2['Embarque'].'"  onclick="eliminarRegistro(this.id);"class="glyphicon glyphicon-trash" alt="Eliminar Registro" title="Eliminar Registro"></button></a>

              </td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
                   1 => $lista);

    echo json_encode($array);   
?>        
        
        
