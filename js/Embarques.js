$('document').ready(function(){ 

		/* Validacion */
	 $("#formulario").validate({
      rules:
	  {
			numeroEmbarque: {
			required: true,
			},
			naviera: {
            required: true,
            
            },
            fechaEstimada: {
            required: true,
            
            },
            agente: {
            required: true,
            
            },
            aduana: {
            required: true,
            
            },
            estadoDispensa: {
            required: true,
            
            },
            valorFlete: {
            required: true,
            
            },
            valorFactura: {
            required: true,
            
            },
            valorSeguro: {
            required: true,
            
            },
            observacion: {
            required: true,
            
            },
            numeroBL: {
            required: true,
            
            },
            numeroContenedor: {
            required: true,
            
            },
            observacionContenedor: {
            required: true,
            
            },

	   },
       messages:
	   {
            numeroEmbarque:{
                      required: "Ingrese numero de embarque.!"
                     },
            naviera: "Ingrese nombre de naviera.!",
            fechaEstimada: "Ingrese la fecha estimada.!",
            agente: "Ingrese agencia aduanera.!",
            aduana: "Ingrese la aduana.!",
            estadoDispensa:"Ingrese estado de embarque.!",
            valorFlete: "Ingrese valor del flete.!",
            valorFactura: "Ingrese valor de factura.!",
            valorSeguro: "Ingrese valor del seguro.!",
            observacion: "Ingrese observacion.!",
            numeroBL:"Ingrese numeroBL.!",
            numeroContenedor: "Ingrese numero contenedor.!",
            observacionContenedor:"Ingrese observacion de contenedor.!",
            po:"Ingrese PO.!",
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

		var campo = document.getElementById('FilaContenedor');
		campo.style.display = "";

		document.getElementById("numeroEmbarque").disabled=false;

		$('#registra-producto').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	$('#bs-prod').on('keyup',function(){
		var pag=1;
		var dato = $('#bs-prod').val();
		var url = '../PHP/Embarques.php';
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
	var url = '../PHP/Embarques.php';
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

	var agencia = document.getElementById("agente").value;
	var aduana = document.getElementById("aduana").value;
	var naviera = document.getElementById("naviera").value;

	if (agencia == 0 || aduana == 0 || naviera == 0){

	if (naviera == 0){
	swal("Error","Debe seleccionar una naviera.!","error");	
	}else{
		if(agencia == 0){
		swal("Error","Debe seleccionar una agencia aduanera.!","error");	
		}else{
			if(aduana == 0){
			swal("Error","Debe seleccionar una aduna.!","error");	
			}	
			}	
	}	

	}else{
	
	var id = document.getElementById("id-prod").value;
	var items = document.getElementById("Items").value;
	var Usuario = document.getElementById("IdSession").value;

	var pag=1;
	var url = '../PHP/AgregarEmbarque.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize()+'&pag='+pag+'&id='+id+'&items='+items+'&usuario='+Usuario,
		success: function(registro){
	
			if(registro==2 || registro==3){
			
					if(registro==2){
					swal("Error","No puede dejar en blanco los campos Contenedor y observacion","error");
					return false;
						
					}
					if(registro==3){
					swal("Error","Contenedor ya esta registrado.!","error");
					return false;
						
					}


			}else{

			if(registro==1){
			swal("Error","Embarque ya existe.!","error");
			return false;
			}else{

			if (registro == 'INGRESO OK'){
			$('#formulario')[0].reset();
			$('#pro').val('Registro');
			swal("Exito","Registro agregado correctamente.!","success");

			pagination(1);
			$("#tablaDetalleContenedores").empty();
			return false;
			}if(registro == 'MODIFICADO OK'){
			swal("Exito","Registro se actualizo correctamente.!","success");
			pagination(1);
			return false;
			}else{
				swal("Error",registro,"error");
				return false;
			}

				}
		}
	}
	});
	return false;

		}
}

function editarRegistro(id){
	$('#formulario')[0].reset();

	document.getElementById("numeroEmbarque").readOnly = true;
	var campo = document.getElementById('FilaContenedor');
	campo.style.display = "none";

	var url = '../PHP/EditarEmbarque.php';
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
				$('#naviera').val(datos[1]);
				$('#fechaEstimada').val(datos[2]);
				$('#agente').val(datos[3]);
				$('#aduana').val(datos[4]);
				$('#estadoDispensa').val(datos[5]);
				$('#valorFlete').val(datos[6]);
				$('#valorFactura').val(datos[7]);
				$('#valorSeguro').val(datos[8]);
				$('#fechaLlegada').val(datos[9]);
				$('#vencimiento').val(datos[10]);
				$('#observacion').val(datos[11]);
				$('#numeroBL').val(datos[12]);
				$('#tipoDonacion').val(datos[13]);
				$('#po').val(datos[14]);
				$('#registra-producto').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}


function eliminarRegistro(Embarque){

  var url = '../PHP/EliminarEmbarque.php';

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
		data:'Embarque='+Embarque,
		success: function(registro){
		 if(registro==1){
		 swal("Eliminado!", "Registro Eliminado correctamente.", "success");
		 pagination(1);
		 }else{
		 swal("Error", "Registro no se elimino. "+registro, "error");	
		 }
	    }
		});
 		 
	});

}

function crearCampo(nombre,id,placeholder,required){
td=document.createElement('td');
txt= document.createElement('input');
txt.type='text';
txt.setAttribute('name',nombre);
txt.setAttribute('id',id);
txt.setAttribute('placeholder',placeholder);
txt.setAttribute('class','form-control');
if(required){
	txt.setAttribute('required','required');
}
td.appendChild(txt);
return td;

}

function nuevo (){


destino=document.getElementById('tablaDetalleContenedores');
tr=document.createElement('tr');
tr.appendChild(crearCampo('numeroContenedor[]','numeroContenedor[]','Ingrese Numero de Contenedor',false)); 
tr.appendChild(crearCampo('observacionContenedor[]','observacionContenedor[]','Descripcion de Contenedor',false)); 
tr.appendChild(crearCampo('comentarioContenedor[]','comentarioContenedor[]','Comentario de Contenedor',false)); 
	td = document.createElement('td');
	x= document.createElement('button');
	x.type='button';
	x.setAttribute('class','glyphicon glyphicon-trash btn btn-danger');
	x.setAttribute('onClick','eliminarFila(this)');
	td.appendChild(x);
	tr.appendChild(td);
	
	destino.appendChild(tr);
	
}

function eliminarFila(btn){

 swal({
  title: "Esta Seguro?",
  text: "Que desea eliminar este Contenedor!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Eliminarlo!",
  closeOnConfirm: false
},
function(){

		fila = btn.parentNode.parentNode;
		fila.parentNode.removeChild(fila);
 		swal("Eliminado!", "Contenedor Eliminado correctamente.", "success");
	});

}

function verDetalle (id){

	$('#DetalleIdContenedor').val(id);

	$('#Vercontenedores').modal({
			show:true,
			backdrop:'static'
		});

    var url = '../PHP/VerContenedores.php';

 	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success:function(data){
			var array = eval(data);
			//alert(array[1]);
			$('#agrega-registrosContenedores').html(array[0]);
	

		}
	});
}

function DetalleAgregarContenedor(){
	var Embarque = $('#DetalleIdContenedor').val();
	var Contenedor = $('#DetalleNumeroContenedor').val();
	var Detalle = $('#DetalleDescripcionContenedor').val();
	var Comentario = $('#DetalleComentarioContenedor').val();

 		var url = '../PHP/DetalleAgregarContenedores.php';
	 	$.ajax({
			type:'POST',
			url:url,
			data:'contenedor='+Contenedor+'&embarque='+Embarque+'&detalle='+Detalle+'&comentario='+Comentario,
			success:function(response){
				
				if(response == 'Ok'){
					$('#DetalleNumeroContenedor').val('');
					$('#DetalleDescripcionContenedor').val('');
					$('#DetalleComentarioContenedor').val('');
					verDetalle(Embarque);
					swal("Exito",'Se agrego contenedor correctamente.!', "success");
				}else{
					swal("Error:",response, "error");
					return false;
				}	

			}
		});
}

function editarRegistroD(id,contador){
	
	var ContenedorD = document.getElementById("ContenedorD"+contador).value;
	var ObservacionContenedorD = document.getElementById("ObservacionContenedorD"+contador).value;
	var ComentarioContenedorD = document.getElementById("ComentarioContenedorD"+contador).value;
	var FechaBodegaD = document.getElementById("FechaBodegaD"+contador).value;
	var FechaRetornoD = document.getElementById("FechaRetornoD"+contador).value;

	var url = '../PHP/UpdateEmbarqueContenedores.php';

 	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&contenedor='+ContenedorD+'&observacion='+ObservacionContenedorD+'&comentario='+ComentarioContenedorD+'&fechaBodega='+FechaBodegaD+'&fechaRetorno='+FechaRetornoD,
		success:function(data){
		
			if(data==1){
			swal("Actualizado.!", "Registro actualizado correctamente.", "success");
			pagination(1);
			}else{
		    swal("Error:", "Registro no se actualizo por: "+data, "error");
			}
	

		}
	});

}


function eliminarRegistroD(id,Embarque){

  var Embarque = $('#DetalleIdContenedor').val();
  var url = '../PHP/EliminarContenedorEmbarque.php';

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
		data:'id='+id+'&Embarque='+Embarque,
		success: function(registro){
		 if(registro==1){
		 swal("Eliminado!", "Registro Eliminado correctamente.", "success");
		 verDetalle(Embarque);
		 pagination(1);
		 }else{
		 swal("Error", "Registro no se elimino. "+registro, "error");	
		 }
	    }
		});
 		 
	});

}






