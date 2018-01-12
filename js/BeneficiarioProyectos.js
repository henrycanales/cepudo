$('document').ready(function(){ 

		/* Validacion */
	 $("#formulario").validate({
      rules:
	  {
			nombreBeneficiario: {
			required: true,
			},
			direccion: {
			required: true,
			},
			telefono: {
			required: true,
			},
			contacto: {
			required: true,
			},


	   },
       messages:
	   {

           			nombreBeneficiario:{
                      required: "Ingrese nombre.!"
                     },
                     direccion:{
                      required: "Ingrese direccion.!"
                     },
                     telefono:{
                      required: "Ingrese telefono.!"
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
		var url = '../PHP/BeneficiariosProyectos.php';
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
	var url = '../PHP/BeneficiariosProyectos.php';
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

		var pag=1;
		var url = '../PHP/AgregarBeneficiarioProyectos.php';
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

function editarRegistro(id){
	$('#formulario')[0].reset();
	//var campo = document.getElementById('nombreUsuario');
	//campo.readOnly = true; // Se añade el atributo
	var url = '../PHP/EditarBeneficiariosProyectos.php';
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
				$('#nombreBeneficiario').val(datos[1]);
				$('#direccion').val(datos[2]);
				$('#telefono').val(datos[3]);
				$('#contacto').val(datos[4]);
				$('#email').val(datos[5]);
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
	var url = '../PHP/EliminarBeneficiariosProyectos.php';
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

function ExportarExcel(){
 
	location.href='../Reportes/ReporteBeneficiariosProyectos.php';

}
