<?php
  include('../conexion/conexion.php');

  
  
  $paginaActual = $_POST['pag'];
  $id = $_POST['id'];
  $items = $_POST['items'];

    mysqli_query($conexion,"UPDATE Donantes SET Estado='Inactivo' where DonanteId='$id'");


    $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM Donantes where Estado='Activo' "));
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


$registro = mysqli_query($conexion,"SELECT * FROM Donantes where Estado='Activo' Order By DonanteId Desc LIMIT $limit, $nroLotes ");


    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="300">Nombre</th>
                 <th width="300">Direccion</th>
                 <th width="100">Telefono</th>
                 <th width="100">Fax</th>
                 <th width="100">Contacto</th>
                 <th width="100">Correo</th>
                 <th width="100">Creado</th>
                 <th width="100">Modificado</th>
                 <th width="100">Estado</th>
                 <th width="200">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){

    $tabla = $tabla.'<tr>
              <td>'.$registro2['Nombre'].'</td>
              <td>'.$registro2['Direccion'].'</td>
              <td>'.$registro2['Telefono'].'</td>
              <td>'.$registro2['Fax'].'</td>
              <td>'.$registro2['Contacto'].'</td>
              <td>'.$registro2['Correo'].'</td>
              <td>'.$registro2['CreadoPor'].'</td>
              <td>'.$registro2['ModificadoPor'].'</td>
              <td>'.$registro2['Estado'].'</td>
              <td>
              &nbsp;
              <a <button onclick="editarRegistro('.$registro2['DonanteId'].');" class="btn glyphicon glyphicon-refresh" alt="Actualizar Registro" title="Actualizar Registro"></button></a>
              <a <button onclick="eliminarRegistro('.$registro2['DonanteId'].');" class="btn glyphicon glyphicon-trash" alt="Eliminar Registro" title="Eliminar Registro"></button></a>

              </td>
              
             </tr>';   
  }
        
        
   
   echo $tabla;
?>        
        
        
