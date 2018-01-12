<?PHP
session_start();

$IdUsuario=$_SESSION['session_nombre_cepudo'];

if($_SESSION['session_nivel_cepudo']=="Inventario" || $_SESSION['session_nivel_cepudo']=="root" || $_SESSION['session_nivel_cepudo']=="Administrador")
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INVENTARIO</title>
<script src="../js/jquery.js"></script>
<script src="../js/Global.js"></script>
<script src="../js/Inventario.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>


<?php include ('../Menu/MenuNav.php'); ?>
</head>
    <center>
    <h1>INVENTARIO</h1>
    <section>
    
    <table border="0" align="center">
    	<tr>
        	<td width="335">
          <input type="text" placeholder="Buscar por numero de embarque, contenedor, Descripcion" id="bs-prod" nombre="bs-prod"class="form-control"/>
          </td>
          <td width="100">&nbsp;
          <button id="nuevo-producto" class="btn btn-primary">Nuevo</button>
          </td>
          <td>
          <label>Buscar Por: </label>&nbsp;
          </td>
             <td height="50">
              <select name="Busqueda" id="Busqueda" class="form-control">
              <option value="Contenedor"> Contenedor </option>     
              <option value="Productos"> Productos </option>  
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
    <!-- MODAL PARA EL REGISTRO DE DONACIONES-->
    <div class="modal fade" id="registra-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <center>
              <h4 class="modal-title" id="myModalLabel"><b>Registra Inventario por Contenedor</b></h4>

              </center>
            </div>
            <input type="hidden" id="Descripcion" name="Descripcion" value="">
            <input type="hidden" id="contador" name="contador" value="0">
            <input type="hidden" id="contenedor" name="contenedor" value="0">

            <form id="formulario" class="formulario">
            <input type="hidden" id="IdSession" nombre="IdSession" value="<?php echo $IdUsuario; ?>">
            <div class="modal-body">
            <input type="text" readonly="readonly" id="pro" name="pro" value="Registro" class="form-control" style="text-align:center" />
            <input type="text" readonly="readonly" id="id-prod" name="id-prod" readonly="readonly" style="visibility:hidden; height:5px;"/>

				    <table border="0" width="100%">
        
                  <tr>
                      <td height="50" width="150">Numero Contenedor: </td>
                      <td height="50" width="200"><input type="text" required="required" name="numeroContenedor" id="numeroContenedor" maxlength="100" class="form-control"/></td>
      
                    	<td height="50" width="70">Estado: </td>
                      <td height="50" width="200"> 
                
                          <select id="estadoContenedor" name="estadoContenedor" required="required" class="form-control">
                          <option value="0">Elija una opcion</option>                      
                          <option value="Bueno">Bueno</option>   
                          <option value="Malo">Malo</option>   
                          <option value="Regular">Regular</option>                      
                          </select>
                      </td>
                      <td height="50" width="70">Fecha: </td>
                      <td height="50" width="200"><input type="date" required="required" name="fecha" id="fecha" maxlength="100" class="form-control"/></td>
             
                      <td height="50" width="70">Tamaño: </td>
                      <td height="50" width="200"> 
                         
                          <select id="tamano" name="tamano" required="required" class="form-control">
                          <option value="0">Elija una opcion</option>                        
                          <option value="20">20 Pies</option>  
                          <option value="40">40 Pies</option>   
                          <option value="40 HC">40 HC  Pies</option>                         
                          </select>
                      </td>
                  </tr>
            </table>
            </br>
            <div id="FilaContenedor">
            <table border="0" width="100%">
                   <tr>
                       <td height="50" width="10%"><input type="number" placeholder="Palet"  name="palet" id="palet" maxlength="100"  class="form-control"/></td>
                       <td height="50" width="10%">
                        <?php
                          //***********************************************
                          include'../conexion/conexion.php';
                          $registro = mysqli_query($conexion,"SELECT * FROM Productos where Estado='Activo'");
                          ?>
                          <select name="producto" id="producto" class="selectpicker remove-example" data-live-search="true"  data-size="5" title="Seleccione Producto...">
                          <?php
                          while($registro2 = mysqli_fetch_array($registro)){
                          $Codigo=$registro2['ProductoId'];
                          $Nombre=$registro2['Descripcion'];
                          ?>
                          <option value="<?php echo $Codigo; ?>"data-tokens="<?php echo $Nombre; ?>"><?php echo $Nombre;?></option>
                          <?php
                          }
                          ?>
                           </select>
                       </td>
                       <td height="50" width="10%"><input type="text"   placeholder="Lote" name="lote" id="lote" maxlength="100"  class="form-control"/></td>
                       <td height="50" width="3%">Vencimiento: </td>
                       <td height="50" width="10%"><input type="month"  placeholder="2000-01"name="fechaVencimiento" id="fechaVencimiento" maxlength="100" class="form-control" /></td>
                       <td height="50" width="10%"><input type="number" placeholder="Cant." name="cantidad" id="cantidad" maxlength="100"  class="form-control"/></td>
                       <td height="50" width="10%"> 
                          <select id="presentacion" name="presentacion" required="required" class="form-control">
                          <option value="0">Elija Presentacion</option>                        
                          <option value="Unidad">Unidad</option>  
                          <option value="Cajas">Cajas</option>   
                          <option value="Botes">Botes</option> 
                          <option value="Paquetes">Paquetes</option> 
                          <option value="Sacos">Sacos</option> 
                          <option value="Libras">Libras</option> 
                          <option value="Galones">Galones</option> 
                          <option value="Barril">Barril</option> 
                          <option value="Cajitas">Cajitas</option>
                          <option value="Kits">Kits</option> 
                          <option value="Pallets">Pallets</option> 
                          <option value="Rollos">Rollos</option>
                          <option value="Pares">Pares</option>  
                          <option value="Tanquetas">Tanquetas</option>
                          <option value="Cubetas">Cubetas</option>
			
                          </select>
                       </td>
                       <td height="50" width="10%"><input type="number" placeholder="CXP" name="cxp" id="cxp" maxlength="100"  class="form-control"/></td>
                       <td height="50" width="10%"><input type="number" placeholder="CXB" name="cxb" id="cxb" maxlength="100"  class="form-control"/></td>
                       <td height="50" width="5%"><button type="button" class="btn btn-success" onClick="nuevo();"> Agregar</button></td> 
                        
                  </tr>                   	
            </table>
          
          

          <table border="0" width="100%" class="table table-striped table-condensed table-hover">
                 <thead>
                  <tr>
                    <th height="50" width="100">Palet #</th>
                    <th height="50" width="50">Codigo</th>
                    <th height="50" width="300">Producto</th>
                    <th height="50" width="100">Lote #</th>
                    <th height="50" width="100">Vencimiento</th>
                    <th height="50" width="100">Cantidad</th>
                    <th height="50" width="100">Presentacion</th>
                    <th height="50" width="100">Cantidad X Presentacion</th>
                    <th height="50" width="100">Cantidad X Bote</th>
                    <th height="50" width="100">Eliminar</th>
                    </tr>

                 </thead>
                 <tbody id="tablaDetalleContenedores">
                 </tbody>
          </table>
         </div>
            </div>
            
            <div class="modal-footer">
            	<input type="submit" value="Registrar" class="btn btn-success" id="reg"/>
                <input type="button" value="Editar" class="btn btn-warning" onclick="ActualizarRegistro();" id="edi"/>
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
include('../Modals/ModalProductosXContenedor.php');
include('../Modals/ModalVistaProductos.php');
?>
</body>
</html>
<?php

}else{
  header("Location: ../index.php ");
}
?>
