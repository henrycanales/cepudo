$('document').ready(function()
{ 
	ocultarModal();
     /* Validacion */
	 $("#login-form").validate({
      rules:
	  {
			password: {
			required: true,
			},
			user: {
            required: true,
            
            },
	   },
       messages:
	   {
            password:{
                      required: "Por favor ingrese su contraseña"
                     },
            user: "Por favor ingrese su usuario",
       },
	   submitHandler: submitForm	
       });  
	   /* Validacion */
	   
	   /* login submit */

	   function mostrarModal(){
	   		$('#cargar').modal('show');
		    $('#cargar').show();
	   }
	   function ocultarModal(){
	   		$('#cargar').modal('hide');
		    $('#cargar').hide();
	   }

	   function submitForm()
	   {		
	   		mostrarModal();
			var data = $("#login-form").serialize();
				
			$.ajax({
			type : 'POST',
			url  : 'Login.php',
			data : data,
			beforeSend: function()
			{	
				$("#error").fadeOut();
				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando ...');
			},
			success : function(response)
			   {						
			if(response==1)
			{
				setTimeout(' window.location.href = "./Inicio/"; ',3000);
			}
			else{
		    setTimeout(ocultarModal,3000);					
			$("#error").fadeIn(3000, function(){						
			$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>').show(200).delay(2500).hide(200);
			$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Ingresar');
									});
					}
			  }
			});
				return false;
		}
	   /* login submit */
});

