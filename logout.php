<?php
	session_start();
	unset($_SESSION['nombre_session']);
	unset($_SESSION['usuario_session']);
	
	if(session_destroy())
	{
		header("Location: index.php");
	}
?>