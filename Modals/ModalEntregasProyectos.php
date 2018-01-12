<!-- Modal clientes -->
<div id="VerEP" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center> <h4 class="modal-title">Productos</h4> </center>
      </div>
      <div class="modal-body">

      <table border="0" width="98%">
      <tr>

          <td height="50" >
          <label> Beneficiarios: </label>&nbsp;

          </td>
          <td height="50"  >
            <?php
              //***********************************************
              include'../conexion/conexion.php';
              $registro = mysqli_query($conexion,"SELECT * FROM BeneficiariosProyectos where Estado='A'");
              ?>
              <select name="beneficiario2" id="beneficiario2" class="selectpicker remove-example form-control" data-live-search="true"  data-size="10" title="Seleccione Beneficiarios...">
              <?php
              while($registro2 = mysqli_fetch_array($registro)){
              $Codigo=$registro2['BeneficiarioId'];
              $Nombre=$registro2['Nombre'];
              ?>
              <option value="<?php echo $Codigo; ?>"data-tokens="<?php echo $Nombre; ?>"><?php echo $Nombre;?></option>
              <?php
              }
            ?>
            </select>
         </td>
         <td width="2%"></td>
         <td id="nombreBeneficiario" style="color:green">&nbsp;</td>
       </tr>
     </table>
    <center>
    <div id="agrega-registrosProductos"></div>


    <ul class="pagination" id="pagination"></ul>
    </center>
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="actualizar" onclick="ActualizarEP();">Actualizar</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal clientes -->