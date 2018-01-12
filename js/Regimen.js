$('document').ready(function(){ 

			/* Validacion */
	 $("#formulario").validate({
      rules:
	  {
			cai: {
			required: true,
			},
			correlativod: {
			required: true,
			},
			correlativoh: {
			required: true,
			},
			fecha: {
			required: true,
			},
			comprobanteRegimen: {
			required: true,
			},
			noComprobante: {
			required: true,
			},


	   },
       messages:
	   {
            		cai:{
                      required: "Ingrese CAI.!"
                     },
           			correlativod:{
                      required: "Ingrese correlativo desde.!"
                     },
                     correlativoh:{
                      required: "Ingrese correlativo hasta.!"
                     },
                     fecha:{
                      required: "Ingrese fecha autorizacion.!"
                     },
                     comprobanteRegimen:{
                      required: "Ingrese el comprobanteRegimen.!"
                     },
                     noComprobante:{
                      required: "Ingrese el numero de comprobante.!"
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
		$('#RegimenF').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	$('#bs-prod').on('keyup',function(){
		var pag=1;
		var dato = $('#bs-prod').val();
		var url = '../PHP/Regimen.php';
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
	var url = '../PHP/Regimen.php';
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
	var url = '../PHP/AgregarRegimen.php';
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
	var url = '../PHP/EditarRegimen.php';
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
				$('#cai').val(datos[0]);
				$('#correlativod').val(datos[1]);
				$('#correlativoh').val(datos[2]);
				$('#fecha').val(datos[3]);
				$('#comprobanteRegimen').val(datos[4]);
				$('#noComprobante').val(datos[5]);
				$('#RegimenF').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}



function habilitarRegistro(id,condicion){

	var url = '../PHP/HabilitarRegimen.php';

		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&condicion='+condicion,
		success: function(data){

			swal("Mensaje",data,"info");
			pagination(1);
			return false;
		}
	});
	return false;
}


function eliminarRegistro(id){

	var url = '../PHP/EliminarRegimen.php';

		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(data){

			swal("Mensaje",data,"info");
			pagination(1);
			return false;
		}
	});
	return false;
}
