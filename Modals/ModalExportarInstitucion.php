 <!-- Modal productos -->
<div id="ModalExportarI" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       <center> <h4 class="modal-title" id="titulo">Exportar Listado Instituciones</h4> </center>
      </div>
      <div class="modal-body">

       <table border="0" align="center">
        <tr>
            <td>Tipo de Institucion: </td>
            <td height="50" width="200"> 
                              <?php
                             //***********************************************
                            include'../conexion/conexion.php';
                            $registro = mysqli_query($conexion,"SELECT * FROM TiposInstituciones where Estado='Activo'");
                            ?>
                            <select id="tipoInst2" name="tipoInst" required="required" class="form-control">
                            <option value="0">Elija una opcion</option>
                            <?php
                            while($registro2 = mysqli_fetch_array($registro)){
                            $Codigo=$registro2['Descripcion'];
                            $Nombre=$registro2['Descripcion'];
                            ?>
                            <option value="<?php echo $Codigo; ?>"><?php echo $Nombre;?></option>
                            <?php
                            }
                            ?>
                            </select>
          </td>
          <td width="10"></td>
          <td width="150"><button onclick="ExportarExcel(1);" class="btn btn-success btn-block">Exportar a Excel</button></td>
        </tr>
        <tr>
           <td>Categoria: </td>
                        <td height="50" width="200"> 
                            <?php
                            //***********************************************
                            include'../conexion/conexion.php';
                            $registro = mysqli_query($conexion,"SELECT * FROM Categorias where Estado='Activo'");
                            ?>
                            <select id="categoria2" name="categoria" required="required" class="form-control">
                            <option value="0">Elija una opcion</option>
                            <?php
                            while($registro2 = mysqli_fetch_array($registro)){
                            $Codigo=$registro2['Nombre'];
                            $Nombre=$registro2['Nombre'];
                            ?>
                            <option value="<?php echo $Codigo; ?>"><?php echo $Nombre;?></option>
                            <?php
                            }
                            ?>
                            </select>
           </td>
           <td width="10"></td>
           <td width="150"><button onclick="ExportarExcel(2);" class="btn btn-success btn-block">Exportar a Excel</button>
        </tr>
      </table>
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal productos -->