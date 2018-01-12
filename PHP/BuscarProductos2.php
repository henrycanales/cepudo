<?php
  include('../conexion/conexion.php');

  $paginaActual = $_POST['pag'];
  $dato = $_POST['dato'];
  $items = $_POST['items'];


    if($dato!="Todo"){  
            $nroProductos = mysqli_num_rows(mysqli_query(
            $conexion,"SELECT * FROM verproductos where Descripcion LIKE '%$dato%' or Contenedor LIKE '%$dato%' "));
    }else{

            $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM verproductos"));
    }
    $nroLotes = $items;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';


    if($paginaActual > 1){
    $lista = $lista.'<li><a href="javascript:pagination2('.(1).');"> Primero </a></li>';
        $lista = $lista.'<li><a href="javascript:pagination2('.($paginaActual-1).');">Anterior</a></li>';
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
                $lista = $lista.'<li class="active"><a href="javascript:pagination2('.($i+$a).');">'.($i+$a).'</a></li>';
            }else{
                $lista = $lista.'<li><a href="javascript:pagination2('.($i+$a).');">'.($i+$a).'</a></li>';
            }
             }


    }
    if($paginaActual < $nroPaginas){
        
        $lista = $lista.'<li><a href="javascript:pagination2('.($paginaActual+1).');">Siguiente >></a></li>';
        $lista = $lista.'<li><a href="javascript:pagination2('.$nroPaginas.');"> Ultimo </a></li>';
    }
  
    if($paginaActual <= 1){
      $limit = 0;
    }else{
      $limit = $nroLotes*($paginaActual-1);
    }

 if($dato!="Todo"){
    
        $registro = mysqli_query(
                    $conexion,"SELECT * FROM verproductos where Descripcion LIKE '%$dato%' or Contenedor LIKE '%$dato%'  LIMIT $limit, $nroLotes ");
    
}else{
   
      $registro = mysqli_query($conexion,"SELECT * FROM verproductos LIMIT $limit, $nroLotes ");

}

    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="100">Embarque</th>
		 <th width="100">Contenedor</th>
                 <th width="400">Descripcion</th>
                 <th width="100">Vencimiento</th>
                 <th width="100" Style="color:green" >Stock(Unidades)</th>
                 <th width="100">Presentacion</th>
                 <th width="100">CantXPres</th>
                 <th width="100">CantidadBote</th>
                 <th width="150">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){

    $tabla = $tabla.'<tr onclick="agregarProducto('.$registro2['InventarioContenedorDetalleId'].');">
              <td>'.$registro2['Embarque'].'</td>
	      <td>'.$registro2['Contenedor'].'</td>
              <td>'.$registro2['Descripcion'].'</td>
              <td>'.$registro2['Vencimiento'].'</td>
              <td align="center" Style="color:green">'.$registro2['Stock'].'</td>
              <td>'.$registro2['Presentacion'].'</td>
              <td>'.$registro2['CantidadXPresentacion'].'</td>
              <td>'.$registro2['CantidadXBote'].'</td>
              <td>
              <a <button onclick="agregarProducto('.$registro2['InventarioContenedorDetalleId'].');"class="btn glyphicon glyphicon-plus" alt="Agregar" title="Agregar"></button></a>
              </td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
                   1 => $lista);

    echo json_encode($array);   
?>        
        
        
