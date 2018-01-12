$('document').ready(function(){ 

		/* Validacion */
	 $("#formulario").validate({
      rules:
	  {
			nombreUsuario: {
			required: true,
			},
			pass: {
            required: true,
            
            },
            confirmePass: {
            required: true,
            
            },
            nombre: {
            required: true,
            
            },
	   },
       messages:
	   {
            nombreUsuario:{
                      required: "Ingrese Nombre de Usuario"
                     },
            pass: "Ingrese contraseña",
            confirmePass: "Confirme su contraseña",
            nombre: "Ingrese Nombre",
           
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
	var campo = document.getElementById('nombreUsuario');
	campo.readOnly = false;
		$('#registra-producto').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	$('#bs-prod').on('keyup',function(){
		var pag=1;
		var dato = $('#bs-prod').val();
		var url = '../PHP/Usuarios.php';
		var items = document.getElementById("Items").value;

		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato+'&pag='+pag+'&items='+items,
		success: function(datos){
			 var array = eval(datos);
			// alert(array[0]);
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
	var url = '../PHP/Usuarios.php';
	var dato = document.getElementById("bs-prod").value;
	var items = document.getElementById("Items").value;

	if (dato==undefined){
		dato="Todo";
	}
	$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato+'&pag='+pag+'&items='+items,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);

		}
	});
	return false;
}

function agregaRegistro(){
	var pass = document.getElementById("pass").value;
	var confirmePass = document.getElementById("confirmePass").value;
	var id = document.getElementById("id-prod").value;
	var items = document.getElementById("Items").value;

	if(pass == confirmePass){
	var pag=1;
	var url = '../PHP/AgregarUsuario.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize()+'&pag='+pag+'&id='+id+'&items='+items,
		success: function(registro){
			if(registro==1){
			swal("Error","Usuario ya existe.!","error");
			return false;
			}
			else{
			if ($('#pro').val() == 'Registro'){
			$('#formulario')[0].reset();
			$('#pro').val('Registro');
			swal("Exito","Registro agregado correctamente.!","success");

			$('#agrega-registros').html(registro);
			return false;
			}else{
			swal("Exito","Registro se actualizo correctamente.!","success");
			$('#agrega-registros').html(registro);
			return false;
		}
		}
		}
	});
	return false;
}else{
	swal("Error","Las contraseñas no son iguales.!","error");
	return false;
}
return false;

}

function editarRegistro(id){
	$('#formulario')[0].reset();
	var campo = document.getElementById('nombreUsuario');
	campo.readOnly = true; // Se añade el atributo
	var url = '../PHP/EditarUsuario.php';
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
				$('#nombreUsuario').val(datos[0]);
				$('#pass').val(datos[1]);
				$('#confirmePass').val(datos[1]);
				$('#nombre').val(datos[2]);
				$('#nivel').val(datos[3]);
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
	var url = '../PHP/EliminarUsuario.php';
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

