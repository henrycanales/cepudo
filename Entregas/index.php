<?PHP
session_start();
$Fecha = date("Y-m-d");
$IdUsuario=$_SESSION['session_nombre_cepudo'];
if($_SESSION['session_nivel_cepudo']=="Entregas" || $_SESSION['session_nivel_cepudo']=="root")
{

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entrega Donacion</title>
<script src="../js/jquery.js"></script>
<script src="../js/Global.js"></script>
<script src="../js/Entregas.js"></script>
<script type="text/javascript" src="../js/validation.min.js"></script>


<?php include ('../Menu/MenuNav.php'); ?>
</head>
    <center>
    <h1>Ingresar hoja de Donacion</h1>
    <section>
    

    <input type="hidden" id="Presentacion" name="Presentacion" value="">
    <input type="hidden" id="CodigoP" name="CodigoP" value="">
    <input type="hidden" id="contador" name="contador" value="0">
    <input type="hidden" id="IdSession" name="IdSession" value="<?php echo $IdUsuario;?>">

    <form id="formulario" class="formulario">

    <table border="0" width="98%">
    	<tr>

          <td height="50" width="10%">
          <label> Institucion: </label>&nbsp;

          </td>
        	<td height="50" width="15%" >
            <?php
              //***********************************************
              include'../conexion/conexion.php';
              $registro = mysqli_query($conexion,"SELECT * FROM Instituciones where Estado='A'");
              ?>
              <select name="Institucion" id="Institucion" class="selectpicker remove-example form-control" data-live-search="true"  data-size="10" title="Seleccione Beneficiarios...">
              <?php
              while($registro2 = mysqli_fetch_array($registro)){
              $Codigo=$registro2['InstitucionId'];
              $Nombre=$registro2['Nombre'];
              ?>
              <option value="<?php echo $Codigo; ?>"data-tokens="<?php echo $Nombre; ?>"><?php echo $Nombre;?></option>
              <?php
              }
            ?>
            </select>
         </td>

          <td height="50" width="5%">
          <label> RTN: </label>&nbsp;
          </td> 
          <td height="50" width="20%">
          <input type="text" name="RTN" id="RTN" class="form-control" readonly />
          </td>

          <td height="50" width="8%">
          <label> Direccion: </label>&nbsp;
          </td> 
          <td height="50" width="22%">
          <input type="text" name="direccion" id="direccion" class="form-control" readonly />
          </td>
          <td height="50" width="6%">
          <label> Fecha: </label>&nbsp;
          </td> 
          <td height="50" width="14%">
          <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $Fecha; ?>"/>
          </td>
      </tr>
    </table>
    </br>
    <table border="0" width="98%">

        <tr>
           <td height="50" width="25%">
           <input type="button" id="Buscar" onclick="BuscarProducto()" value="Buscar Producto" class="btn btn-info form-control" />
           </td>
           <td height="50" width="5%">
           <label> Contenedor: </label>
           </td>
           <td height="50" width="20%">
           <input type="text" id="Contenedor" name="Contenedor" readonly class="form-control" />
           </td>
           <td height="50" width="8%">
           <label> Producto: </label>
           </td>
           <td height="50" width="22%">
           <input type="text" id="Producto" name="Producto" readonly class="form-control" />
           </td>
           <td height="50" width="5%">
           <label> Stock: </label>
           </td>
           <td height="50" width="5%">
           <input type="text" id="Stock" name="Stock" readonly class="form-control" />
           </td>
          <td height="50" width="6%">
           <label> Cantidad: </label>
           </td>
           <td height="50" width="13%">
           <input type="number" id="Cantidad" name="Cantidad" value="0"class="form-control" />
           </td>
           <td height="50" width="1%">
           <button type="button" class="btn btn-success glyphicon glyphicon-plus " onClick="nuevo();"> </button>
           </td>
        </tr>

    </table>

    <table border="0" width="95%" class="table table-striped table-condensed table-hover">
      <thead>
           <tr>
           <th height="50" width="100">Contenedor</th>
           <th height="50" width="50">Codigo</th>
           <th height="50" width="300">Descripcion</th>
           <th height="50" width="100">Cantidad</th>
           <th height="50" width="100">Presentacion</th>
           <th height="50" width="100">Eliminar</th>
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
