     <!-- InformacionEmpresa -->
<div id="InformacionE" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center> <h4 class="modal-title">Informacion de Empresa</h4> </center>
      </div>
      
    <form id="Informacion" class="formulario">
     <div class="modal-body">
       
       <table border="0" width="100%">
         <tr>
         <td>Proceso: </td>
         <td><input type="text" required="required" class="form-control" name="Proceso" id="Proceso" readonly/></td>
        </tr>
        <tr>
         <td>Nombre: </td>
         <td><input type="text" required="required" class="form-control" name="nombreInformacion" id="nombreInformacion"/></td>
        </tr>
        <tr>
          <td>RTN: </td>
          <td><input type="text" required="required" class="form-control" name="rtnInformacion" id="rtnInformacion"/></td>
        </tr>
          <tr>
          <td>Direccion: </td>
          <td><input type="text" required="required" class="form-control" name="direccionInformacion" id="direccionInformacion"/></td>
        </tr>
         <tr>
          <td>Telefono: </td>
          <td><input type="text" required="required" class="form-control" name="telefonoInformacion" id="telefonoInformacion"/></td>
        </tr>
        <tr>
          <td>Correo: </td>
          <td><input type="text" required="required" class="form-control" name="correo" id="correo"/></td>
        </tr> 
             <tr>
          <td>Web: </td>
          <td><input type="text" required="required" class="form-control" name="Sitioweb" id="Sitioweb"/></td>
        </tr> 

        <tr>
         <td colspan="2">
         <div id="mensajeInfoEmpresa"></div>
         </td>
        </tr>
       </table>
       </div>
      <div class="modal-footer">
        <input type="button" value="Agregar" class="btn btn-success" id="Agregar" onclick="agregaInformacionEmpresa();"/>
        <input type="button" value="Actualizar" class="btn btn-success" id="Actualizar" onclick="agregaInformacionEmpresa();"/>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
      </form>
    </div>

  </div>
</div>


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
                          <?php
                          //***********************************************
                          include'../conexion/conexion.php';
                          $registro = mysqli_query($conexion,"SELECT Contenedor FROM InventarioContenedor where EstadoIngreso = 'APLICADO' ");
                          ?>
                          <select id="NoContenedor" name="NoContenedor" class="selectpicker form-control" data-live-search="true" data-size="5" title="Buscar Contenedor">
                          <?php
                          while($registro2 = mysqli_fetch_array($registro)){
                          $Nombre=$registro2['Contenedor'];
                          ?>
                          <option value="<?php echo $Nombre; ?>" data-tokens="<?php echo $Nombre; ?>"><?php echo $Nombre;?></option>
                          <?php
                          }
                          ?>
                          </select>
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
