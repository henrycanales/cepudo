<?PHP
session_start();

if($_SESSION['session_nivel_cepudo']=="root")
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Usuarios</title>
<script src="../js/jquery.js"></script>
<script src="../js/Global.js"></script>
<script src="../js/Usuarios.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/PieDePagina.css" media="screen" />

<?php include ('../Menu/MenuNav.php'); ?>
</head>
    <center>
    <h1>Usuarios</h1>
    <section>
    
    <table border="0" align="center">
    	<tr>
        	<td width="335">
          <input type="text" placeholder="Buscar Por Usuario o Nombre" id="bs-prod" class="form-control"/>
          </td>
          <td width="100">&nbsp;
          <button id="nuevo-producto" class="btn btn-primary">Nuevo</button>
          </td>
          <td>
          <label>No. Items: </label>&nbsp;
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

    </br>
    <center>
    <div style="width:90%">
    <div id="agrega-registros"></div>
    
    <ul class="pagination" id="pagination"></ul>
    </div>
    </center>
    <!-- MODAL PARA EL REGISTRO DE USUARIOS-->
    <div class="modal fade" id="registra-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <center>
              <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita un Usuario</b></h4>
              </center>
            </div>
            <form id="formulario" class="formulario">
            <div class="modal-body">
				    <table border="0" width="100%">
               		 <tr>
                      <td colspan="2">
                      <input type="text" readonly="readonly" id="id-prod" name="id-prod" readonly="readonly" style="visibility:hidden; height:5px;"/>
                      </td>
                   </tr>
                  <tr>
                    	<td width="150" height="50">Proceso: </td>
                      <td height="50"><input type="text" readonly="readonly" id="pro" name="pro" value="Registro" class="form-control"/></td>
                      </tr>
                	<tr>
                    	<td>Usuario: </td>
                      <td height="50"><input type="text" required="required" name="nombreUsuario" id="nombreUsuario" maxlength="100" class="form-control"/></td>
                  </tr>                 
                  </tr>
                	<tr>
                    	<td>Contraseña: </td>
                      <td height="50"><input type="password" required="required" name="pass" id="pass" maxlength="100" class="form-control"/></td>
                  </tr>
                  <tr>
                      <td>Confirme Contraseña: </td>
                      <td height="50"><input type="password" required="required" name="confirmePass" id="confirmePass" maxlength="100" class="form-control"/></td>
                  </tr>
                     
                  <tr>
                    	<td>Nombre: </td>
                      <td height="50"><input type="text" required="required" name="nombre" id="nombre" maxlength="100" class="form-control"/></td>
                  </tr>
					
				        	<tr>
                    	<td>Nivel: </td>
                      <td height="50">
          		<select name="nivel" id="nivel"class="form-control">;
          		<option value="Administrador">Administrador</option> ;		
        		<option value="Donaciones">Donaciones</option>;
                        <option value="Embarques">Embarques</option>;
                        <option value="Inventario">Inventario</option>;
                        <option value="Entregas">Entregas</option>;
                        <option value="EntregasProyecto">Entregas Proyectos</option>;
                        <option value="Contabilidad">Contabilidad</option>;
		        <option value="AplicarEntrega">Aplicar Entregas</option>;
			<option value="DyE">Donaciones & Embarques</option>;
			<option value="root">ROOT</option>;

          						</select>
		        				  </td>
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
  </center>


  <footer class="clase-general">
  </br>
  </br>
  </br>
      <center>
        <p>Copyright © 2017 <a href="http://www.syteccop.com">SYTEC</a></p>
      </center>
 </footer>
</body>
</html>
<?php

}else{
   header("Location: ../index.php ");
}
?>
