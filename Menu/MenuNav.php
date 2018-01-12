<?php


?>

<input type="hidden" name="Nivel_permiso" id="Nivel_permiso" value="<?php echo $_SESSION['session_nivel_cepudo'] ?>">


<link rel="stylesheet" href="../bootstrap/css/bootstrap-select.min.css">
<link href="../css/estilo.css" rel="stylesheet">
<script src="../bootstrap/js/bootstrap-select.min.js"></script>
<script src="../bootstrap/js/sweetalert.min.js"></script>
<link href="../bootstrap/css/sweetalert.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
<script src="../bootstrap/js/dropdown.js"></script>

<script src="../bootstrap/js/fileinput.min.js" type="text/javascript"></script>
<link href="../bootstrap/css/fileinput.css" media="all" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="../bootstrap/css/bootstrap-table.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="../bootstrap/js/bootstrap-table.min.js"></script>

<!-- Latest compiled and minified Locales -->
<script src="../bootstrap/js/bootstrap-table-zh-CN.min.js"></script>


<nav role="navigation" class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        <a href="../Inicio" class="navbar-brand"><img src="../recursos/cepudo.png" width="80" height="15"></a>
        </div>
 
        <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
      
  
      <!-- SUB MENU DONACIONES-->
      <li class="dropdown" id="Donaciones"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <span class="glyphicon glyphicon-tags"></span>
      Donaciones <span class="caret"></span></a>
      <ul class="dropdown-menu">
      <li><a href="../Donantes"> Ingresar Donante </a></li>
      <li><a href="../Donaciones"> Ingresar Donaciones </a></li>
      </ul>
      </li>

      <!-- SUBMENU EMBARQUES-->
      <li class="dropdown" id="Embarques"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <span class="glyphicon glyphicon-barcode"></span>
      Embarques <span class="caret"></span></a>
      <ul class="dropdown-menu">
      <li><a href="../Navieras"> Ingresar Naviera </a></li>
      <li><a href="../AgentesAduaneros"> Ingresar Agente Aduanero </a></li>
      <li><a href="../Aduanas"> Ingresar Aduana </a></li>
      <li><a href="../Embarques"> Ingresar Embarques </a></li>
      <li><a href="../Dispensas"> Dispensas </a></li>
      <li><a href="../DeclaracionAduanera"> Declaracion Unica Aduanera </a></li>
      </ul>
      </li>

      <!-- SUBMENU INVENTARIO-->
      <li class="dropdown" id="Inventario"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <span class="glyphicon glyphicon-bookmark"></span>
      Inventario <span class="caret"></span></a>
      <ul class="dropdown-menu">
      <li id="MProducto" ><a href="../Productos"> Ingresar Productos </a></li>
      <li id="MIngresar" ><a href="../IngresarInventario"> Ingresar Inventario </a></li>
      <li id="MAplicar" ><a href="../AplicarEntregas"> Aplicar Hojas de Entrega</a></li>
      <li id="MEntregas"><a href="../VerEntregas"> Ver Hojas de Entregas </a></li>

      <li id="MAjuste" ><a href="../AjusteInventario"> Ajustes de Inventario</a></li>
      <li id="MVerAjuste" ><a href="../VerAjustesInventario"> Ver Ajustes de Inventario</a></li>
      <li id="MReporte"><a href="#" id="ReporteContenedorDetalle"> Reporte De Productos Por Contenedor</a></li>
      </ul>
      </li>

      <li class="dropdown" id="Entregas"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <span class="glyphicon glyphicon-shopping-cart"></span>
      Entregas <span class="caret"></span></a>
      <ul class="dropdown-menu">
      <li><a href="../Entregas"> Ingresar Hoja de Entrega </a></li>
      <li><a href="../VerEntregas"> Ver Hojas de Entregas </a></li>
      <li><a href="../AutorizarAjustes"> Autorizar Ajustes de inventario </a></li>
      </ul>
      </li>

      <li class="dropdown" id="EntregasProyectos"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <span class="glyphicon glyphicon-th"></span>
      Entregas Proyectos<span class="caret"></span></a>
      <ul class="dropdown-menu">
      <li><a href="../EntregasProyectos"> Ingresar Entrega de Proyectos </a></li>
      <li><a href="../VerEntregasProyectos"> Ver Entregas de Proyectos </a></li>
      <li><a href="../BeneficiariosProyectos"> Beneficiarios de Proyectos </a></li>
      </ul>
      </li>
      
      <!-- SUBMENU CONTABILIDAD -->
      <li class="dropdown" id="Conta"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <span class="glyphicon glyphicon-folder-open"></span>
      Contabilidad<span class="caret"></span></a>
      <ul class="dropdown-menu">
      <li><a href="../Contabilidad"> Reporte Contable </a></li>
      <li><a href="../Regimen"> Regimen </a></li>
      </ul>
      </li>

      <!-- SUBMENU ADMINISTRACION -->
      <li class="dropdown" id="Administracion"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
      <span class=" glyphicon glyphicon-cog"></span>
      Administracion<span class="caret"></span></a>
      <ul class="dropdown-menu">
      <li><a href="../Categorias"> Categorias de Beneficiario </a></li>
      <li><a href="../TipoInstitucion"> Tipos de Instituciones </a></li>
      <li><a href="../Instituciones"> Instituciones </a></li>
      <li><a id="InformacionEmpresa" href="#"> Informacion Empresa </a></li>
      <li id="MUsuarios" ><a href="../Usuarios"> Usuarios </a></li>
      </ul>
      </li>

       </ul>

            <ul class="nav navbar-nav navbar-right">
               <!-- <li class="active"><a href="#">Cerrar Sesion</a></li>-->
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
             <span class="glyphicon glyphicon-user">
             </span>
             <?php echo $_SESSION['session_nombre_cepudo'];?>
             <span class="caret"></span></a>
             <ul class="dropdown-menu">
	     <li><a href="#" onclick="mostrarContrasena();"> Cambiar Password </a></li>
             <li><a href="../logout.php"> Cerrar Sesion </a></li>
             
        </ul>
      </li>

 
             </li>
             </ul>
        </div>
</nav>


<!--Termina Menu Nav -->

<!--Incluir los Modal Utizados -->
<?php
include('../Modals/ModalinformacionEmpresa.php'); //Modal Informacion Empresa
include('../Modals/ModalContrasena.php'); //Modal Contrasena
/*
include ('ModalContrasenaCorreo.php');
include ('ModalEnviarCorreo.php');
include ('ModalPago.php');
include ('ModalPagoDetalle.php');

include('../Modals/ModalContrasena.php'); //Modal Contrasena
include('../Modals/ModalFacturaD.php'); //Modal Contrasena
*/


?>
