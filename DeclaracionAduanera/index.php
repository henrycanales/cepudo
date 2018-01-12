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


if($_SESSION['session_nivel_cepudo']=="root" ||$_SESSION['session_nivel_cepudo']=="DyE" ||$_SESSION['session_nivel_cepudo']=="Embarques")
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Declaracion Aduanera</title>
<script src="../js/jquery.js"></script>
<script src="../js/Global.js"></script>
<script src="../js/Declaraciones.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>

<?php include ('../Menu/MenuNav.php'); ?>
</head>
    <center>
    <h1>DECLARACION UNICA ADUANERA</h1>
    <section>
    
    <table border="0" align="center">
    	<tr>
        	<td width="335">
          <input type="text" placeholder="Buscar por numero de embarque o por numero dispensa" id="bs-prod" nombre="bs-prod"class="form-control"/>
          </td>
          <td width="100">&nbsp;
          <button id="nuevo-producto" class="btn btn-primary">Nuevo</button>
          </td>
          <td width="100">
          <input type="month" id="mes" name="mes" class = "form-control" placeholder="aaaa-mm" />
          </td>
          <td width="10"></td>
          <td width="100">
          <button id="exportar" onclick="exportarExcel();"class="btn btn-success">Exportar Excel</button>
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
    <!-- MODAL PARA EL REGISTRO DE DONACIONES-->
    <div class="modal fade" id="registra-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <center>
              <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita una Declaracion</b></h4>
              </center>
            </div>
            <form id="formulario" class="formulario" action="" method="post" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
            <input type="hidden" id="IdSession" nombre="IdSession" value="<?php echo $IdUsuario; ?>">
            <div class="modal-body">
             <input type="text" readonly="readonly" id="pro" name="pro" value="Registro" class="form-control" style="text-align:center" />
            <input type="text" readonly="readonly" id="id-prod" name="id-prod" readonly="readonly" style="visibility:hidden; height:5px;"/>
				    <table border="0" width="100%">
               		 <tr>
                    	<td width="150">Numero Embarque: </td>
                      <td height="50" width="200" ><input type="text" required="required" name="numeroEmbarque" id="numeroEmbarque" class="form-control" maxlength="500" ></td>
                      </td>
             
              
                      <td width="150" >Numero Dispensa: </td>
                      <td height="50" width="200" ><input type="text" readonly name="numeroDispensa" id="numeroDispensa" maxlength="100" class="form-control"/></td>

                     
                    	<td width="150">Fecha Dispensa: </td>
                      <td height="50" width="200" ><input type="date" readonly name="fechaRecepcion" id="fechaRecepcion" maxlength="100" class="form-control"/></td>
                  </tr>         
                  <tr>
                      <td width="150">Numero Poliza: </td>
                      <td height="50" width="200"><input type="text" required="required" name="numeroPoliza" id="numeroPoliza" maxlength="100" class="form-control"/></td>
         
                      <td width="150">Fecha Poliza: </td>
                      <td height="50" width="200"><input type="date" required="required" name="fechaPoliza" id="fechaPoliza" maxlength="100" class="form-control"/></td>
               
                      <td width="150">Observacion: </td>
                      <td height="50" width="200" ><textarea cols=200 rows=2 name="observacion" id="observacion" class="form-control" maxlength="500" ></textarea>
                      </TEXTAREA> </td>
                  </tr>
                  <tr>
                      <td width="150">TipoDonacion: </td>
                      <td height="50" width="200"><textarea readonly cols=200 rows=2 name="tipoDonacion" id="tipoDonacion" class="form-control" maxlength="500" ></textarea>
                      </TEXTAREA> </td>
                
                      <td width="150">Tasa Cambio: </td>
                      <td height="50" width="200"><input type="number" step="any" required="required" name="tasaCambio" id="tasaCambio" value="0.00" maxlength="100" class="form-control"/></td>
                
                      <td width="150">Valor FOB: </td>
                      <td height="50" width="200"><input type="number" readonly name="valorFob" id="valorFob" value="0.00" maxlength="100" class="form-control"/></td>
                  </tr>
                  <tr>
                      <td width="150">Valor Flete: </td>
                      <td height="50" width="200"><input type="number" readonly  name="valorFlete" id="valorFlete" value="0.00" maxlength="100" class="form-control"/></td>
               
                      <td width="150">Valor Seguro: </td>
                      <td height="50" width="200"><input type="number" readonly name="valorSeguro" id="valorSeguro" value="0.00" maxlength="100" class="form-control"/></td>
               
                      <td width="150">Otros Gastos: </td>
                      <td height="50" width="200" ><input type="number" step="any" name="otrosGastos" id="otrosGastos" value="0.00" maxlength="100" class="form-control"/></td>
                  </tr>
                  <tr>
                      
                      <td width="150">Ajustes: </td>
                      <td height="50" width="200"><input type="text" name="ajustes" id="ajustes"  maxlength="100" class="form-control"/></td>
                 
                      <td width="150">CIF Imponibles: </td>
                      <td height="50" width="200"><input type="text" name="cifImponibles" id="cifImponibles"  maxlength="100" class="form-control"/></td>
                  </tr>
            </table>
            <!--
                  </br>
                  <center>Total: </center>
                  <input type="text" required="required" style="text-align:center" name="total" id="total" value="0.00" maxlength="100" class="form-control" readonly/></td>
            -->   
            </div>
            <div id="mensajeImagen"></div>
            <div class="modal-footer">
            	<input type="submit" value="Registrar" class="btn btn-success" id="reg"/>
                <input type="submit" value="Editar" class="btn btn-warning"  id="edi"/>
            </div>
            </form>
          </div>
        </div>
      </div>
  </center>
  <div class="footer">
      <center>
        <p>Copyright © 2017 <a href="http://www.syteccop.com">SYTEC</a></p>
      </center>
      </div>
<?php
include('../Modals/ModalVerFoto.php');
?>
</body>
</html>
<?php

}else{
  header("Location: ../index.php ");
}
?>
