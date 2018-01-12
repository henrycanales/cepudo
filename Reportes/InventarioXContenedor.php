<?php

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=ReporteContenedor.xls"); 
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);


$dato=$_GET['dato'];

include('../conexion/conexion.php');
/*
$usuario='cepudo';
$contrasena = 'cepudo#2017';

//$dato=1487878;

$pdo = new PDO('mysql:host=localhost;dbname=Cepudo', $usuario, $contrasena);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

*/

$stmt = $pdo->prepare("SELECT * FROM vistareportecontenedor where Contenedor=? ");
$stmt->execute([$dato]);
$query = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($query as $key => $campos) {
  $PO = $campos['Po'];
  $UWS = $campos['Embarque'];
}

?> 
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>REPORTE DE CONTENEDOR</title>
</head>
<body>

 <table>
    <tr>
    <td height="50" width="10%"></td>
 </tr>
 </table> 

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%" COLOR="Red"></td>
    <td width="10%"><FONT COLOR="RED"> FFTP PO NO.</FONT></td>
    <td width="20%" style="text-align:left;"><FONT COLOR="RED"><?php echo "".$PO; ?></FONT></td>
    <td width="60%"></td>
  </tr>
  <tr>
    <td  width="10%"></td>
    <td  width="10%"> FFTP UWS NO.</td>
    <td  width="20%"><?php echo "UWS".$UWS; ?></td>
    <td  width="60%"></td>
  </tr>
  <tr>

    <td height="25" width="10%"></td>
    <td height="25" width="10%"> CONTAINER NO.</td>
    <td height="25" width="20%" style="text-align:left;"><?php echo "".$dato; ?></td>
    <td height="25" width="60%"></td>
 </tr>
 <tr>
    <td  width="10%"></td>
    <td  width="10%"> COMMENTS:.</td>
    <td  width="20%"></td>
    <td  width="60%"></td>
 </tr>
 </table>
  </br>
  </br>

 <table>
    <tr>
    <td height="50" width="10%"></td>
 </tr>
 </table> 

 <table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr >
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">BENEFICIARY ID #</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="200" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">BENEFICIARY NAME</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">TYPE OF INSTITUTION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">LOCATION DEPARTMENT</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">DATE OF DISTRIBUTION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="200" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">DESCRIPTION OF PRODUCT</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">LOTE</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">QUANTITY</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">UNIT OF MEASURE</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CANTIDAD POR CAJA</FONT></center></strong></td>
  </tr>

    <tr >
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey"># BENEFICIARIO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="250" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">NOMBRE BENEFICIARIO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="150" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">TIPO DE INSTITUCION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="150" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">DEPARTAMENTO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">FECHA DISTRIBUCION</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="200" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">DESCRIPCION DE PRODUCTO</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">LOTE</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CANTIDAD</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">UNIDAD DE MEDIDA</FONT></center></strong></td>
    <td bgcolor="#E6E6E6" width="100" align="center"><strong><center><FONT FACE="Arial" SIZE=3 COLOR="Grey">CANTIDAD POR CAJA</FONT></center></strong></td>
  </tr>
  
<?PHP

$stmt = $pdo->prepare("SELECT * FROM vistareportecontenedordetalle where Contenedor=? ");
$stmt->execute([$dato]);
$query = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($query as $key => $campos) {
?>

 <tr>

 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $campos['Codigo'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $campos['Nombre'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $campos['TipoInstitucion'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $campos['Direccion'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $campos['FechaEntrega'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $campos['Producto'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $campos['Lote'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $campos['Cantidad'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $campos['Presentacion'];?></FONT></td>
 <td align="center"><FONT FACE="Arial" SIZE=3 COLOR="Grey"> <?php echo $campos['CantidadXPresentacion'];?></FONT></td>

</tr>
<?php

}


  ?>
</table>
</body>
</html>
