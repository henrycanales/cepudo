$('document').ready(function(){ 

		/* Validacion */
	 $("#formulario").validate({
      rules:
	  {
			NEmbarque: {
			required: true,
			},
			fechaDispensa: {
            required: true,
            
            },
	   },
       messages:
	   {
            NEmbarque:{
                      required: "Ingrese Numero de Embarque.!"
                     },
            fechaDispensa: "Ingrese Fecha Dispensa.!",
           
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

		var campo = document.getElementById('Recepcion');
		campo.style.display = "none";

		var campo2 = document.getElementById('FilaImagen');
		campo2.style.display = "none";

		$("#mensajeImagen").html("");

		$('#registra-producto').modal({
			show:true,
			backdrop:'static'
		});
	});

	$('#subirImagen').on('click',function(){

	agregaImagen();
	});
	
	$('#bs-prod').on('keyup',function(){
		var pag=1;
		var dato = $('#bs-prod').val();
		var url = '../PHP/Dispensas.php';
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
	var url = '../PHP/Dispensas.php';
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
	var Usuario = document.getElementById("IdSession").value;

	var url = '../PHP/AgregarDispensa.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize()+'&id='+id+'&usuario='+Usuario,
		success: function(registro){

			if(registro==1){
			$('#formulario')[0].reset();
			$('#pro').val('Registro');
			swal("Exito","Registro agregado correctamente.!","success");
			pagination(1);
			return false;
			}
			if(registro==2){
			swal("Exito","Registro se actualizo correctamente.!","success");
			pagination(1);
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

function editarRegistro(id){
	$('#formulario')[0].reset();
	var campo = document.getElementById('Recepcion');
	campo.style.display = "";

	var campo2 = document.getElementById('FilaImagen');
	campo2.style.display = "";



	var url = '../PHP/EditarDispensa.php';
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
				$('#NEmbarque').val(datos[0]);
				$('#fechaDispensa').val(datos[1]);
				$('#NDispensa').val(datos[2]);
				$('#fechaRecepcion').val(datos[3]);
				$('#mensajeImagen').html('PDF SUBIDO');
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
	var url = '../PHP/EliminarDispensa.php';

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
		data:'id='+id,
		success: function(registro){
			//alert(registro);
			if(registro==1){	
			 swal("Eliminado!", "Registro Eliminado correctamente.", "success");
			 pagination(1);
			 return false;
			}else{
			swal("Error", registro , "error");	
			return false;
			}
		}
		});
 		 //swal("Eliminado!", "Registro Eliminado correctamente.", "success");
	});

}

function agregaImagen(){

	var url = '../PHP/uploader.php';
	var formData = new FormData($("#formulario")[0]);
	
	//alert(formData);

	 $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success: function(datos)
                {
                    $("#mensajeImagen").html(datos);
                    //alert(datos);
                    return false;
                }
            });
	return false;
}

function VerImagen(id){

	if(id != ''){
	var pagina = id;
	opciones='toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes,width=800, height=800, top=0, left=0';
	window.open(pagina,'',opciones); 
	}else{
		swal("Error", "No han subido PDF a esta dispensa.!","error");
		return false;
	}


}





