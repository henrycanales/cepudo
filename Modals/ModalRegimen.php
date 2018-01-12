 <!-- MODAL PARA EL REGISTRO DE PRODUCTOS-->
    <div class="modal fade" id="RegimenF" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita Regimen SAR</b></h4>
            </div>
            <form id="formulario" class="formulario" onsubmit="return agregaRegistro();">
            <div class="modal-body">
				<table border="0" width="100%">
               		 <tr>
                        <td colspan="2"><input type="text" required="required" readonly="readonly" id="id-prod" name="id-prod" readonly="readonly" style="visibility:hidden; height:5px;"/></td>
                    </tr>
                     <tr>
                    	<td width="150">Proceso: </td>
                        <td><input type="text" class="form-control" required="required" readonly="readonly" id="pro" name="pro" value="Registro"/></td>
                    </tr>
                	<tr>
                    	<td>CAI: </td>
                        <td><input type="text" class="form-control" required="required" name="cai" id="cai" maxlength="100"/></td>
                    </tr>
                    	<tr>
                    	<td>Correlativo Desde: </td>
                        <td><input type="number" class="form-control" required="required" name="correlativod" id="correlativod" maxlength="100"/></td>
                    </tr>
                    
           				<tr>
                    	<td>Correlativo Hasta: </td>
                        <td><input type="number" class="form-control" required="required" name="correlativoh" id="correlativoh" maxlength="100"/></td>
                    </tr>
                    	<tr>
                    	<td>Fecha Autoriacion: </td>
                        <td><input type="date" class="form-control" required="required" name="fecha" id="fecha" maxlength="100" value="<?php echo date('Y-m-d'); ?>"/></td>
                    	<tr>
                    	<td>Comprobante: </td>
                        <td><input type="text" class="form-control" required="required" name="comprobanteRegimen" id="comprobanteRegimen" maxlength="100"/></td>
                    </tr>
                    	<tr>
                    	<td>No.Comprobante: </td>
                        <td><input type="text" class="form-control" name="noComprobante" id="noComprobante" maxlength="100"/></td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<div id="mensaje"></div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div class="modal-footer">
            	<input type="submit" value="Registrar" class="btn btn-success" id="reg"/>
                <input type="submit" value="Editar" class="btn btn-warning"  id="edi"/>
            </div>
            </form>
          </div>
        </div>
      </div>