$('document').ready(function(){ 

		/* Validacion */
	 $("#formulario").validate({
      rules:
	  {
			nombreDonante: {
			required: true,
			},
			direccionDonante: {
            required: true,
            
            },
            telefonoDonante: {
            required: true,
            
            },
            contactoDonante: {
            required: true,
            
            },
            correoDonante: {
            required: true,
            
            },
	   },
       messages:
	   {
            nombreDonante:{
                      required: "Ingrese Nombre de Donante.!"
                     },
            direccionDonante: "Ingrese Direccion.!",
            telefonoDonante: "Ingrese Telefono.!",
            contactoDonante: "Ingrese Contacto.!",
            correoDonante: "Ingrese Correo.!",
           
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
		var url = '../PHP/Donantes.php';
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
	var url = '../PHP/Donantes.php';
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
	var Usuario = document.getElementById("IdSession").value;

	var pag=1;
	var url = '../PHP/AgregarDonante.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize()+'&pag='+pag+'&id='+id+'&items='+items+'&usuario='+Usuario,
		success: function(registro){
			if(registro==1){
			$('#formulario')[0].reset();
			$('#pro').val('Registro');
			swal("Exito","Registro agregado correctamente.!","success");
			pagination(1);
			return false;
			}if(registro==2){
			swal("Exito","Registro se actualizo correctamente.!","success");
			pagination(1);
			return false;
		    }else{
		    swal("Error",registro,"error");
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
	var url = '../PHP/EditarDonante.php';
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
				$('#nombreDonante').val(datos[0]);
				$('#direccionDonante').val(datos[1]);
				$('#telefonoDonante').val(datos[2]);
				$('#faxDonante').val(datos[3]);
				$('#contactoDonante').val(datos[4]);
				$('#correoDonante').val(datos[5]);
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
	var url = '../PHP/EliminarDonante.php';
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
			$('#agrega-registros').html(registro);
			return false;
		}
		});
 		 swal("Eliminado!", "Registro Eliminado correctamente.", "success");
	});

}

