<?php
include('../conexion/conexion.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$usuario = $_POST['nombreUsuario'];
$pass = $_POST['pass'];
$nombre = $_POST['nombre'];
$nivel = $_POST['nivel'];
$fecha = date("Y/m/d");
$items = $_POST['items'];


//VERIFICAMOS EL PROCESO

$verificar= mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario='$usuario'"));

if($verificar==1 && $proceso=='Registro'){
  echo "1";
}else{

 switch($proceso){
 case 'Registro': 
 mysqli_query($conexion,"INSERT INTO usuarios (Usuario,Pass,Nombre,Nivel,Fecha,Estado)
 VALUES ('$usuario','$pass','$nombre','$nivel','$fecha','Activo')");
 break;
	
case 'Edicion':
mysqli_query($conexion, "UPDATE usuarios SET Usuario = '$usuario', Nombre = '$nombre',
Pass='$pass', Nivel='$nivel' 	
WHERE UsuarioId = '$id'");
	break; 
} 

/* 
//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS


//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

*/
	$paginaActual = $_POST['pag'];
	$nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM usuarios"));
    $nroLotes = $items;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';


   if($paginaActual > 1){
		$lista = $lista.'<li><a href="javascript:pagination('.(1).');"> < </a></li>';
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
        
        $lista = $lista.'<li><a href="javascript:pagination('.($paginaActual+1).');">Siguiente</a></li>';
        $lista = $lista.'<li><a href="javascript:pagination('.$nroPaginas.');"> > </a></li>';
    }
  
  	if($paginaActual <= 1){
  		$limit = 0;
  	}else{
  		$limit = $nroLotes*($paginaActual-1);
  	}

$registro = mysqli_query($conexion,"SELECT * FROM usuarios LIMIT $limit, $nroLotes ");



  $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="200">Usuario</th>
                 <th width="300">Nombre</th>
                 <th width="200">Nivel</th>
                 <th width="200">Fecha</th>
                 <th width="100">Estado</th>
                 <th width="200">Seleccionar</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){

    $tabla = $tabla.'<tr>
              <td>'.$registro2['Usuario'].'</td>
              <td>'.$registro2['Nombre'].'</td>
              <td>'.$registro2['Nivel'].'</td>
              <td>'.$registro2['Fecha'].'</td>
              <td>'.$registro2['Estado'].'</td>
              <td>
              &nbsp;
              <a <button onclick="editarRegistro('.$registro2['UsuarioId'].');" class="btn glyphicon glyphicon-refresh" alt="Actualizar Registro" title="Actualizar Registro"></button></a>
              <a <button onclick="eliminarRegistro('.$registro2['UsuarioId'].');" class="btn glyphicon glyphicon-trash" alt="Eliminar Registro" title="Eliminar Registro"></button></a>

              </td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';

	 
	 echo $tabla;
  }

?>