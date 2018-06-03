<html>
	<head>
		<?php 
		require 'classes.php';
		session_start();
			$_POST = $_SESSION;
			$Nombre = $_POST["Nombre"];
			$ApP = $_POST["ApP"];
			$ApM = $_POST["ApM"];
			$correo = $_POST["correo"];
			$User = $_POST["Username"];
			$Pass = $_POST["Password"];
			$Dir = $_POST["Dir"];
			$Pais = $_POST["Pais"];
			$Ciu = $_POST["Ciu"];

			echo $Nombre;
			echo $correo;
			echo $User;
			echo $Pass;
			
			
			$newUser = new user;
			$newUser->name = $Nombre;
			$newUser->ap_paterno = $ApP;
			$newUser->ap_materno = $ApM;
			$newUser->email = $correo;
			$newUser->user = $User;
			$newUser->pass = $Pass;
			$newUser->address = $Dir;
			$newUser->pais = $Pais;
			$newUser->city = $Ciu;

			
			echo $newUser->crearCuenta();
    		
		?>
	</head>
	<body>

		<div align="center">

			<h2>Sus datos han sido enviados correctamente!</h2>
			<h5><a href ="index.php"> Regresar a la pagina principal </h5>

		</div>
	
	</body>
	</html>	




