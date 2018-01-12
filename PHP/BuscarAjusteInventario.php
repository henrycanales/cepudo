<?php
  include('../conexion/conexion.php');

  $paginaActual = $_POST['pag'];
  $dato = $_POST['dato'];
  $dato2 = $_POST['dato2'];
  $items = $_POST['items'];


    if($dato == "Todo" && $dato2 == "Todo"){  

            $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM AjusteInventario"));

    }
    if($dato != "Todo" && $dato2 == "Todo"){

            $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM AjusteInventario where TipoAjuste = '$dato' "));

    }
    if($dato == "Todo" && $dato2 != "Todo"){

            $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM AjusteInventario where Estado = '$dato2' "));

    }
    if($dato != "Todo" && $dato2 != "Todo"){

    $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM AjusteInventario where TipoAjuste = '$dato' and Estado = '$dato2' "));

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


    if($dato == "Todo" && $dato2 == "Todo"){  
       $registro = mysqli_query(
                    $conexion,"SELECT * FROM AjusteInventario Order By AjusteId Desc LIMIT $limit, $nroLotes ");
     }

     if($dato != "Todo" && $dato2 == "Todo"){
        $registro = mysqli_query(
                    $conexion,"SELECT * FROM AjusteInventario where TipoAjuste = '$dato' Order By AjusteId Desc LIMIT $limit, $nroLotes ");
      }

     if($dato == "Todo" && $dato2 != "Todo"){
        $registro = mysqli_query($conexion,"SELECT * FROM AjusteInventario where Estado = '$dato2' Order By AjusteId Desc LIMIT $limit, $nroLotes ");
      }

     if($dato != "Todo" && $dato2 != "Todo"){
        $registro = mysqli_query($conexion,"SELECT * FROM AjusteInventario where TipoAjuste = '$dato' and Estado = '$dato2' 
                  Order By AjusteId Desc LIMIT $limit, $nroLotes ");
      }


    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="50">Codigo</th>
                 <th width="100">Tipo Ajuste</th>
                 <th width="30">Comentario</th>
                 <th width="100">Fecha</th>
                 <th width="100">Usuario</th>
                 <th width="100">Estado</th>
		 <th width="100">Autorizado</th>
                 <th width="200">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){

    $tabla = $tabla.'<tr>
              <td>'.$registro2['AjusteId'].'</td>
              <td>'.$registro2['TipoAjuste'].'</td>
              <td>'.$registro2['Comentarios'].'</td>
              <td>'.$registro2['Fecha'].'</td>
              <td>'.$registro2['Usuario'].'</td>
              <td>'.$registro2['Estado'].'</td>
              <td>'.$registro2['Autorizacion'].'</td>
	      <td>
              <a <button onclick="verDetalle('.$registro2['AjusteId'].');"class="btn glyphicon glyphicon-th-list" alt="Ver Detalle" title="Ver Detalle"></button></a>
              <a <button onclick="aplicarEntregas('.$registro2['AjusteId'].');"class="btn glyphicon glyphicon-ok" alt="Aplicar Entrega" title="Aplicar Entrega"></button></a>
              <a <button onclick="Actualizar('.$registro2['AjusteId'].');"class="btn glyphicon glyphicon-refresh" alt="Ver Detalle" title="Ver Detalle"></button></a>
              <a <button onclick="eliminarRegistro('.$registro2['AjusteId'].');"class="btn glyphicon glyphicon-trash" alt="Eliminar Registro" title="Eliminar Registro"></button></a>
              <a <button onclick="Imprimir('.$registro2['AjusteId'].');"class="btn glyphicon glyphicon-print" alt="Imprimir" title="Imprimir"></button></a>

              </td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
                   1 => $lista);

    echo json_encode($array);   
?>        
        
        
