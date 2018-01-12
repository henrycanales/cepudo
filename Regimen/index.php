<?PHP

session_start();

if($_SESSION['session_nivel_cepudo']=="Contabilidad" || $_SESSION['session_nivel_cepudo']=="root")
{


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Regimen Facturacion</title>
<script src="../js/jquery.js"></script>
<script src="../js/Regimen.js"></script>
<script src="../js/Global.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>

  <?php
include('../Menu/MenuNav.php'); //Menu Nav
?>
   <center> <h1>Regimen de Remision</h1></center>
    <section>
    <table border="0" align="center">
    	<tr>
        	<td width="335"><input type="text" class="form-control" placeholder="Buscar un Regimen por: CAI" id="bs-prod"/></td>
          <td width="20"></td>
            <td width="100"><button id="nuevo-producto" class="btn btn-primary">Nuevo</button></td>
         <td>
          &nbsp;&nbsp;<label>No. Items: </label>&nbsp;
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
    <div style="width:95%">
    <div id="agrega-registros"></div>
    <ul class="pagination" id="pagination"></ul>
    </div>
    </center>
      
<?php
//Incluyo los Modals
include('../Modals/ModalRegimen.php'); //Modal Regimen Facturacion
//include('../Modals/ModalinformacionEmpresa.php'); //Modal Informacion Empresa
?>
  <div class="footer">
      <center>
        <p>Copyright © 2017 <a href="http://www.syteccop.com">SYTEC</a></p>
      </center>
      </div>
</body>
</html>
<?php

}
else{
  header("Location: ../index.php");
}

?>
