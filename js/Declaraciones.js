$('document').ready(function(){ 

		/* Validacion */
	 $("#formulario").validate({
      rules:
	  {
			numeroEmbarque: {
			required: true,
			},
            numeroPoliza: {
            required: true,
            
            },
            fechaPoliza: {
            required: true,
            
            },
	   },
       messages:
	   {
            numeroEmbarque:{
                      required: "Ingrese Numero de Embarque.!"
                     },
            numeroPoliza: "Ingrese Numero de Poliza.!",
            fechaPoliza: "Ingrese fecha de poliza.!",
           
       },
	   submitHandler: agregaRegistro	
       });  
	   /* Validacion */

	pagination(1);

$('#numeroEmbarque').keypress(function (e) {
    if (e.which == 13) {
        buscarEmbarque();
    }
});
	$('#nuevo-producto').on('click',function(){

		$('#formulario')[0].reset();
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#reg').show();

		//var campo = document.getElementById('Recepcion');
		//campo.style.display = "none";



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
		var url = '../PHP/Declaraciones.php';
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
	var url = '../PHP/Declaraciones.php';
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

	var url = '../PHP/AgregarDeclaracion.php';
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
	
	var url = '../PHP/EditarDeclaracion.php';
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
				$('#numeroEmbarque').val(datos[0]);
				$('#numeroDispensa').val(datos[1]);
				$('#fechaRecepcion').val(datos[2]);
				$('#tipoDonacion').val(datos[3]);
				$('#valorFactura').val(datos[4]);
				$('#valorFlete').val(datos[5]);
				$('#valorSeguro').val(datos[6]);
				$('#otrosGastos').val(datos[7]);
				$('#numeroPoliza').val(datos[8]);
				$('#fechaPoliza').val(datos[9]);
				$('#observacion').val(datos[10]);
				$('#tasaCambio').val(datos[11]);
				$('#ajustes').val(datos[12]);
				$('#cifImponibles').val(datos[13]);
				
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

function buscarEmbarque()
{
    var id = document.getElementById("numeroEmbarque").value;

	var url = '../PHP/BuscarDispensaRecibida.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize()+'&id='+id,
		success: function(registro){
			var datos = eval(registro);

			    if(datos[0]==null){
				swal("Error","Embarque no es correcto.!","error");
		        return false;
			    }else{

				$('#numeroDispensa').val(datos[0]);
				$('#fechaRecepcion').val(datos[1]);	
				$('#tipoDonacion').val(datos[2]);
				$('#valorFob').val(datos[3]);
				$('#valorFlete').val(datos[4]);
				$('#valorSeguro').val(datos[5]);	
				return false;

			    }
		
	    }
	});
	return false;

}

function exportarExcel(){
	var dato = document.getElementById("bs-prod").value;
	var fecha = document.getElementById("mes").value;

	//window.open('../Reportes/ReporteExcel.php?fechaInicio='+fechaInicio+'&fechaFin='+fechaFin+'&lugar='+lugar+'&evento='+evento);
//	window.open('../Reportes/ReporteExcel.php?dato='+dato);
	location.href='../Reportes/ReporteExcel.php?dato='+dato+'&Fecha='+fecha+'';

}



