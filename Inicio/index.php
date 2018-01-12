<?PHP
session_start();

if (isset($_SESSION['session_nivel_cepudo'])){

include('../conexion/conexion.php');
$verRegimen = mysqli_query($conexion,"SELECT NoComprobante,CorrelativoHasta,FechaAutorizacion from Regimen where Estado = 'Activo'");
$verRegimen2 = mysqli_fetch_array($verRegimen);

$Comprobante = $verRegimen2['NoComprobante'];
$Limite = $verRegimen2['CorrelativoHasta'];
$FechaLimite = $verRegimen2['FechaAutorizacion'];
$FechaActual = date("Y-m-d");

function dias_transcurridos($fecha_i,$fecha_f)
{
  $dias = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
  $dias   = abs($dias); $dias = floor($dias);   
  return $dias;
}

$Dias = dias_transcurridos($FechaActual,$FechaLimite);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inicio</title>
<script src="../js/jquery.js"></script>
<!--<script src="../js/Reportes.js"></script> -->
<script src="../js/Global.js"></script>
<script type="text/javascript">

</script>
</head>
<?php
include('../Menu/MenuNav.php'); //Menu Nav
?>
  	 <section>
 	   <center>
  		  <header>CEPUDO</header>
     <br />
    <img src="../recursos/fondo-inicio.png" width="600" height="300"/> 
    <br />
    <h3>
    <label> Bienvenido </label> 
    <?php echo $_SESSION['session_nombre_cepudo'];?>
    </h3>
     <h4>
    <label> Fecha: </label> 
    <?php echo date('d-m-Y  h:i:s');?>
    </h4> 
    </center>
</section>  

  <div class="inferior">

  <?php
  if( $Dias <= 30 && $FechaActual < $FechaLimite){
  ?>
    <div class="alert alert-warning alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>!</strong> Hace Falta <?php echo $Dias; ?>
       Dias de la Fecha Autorizada del CAI
    </div>
  <?php
  }


  if( ($Limite - $Comprobante) <=100  && ($Limite - $Comprobante) >0 ){
  ?>
    <div class="alert alert-warning alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>!</strong> Hace Falta <?php echo ($Limite - $Comprobante); ?>
       remisiones para terminar el rango autorizado.
    </div>
  <?php
  }
    if($Comprobante >= $Limite){
  ?>
    <div class="alert alert-danger alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>!</strong> Se llego al limite del rango Autorizado.
    </div>
  <?php
  }
    if($FechaActual > $FechaLimite){
  ?>
    <div class="alert alert-danger alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>!</strong> Se termino la fecha de autorizacion del CAI.
    </div>
  <?php
  }
  ?>

  </div>

<?php
include('../Modals/Firma.php');
?>


</body>
</html>
<?php

}
else{
	header("Location: ../index.php");
}

?>
