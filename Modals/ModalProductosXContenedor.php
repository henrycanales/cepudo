<!-- Modal clientes -->
<div id="VerProductosXContenedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center> <h4 class="modal-title">Detalle Productos en Contenedor</h4> </center>
      </div>
      <div class="modal-body">
                  <input type="hidden" id="InventarioContenedorId" name="InventarioContenedorId" />
                  <input type="hidden" id="Descripcion2" name="Descripcion2" value="">
                  

                  <table border="0" width="100%">
                   <tr>
                       <td height="50" width="10%"><input type="number" placeholder="Palet"  name="palet2" id="palet2" maxlength="100"  class="form-control"/></td>
                       <td height="50" width="0.5%"></td>
                       <td height="50" width="10%">
                        <?php
                          //***********************************************
                          include'../conexion/conexion.php';
                          $registro = mysqli_query($conexion,"SELECT * FROM Productos where Estado='Activo'");
                          ?>
                          <select name="producto2" id="producto2" class="selectpicker remove-example" data-live-search="true"  data-size="5" title="Seleccione Producto...">
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
                       <td height="50" width="0.5%"></td>
                       <td height="50" width="10%"><input type="text"   placeholder="Lote" name="lote2" id="lote2" maxlength="100"  class="form-control"/></td>
                       <td height="50" width="0.5%"></td>
                       <td height="50" width="7%">Vencimiento: </td>
                       <td height="50" width="0.5%"></td>
                       <td height="50" width="10%"><input type="month"  placeholder="2000-01"name="fechaVencimiento2" id="fechaVencimiento2" maxlength="100" class="form-control" /></td>
                       <td height="50" width="0.5%"></td>
                       <td height="50" width="10%"><input type="number" placeholder="Cant." name="cantidad2" id="cantidad2" maxlength="100"  class="form-control"/></td>
                       <td height="50" width="0.5%"></td>
                       <td height="50" width="13%"> 
                          <select id="presentacion2" name="presentacion2" required="required" class="form-control">
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
			  <option value="Pares">Pares</option>
                          <option value="Rollos">Rollos</option>
                          <option value="Tanquetas">Tanquetas</option>   
			  <option value="Cubetas">Cubetas</option>

                          </select>
                       </td>
                       <td height="50" width="0.5%"></td>
                       <td height="50" width="10%"><input type="number" placeholder="CXP" name="cxp2" id="cxp2" maxlength="100"  class="form-control"/></td>
                       <td height="50" width="10%"><input type="number" placeholder="CXB" name="cxb2" id="cxb2" maxlength="100"  class="form-control"/></td>
                       <td height="50" width="0.5%"></td>
                       <td height="50" width="10%"><button type="button" class="btn btn-success" onClick="nuevoDetalle();"> Agregar</button></td> 
                        
                  </tr>                     
            </table>
          </br>
      <div id="agrega-registrosProductosXcontenedores"></div>
        
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal clientes -->
