$('document').ready(function(){ 

		/* Validacion */
	 $("#formulario").validate({
      rules:
	  {
			numeroContenedor: {
			required: true,
			},
			fecha: {
            required: true,
            
            },

            
          
	   },
       messages:
	   {
            numeroContenedor:{
                      required: "Ingrese contenedor.!"
                     },
            fecha: "Ingrese la fecha.!",

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

		$('#registra-producto').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	$('#bs-prod').on('keyup',function(){
		var pag=1;
		var dato = $('#bs-prod').val();
		var dato2 = $('#Busqueda').val();
		
		var url = '../PHP/InventarioContenedor.php';
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

	$('#bs-prodVista').on('keyup',function(){
		paginationVista(1);
	});
	
   $('#Items').change(function() {
    pagination(1);
	});

    $('#ItemsVista').change(function() {
    paginationVista(1);
	});

   	$('#presentacion').change(function() {
    	var presentacion = $('#presentacion').val();

    	if(presentacion == 'Unidad'){
    		$('#cxp').val(1);

    	}
    	if(presentacion == 'Pares'){
    		$('#cxp').val(2);
    	}



	});

	$('#presentacion2').change(function() {
    	var presentacion2 = $('#presentacion2').val();

    	if(presentacion2 == 'Unidad'){
    		$('#cxp2').val(1);
    	}
    	if(presentacion2 == 'Pares'){
    		$('#cxp2').val(2);
    	}

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
	var url = '../PHP/InventarioContenedor.php';
	var dato2 = $('#Busqueda').val();
	var dato = document.getElementById("bs-prod").value;
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

function agregaRegistro(){


	swal({
  title: "Esta Seguro?",
  text: "Que desea agregar o actualizar inventario a este contenedor!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Agregar!",
  closeOnConfirm: false
},
function(){

	var estado = document.getElementById("estadoContenedor").value;
	var tamano = document.getElementById("tamano").value;
	var contador = document.getElementById("contador").value; 
	var proceso = document.getElementById("pro").value;

	if (estado == 0 || tamano == 0 || contador== 0){

	if (estado == 0){
	swal("Error","Debe seleccionar Estado!","error");	
	return false;
	}
	if(tamano == 0){
		swal("Error","Debe seleccionar Tamaño!","error");
		return false;	
	}
	if(contador == 0){
		swal("Error","Debe Agregar un producto.!","error");
		return false;	
	}
	
	

	}else{
	
	var id = document.getElementById("id-prod").value;
	var items = document.getElementById("Items").value;
	var Usuario = document.getElementById("IdSession").value;

	var pag=1;
	var url = '../PHP/AgregarInventarioContenedor.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize()+'&pag='+pag+'&id='+id+'&items='+items+'&usuario='+Usuario,
		success: function(registro){
	
			if(registro==0){
				swal("Error","No puede dejar detalle en blanco.!","error")
				return false;
			}
			if(registro==1){
		    swal("Exito","Registro agregado correctamente.!","success")
			$('#formulario')[0].reset();
			$("#tablaDetalleContenedores").empty();
			var mySelect = $('#producto');
            mySelect.selectpicker('refresh');
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

});


}

function ActualizarRegistro(){

	var id = document.getElementById("id-prod").value;
	var tamano = document.getElementById("tamano").value;
	var estado = document.getElementById("estadoContenedor").value;
	var numeroContenedor = document.getElementById("numeroContenedor").value;
	var fecha = document.getElementById("fecha").value;
	var Usuario = document.getElementById("IdSession").value;

	if(numeroContenedor =='' || tamano == 0 || estado == 0 || fecha == '' || fecha == '00/00/000' || fecha == false){
		if(numeroContenedor == ''){
			swal("Error","Debe de ingresar numero de contenedor.!","error");
			return false;
		}
		if(tamano == 0){
			swal("Error","Debe de ingresar Tamaño.!","error");
			return false;

		}
		if(estado == 0){
			swal("Error","Debe de elegir un estado.!","error");
			return false;
		}
		if(fecha == ''){
			swal("Error","Debe de ingresar la fecha.!","error");
			return false;
		}
		if(fecha == '00/00/000'){
			swal("Error","Debe de ingresar la fecha.!","error");
			return false;
		}
		if(fecha == false){
			swal("Error","Debe de ingresar !","error");
			return false;
		}

	}else{
		
		var url = '../PHP/ActualizarInventarioContenedor.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&tamano='+tamano+'&estado='+estado+'&numeroContenedor='+numeroContenedor+'&fecha='+fecha+'&usuario='+Usuario,
		success: function(data){

			if(data=='Ok'){
				swal("Exito","Registro actualizdo correctamente.!",'success');
				pagination(1);
			}else{
				swal("Error",data,"error");
				return false;
			}


		}
	});
	return false;
	}

}


function editarRegistro(id){
	$('#formulario')[0].reset();
	var campo = document.getElementById('FilaContenedor');
	campo.style.display = "none";

	var url = '../PHP/EditarIngresoInventario.php';
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
				$('#numeroContenedor').val(datos[0]);
				$('#fecha').val(datos[1]);
				$('#tamano').val(datos[2]);
				$('#estadoContenedor').val(datos[3]);
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

  var url = '../PHP/EliminarProductoXContenedor.php';

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

function crearCampo(type,nombre,id,value,readonly){
td=document.createElement('td');
txt= document.createElement('input');
txt.type=type;
txt.setAttribute('name',nombre);
txt.setAttribute('id',id);
txt.setAttribute('value',value);
txt.setAttribute('class','form-control');
if(readonly){
	txt.setAttribute('readonly','readonly');
}
td.appendChild(txt);
return td;

}

function nuevo (){

palet=document.getElementById('palet').value;
producto=document.getElementById('Descripcion').value;
codigo=document.getElementById('producto').value;
lote=document.getElementById('lote').value;
vencimiento=document.getElementById('fechaVencimiento').value;
cantidad=document.getElementById('cantidad').value;
presentacion=document.getElementById('presentacion').value;
cxp=document.getElementById('cxp').value;
cxb=document.getElementById('cxb').value;

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

destino=document.getElementById('tablaDetalleContenedores');
tr=document.createElement('tr');
tr.appendChild(crearCampo('number','paletD[]','palet[]',palet,false)); 
tr.appendChild(crearCampo('text','codigoD[]','codigo[]',codigo,true)); 
tr.appendChild(crearCampo('text','productoD[]','productoD[]',producto,true)); 
tr.appendChild(crearCampo('text','loteD[]','loteD[]',lote,false)); 
tr.appendChild(crearCampo('month','vencimientoD[]','vencimientoD[]',vencimiento,false)); 
tr.appendChild(crearCampo('number','cantidadD[]','cantidadD[]',cantidad,false)); 
tr.appendChild(crearCampo('text','presentacionD[]','presentacionD[]',presentacion,true)); 
tr.appendChild(crearCampo('number','cantidadPD[]','cantidadPD[]',cxp,true)); 
tr.appendChild(crearCampo('number','cxbD[]','cxbD[]',cxb,false)); 



	td = document.createElement('td');
	x= document.createElement('button');
	x.type='button';
	x.setAttribute('class','glyphicon glyphicon-trash btn btn-danger');
	x.setAttribute('onClick','eliminarFila(this)');
	td.appendChild(x);
	tr.appendChild(td);
	
	destino.appendChild(tr);

	var contador = document.getElementById("contador").value;

	document.getElementById("palet").value='';
	document.getElementById("cantidad").value='';
	document.getElementById("lote").value='';
	document.getElementById("fechaVencimiento").value='';
	document.getElementById("cxp").value='';
	document.getElementById("cxb").value='';
	document.getElementById("presentacion").value=0;
	var mySelect = $('#producto');
    mySelect.selectpicker('refresh');

	contador =parseInt(contador) + 1;

	document.getElementById("contador").value=contador;

	

    $('.selectpicker').selectpicker('render');


	}
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
 		var contador = document.getElementById("contador").value;

		contador = contador - 1;

		document.getElementById("contador").value=contador;
	});

}

function verDetalle(id){

$('#InventarioContenedorId').val(id);

	$('#VerProductosXContenedor').modal({
			show:true,
			backdrop:'static'
		});

    var url = '../PHP/VerProductoXContenedor.php';

 	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success:function(data){
			var array = eval(data);
			//alert(array[1]);
			$('#agrega-registrosProductosXcontenedores').html(array[0]);
	

		}
	});
}

function editarRegistroD(id,contador){
	var InventarioContenedorId = $('#InventarioContenedorId').val();
	var LotD = document.getElementById("LotD"+contador).value;
	var VenceD = document.getElementById("VenceD"+contador).value;
	var CantD = document.getElementById("CantD"+contador).value;
	var cpD = document.getElementById("cpD"+contador).value;
	var cbD = document.getElementById("cbD"+contador).value;

	var url = '../PHP/UpdateProductosXContenedor.php';

 	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&lote='+LotD+'&vencimiento='+VenceD+'&cantidad='+CantD+'&cp='+cpD+'&inventarioId='+InventarioContenedorId+'&cb='+cbD,
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


function eliminarRegistroD(id,InventarioContenedorId){

  var url = '../PHP/EliminarProductoContenedor.php';
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
		data:'id='+id+'&InventarioContenedorId='+InventarioContenedorId,
		success: function(registro){
		 if(registro==1){
		 swal("Eliminado!", "Registro Eliminado correctamente.", "success");
		 pagination(1);
		 verDetalle(InventarioContenedorId);

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
	var cxb= $('#cxb2').val();

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
		cantidad+'&presentacion='+presentacion+'&cxp='+cxp+'&usuario='+usuario+'&cxb='+cxb,
		success: function(registro){
		 if(registro==1){
		 $('#palet2').val('');
		 $('#lote2').val('');
		 $('#fechaVencimiento2').val('');
		 $('#cantidad2').val('');
		 $('#presentacion2').val(0);
		 $('#cxp2').val('');
		 $('#cxb2').val('');
		 var mySelect = $('#producto2');
    	 mySelect.selectpicker('refresh');
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

function Aplicar(InventarioContenedorId){

  var url = '../PHP/AplicarIngresoInventario.php';

  swal({
  title: "Esta Seguro?",
  text: "Que desea Aplicar este Ingreso a Inventario!",
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
		data:'id='+InventarioContenedorId,
		success: function(registro){
		 if(registro==1){
		 swal("Aplicado!", "Ingreso al inventario Aplicado Correctamente", "success");
		 pagination(1);
		 }else{
		 swal("Error", "No se logro aplicar. "+registro, "error");	
		 }
	    }
		});
 		 
	});
	
}


function Excel(id,contenedor){

location.href='../Reportes/ReporteExcelContenedor.php?dato='+id+'&contenedor='+contenedor+'';

}

function VerInv(Contenedor){

	$('#VerVistaProductos').modal({
			show:true,
			backdrop:'static'
		});

	$('#contenedor').val(Contenedor);

	paginationVista(1);
	

}

function paginationVista(pag){

	var Contenedor = $('#contenedor').val();
	var dato=$('#bs-prodVista').val();
	var Items = $('#ItemsVista').val();

	$('#titulo').html('Productos de Contenedor '+Contenedor);

	if(dato == '' || dato == undefined){
		dato='Todo';
	}
   
    var url = '../PHP/BuscarVistaProductos.php';

 	$.ajax({
		type:'POST',
		url:url,
		data:'contenedor='+Contenedor+'&pag='+pag+'&dato='+dato+'&items='+Items,
		success:function(data){
			var array = eval(data);
			//alert(array[1]);
			$('#agrega-registrosVistaProductos').html(array[0]);
			$('#paginationVista').html(array[1]);
	

		}
	});
}

