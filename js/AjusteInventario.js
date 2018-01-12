$('document').ready(function(){ 

		/* Validacion */
	 $("#formulario").validate({
      rules:
	  {
			tipoAjuste: {
			required: true,
			},
			Comentario: {
            required: true,
            
            },

            
          
	   },
       messages:
	   {
           tipoAjuste:{
                      required: "Seleccione Tipo de Ajuste.!"
                     },
            Comentario: "Ingrese Comentario del Ajuste.!",

       },
	   submitHandler: agregaRegistro	
       });  
	   /* Validacion */


	$('#bs-prod').on('keyup',function(){
		var pag=1;
		var dato = $('#bs-prod').val();

		var url = '../PHP/BuscarProductos.php';
		var items = document.getElementById("Items").value;

		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato+'&pag='+pag+'&items='+items,
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


function agregaRegistro(){


	swal({
  title: "Esta Seguro?",
  text: "Que desea agregar esta orden de entrega!",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Si, Agregar!",
  closeOnConfirm: false
},
function(){

	var Usuario = document.getElementById("IdSession").value;

	var pag=1;
	var url = '../PHP/AgregarAjusteInventario.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize()+'&usuario='+Usuario,
		success: function(registro){
	
			if(registro==0){
				swal("Error","No puede dejar cantidad en blanco o en cero.!","error")
				return false;
			}
			if(registro==1){
		    swal("Exito","Registro agregado correctamente.!","success")
			$('#formulario')[0].reset();
			$("#tablaDetalleProducto").empty();
			var mySelect = $('#tipoAjuste');
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

		

});


}

function crearCampo(nombre,id,value,readonly){
td=document.createElement('td');
txt= document.createElement('input');
txt.type='text';
txt.setAttribute('name',nombre);
txt.setAttribute('id',id);
txt.setAttribute('value',value);
txt.setAttribute('style','text-align:center');
txt.setAttribute('class','form-control');
if(readonly){
	txt.setAttribute('readonly','readonly');
}
td.appendChild(txt);
return td;

}

function nuevo (){

CodigoP=document.getElementById('CodigoP').value;
Producto=document.getElementById('Producto').value;
Cantidad=document.getElementById('Cantidad').value;



if(Producto=='' || Cantidad=='' || Cantidad < 1 ){

	if(Producto==''){
		swal("Error","Tiene que seleccionar un producto",'error');
		return false;
	}if(Cantidad==''){
		swal("Error","Tiene que ingresar cantidad",'error');
		return false;
	}if(Cantidad < 1){
		swal("Error","Cantidad no puede ser menor a 1",'error');
		return false;
	}
}else{

destino=document.getElementById('tablaDetalleProducto');
tr=document.createElement('tr');
tr.appendChild(crearCampo('codigoD[]','codigoD[]',CodigoP,true)); 
tr.appendChild(crearCampo('productoD[]','productoD[]',Producto,true)); 
tr.appendChild(crearCampo('cantidadD[]','cantidadD[]',Cantidad,false)); 




	td = document.createElement('td');
	x= document.createElement('button');
	x.type='button';
	x.setAttribute('class','glyphicon glyphicon-trash btn btn-danger');
	x.setAttribute('onClick','eliminarFila(this)');
	td.appendChild(x);
	tr.appendChild(td);
	
	destino.appendChild(tr);

	var contador = document.getElementById("contador").value;

	document.getElementById("Producto").value='';
	document.getElementById("Cantidad").value='0';
	document.getElementById("CodigoP").value='';

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


function BuscarProducto(){

		pagination(1);

		$('#VerProductos').modal({
			show:true,
			backdrop:'static'
		});

	

}


function pagination(pag){
	var url = '../PHP/BuscarProductos.php';
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
			$('#agrega-registrosProductos').html(array[0]);
			$('#pagination').html(array[1]);

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
			
			 $('#Producto').val(array[1]);
	    	 $('#CodigoP').val(array[3]);
		}
    
	});

 $('#VerProductos').modal('hide') 

 document.getElementById("Cantidad").focus();
}


