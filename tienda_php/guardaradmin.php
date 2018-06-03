<html>
	<head>
		<?php 
			require 'classes.php';
			$dbconn = pg_connect("host=localhost dbname=tiendita user=tiendo password=hola123.,")
    		or die('No se ha podido conectar: ' . pg_last_error());

    		$admin = new admin;
			//$User = $_POST["User"];
			//$Pass = $_POST["Password"];
			$admin->username = $_POST["User"];
			$admin->password = $_POST["Password"];
			echo $admin->displayVar();
			$query = "SELECT * FROM admin";

			$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
			$us = array();		
			$ps = array();		
			while ($arr = pg_fetch_array($result, null, PGSQL_ASSOC)){
				array_push($us, $arr['User'] );
				array_push($ps, $arr['Pass'] );
			}

			if (in_array($admin->username, $us)){
			$num_us = array_search($admin->username, $us);
			if ($ps[$num_us] == $admin->password){

				echo "Bienvenido $admin->username";
				session_start();
				$_SESSION['User']=$admin->username;
				}else{
					echo "Verifique su usuario o contraseña";	
				}
			}else {
				echo "Aun no sabes hackear";
				}

// Liberando el conjunto de resultados
pg_free_result($result);

// Cerrando la conexión
pg_close($dbconn);

		?>
	</head>
	<body>

		<div align="center">
			<h2>Sus datos han sido enviados correctamente!</h2>
			<h5><a href ="index.html"> Regresar a la pagina principal </h5>

		</div>
	
	</body>
	</html>	