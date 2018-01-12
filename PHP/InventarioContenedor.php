<?php
  include('../conexion/conexion.php');

  $paginaActual = $_POST['pag'];
  $dato = $_POST['dato'];
  $dato2 = $_POST['dato2'];
  $items = $_POST['items'];


    if($dato!="Todo"){  
       if($dato2=="Contenedor"){ 
            $nroProductos = mysqli_num_rows(mysqli_query(
            $conexion,"SELECT * FROM InventarioContenedor where Contenedor LIKE '%$dato%' "));
        }

        if($dato2=="Productos"){ 
            $nroProductos = mysqli_num_rows(mysqli_query(
            $conexion,"SELECT * FROM VerProductosXContenedor where Descripcion LIKE '%$dato%' "));
        }


    }else{
          if($dato2=="Contenedor"){ 
            $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM InventarioContenedor"));
          }
          if($dato2=="Productos"){ 
            $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM VerProductosXContenedor"));
          }
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
      if($dato2=="Contenedor"){
        $registro = mysqli_query(
                    $conexion,"SELECT * FROM InventarioContenedor where Contenedor LIKE '%$dato%' 
                    Order By InventarioContenedorId Desc LIMIT $limit, $nroLotes ");
      }
      if($dato2=="Productos"){
        $registro = mysqli_query(
                    $conexion,"SELECT * FROM VerProductosXContenedor where Descripcion LIKE '%$dato%' 
                    Order By InventarioContenedorId Desc LIMIT $limit, $nroLotes ");
      }
      
}else{
      if($dato2=="Contenedor"){
      $registro = mysqli_query($conexion,"SELECT * FROM InventarioContenedor Order By InventarioContenedorId Desc LIMIT $limit, $nroLotes ");
      }
      if($dato2=="Productos"){
      $registro = mysqli_query($conexion,"SELECT * FROM VerProductosXContenedor Order By InventarioContenedorId Desc LIMIT $limit, $nroLotes ");
      }
}

    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="100">Contenedor</th>
                 <th width="100">Fecha</th>
                 <th width="100">Tamano</th>
                 <th width="100">EstadoContendor</th>
                 <th width="100">CreadoPor</th>
                 <th width="100">ModificadoPor</th>
                 <th width="100">EstadoIngreso</th>
                 <th style = "text-align: center" width="200">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){

    $tabla = $tabla.'<tr>
              <td>'.$registro2['Contenedor'].'</td>
              <td>'.$registro2['Fecha'].'</td>
              <td>'.$registro2['Tamano'].'</td>
              <td>'.$registro2['Estado'].'</td>
              <td>'.$registro2['CreadoPor'].'</td>
              <td>'.$registro2['ModificadoPor'].'</td>
              <td>'.$registro2['EstadoIngreso'].'</td>
              <td>
              <a <button onclick="verDetalle('.$registro2['InventarioContenedorId'].');"class="btn glyphicon glyphicon-list-alt" alt="Ver Detalle" title="Ver Detalle"></button></a>
              <a <button onclick="editarRegistro('.$registro2['InventarioContenedorId'].');"class="btn glyphicon glyphicon-refresh" alt="Actualizar Registro" title="Actualizar Registro"></button></a>
              <a <button onclick="Aplicar('.$registro2['InventarioContenedorId'].');"class="btn glyphicon glyphicon-ok" alt="Aplicar" title="Aplicar"></button></a>
              <a <button id="'.$registro2['Contenedor'].'" onclick="VerInv(this.id);"class="btn glyphicon glyphicon glyphicon-eye-open" alt="Ver Inventario" title="Ver Inventario">
              </button></a>
              <a <button id="'.$registro2['Contenedor'].'" onclick="Excel('.$registro2['InventarioContenedorId'].',this.id);"class="btn glyphicon glyphicon-print" alt="Exportar Excel" title="Exportar Excel"></button></a>
              <a <button onclick="eliminarRegistro('.$registro2['InventarioContenedorId'].');"class="btn glyphicon glyphicon-trash" alt="Eliminar Registro" title="Eliminar Registro"></button></a>

              </td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
                   1 => $lista);

    echo json_encode($array);   
?>        
        
        
