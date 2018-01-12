<!-- Modal clientes -->
<div id="VerModalReporteExcel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center> <h4 class="modal-title">Exportar Reporte Por Rango de Fechas</h4> </center>
      </div>
      <div class="modal-body">
              
                  <table border="0" width="100%">
                   <tr>
                       <td height="50" width="100">Inicial: </td>
                       <td height="50" ><input type="date" placeholder="Palet"  name="fechai" id="fechai" class="form-control"/></td>
                       <td height="50" width="100" >&nbsp;Final: </td>
                       <td height="50" ><input type="date" placeholder="Palet"  name="fechaf" id="fechaf" class="form-control"/></td>
                       <td width="10"></td>
                       <td height="50" ><button id="exportar" onclick="exportarRangoExcel();"class="btn btn-success">Exportar Excel</button></td>
            </table>
          </br>
        
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal clientes -->