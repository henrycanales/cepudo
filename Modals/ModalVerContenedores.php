<!-- Modal clientes -->
<div id="Vercontenedores" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center> <h4 class="modal-title">Detalle de Contenedores de Embarque</h4> </center>
      </div>
      <div class="modal-body">
      <input type="hidden" name="DetalleIdContenedor" id="DetalleIdContenedor" />

      <table class="table">
        <tr>
          <td width="30%">
            <input type="text" id="DetalleNumeroContenedor" name="DetalleNumeroContenedor" class="form-control" placeholder="Numero Contenedor..." />
          </td>
          <td width="30%">
            <input type="text" id="DetalleDescripcionContenedor" name="DetalleDescripcionContenedor" class="form-control" placeholder="Descripcion Contenedor..."/>
          </td>
          <td width="30%">
            <input type="text" id="DetalleComentarioContenedor" name="DetalleComentarioContenedor" class="form-control" placeholder="Comentario Contenedor...">
          </td>
          <td width="10%">
            <button class="btn btn-danger" id="DetalleAgregarContenedor" onclick="DetalleAgregarContenedor();"> Agregar Contenedor</button>
          </td>
        </tr>
      </table>


    <div id="agrega-registrosContenedores"></div>
        
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal clientes -->
