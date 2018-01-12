<?php
//error_reporting(0);

$dato=$_GET['dato'];
$contenedor = $_GET['contenedor'];

$Titulo = "Contenedor".$contenedor.".xls";

include('../conexion/conexion.php');


header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=$Titulo"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>REPORTE CONTENEDOR</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="11" ><CENTER><strong><h1>REPORTE DE CONTENEDOR  <?php  echo $contenedor; ?></h1></strong></CENTER></td>
  </tr>
  <tr >
   
    <td bgcolor="#E6E6E6" width="300" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">DESCRIPCION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">LOTE</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">VENCIMIENTO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CANTIDAD</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">PRESENTACION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CANTIDAD PRESENTACION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CANTIDAD BOTE</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">TOTAL UNIDADES</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">STOCK UNIDADES</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">FISICO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">DIFERENCIA</FONT></center></strong></td>
  </tr>
  
<?PHP

$registro = mysqli_query($conexion,"SELECT * FROM InventarioContenedorDetalle where InventarioContenedorId = '$dato' "); 


while($registro2 = mysqli_fetch_array($registro)){

?>  
 <tr>

 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Descripcion'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Lote'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Vencimiento'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Cantidad'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Presentacion'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['CantidadXPresentacion'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['CantidadXBote'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['TotalUnidades'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Stock'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> </FONT></td>
<td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> </FONT></td>
                
 </tr> 

  <?php
}
  ?>
</table>
</body>
</html>