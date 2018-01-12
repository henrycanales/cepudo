<?php
  include('../conexion/conexion.php');

  $paginaActual = $_POST['pag'];
  $dato = $_POST['dato'];
  $items = $_POST['items'];


    if($dato!="Todo"){   
    $nroProductos = mysqli_num_rows(mysqli_query(
            $conexion,"SELECT * FROM contabilidad where Embarque LIKE '%$dato%' or NumeroDispensa LIKE '%$dato%' or Poliza LIKE '%$dato%'"));
    }else{
    $nroProductos = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM verDeclaraciones"));
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
            $conexion,"SELECT * FROM contabilidad where Embarque LIKE '%$dato%' or NumeroDispensa LIKE '%$dato%' or Poliza LIKE '%$dato%'
            Order By DeclaracionId Desc LIMIT $limit, $nroLotes ");


}else
{
$registro = mysqli_query($conexion,"SELECT * FROM contabilidad Order By DeclaracionId Desc LIMIT $limit, $nroLotes ");
}

    $tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
                 <tr>
                 <th width="100">Embarque</th>
                 <th width="100">Dispensa</th>
                 <th width="100">FechaDispensa</th>
                 <th width="100">Poliza</th>
                 <th width="100">FechaPoliza</th>
                 <th width="50">Cambio</th>
                 <th width="120">Factura</th>
                 <th width="120">Flete</th>
                 <th width="120">Seguro</th>
                 <th width="120">OtrosGastos</th>
                 <th width="120">Total</th>
                 <th width="120">LpsTotal</th>
                 <th width="100">%Distribuido</th>
                 <th width="150">Distribuido</th>
                 </tr>';
        
  while($registro2 = mysqli_fetch_array($registro)){

    $tabla = $tabla.'<tr>
              <td>'.$registro2['Embarque'].'</td>
              <td>'.$registro2['NumeroDispensa'].'</td>
              <td>'.$registro2['FechaDispensa'].'</td>
              <td>'.$registro2['Poliza'].'</td>
              <td>'.$registro2['FechaPoliza'].'</td>
              <td>L '.$registro2['TasaCambio'].'</td>
              <td>$ '.$registro2['ValorFactura'].'</td>
              <td>$ '.$registro2['ValorFlete'].'</td>
              <td>$ '.$registro2['ValorSeguro'].'</td>
              <td>$ '.$registro2['OtrosGastos'].'</td>
              <td>L '.$registro2['Total'].'</td>
              <td>L '.round($registro2['LpsTotal'],2).'</td>
              <td>% '.round($registro2['PorcentajeDistribuido'],2).'</td>
              <td>L '.round($registro2['LpsValorDistribuido'],2).'</td>
              
             </tr>';   
  }
        

     $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
                   1 => $lista);

    echo json_encode($array);   
?>        
        
        
