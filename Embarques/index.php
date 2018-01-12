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
<title>Embarques</title>
<script src="../js/jquery.js"></script>
<script src="../js/Global.js"></script>
<script src="../js/Embarques.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>

<?php include ('../Menu/MenuNav.php'); ?>
</head>
    <center>
    <h1>EMBARQUES</h1>
    <section>
    
    <table border="0" align="center">
    	<tr>
        	<td width="335">
          <input type="text" placeholder="Buscar por numero de embarque" id="bs-prod" nombre="bs-prod"class="form-control"/>
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
              <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita un Embarque</b></h4>

              </center>
            </div>
            <form id="formulario" class="formulario">
            <input type="hidden" id="IdSession" nombre="IdSession" value="<?php echo $IdUsuario; ?>">
            <div class="modal-body">
            <input type="text" readonly="readonly" id="pro" name="pro" value="Registro" class="form-control" style="text-align:center" />
            <input type="text" readonly="readonly" id="id-prod" name="id-prod" readonly="readonly" style="visibility:hidden; height:5px;"/>

				    <table border="0" width="100%">
        
                  <tr>
                      <td height="50" width="150">Numero Embarque: </td>
                      <td height="50" width="200"><input type="text" required="required" name="numeroEmbarque" id="numeroEmbarque" maxlength="100" class="form-control"/></td>
      
                    	<td height="50" width="120">Naviera: </td>
                      <td height="50" width="200"> 
                          <?php
                          //***********************************************
                          include'../conexion/conexion.php';
                          $registro = mysqli_query($conexion,"SELECT * FROM Navieras where Estado='Activo'");
                          ?>
                          <select id="naviera" name="naviera" required="required" class="form-control">
                          <option value="0">Elija una opcion</option>
                          <?php
                          while($registro2 = mysqli_fetch_array($registro)){
                          $Codigo=$registro2['NavieraId'];
                          $Nombre=$registro2['Nombre'];
                          ?>
                          <option value="<?php echo $Codigo; ?>"><?php echo $Nombre;?></option>
                          <?php
                          }
                          ?>
                          </select>
                      </td>
                      <td height="50" width="200">Fecha Estimada Llegada: </td>
                      <td height="50" width="200"><input type="date" required="required" name="fechaEstimada" id="fechaEstimada" maxlength="100" class="form-control"/></td>
                  </tr>  
                  <tr>
                      <td height="50" width="120">Agencia Aduanera: </td>
                      <td height="50" width="200"> 
                          <?php
                          //***********************************************
                          include'../conexion/conexion.php';
                          $registro = mysqli_query($conexion,"SELECT * FROM AgenteAduanero where Estado='Activo'");
                          ?>
                          <select id="agente" name="agente" required="required" class="form-control">
                         <option value="0">Elija una opcion</option>
                          <?php
                          while($registro2 = mysqli_fetch_array($registro)){
                          $Codigo=$registro2['AgenteId'];
                          $Nombre=$registro2['Nombre'];
                          ?>
                          <option value="<?php echo $Codigo; ?>"><?php echo $Nombre;?></option>
                          <?php
                          }
                          ?>
                          </select>
                      </td>
                      <td height="50" width="120">Aduana: </td>
                      <td height="50" width="200"> 
                          <?php
                          //***********************************************
                          include'../conexion/conexion.php';
                          $registro = mysqli_query($conexion,"SELECT * FROM Aduanas where Estado='Activo'");
                          ?>
                          <select id="aduana" name="aduana" required="required" class="form-control">
                          <option value="0">Elija una opcion</option>
                          <?php
                          while($registro2 = mysqli_fetch_array($registro)){
                          $Codigo=$registro2['AduanaId'];
                          $Nombre=$registro2['Nombre'];
                          ?>
                          <option value="<?php echo $Codigo; ?>"><?php echo $Nombre;?></option>
                          <?php
                          }
                          ?>
                          </select>
                      </td>
                      <td height="50" width="200">Estado de Dispensa: </td>
                      <td height="50" width="200"> 
                          <select id="estadoDispensa" name="estadoDispensa" required="required" class="form-control">      
                          
                          <option value="Documentos Preliminares">Documentos Preliminares</option>
                          <option value="Esperando Dispensa">Esperando Dispensa</option>
                          <option value="Transito Aduana">Transito Aduana</option>
                          <option value="Esperando Documentos Originales">Esperando Documentos Originales</option>
                          <option value="Esperando Revision">Esperando Revision</option>
                          <option value="Dispensa Entregada Agente Aduanero">Dispensa Entregada Agente Aduanero</option>
		          <option value="No Necesita Dispensa">No Necesita Dispensa</option>

                          </select>
                      </td>

                  </tr>  
                  <tr>

                      <td height="50" width="150">Valor de Flete: </td>
                      <td height="50" width="200"><input type="number" step="any" required="required" name="valorFlete" id="valorFlete" maxlength="100" class="form-control"/></td>
                     
                      <td height="50" width="120">Valor de Factura: </td>
                      <td height="50" width="200"><input type="number" step="any" required="required" name="valorFactura" id="valorFactura" maxlength="100" class="form-control"/></td>
                     
                      <td height="50" width="150">Valor de Seguro: </td>
                      <td height="50" width="200"><input type="number" step="any" required="required" name="valorSeguro" id="valorSeguro" maxlength="100" class="form-control"/></td>
      
                  </tr>    
                  <tr>

                      <td height="50" width="150">Fecha Llegada Puerto: </td>
                      <td height="50" width="200"><input type="date" name="fechaLlegada" id="fechaLlegada" maxlength="100" class="form-control"/></td>
                     
                      <td height="50" width="120">Vencimiento: </td>
                      <td height="50" width="200"><input type="date" name="vencimiento" id="vencimiento" maxlength="100" class="form-control"/></td>
                     
                      <td height="50" width="150">Observacion: </td>
                      <td height="50" width="200"><textarea required="required" cols=200 rows=2 name="observacion" id="observacion" class="form-control" maxlength="500" ></textarea>
                      </TEXTAREA> </td>
                  </tr>   
                  <tr>

                      <td height="50" width="150">Numero BL: </td>
                      <td height="50" width="200"><input type="text" required="required" name="numeroBL" id="numeroBL" maxlength="100" class="form-control"/></td>
                      <td height="50" width="200">Tipo Donacion: </td>
                      <td height="50" width="200"> 
                          <select id="tipoDonacion" name="tipoDonacion" required="required" class="form-control">      
                          
                          <option value="Compra">Compra</option>
                          <option value="GIK">GIK</option>
                          <option value="Otros">Otros</option>
                          </select>
                     </td>
                     <td height="50" width="150">PO: </td>
                      <td height="50" width="200"><input type="text" name="po" id="po" maxlength="100" class="form-control"/></td>
                  </tr>                   	
            </table>
          <div id="FilaContenedor">
          <center><h4>DETALLE DE CONTENEDORES</h4></center>

          <table border="0" width="100%">
                  <tr>
                     <td width="300"><input type="text" placeholder="Ingrese Numero de Contenedor" class="form-control" name="numeroContenedor[]" id="numeroContenedor[]" /></td>
                     <td width="600"><input type="text" placeholder="Descripcion de Contenedor" class="form-control" name="observacionContenedor[]" id="observacionContenedor[]" /></td>
                     <td width="400"><input type="text" placeholder="Comentario de Contenedor" class="form-control" name="comentarioContenedor[]" id="comentarioContenedor[]" /></td>
                     
                      <!--
                      <td height="50" width="500"><textarea required="required" cols=200 rows=2 name="observacionContenedor" id="observacionContenedor" class="form-control" maxlength="500" ></textarea>
                      </TEXTAREA> </td>
                      -->
                     <td><button type="button" class="btn btn-success glyphicon glyphicon-plus" onClick="nuevo();"> </button></td>
                  </tr>
                 <tbody id="tablaDetalleContenedores">
                 </tbody>
          </table>
        </div>
            </div>
            
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
include('../Modals/ModalVerContenedores.php');
?>
</body>
</html>
<?php

}else{
   header("Location: ../index.php ");
}
?>
