 <!-- Modal productos -->
<div id="VerVistaProductos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center> <h4 class="modal-title" id="titulo">Productos</h4> </center>
      </div>
      <div class="modal-body">

       <table border="0" align="center">
      <tr>
          <td width="400">
          <input type="text" placeholder="Buscar producto por descripcion" id="bs-prodVista" nombre="bs-prod"class="form-control"/>
          </td>
          <td>
          <label>&nbsp;&nbsp;&nbsp;No. Items: </label>&nbsp;
          </td>
             <td height="50">
              <select name="ItemsVista" id="ItemsVista" class="form-control">
              <option value="10"> 10 </option>     
              <option value="20"> 20 </option>  
              <option value="30"> 30 </option>  
              <option value="40"> 40 </option> 
              <option value="50"> 50 </option> 
              </select>
             </td>
        </tr>
    </table>
    <center>
    <div id="agrega-registrosVistaProductos"></div>


    <ul class="pagination" id="paginationVista"></ul>
    </center>
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal productos -->