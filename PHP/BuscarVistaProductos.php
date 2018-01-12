<?php
  include('../conexion/conexion.php');

  $paginaActual = $_POST['pag'];
  $dato = $_POST['dato'];
  $items = $_POST['items'];
  $Contenedor = $_POST['contenedor'];


    if($dato!="Todo"){  
            $nroProductos = mysqli_num_rows(mysqli_query(
            $conexion,"SELECT * FROM verproductos where Contenedor = '$Contenedor' and Descripcion LIKE '%$dato%' "));
    }else{

            $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM verproductos where Contenedor = '$Contenedor'"));
    }
    $nroLotes = $items;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';


    if($paginaActual > 1){
    $lista = $lista.'<li><a href="javascript:paginationVista('.(1).');"> Primero </a></li>';
        $lista = $lista.'<li><a href="javascript:paginationVista('.($paginaActual-1).');">Anterior</a></li>';
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
                $lista = $lista.'<li class="active"><a href="javascript:paginationVista('.($i+$a).');">'.($i+$a).'</a></li>';
            }else{
                $lista = $lista.'<li><a href="javascript:paginationVista('.($i+$a).');">'.($i+$a).'</a></li>';
            }
             }


    }
    if($paginaActual < $nroPaginas){
        
        $lista = $lista.'<li><a href="javascript:paginationVista('.($paginaActual+1).');">Siguiente >></a></li>';
        $lista = $lista.'<li><a href="javascript:paginationVista('.$nroPaginas.');"> Ultimo </a></li>';
    }
  
    if($paginaActual <= 1){
      $limit = 0;
    }else{
      $limit = $nroLotes*($paginaActual-1);
    }

 if($dato!="Todo"){
    
        $registro = mysqli_query(
                    $conexion,"SELECT * FROM verproductos where Contenedor = '$Contenedor' and Descripcion LIKE '%$dato%' LIMIT $limit, $nroLotes ");
    
}else{
   
      $registro = mysqli_query($conexion,"SELECT * FROM verproductos where Contenedor = '$Contenedor' LIMIT $limit, $nroLotes ");

}

    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="400">Descripcion</th>
                 <th width="100">Vencimiento</th>
                 <th width="100">Cantidad</th>
                 <th width="100">Presentacion</th>
                 <th width="100">CantXPres</th>
                 <th width="100">TotalUnidades</th>
                 <th width="100">CantidadBote</th>
                 <th width="100" Style="color:green" >Stock(Unidades)</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){

    $tabla = $tabla.'
              <td>'.$registro2['Descripcion'].'</td>
              <td>'.$registro2['Vencimiento'].'</td>
              <td>'.$registro2['Cantidad'].'</td>
              <td>'.$registro2['Presentacion'].'</td>
              <td>'.$registro2['CantidadXPresentacion'].'</td>
              <td>'.$registro2['Cantidad'] * $registro2['CantidadXPresentacion'].'</td>
              <td>'.$registro2['CantidadXBote'].'</td>
              <td align="center" Style="color:green">'.$registro2['Stock'].'</td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
                   1 => $lista);

    echo json_encode($array);   
?>        
    
