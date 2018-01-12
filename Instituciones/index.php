<?PHP
session_start();

if($_SESSION['session_nivel_cepudo']=="root" || $_SESSION['session_nivel_cepudo']=="Administrador")
{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instituciones</title>
<script src="../js/jquery.js"></script>
<script src="../js/Global.js"></script>
<script src="../js/Instituciones.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>
</head>

<?php
include('../Menu/MenuNav.php'); //Menu Nav
?>

   <center><h1>Instituciones</h1></center>
    <section>
    <table border="0" align="center">
    	<tr>
        	<td width="400"><input type="text" class="form-control"placeholder="Buscar una Institucion por: Nombre" id="bs-prod"/></td>
            <td width="10"></td>
            <td width="100"><button id="nuevo-producto" class="btn btn-primary btn-block">Nuevo</button></td>
                        <td width="10"></td>
            <td width="150"><button onclick="VerModal();" class="btn btn-success btn-block">Exportar a Excel</button></td>
            <td>
          &nbsp;&nbsp;<label>No. Items: </label>&nbsp;
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
        </tr>
    </table>
    </section>
    </br>
    <center>
    <div style="width:95%">
    <div id="agrega-registros"></div>
    
    <ul class="pagination" id="pagination"></ul>
    </div>
    </center>
    <!-- MODAL PARA EL REGISTRO DE PRODUCTOS-->
    <div class="modal fade" id="registra-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registra o Edita una Institucion</b></h4>
            </div>
            <form id="formulario" class="formulario">
            <div class="modal-body">
				<table border="0" width="100%">
               		 <tr>
                        <td colspan="2"><input type="text" readonly="readonly" id="id-prod" name="id-prod" readonly="readonly" style="visibility:hidden; height:5px;"/></td>
                    </tr>
                    <tr>
                      	<td width="150">Proceso: </td>
                        <td><input type="text" required="required" class="form-control" readonly="readonly" id="pro" name="pro" value="Registro"/></td>
                    </tr>
                        <tr>
                        <td>Codigo: </td>
                        <td><input type="text" required="required" class="form-control" name="codigoInst" id="codigoInst" maxlength="100"/></td>
                    </tr>
                	  <tr>
                      	<td>Nombre: </td>
                        <td><input type="text" required="required" class="form-control" name="nombreInst" id="nombreInst" maxlength="500"/></td>
                    </tr>
                    <tr>
                        <td>Tipo de Institucion: </td>
                        <td height="50" width="200"> 
                            <?php
                            //***********************************************
                            include'../conexion/conexion.php';
                            $registro = mysqli_query($conexion,"SELECT * FROM TiposInstituciones where Estado='Activo'");
                            ?>
                            <select id="tipoInst" name="tipoInst" required="required" class="form-control">
                            <option value="0">Elija una opcion</option>
                            <?php
                            while($registro2 = mysqli_fetch_array($registro)){
                            $Codigo=$registro2['TipoInstitucionId'];
                            $Nombre=$registro2['Descripcion'];
                            ?>
                            <option value="<?php echo $Codigo; ?>"><?php echo $Nombre;?></option>
                            <?php
                            }
                            ?>
                            </select>
                      </td>
                    </tr>
                    <tr>
                    	  <td>Direccion: </td>
                        <td><input type="text" required="required" class="form-control" name="direccion" id="direccion" maxlength="500"/></td>
                    </tr>
                    
           				 <tr>
                    	  <td>Telefono: </td>
                        <td><input type="text" required="required" class="form-control" name="telefono" id="telefono" maxlength="100"/></td>
                   </tr>
                    	  <tr>
                    	  <td>RTN: </td>
                        <td><input type="text" required="required" class="form-control" name="rtn" id="rtn" maxlength="20"/></td>
                   </tr>
                   <tr>
                    	  <td>Contacto: </td>
                        <td><input type="text" required="required" class="form-control" name="contacto" id="contacto" maxlength="100"/></td>
                   </tr>
                   <tr>
                    	  <td>Correo: </td>
                        <td><input type="text" name="email" id="email" class="form-control" maxlength="100"/></td>
                  </tr>
                  <tr>
                        <td>Categoria: </td>
                        <td height="50" width="200"> 
                            <?php
                            //***********************************************
                            include'../conexion/conexion.php';
                            $registro = mysqli_query($conexion,"SELECT * FROM Categorias where Estado='Activo'");
                            ?>
                            <select id="categoria" name="categoria" required="required" class="form-control">
                            <option value="0">Elija una opcion</option>
                            <?php
                            while($registro2 = mysqli_fetch_array($registro)){
                            $Codigo=$registro2['CategoriaId'];
                            $Nombre=$registro2['Nombre'];
                            ?>
                            <option value="<?php echo $Codigo; ?>"><?php echo $Nombre;?></option>
                            <?php
                            }
                            ?>
                            </select>
                      </td>
                    </tr>
                    <tr>
                           <td>Proyecto </td>
                           <td height="50">
                              <select name="proyecto" id="proyecto" class="form-control">
                              <option value="NO"> No </option>   
                              <option value="SI"> Si </option>   
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
      
<?php include("../Modals/ModalExportarInstitucion.php"); ?>

  <div class="footer">
      <center>
        <p>Copyright © 2017 <a href="http://www.syteccop.com">SYTEC</a></p>
      </center>
      </div>
</body>
</html>
<?php

}else
{
  header("Location: ../index.php");
}

?>
