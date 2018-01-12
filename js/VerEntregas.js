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

	$('#bs-prod3').on('keyup',function(){
		var pag=1;
		var dato = $('#bs-prod3').val();
		var url = '../PHP/BuscarProductos2.php';
		var items = document.getElementById("Items").value;

		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato+'&pag='+pag+'&items='+items,
		success: function(datos){
			 var array = eval(datos);

			$('#agrega-registrosProductos2').html(array[0]);
			$('#pagination2').html(array[1]);
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
	var url = '../PHP/VerEntregas.php';
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
			//alert(array[1]);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);

		}
	});
	return false;
}


function eliminarRegistro(id){

  var EntregaId=$('#EntregaId').val();
  var url = '../PHP/EliminarEntrega.php';

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
	var Producto=$('#CodigoP').val();
	var Cantidad=document.getElementById("Cantidad").value;

	if(Producto != ''){
	
		//alert("id:"+id+" Producto:"+Producto+" Cantidad:"+Cantidad);

	    var url = '../PHP/AgregarProductoEntregaDetalle.php';

	 	$.ajax({
			type:'POST',
			url:url,
			data:'id='+id+'&producto='+Producto+'&cantidad='+Cantidad,
			success:function(data){

				if(data == 1){
					swal("Exito","Produto Agreado Correctamente.!","success");
					verDetalle(id);
					$('#CodigoP').val('');
					$('#Producto').val('');
					$('#Contenedor').val('');
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

function verDetalle(id){

$('#EntregaId').val(id);

	$('#VerDetalleEntrega').modal({
			show:true,
			backdrop:'static'
		});

    var url = '../PHP/VerDetalleEntrega.php';

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

	var url = '../PHP/UpdateEntregaDetalle.php';

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
  var url = '../PHP/EliminarProductoEntregaDetalle.php';

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
    	 verDetalle(EntregaId);
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

		$('#bs-prod3').val('');

		$('#VerProductos2').modal({
			show:true,
			backdrop:'static'
		});

	

}


function pagination2(pag){
	var url = '../PHP/BuscarProductos2.php';
	var dato = document.getElementById("bs-prod3").value;
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
			$('#agrega-registrosProductos2').html(array[0]);
			$('#pagination2').html(array[1]);

		}
	});
	return false;
}

function agregarProducto(id){

    var url = '../PHP/BuscarDetalleProducto.php';
    $.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(datos){
			 var array = eval(datos);
			 $('#Contenedor').val(array[0]);
			 $('#Producto').val(array[1]);
			 $('#Presentacion').val(array[2]);
			 $('#CodigoP').val(array[3]);
		}
    
	});

 $('#VerProductos2').modal('hide') 

 document.getElementById("Cantidad").focus();
}


