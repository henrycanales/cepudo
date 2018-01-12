$('document').ready(function(){ 

		/* Validacion */
	pagination(1);
	
	$('#bs-prod2').change(function() {
		var pag=1;
		var dato = $('#bs-prod2').val();
		var dato2 = $('#Busqueda').val();
		
		var url = '../PHP/AutorizarAjuste.php';
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

	var url = '../PHP/AutorizarAjuste.php';
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


function autorizarAjuste(id){

	var url = '../PHP/UpdateAutorizarAjuste.php';

 	$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success:function(data){
		
			if(data==1){
			swal("Autorizado.!", "Ajuste ha sido Autorizado.", "success");
			pagination(1);
			}else{
		    swal("Error:",data, "error");
			}
	

		}
	});

}


function Imprimir(Id){

var pagina = '../Reportes/ImprimirAjusteInventario.php?Id='+Id
opciones='toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes,width=800, height=800, top=0, left=0';

window.open(pagina,'',opciones); 


}
