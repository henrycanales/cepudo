<?PHP
session_start();
$Fecha = date("Y-m-d");
$IdUsuario=$_SESSION['session_nombre_cepudo'];

if($_SESSION['session_nivel_cepudo']=="root" || $_SESSION['session_nivel_cepudo']=="Inventario" || $_SESSION['session_nivel_cepudo']=="Administrador")
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajuste Inventario</title>
<script src="../js/jquery.js"></script>
<script src="../js/Global.js"></script>
<script src="../js/AjusteInventario.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>


<?php include ('../Menu/MenuNav.php'); ?>
</head>
    <center>
    <h1>AJUSTE DE INVENTARIO</h1>
    <section>
    

    <input type="hidden" id="Presentacion" name="Presentacion" value="">
    <input type="hidden" id="CodigoP" name="CodigoP" value="">
    <input type="hidden" id="contador" name="contador" value="0">
    <input type="hidden" id="IdSession" name="IdSession" value="<?php echo $IdUsuario;?>">

    <form id="formulario" class="formulario">

    <table border="0" width="98%">
    	<tr>
          <td height="50" width="10%">
          <label> Tipo Ajuste: </label>&nbsp;

          </td>
          <td height="50" width="10%" >
         
            <select name="tipoAjuste" id="tipoAjuste" class="selectpicker remove-example form-control" title="Seleccione Tipo Ajuste..." required="required">
              <option value="Entrada"> Entrada a Inventario</option>
              <option value="Salida"> Salida de Inventario </option>
            </select>
         </td>

          <td height="50" width="10%">
          <label> Comentario: </label>&nbsp;
          </td>
        	<td height="50" width="45%" >
            <textarea class="form-control" rows="2" id="Comentario" name="Comentario" required="required" placeholder="Ingrese Comentario del Ajuste de Inventario.!"></textarea>
         </td>
          <td height="50" width="10%">
          <label> Fecha: </label>&nbsp;
          </td> 
          <td height="50" width="10%" colspan="2">
          <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $Fecha; ?>"/>
          </td>
      </tr>
      <tr>
           <td height="50" colspan="2">
           <input type="button" id="Buscar" onclick="BuscarProducto()" value="Buscar Producto" class="btn btn-info form-control" />
           </td>

           <td height="50" >
           <label> Producto: </label>
           </td>
           <td height="50" >
           <input type="text" id="Producto" name="Producto" readonly class="form-control" />
           </td>
          <td height="50" >
           <label> Cantidad: </label>
           </td>
           <td height="50">
           <input type="number" id="Cantidad" name="Cantidad" value="0"class="form-control" />
           </td>
           <td height="50">
           <button type="button" class="btn btn-success glyphicon glyphicon-plus " onClick="nuevo();"> </button>
           </td>
        </tr>

    </table>

    <table border="0" width="95%" class="table table-striped table-condensed table-hover">
      <thead>
           <tr>
           <th height="50" width="50" style="text-align:center">Codigo</th>
           <th height="50" width="300" style="text-align:center" >Descripcion</th>
           <th height="50" width="100" style="text-align:center">Cantidad</th>
           <th height="50" width="50" style="text-align:left">Eliminar</th>
          </tr>
     </thead>
         <tbody id="tablaDetalleProducto">
         </tbody>
   
    </table>
    </br>
    </br>
    <input type="submit" id="enviar" value="Guardar Registro" class="btn btn-primary form-control" >

    </form>
    </section>

  </center>
  <div class="footer">
      <center>
        <p>Copyright © 2017 <a href="http://www.syteccop.com">SYTEC</a></p>
      </center>
      </div>
<?php 
include('../Modals/ModalProductos.php');
?>
</body>
</html>
<?php

}else{
    header("Location: ../index.php ");
}
?>
