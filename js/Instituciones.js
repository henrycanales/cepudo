$('document').ready(function(){ 

		/* Validacion */
	 $("#formulario").validate({
      rules:
	  {
			codigoInst: {
			required: true,
			},
			nombreInst: {
			required: true,
			},
			direccion: {
			required: true,
			},
			telefono: {
			required: true,
			},
			rtn: {
			required: true,
			},
			contacto: {
			required: true,
			},


	   },
       messages:
	   {
            		codigoInst:{
                      required: "Ingrese Codigo.!"
                     },
           			nombreInst:{
                      required: "Ingrese nombre.!"
                     },
                     direccion:{
                      required: "Ingrese direccion.!"
                     },
                     telefono:{
                      required: "Ingrese telefono.!"
                     },
                     rtn:{
                      required: "Ingrese rtn.!"
                     },
                     contacto:{
                      required: "Ingrese contacto.!"
                     },

       },
	   submitHandler: agregaRegistro	
       });  
	   /* Validacion */

	pagination(1);

	$('#nuevo-producto').on('click',function(){

		$('#formulario')[0].reset();
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#reg').show();
	//var campo = document.getElementById('nombreUsuario');
	//campo.readOnly = false;
		$('#registra-producto').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	$('#bs-prod').on('keyup',function(){
		var pag=1;
		var dato = $('#bs-prod').val();
		var url = '../PHP/Instituciones.php';
		var items = document.getElementById("Items").value;

		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato+'&pag='+pag+'&items='+items,
		success: function(datos){
			 var array = eval(datos);

			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
	});
	
   $('#Items').change(function() {
    pagination(1);
	});


});

function pagination(pag){
	var url = '../PHP/Instituciones.php';
	var dato = document.getElementById("bs-prod").value;
	var items = document.getElementById("Items").value;
	
	if (dato==""){
		dato="Todo";
	}
	$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato+'&pag='+pag+'&items='+items,
		success:function(data){
			var array = eval(data);
			//alert(array[1]);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);

		}
	});
	return false;
}

function agregaRegistro(){

	var id = document.getElementById("id-prod").value;
	var items = document.getElementById("Items").value;
	var tipo = document.getElementById("tipoInst").value;
	var categoria = document.getElementById("categoria").value;

	if(tipo == 0 || categoria == 0){
		if(tipo == 0){
			swal("Error","No ha seleccionado el tipo de institucion.!","error");
			return false;
		}
		if(categoria == 0){
			swal("Error","No ha seleccionado el tipo de institucion.!","error");
			return false;
		}
	}
	else{
		var pag=1;
		var url = '../PHP/AgregarInstitucion.php';
		$.ajax({
			type:'POST',
			url:url,
			data:$('#formulario').serialize()+'&pag='+pag+'&id='+id+'&items='+items,
			success: function(registro){
				
				if(registro==1){
					swal("Exito","Se agrego registro correctamente.!","success");
					$('#formulario')[0].reset();
					pagination(1);
					return false;
				}
				if(registro==2){
					swal("Exito","Se actulizo registro correctamente.!","success");
					pagination(1);
					return false;
				}else{
					swal("Error",registro,"error");
					pagination(1);
					return false;
				}
			}
		});
		return false;
	}

}

function editarRegistro(id){
	$('#formulario')[0].reset();
	//var campo = document.getElementById('nombreUsuario');
	//campo.readOnly = true; // Se añade el atributo
	var url = '../PHP/EditarInstitucion.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(valores){
				var datos = eval(valores);
				$('#reg').hide();
				$('#edi').show();
				$('#pro').val('Edicion');
				$('#id-prod').val(id);
				$('#codigoInst').val(datos[0]);
				$('#nombreInst').val(datos[1]);
				$('#direccion').val(datos[2]);
				$('#telefono').val(datos[3]);
				$('#rtn').val(datos[4]);
				$('#contacto').val(datos[5]);
				$('#email').val(datos[6]);
				$('#tipoInst').val(datos[7]);
				$('#categoria').val(datos[8]);
				$('#proyecto').val(datos[9]);
				$('#registra-producto').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}


function eliminarRegistro(id){
	var pag=1;
	var url = '../PHP/EliminarInstitucion.php';
	var items = document.getElementById("Items").value;

  swal({
  title: "Esta Seguro?",
  text: "Que desea eliminar este registro!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Eliminarlo!",
  closeOnConfirm: false
},
function(){

  		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&pag='+pag+'&items='+items,
		success: function(registro){
			//alert(registro);
			if (registro==1){
			swal("Eliminado!", "Registro Eliminado correctamente.", "success");
			pagination(1);
			return false;
		}else{
			swal("Error", registro, "error");
			return false;
		}
		}
		});
 		 //swal("Eliminado!", "Registro Eliminado correctamente.", "success");
	});

}

function ExportarExcel(id){
	
	var Tipo = $('#tipoInst2').val();
	var categoria = $('#categoria2').val();

	if(Tipo == 0 && id==1 || categoria == 0 && id==2){

		if(Tipo == 0 && id==1){
			swal("Error","Debe de seleccionar un tipo de institucion.!","error");
		}
		if(categoria == 0 && id==2){
			swal("Error","Debe de seleccionar una categoria de institucion.!","error");
		}

	}else{
		if(id==1){
			location.href='../Reportes/ReporteInstituciones.php?dato1='+Tipo+'&dato2='+id+'';
	    }
	    if(id==2){
			location.href='../Reportes/ReporteInstituciones.php?dato1='+categoria+'&dato2='+id+'';
	    }
	}

}

function VerModal(){
	$('#ModalExportarI').modal('show');

}

