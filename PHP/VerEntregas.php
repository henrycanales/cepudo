<?php
  include('../conexion/conexion.php');

  $paginaActual = $_POST['pag'];
  $dato = $_POST['dato'];
  $dato2 = $_POST['dato2'];
  $items = $_POST['items'];


    if($dato == "Todo" && $dato2 == "Todo"){  

            $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM VerEntrega"));

    }
    if($dato != "Todo" && $dato2 == "Todo"){

            $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM VerEntrega where Nombre LIKE '%$dato%'"));

    }
    if($dato == "Todo" && $dato2 != "Todo"){

            $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM VerEntrega where Estado = '$dato2' "));

    }
    if($dato != "Todo" && $dato2 != "Todo"){

    $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM VerEntrega where Nombre LIKE '%$dato%' and Estado = '$dato2' "));

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


    if($dato == "Todo" && $dato2 == "Todo"){  
       $registro = mysqli_query(
                    $conexion,"SELECT * FROM VerEntrega Order By EntregaId Desc LIMIT $limit, $nroLotes ");
     }

     if($dato != "Todo" && $dato2 == "Todo"){
        $registro = mysqli_query(
                    $conexion,"SELECT * FROM VerEntrega where Nombre LIKE '%$dato%'
                    Order By EntregaId Desc LIMIT $limit, $nroLotes ");
      }

     if($dato == "Todo" && $dato2 != "Todo"){
        $registro = mysqli_query($conexion,"SELECT * FROM VerEntrega where Estado = '$dato2' Order By EntregaId Desc LIMIT $limit, $nroLotes ");
      }

     if($dato != "Todo" && $dato2 != "Todo"){
        $registro = mysqli_query($conexion,"SELECT * FROM VerEntrega where Nombre LIKE '%$dato%' and Estado = '$dato2' 
                  Order By EntregaId Desc LIMIT $limit, $nroLotes ");
      }


    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="50">Codigo</th>
                 <th width="100">Institucion</th>
                 <th width="50">RTN</th>
                 <th width="200">Direccion</th>
                 <th width="100">Fecha</th>
                 <th width="100">Remision</th>
                 <th width="100">FechaEntrega</th>
                 <th width="200">Estado</th>
                 <th width="150">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){

    $tabla = $tabla.'<tr>
              <td>'.$registro2['Codigo'].'</td>
              <td>'.$registro2['Nombre'].'</td>
              <td>'.$registro2['RTN'].'</td>
              <td>'.$registro2['Direccion'].'</td>
              <td>'.$registro2['Fecha'].'</td>
              <td>'.$registro2['GuiaRemision'].'</td>
              <td>'.$registro2['FechaEntrega'].'</td>
              <td>'.$registro2['Estado'].'</td>
              <td>
              <a <button onclick="verDetalle('.$registro2['EntregaId'].');"class="btn glyphicon glyphicon-refresh" alt="Ver Detalle" title="Ver Detalle"></button></a>
              <a <button onclick="eliminarRegistro('.$registro2['EntregaId'].');"class="btn glyphicon glyphicon-trash" alt="Eliminar Registro" title="Eliminar Registro"></button></a>

              </td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
                   1 => $lista);

    echo json_encode($array);   
?>        
        
        
