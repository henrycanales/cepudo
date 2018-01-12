<!-- Modal clientes -->
<div id="VerProyectoDetalleEntrega" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center> <h4 class="modal-title">Detalle Productos de Entrega Proyecto</h4> </center>
      </div>
      <div class="modal-body">
                  
     <table border="0" width="98%">

        <tr>
           <td height="50" width="25%">
           <input type="button" id="Buscar" onclick="BuscarProducto()" value="Buscar Producto" class="btn btn-info form-control" />
           </td>

           <td height="50" width="10%">
           <label> Producto: </label>
           </td>
           <td height="50" width="45%">
           <input type="text" id="Producto" name="Producto" readonly class="form-control" />
           </td>
          <td height="50" width="10%">
           <label> Cantidad: </label>
           </td>
           <td height="50" width="10%">
           <input type="number" id="Cantidad" name="Cantidad" value="0"class="form-control" />
           </td>
           <td height="50" width="5%">
           <button type="button" class="btn btn-success glyphicon glyphicon-plus " onClick="nuevo();"> </button>
           </td>
        </tr>

    </table>

          </br>
      <div id="agrega-registrosDetalle"></div>
        
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal clientes -->