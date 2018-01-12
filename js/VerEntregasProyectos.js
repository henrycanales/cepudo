$('document').ready(function(){ 

		/* Validacion */
	pagination(1);
	
	$('#bs-prod2').on('keyup',function(){
		var pag=1;
		var dato = $('#bs-prod2').val();
		var dato2 = $('#Busqueda').val();
		
		var url = '../PHP/VerEntregas.php';
		var items = document.getElementById("Items").value;

		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato+'&pag='+pag+'&items='+items+'&dato2='+dato2,
		success: function(datos){
			 var array = eval(datos);

			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
	});

	$('#bs-prod').on('keyup',function(){
		var pag=1;
		var dato = $('#bs-prod').val();

		var url = '../PHP/BuscarProductosProyectos.php';
		var proyecto = document.getElementById("InstitucionId").value;
		var items = document.getElementById("Items").value;

		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato+'&pag='+pag+'&items='+items+'&proyecto='+proyecto,
		success: function(datos){
			 var array = eval(datos);

			$('#agrega-registrosProductos').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
	});

    $('#Items').change(function() {
    pagination(1);
	});

    $('#Busqueda').change(function() {
    pagination(1);
	});

    $('#producto').change(function() {
    var url = '../PHP/BuscarDescripcion.php';
    var descripcion= $('#producto').val();
    $.ajax({
		type:'POST',
		url:url,
		data:'id='+descripcion,
		success: function(datos){
			 var array = eval(datos);
			 $('#Descripcion').val(array[0]);
		}
    
	});
});

    $('#producto2').change(function() {
    var url = '../PHP/BuscarDescripcion.php';
    var descripcion= $('#producto2').val();
    $.ajax({
		type:'POST',
		url:url,
		data:'id='+descripcion,
		success: function(datos){
			 var array = eval(datos);
			 $('#Descripcion2').val(array[0]);
		}
    
	});
});


});

function pagination(pag){

	var url = '../PHP/VerEntregasProyectos.php';
	var dato2 = $('#Busqueda').val();
	var dato = document.getElementById("bs-prod2").value;
	var items = document.getElementById("Items").value;
	
	if (dato==""){
		dato="Todo";
	}
	$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato+'&pag='+pag+'&items='+items+'&dato2='+dato2,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);

		}
	});
	return false;
}


function eliminarRegistro(id){

  var EntregaId=$('#EntregaId').val();
  var url = '../PHP/EliminarEntregaProyecto.php';

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
		data:'id='+id+'&entregaId='+EntregaId,
		success: function(registro){
		 if(registro==1){
		 swal("Eliminado!", "Registro Eliminado correctamente.", "success");
		 pagination(1);
		 }else{
		 swal("Error",registro, "error");	
		 }
	    }
		});
 		 
	});

}


function nuevo(){

	var id=$('#EntregaId').val();
	var InstitucionId = $('#InstitucionId').val();
	var Producto=$('#CodigoP').val();
	var Cantidad=document.getElementById("Cantidad").value;

	if(Producto != ''){
	
		//alert("id:"+id+" Producto:"+Producto+" Cantidad:"+Cantidad);

	    var url = '../PHP/AgregarProductoEntregaDetalleProyectos.php';

	 	$.ajax({
			type:'POST',
			url:url,
			data:'id='+id+'&producto='+Producto+'&cantidad='+Cantidad,
			success:function(data){

				if(data == 1){
					swal("Exito","Produto Agreado Correctamente.!","success");
					verDetalle(id,InstitucionId);
					$('#CodigoP').val('');
					$('#Producto').val('');
					$('#Cantidad').val(0);
					return false;
				}else{
					swal("Error",data,"error");
					return false;
				}

			}
		});
	 }else{
	 	swal("Error","Tiene que seleccionar un producto.!","error");
	 	return false;
	 }


}

function verDetalle(id,InstitucionId){

$('#EntregaId').val(id);
$('#InstitucionId').val(InstitucionId);

	$('#VerProyectoDetalleEntrega').modal({
			show:true,
			backdrop:'static'
		});

    var url = '../PHP/VerDetalleEntregaProyecto.php';

 	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success:function(data){
			var array = eval(data);
			//alert(array[1]);
			$('#agrega-registrosDetalle').html(array[0]);
	

		}
	});
}

function editarRegistroD(id,contador){

	var EntregaId=$('#EntregaId').val();
	var CantD = document.getElementById("CantD"+contador).value;

	var url = '../PHP/UpdateEntregaDetalleProyecto.php';

 	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&cantidad='+CantD+'&entregaId='+EntregaId,
		success:function(data){
		
			if(data==1){
			swal("Actualizado.!", "Registro actualizado correctamente.", "success");
			pagination(1);
			}else{
		    swal("Error:",data, "error");
			}
	

		}
	});

}


function eliminarRegistroD(id,EntregaId){

  var EntregaId=$('#EntregaId').val();
  var InstitucionId = $('#InstitucionId').val();
  var url = '../PHP/EliminarProductoEntregaDetalleProyecto.php';

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
		data:'id='+id+'&entregaId='+EntregaId,
		success: function(registro){
		 if(registro==1){
		 swal("Eliminado!", "Registro Eliminado correctamente.", "success");
    	 verDetalle(EntregaId,InstitucionId);
		 return false;

		 }else{
		 swal("Error", "Registro no se elimino. "+registro, "error");	
		 }
	    }
		});
 		 
	});
	
}

function nuevoDetalle(){

	var id= $('#InventarioContenedorId').val();
	var palet= $('#palet2').val();
	var producto= $('#producto2').val();
	var descripcion= $('#Descripcion2').val();
	var lote= $('#lote2').val();
	var vencimiento= $('#fechaVencimiento2').val();
	var cantidad= $('#cantidad2').val();
	var presentacion= $('#presentacion2').val();
	var cxp= $('#cxp2').val();
	var usuario= $('#IdSession').val();

	url='../PHP/AgregarProductoInventarioDetalle.php';

	if(producto=='' || cantidad=='' || presentacion==0){

		if(producto==''){
			swal("Error","Tiene que seleccionar un producto",'error');
			return false;
		}if(cantidad==''){
			swal("Error","Tiene que ingresar cantidad",'error');
			return false;
		}if(presentacion==0){
			swal("Error","Tiene que seleccionar una presentacion",'error');
			return false;
		}
	}else{
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&palet='+palet+'&producto='+producto+'&descripcion='+descripcion+'&lote='+lote+'&vencimiento='+vencimiento+'&cantidad='+
		cantidad+'&presentacion='+presentacion+'&cxp='+cxp+'&usuario='+usuario,
		success: function(registro){
		 if(registro==1){
		 swal("Exito!", "Registro Agregado Correctamente", "success");
		 pagination(1);
		 verDetalle(id);

		 }else{
		 swal("Error", "Registro no se agrego. "+registro, "error");	
		 }
	    }
		});

	}
}

function BuscarProducto(){
		pagination2(1);

		$('#VerProductos').modal({
			show:true,
			backdrop:'static'
		});

	

}

function pagination2(pag){
	var url = '../PHP/BuscarProductosProyectos.php';
	var proyecto = document.getElementById("InstitucionId").value;
	var dato = document.getElementById("bs-prod").value;
	var items = document.getElementById("Items").value;
	
	if (dato==""){
		dato="Todo";
	}
	$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato+'&pag='+pag+'&items='+items+'&proyecto='+proyecto,
		success:function(data){
			var array = eval(data);
			//alert(array[1]);
			$('#agrega-registrosProductos').html(array[0]);
			$('#pagination').html(array[1]);

		}
	});
	return false;
}

function agregarProducto(id){

    var url = '../PHP/BuscarDetalleProductoProyectos.php';
    $.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(datos){
			 var array = eval(datos);
			
			 $('#Producto').val(array[0]);
	    	 $('#CodigoP').val(array[1]);
		}
    
	});

 $('#VerProductos').modal('hide') 

 document.getElementById("Cantidad").focus();
}

function aplicarEntregas(id){


  var url = '../PHP/AplicarEntregaProyecto.php';

  swal({
  title: "Esta Seguro?",
  text: "Que desea aplicar esta entrega.!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Aplicar!",
  closeOnConfirm: false
},
function(){

  		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){

			if(registro == 1){
				swal("Exito","Entrega de donacion a proyecto aplicada.!","success");
				pagination(1);
				return false;
			}else{
				swal("Error",registro,"error");
				return false;
			}
		}
		});
 		 
	});

}

function Imprimir(Id){

var pagina = '../Reportes/ImprimirEntregaProyecto.php?Id='+Id
opciones='toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes,width=800, height=800, top=0, left=0';

window.open(pagina,'',opciones); 


}

function Actualizar(id){

	$('#id').val(id);

	var url = '../PHP/EditarEP.php';
	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success:function(data){
			var array = eval(data);

			$('#nombreBeneficiario').html(array[1]);

			$('#VerEP').modal({
				show:true,
				backdrop:'static'
			});

		}
	});


}

function ActualizarEP(){

	var beneficiario = $('#beneficiario2').val();


	if(beneficiario == ''){
			swal("Error","No debe dejar en blanco el nombre del Beneficiario.!","error");
			return false;
	
	}else{

	var id = $('#id').val();
	var url = '../PHP/UpdateEP.php';
	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&beneficiario='+beneficiario,
		success:function(data){

		if(data == 1){
			swal("Exito","Orden de entrega actualizada correctamente.!","success");
			pagination(1);
			$('#VerEP').modal('hide');
			var mySelect = $('#beneficiario2');
            mySelect.selectpicker('refresh');
			return false;
		}else{
			swal("Error",data,"error");
			return false;
		}


		}
	});

	}

}
