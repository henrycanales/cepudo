<?PHP
session_start();

$IdUsuario=$_SESSION['session_nombre_cepudo'];

if($_SESSION['session_nivel_cepudo']=="Inventario" || $_SESSION['session_nivel_cepudo']=="Administrador" || $_SESSION['session_nivel_cepudo']=="root" || $_SESSION['session_nivel_cepudo']=="AplicarEntrega")
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aplicar Entregas Donacion</title>
<script src="../js/jquery.js"></script>
<script src="../js/Global.js"></script>
<script src="../js/AplicarEntregas.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>


<?php include ('../Menu/MenuNav.php'); ?>
</head>
    <center>
    <h1>Entrega de hojas de Donacion</h1>
    <section>
    <input type="hidden" id="Presentacion" name="Presentacion" value="">
    <input type="hidden" id="CodigoP" name="CodigoP" value="">
    <input type="hidden" id="EntregaId" name="EntregaId" value="">
    <table border="0" align="center">
    	<tr>
        	<td width="335">
          <input type="text" placeholder="Buscar por institucion" id="bs-prod" nombre="bs-prod"class="form-control"/>
          </td>
          <td>
          &nbsp;&nbsp;<label>Buscar Por: </label>&nbsp;
          </td>
             <td height="50">
              <select name="Busqueda" id="Busqueda" class="form-control">
              <option value="Todo"> TODO </option>   
              <option value="PENDIENTE DE ENTREGA"> PENDIENTES DE ENTREGAR </option>     
              <option value="ENTREGADA"> ENTREGADAS </option>  
              </select>
             </td>

          <td>
          <label>&nbsp;&nbsp;&nbsp;No. Items: </label>&nbsp;
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
include('../Modals/ModalDetalleProducto.php');

include('../Modals/ModalProductos.php');
?>
</body>
</html>
<?php

}else{
   header("Location: ../index.php ");
}
?>
