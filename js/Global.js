$('document').ready(function(){ 

nivel=document.getElementById("Nivel_permiso").value;


document.getElementById("Donaciones").style.display = "none"
document.getElementById("Embarques").style.display = "none"
document.getElementById("Inventario").style.display = "none"
document.getElementById("Entregas").style.display = "none"
document.getElementById("EntregasProyectos").style.display = "none"
document.getElementById("Administracion").style.display = "none"
document.getElementById("Conta").style.display = "none"

if(nivel=="DyE"){
document.getElementById("Donaciones").style.display = "block"
document.getElementById("Embarques").style.display = "block"
}
if(nivel=="Donaciones"){
document.getElementById("Donaciones").style.display = "block"
}
if(nivel=="Embarques"){
document.getElementById("Embarques").style.display = "block"
}
if(nivel=="Inventario"){
document.getElementById("Inventario").style.display = "block"
document.getElementById("MEntregas").style.display = "none"
}
if(nivel=="AplicarEntrega"){
document.getElementById("Inventario").style.display = "block"
document.getElementById("MEntregas").style.display = "block"
document.getElementById("MProducto").style.display = "none"
document.getElementById("MIngresar").style.display = "none"
document.getElementById("MAjuste").style.display = "none"
document.getElementById("MVerAjuste").style.display = "none"
document.getElementById("MReporte").style.display = "none"
}
if(nivel=="Entregas"){
document.getElementById("Entregas").style.display = "block"
}
if(nivel=="EntregasProyecto"){
document.getElementById("EntregasProyectos").style.display = "block"
}
if(nivel=="Contabilidad"){
document.getElementById("Conta").style.display = "block"
}
if(nivel=="root"){
document.getElementById("Donaciones").style.display = "block"
document.getElementById("Embarques").style.display = "block"
document.getElementById("Inventario").style.display = "block"
document.getElementById("Entregas").style.display = "block"
document.getElementById("EntregasProyectos").style.display = "block"
document.getElementById("Administracion").style.display = "block"
document.getElementById("Conta").style.display = "block"
}
if(nivel=="Administrador"){
document.getElementById("Administracion").style.display = "block"
document.getElementById("Inventario").style.display = "block"
document.getElementById("MUsuarios").style.display ="none"
document.getElementById("MEntregas").style.display = "none"

}

	$('#InformacionEmpresa').on('click',function(){
		
		InformacionEmpresa();
	});
	$('#ReporteContenedorDetalle').on('click',function(){

		verModalReporte();

	});



});
/*
function pagination(partida){
	var url = '../php/EmpleadoS.php';
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}
*/
function agregaInformacionEmpresa(){

	var url = '../PHP/AgregarInformacionEmpresa.php';
	var nombreInformacion = document.getElementById("nombreInformacion").value;
	var rtnInformacion = document.getElementById("rtnInformacion").value;
	var direccionInformacion = document.getElementById("direccionInformacion").value;
	var telefonoInformacion = document.getElementById("telefonoInformacion").value;
	var correo = document.getElementById("correo").value;

	if(nombreInformacion == '' || rtnInformacion == '' || direccionInformacion == '' || telefonoInformacion == '' || correo == '' ){

		if(nombreInformacion == ''){
			swal("Error","Debe Introducir Nombre de Empresa","error");
			return false;
		}
		if(rtnInformacion == ''){
			swal("Error","Debe Introducir RTN","error");
			return false;
		}
		if(direccionInformacion == ''){
			swal("Error","Debe Introducir Direccion","error");
			return false;
		}
		if(telefonoInformacion == ''){
			swal("Error","Debe Introducir Numero de Telefono","error");
			return false;
		}
		if(correo == ''){
			swal("Error","Debe Introducir Correo","error");
			return false;
		}

	}else{

		$.ajax({
			type:'POST',
			url:url,
			data:$('#Informacion').serialize(),
			success: function(registro){
				
				if (registro==1){
				swal("Exito","Se agrego la Informacion Correctamente.!","success");
				return false;
				}
				if(registro==2){
				swal("Exito","Se actualizo la Informacion Correctamente.!","success");
				return false;
				}
				else{
				swal("Error",registro,"error");
				return false;
				}
			}
		});
		return false;
	}
}

function InformacionEmpresa(){

	//$('#InformacionEmpresa')[0].reset();
	$('#InformacionE').modal('show')
	var url = '../PHP/EditarInformacionEmpresa.php';
		$.ajax({
		type:'POST',
		url:url,
		success: function(valores){

				var datos = eval(valores);

				if(datos[0]==null){
				$('#Proceso').val("Agregar");
				$('#Actualizar').hide();
				$('#Agregar').show();
				}else{
				$('#Proceso').val("Editar");
				$('#Agregar').hide();
				$('#Actualizar').show();
				$('#nombreInformacion').val(datos[0]);
				$('#rtnInformacion').val(datos[1]);
				$('#direccionInformacion').val(datos[2]);
				$('#telefonoInformacion').val(datos[3]);
				$('#correo').val(datos[4]);
				$('#Sitioweb').val(datos[5]);
				$('#AgregarInformacion').hide();
				$('#ActualizarInformacion').show();
			return false;
		}
		}
	});
	return false;
}


function seleccionarEmpleado(id){
	document.getElementById("Empleado").value=id;
	 $('#myModal').modal('hide');
}

function verModal(){
$('#myModal').modal('show')
}

function verModalContrasena(){
$('#Contrasena').modal('show')
}

function verModalReporte(){
	
		$('#ReporteContenedor').modal('show');
}


function cambiarContrasena(){
	var pag=(pagination(1));
	var url = '../PHP/CambiarContrasena.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#contrasena').serialize()+'&pag='+pag,
		success: function(response){
			if(response==1){
			$('#contrasena')[0].reset();
			$('#mensaje').html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Cambio Realizado Correctamente !</div>').show(200).delay(2500).hide(200);
			return false;
			}else{
			$('#mensaje').html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>').show(200).delay(2500).hide(200);
			
			return false;
			}
		}
	});
	return false;
}


function VerReporteContenedor(){
	var contenedor = $('#NoContenedor').val();
	var boton = document.getElementById("botonExportar");
	document.getElementById("botonExportar").disabled=false;

	var url = '../PHP/Verificareporte.php';

	if(contenedor ==''){
		swal("Error","No debe dejar en blanco el campo.!","error");
	}else{
		document.getElementById("botonExportar").disabled=true;
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+contenedor,
		success: function(response){
			
			if(response=='Ok'){
			var pagina = '../Reportes/InventarioXContenedor.php?dato='+contenedor
			window.open(pagina,'',''); 
			document.getElementById("botonExportar").disabled=false;
			$('#NoContenedor').val('');
			return false;
			}else{
				swal("Error",response,"error");
				document.getElementById("botonExportar").disabled=false;
			    return false;
			}


		}
	});
	return false;
	}


}

function mostrarContrasena(){

$('#Contrasena').modal('show');
$('#passAnterior').val("");
$('#passNueva').val("");
$('#passConfirme').val("");
//$('#usuario').val("");
}

function  updatePass(){

	var passOld = $('#passAnterior').val();
	var newPass = $('#passNueva').val();
	var confirmarPass = $('#passConfirme').val();


	if (passOld == ''){
		swal("Error","Debe introducir Contrasena Anterior","error");
		return false;
	}else{
		if(newPass == confirmarPass){
			var url = '../PHP/updateContrasena.php';
			$.ajax({
			type:'POST',
			url:url,
			data:'passAnterior='+passOld+'&passNew='+newPass,
			success: function(registro){
				if(registro == 1){
					swal("Exito ","Cambio realizado exitosamente.!","success");
					$('#passAnterior').val("");
					$('#passNueva').val("");
					$('#passConfirme').val("");
					return false;
				}else{
					swal("Error",registro,"error");
					return false;	
				}
			}
			});
			return false;
		}else{
			swal("Error","Error Contrasenas no coinciden.!","error");
			return false;
		}
	}
}
