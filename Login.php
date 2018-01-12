<?php
	error_reporting(0);
	session_start();
	include('./conexion/conexion.php');

	//if(isset($_POST['btn-login']))
	{
		
		$user = $_POST['user'];
		$user_password = $_POST['password']; 
		
			
		$Verificar = mysqli_num_rows(mysqli_query($conexion,"SELECT * FROM Usuarios 
					 WHERE Usuario='$user' AND Pass='$user_password' and Estado = 'Activo' "));

		$stmt=mysqli_query($conexion,"SELECT * FROM Usuarios WHERE Usuario='$user' AND Pass='$user_password'");
 		if ($Verificar==1) 
		{	
				echo "1"; // log in
				$row=mysqli_fetch_array($stmt);	
				
				$nombre=$row['Nombre'];
				$id=$row['Usuario'];
				$nivel=$row['Nivel'];
				$_SESSION['session_id_cepudo'] = $id;
				$_SESSION['session_nombre_cepudo'] = $nombre;
				$_SESSION['session_nivel_cepudo'] = $nivel;

				
			}
			else{
				
				echo "Usuario o Contraseña no existe."; // w
			}
				
		

	}

?>