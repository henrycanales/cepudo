<?php
//error_reporting(0);

$dato1=$_GET['dato1'];
$dato2 = $_GET['dato2'];

$Titulo = "Reporte de instituciones".".xls";

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
<title>REPORTE DE INSTITUCIONES</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="10" ><CENTER><strong><h1>REPORTE DE INSTITUCIONES</h1></strong></CENTER></td>
  </tr>
  <tr >
   
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CODIGO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="300" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">NOMBRE</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="200" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">TIPO INSTITUCION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="300" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">DIRECCION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">TELEFONO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">RTN</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CONTACTO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CORREO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CATEGORIA</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="150" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">FECHA REGISTRO</FONT></center></strong></td>
  </tr>
  
<?PHP

if($dato2 == 1){
  $registro = mysqli_query($conexion,"SELECT * FROM VerInstituciones where TipoInstitucion = '$dato1' and Estado='A' Order By InstitucionId Desc "); 
}
if($dato2 == 2){
  $registro = mysqli_query($conexion,"SELECT * FROM VerInstituciones where Categoria = '$dato1' and Estado='A' Order By InstitucionId Desc"); 
}

while($registro2 = mysqli_fetch_array($registro)){

?>  
 <tr>

 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Codigo'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Nombre'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['TipoInstitucion'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Direccion'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Telefono'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['RTN'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Contacto'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Correo'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Categoria'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Fecha'];?></FONT></td>
                
 </tr> 

  <?php
}
  ?>
</table>
</body>
</html>