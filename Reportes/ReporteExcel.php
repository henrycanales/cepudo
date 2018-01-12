<?php
error_reporting(0);

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=DelcaracionUnica.xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

$dato=$_GET['dato'];
$Fecha=$_GET['Fecha'];

if($Fecha == ''){
  $Fecha = 'Todo';
}else{
$fec = explode("-", $Fecha); 
$Mes = $fec[1]; 
$Ano = $fec[0];  
}

if($dato==''){
  $dato='Todo';
}

include('../conexion/conexion.php');

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>REPORTE DE EVENTOS</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="16" ><CENTER><strong><h1>DISPENSAS RECIBIDAS</h1></strong></CENTER></td>
  </tr>
  <tr >
   
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">EMBARQUE UWS</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">NUMERO DE DISPENSA</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">FECHA DISPENSA</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">NUMERO DE POLIZA</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">FECHA POLIZA</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">OBSERVACION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="200" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">TIPO DONACION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">TASA CAMBIARIA</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">VALOR FOB</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">FLETE</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">SEGURO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">OTROS GASTOS</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">TOTAL CIF</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">TOTAL LPS</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="200" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">AJUSTES</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="200" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CIF IMPONIBLE</FONT></center></strong></td>


  </tr>
  
<?PHP
if($dato!="Todo" && $Fecha != 'Todo'){
$registro = mysqli_query($conexion,"SELECT * FROM verDeclaraciones where Embarque LIKE '%$dato%' and YEAR(FechaRegistro) = '$Ano'
AND MONTH(FechaRegistro) = '$Mes' or NumeroDispensa LIKE '%$dato%' and YEAR(FechaRegistro) = '$Ano'
AND MONTH(FechaRegistro) = '$Mes' or Poliza LIKE '%$dato%' and YEAR(FechaRegistro) = '$Ano'
AND MONTH(FechaRegistro) = '$Mes' Order By DeclaracionId Desc"); 
}
if($dato == 'Todo' && $Fecha !='Todo'){
$registro = mysqli_query($conexion,"SELECT * FROM VerDeclaraciones where YEAR(FechaRegistro) = '$Ano'
AND MONTH(FechaRegistro) = '$Mes' Order By DeclaracionId Desc"); 
}

if($dato == 'Todo' && $Fecha =='Todo'){
$registro = mysqli_query($conexion,"SELECT * FROM VerDeclaraciones Order By DeclaracionId Desc"); 
}

if($dato != 'Todo' && $Fecha =='Todo'){
$registro = mysqli_query($conexion,"SELECT * FROM verDeclaraciones where Embarque LIKE '%$dato%' or NumeroDispensa LIKE '%$dato%' 
or Poliza LIKE '%$dato%'  Order By DeclaracionId Desc"); 
}


while($registro2 = mysqli_fetch_array($registro)){

?>  
 <tr>
 <td align="center" bgcolor="#16A085"><FONT FACE="Arial" SIZE=3 COLOR="Black"> <?php echo $registro2['Embarque'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['NumeroDispensa'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['FechaDispensa'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2["Poliza"];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['FechaPoliza'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Observacion'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['TipoDonacion'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey">L <?php echo $registro2['TasaCambio'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey">$ <?php echo $registro2['ValorFactura'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey">$ <?php echo $registro2["ValorFlete"];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey">$ <?php echo $registro2['ValorSeguro'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey">$ <?php echo $registro2['OtrosGastos'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey">$ <?php echo $registro2['Total'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey">Lps <?php echo $registro2['Total'] * $registro2['TasaCambio'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Ajustes'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['CIF'];?></FONT></td>



                
 </tr> 
  <?php
}
  ?>
</table>
</body>
</html>