<?PHP
session_start();

$IdUsuario=$_SESSION['session_nombre_cepudo'];

if($_SESSION['session_nivel_cepudo']=="root" ||$_SESSION['session_nivel_cepudo']=="DyE" || $_SESSION['session_nivel_cepudo']=="Embarques")
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dispensas</title>
<script src="../js/jquery.js"></script>
<script src="../js/Global.js"></script>
<script src="../js/Dispensas.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>

<?php include ('../Menu/MenuNav.php'); ?>
</head>
    <center>
    <h1>DISPENSAS</h1>
    <section>
    
    <table border="0" align="center">
    	<tr>
        	<td width="335">
          <input type="text" placeholder="Buscar numero de embarque o por numero dispensa" id="bs-prod" nombre="bs-prod"class="form-control"/>
          </td>
          <td width="100">&nbsp;
          <button id="nuevo-producto" class="btn btn-primary">Nuevo</button>
          </td>
          <td>
          <label>No. Items: </label>&nbsp;
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
    <!-- MODAL PARA EL REGISTRO DE DONACIONES-->
    <div class="modal fade" id="registra-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <center>
              <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita una Dispensa</b></h4>
              </center>
            </div>
            <form id="formulario" class="formulario">
            <input type="hidden" id="IdSession" nombre="IdSession" value="<?php echo $IdUsuario; ?>">
            <div class="modal-body">
				    <table border="0" width="100%">
               		 <tr>
                      <td colspan="2">
                      <input type="text" readonly="readonly" id="id-prod" name="id-prod" readonly="readonly" style="visibility:hidden; height:5px;"/>
                      </td>
                   </tr>
                  <tr>
                    	<td width="150" height="50">Proceso: </td>
                      <td height="50" colspan="2"><input type="text" readonly="readonly" id="pro" name="pro" value="Registro" class="form-control"/></td>
                      </tr>                
                  </tr>
                	<tr>
                    	<td>Numero Embarque: </td>
                      <td height="50" colspan="2"><input type="text" required="required" name="NEmbarque" id="NEmbarque" class="form-control" maxlength="500" ></td>
                  </td>
                  </tr>
                  <tr>
                      <td>Fecha Dispensa: </td>
                      <td height="50" colspan="2"><input type="date" required="required" name="fechaDispensa" id="fechaDispensa" maxlength="100" class="form-control"/></td>
                  </tr>
                  </tr>
                  <tr>
                      <td>Numero Dispensa: </td>
                      <td height="50" colspan="2"><input type="text"  name="NDispensa" id="NDispensa" maxlength="100" class="form-control"/></td>
                  </tr>
                     
                  <tr id="Recepcion">
                    	<td>Fecha Recepcion Dispensa: </td>
                      <td height="50" colspan="2"><input type="date" required="required" name="fechaRecepcion" id="fechaRecepcion" maxlength="100" class="form-control"/></td>
                  </tr>         
                  <tr id="FilaImagen">
                        <td>
                        Adjuntar Dispensa:
                        </td>
                        <td>
                        <input id="file" name="file" type="file" /> 
                        </td>
                        <td>
                       <!-- <button onclick="agregaImagen();" class="btn btn-danger glyphicon glyphicon-cloud-upload "></button> -->
                       <a target="_blank" id="subirImagen" class="btn btn-danger glyphicon glyphicon-cloud-upload"></a>
                        </td>
                </tr>
            </table>
            </div>
            <div id="mensajeImagen">SIN SUBIR</div>
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
