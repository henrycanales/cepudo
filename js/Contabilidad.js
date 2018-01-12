$('document').ready(function(){ 

	pagination(1);
	
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
	var url = '../PHP/Contabilidad.php';
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


function exportarExcel(){

	var dato = document.getElementById("bs-prod").value;
	var fecha = document.getElementById("mes").value;

	//window.open('../Reportes/ReporteExcel.php?fechaInicio='+fechaInicio+'&fechaFin='+fechaFin+'&lugar='+lugar+'&evento='+evento);
//	window.open('../Reportes/ReporteExcel.php?dato='+dato);
	location.href='../Reportes/ReporteContaExcel.php?dato='+dato+'&Fecha='+fecha+'';

}


function exportarFechas(){

$('#VerModalReporteExcel').modal('show');

}

function exportarRangoExcel(){

	var fechai = document.getElementById("fechai").value;
	var fechaf = document.getElementById("fechaf").value;

	fechai = fechai+" 00:00:00";
	fechaf = fechaf+" 23:59:59";

	if(fechai == ' 00:00:00' || fechaf ==' 23:59:59'){
	swal("Error","No puede dejar las decha en blanco.!","error");
    }
	else{
	//window.open('../Reportes/ReporteExcel.php?fechaInicio='+fechaInicio+'&fechaFin='+fechaFin+'&lugar='+lugar+'&evento='+evento);
//	window.open('../Reportes/ReporteExcel.php?dato='+dato);
	location.href='../Reportes/ReporteContaRango.php?fechai='+fechai+'&fechaf='+fechaf+'';
	}

}



