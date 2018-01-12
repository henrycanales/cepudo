<?php

session_start();

if(isset($_SESSION['session_nombre_cepudo']))
{
	header("Location: ./Inicio/");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/sweetalert.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/validation.min.js"></script>
<script type="text/javascript" src="js/Login.js"></script>

<script src="bootstrap/js/sweetalert.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">


</head>

<body>
	   
    
<div class="signin-form">  
	<div class="container">
     	
       <form class="form-signin" method="post" id="login-form">
       <center>
    	<img src="./recursos/logo-cepudo.png" width="400" height="200"/> 
   		</center>    
       <center> <h2 class="form-signin-heading">Inicio de Sesión</h2><hr /></center>
        
        <div id="error">
        <!-- error will be shown here ! -->
        </div>
        
        <div class="form-group">
          <div class="input-group">
          <label for="uLogin" class="input-group-addon glyphicon glyphicon-user"></label>
          <input type="text" class="form-control" placeholder="Usuario" name="user" id="user" />
          <span id="check-e"></span>
        </div>
        </div>
        
        <div class="form-group">
          <div class="input-group">
          <label for="password" class="input-group-addon glyphicon glyphicon-lock"></label>
          <input type="password" class="form-control" placeholder="Contraseña" name="password" id="password" />
        </div>
        </div>
            
     	 <hr />
        <center>
        <div class="form-group">
        <button type="submit" class="btn btn-danger btn-block" name="btn-login" id="btn-login"> 
    		<span class="glyphicon glyphicon-log-in"></span> &nbsp; Ingresar
			</button> 
        </div>  
      </center>
      </form>

    </div>
    
</div>
    
<script src="bootstrap/js/bootstrap.min.js"></script>

  <div class="modal" id="cargar">
      <div class="contenido">
      <img src="./recursos/cargando.gif" width="50" heigth="50"/>
       </br>
      <center><label>Cargando...</label></center>
    </div>
  </div>

</body>
<center>
 
  <div class="footer">
      <center>
     <a href="http://www.syteccop.com"><img src="./recursos/sytec.png"/></a>
      </center>

    </div>
      </center>
</html>
