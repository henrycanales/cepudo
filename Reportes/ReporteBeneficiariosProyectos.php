<?php
//error_reporting(0);

$Titulo = "Reporte de beneficiarios de proyectos".".xls";

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
<title>REPORTE DE BENEFICIARIOS DE PROYECTOS</title>
</head>
<body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="5" ><CENTER><strong><h1>REPORTE DE BENEFICIARIOS PROYECTOS</h1></strong></CENTER></td>
  </tr>
  <tr >
   
    <td bgcolor="#E6E6E6" width="300" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">NOMBRE</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="300" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">DIRECCION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">TELEFONO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CONTACTO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CORREO</FONT></center></strong></td>

  </tr>
  
<?PHP

$registro = mysqli_query($conexion,"SELECT * FROM BeneficiariosProyectos where Estado='A' Order By BeneficiarioId Desc"); 

while($registro2 = mysqli_fetch_array($registro)){

?>  
 <tr>

 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Nombre'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Direccion'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Telefono'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Contacto'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $registro2['Correo'];?></FONT></td>
                
 </tr> 

  <?php
}
  ?>
</table>
</body>
</html>
