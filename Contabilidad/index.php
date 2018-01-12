<?PHP
session_start();
include('../conexion/conexion.php');
$IdUsuario=$_SESSION['session_nombre_cepudo'];


$verRegimen = mysqli_query($conexion,"SELECT NoComprobante,CorrelativoHasta,FechaAutorizacion from Regimen where Estado = 'A'");
$verRegimen2 = mysqli_fetch_array($verRegimen);

$Comprobante = $verRegimen2['NoComprobante'];
$Limite = $verRegimen2['CorrelativoHasta'];
$FechaLimite = $verRegimen2['FechaAutorizacion'];
$FechaActual = date("Y-m-d");


if($_SESSION['session_nivel_cepudo']=="Contabilidad" || $_SESSION['session_nivel_cepudo']=="root")
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contabilidad</title>
<script src="../js/jquery.js"></script>
<script src="../js/Global.js"></script>
<script src="../js/Contabilidad.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>

<?php include ('../Menu/MenuNav.php'); ?>
</head>
    <center>
    <h1>CONTABILIDAD</h1>
    <section>
    
    <table border="0" align="center">
    	<tr>
        	<td width="400">
          <input type="text" placeholder="Buscar por numero de embarque o por numero dispensa" id="bs-prod" nombre="bs-prod"class="form-control"/>
          </td>
          <td width="10"></td>
          <td width="100">
          <input type="month" id="mes" name="mes" class = "form-control" placeholder="aaaa-mm" />
          </td>
          <td width="10"></td>
          <td width="100">
          <button id="exportar" onclick="exportarExcel();"class="btn btn-success">Exportar Excel</button>
          </td>

          <td width="100">
          <button id="exportarFechas" onclick="exportarFechas();"class="btn btn-danger">Exportar Por Rango Fechas</button>
          </td>
          <td>
          &nbsp;<label>No. Items: </label>&nbsp;
          </td>
             <td height="50">
              <select name="Items" id="Items" class="form-control">
              <option value="10"> 10 </option>     
              <option value="20"> 20 </option>  
              <option value="30"> 30 </option>  
              <option value="40"> 40 </option> 
              <option value="50"> 50 </option> 
              </select>
             </td>
        </tr>
    </table>
    </section>

    </br>
    <center>
    <div style="width:98%">
    <div id="agrega-registros"></div>
    
    <ul class="pagination" id="pagination"></ul>
    </div>
    </center>

</center>
  <div class="footer">
      <center>
        <p>Copyright © 2017 <a href="http://www.syteccop.com">SYTEC</a></p>
      </center>
      </div>
<?php
include('../Modals/ModalReporteExcel.php');
?>
</body>
</html>
<?php

}else{
  header("Location: ../index.php ");
}
?>
