$('document').ready(function(){ 

		/* Validacion */

	pagination(1);
	
	$('#bs-prod').on('keyup',function(){
		var pag=1;
		var dato = $('#bs-prod').val();
		var dato2 = $('#Busqueda').val();
		
		var url = '../PHP/AplicarEntregas.php';
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


    $('#Items').change(function() {
    pagination(1);
	});

    $('#Busqueda').change(function() {
    pagination(1);
	});

});

function pagination(pag){
	var url = '../PHP/AplicarEntregas.php';
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


function aplicarEntregas(id){


  var url = '../PHP/AplicarEntrega.php';

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
				swal("Exito","Entrega de donacion aplicada.!","success");
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

var pagina = '../Reportes/ImprimirHojaEntrega.php?Id='+Id
opciones='toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes,width=800, height=800, top=0, left=0';

window.open(pagina,'',opciones); 


}

function VerDetalle(id){

	$('#VerDetalleEntrega').modal('show');
	$('#QuitarTabla').hide();

var url = '../PHP/VerDetalleAplicar.php';

		$.ajax({
			type:'POST',
			url:url,
			data:'id='+id,
			success: function(registro){
			var array = eval(registro);
			//alert(array[1]);
			$('#agrega-registrosDetalle').html(array[0]);
		    }
		});

}


