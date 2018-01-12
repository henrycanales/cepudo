<!-- Modal Reporte Contenedores -->
<div id="ReporteContenedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center> <h4 class="modal-title">Reporte Productos Entregados Por Contenedor</h4> </center>
      </div>
      <div class="modal-body">

     <table border="0" align="center">
      <tr>
          <td width="400">
          <input type="text" placeholder="Ingrese Numero Contenedor" id="NoContenedor" nombre="NoContenedor"class="form-control"/>
          </td>
          <td width="10"></td>
          <td>
          <input type="button" onclick="VerReporteContenedor();" value="Exportar a Excel" id="botonExportar"class="btn btn-success"/>
          </td>

      </tr>
    </table>
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal clientes -->