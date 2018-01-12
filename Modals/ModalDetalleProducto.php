<!-- Modal clientes -->
<div id="VerDetalleEntrega" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center> <h4 class="modal-title">Detalle Productos de Entrega</h4> </center>
      </div>
      <div class="modal-body">
                  
      <table border="0" width="100%" id="QuitarTabla">
           <tr>
           <td height="50" width="30%">
           <input type="button" id="Buscar" onclick="BuscarProducto()" value="Buscar Producto" class="btn btn-info form-control" />
           </td>
           <td height="50" width="8%">
           &nbsp;<label> Contenedor: </label>
           </td>
           <td height="50" width="12%">
           <input type="text" id="Contenedor" name="Contenedor" readonly class="form-control" />
           </td>
           <td height="50" width="8%">
           &nbsp;<label> Producto: </label>
           </td>
           <td height="50" width="17%">
           <input type="text" id="Producto" name="Producto" readonly class="form-control" />
           </td>
          <td height="50" width="8%">
          &nbsp; <label> Cantidad: </label>
           </td>
           <td height="50" width="10%%">
           <input type="number" id="Cantidad" name="Cantidad" value="0"class="form-control" />
           </td>
           <td height="50" width="5">
           <td><button type="button" class="btn btn-success glyphicon glyphicon-plus form-control" onClick="nuevo();"> </button></td>
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