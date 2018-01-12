 <center>
    <!-- Modal Contrasena -->
<div id="Contrasena" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center> <h4 class="modal-title">Cambiar Contraseña</h4> </center>
      </div>
      
     <form id="contrasena" class="formulario"">
     <div class="modal-body">
	   <table border="0" width="100%">
        <tr>
         <td>Contraseña Anterior: </td>
         <td><input type="password" class="form-control" required="required" name="passAnterior" id="passAnterior"/></td>
        </tr>
        <tr>
          <td>Nueva Contraseña </td>
          <td><input type="password" class="form-control" required="required" name="passNueva" id="passNueva"/></td>
		</tr>
          <tr>
          <td>Confirme Contraseña </td>
          <td><input type="password" class="form-control" required="required" name="passConfirme" id="passConfirme"/></td>
		</tr>
              
        <tr>
         <td colspan="2">
         <div id="mensajecontrasena"></div>
         </td>
        </tr>
       </table>
       </div>
      <div class="modal-footer">
        <input type="button" value="Aceptar" onclick="updatePass();" class="btn btn-success" id="aceptar"/>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
      </form>
    </div>

  </div>
</div>
   
    </center>
