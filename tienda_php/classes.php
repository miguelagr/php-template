<?php
class admin
{
    public $username = '';
    public $password = '';
    private function displayVar() {
        echo $this->username;
        echo $this->password;
    }
}

class user
{
	public $name= '';
	public $ap_paterno= '';
	public $ap_materno = '';
	public $email = '';
	public $user = '';
	public $pass = '';
	public $address = '';
	public $pais='';
	public $city = '';

	private function verificaUser(){
		$dbconn = pg_connect("host=localhost dbname=tiendita user=postgres password=hola123.,")
    		or die('No se ha podido conectar: ' . pg_last_error());
    	$query = "SELECT * FROM usuarios";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
		$us = array();		
		while ($arr = pg_fetch_array($result, null, PGSQL_ASSOC)){
			array_push($us, $arr['usuario'] );
		}
		pg_free_result($result);
    	pg_close($dbconn);
		if (in_array($this->user, $us)){
			return true;
		}else{
			return false;
		}
	}

	public function crearCuenta() {
		$dbconn = pg_connect("host=localhost dbname=tiendita user=postgres password=hola123.,")
    		or die('No se ha podido conectar: ' . pg_last_error());
		$query = "INSERT into usuarios (nombre,ap_paterno,ap_materno,usuario,pass,email,direccion,pais,ciudad) VALUES('$this->name','$this->ap_paterno','$this->ap_materno','$this->user','$this->pass','$this->email','$this->address','$this->pais','$this->city')";
    	$insUser = pg_query($query);
    	if(!$insUser){
    		pg_free_result($insUser);
    		pg_close($dbconn);
    		return '<script>alert("Ocurrió un error ")</script>';
    	}else{
    		pg_free_result($insUser);
    		pg_close($dbconn);
    		return '<script>alert("Se creó el usuario correctamente")</script>';
    	}
    	
	}
}

class login
{
	public $user='';
	public $pass ='';
	public $mensaje = true;
	public function login(){
		$user = $this->user;
		$pass = $this->pass;
		$mensaje = $this->mensaje;
		$dbconn = pg_connect("host=localhost dbname=tiendita user=postgres password=hola123.,")
    		or die('No se ha podido conectar: ' . pg_last_error());
    	$query = "SELECT * FROM usuarios";
			$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());;
			$us = array();		
			$ps = array();		
			$id = array();
			while ($arr = pg_fetch_array($result, null, PGSQL_ASSOC)){
				array_push($us, $arr['usuario'] );
				array_push($ps, $arr['pass'] );
				array_push($id, $arr['usuario_id']);
			}
			if (in_array($user, $us)){
			$num_us = array_search($user, $us);
			if ($ps[$num_us] == $pass){
				//echo "Bienvenido $admin->username";
				session_start();
				$_SESSION['User']=$user;
				$_SESSION['Pass']=$pass;
				$_SESSION['id_user']=$id[$num_us];
				$_SESSION['Saludo']=$mensaje;
				$_SESSION['Carrito']=0;
								 //header('Location: compras.php');  
				return true;      
				}
			}else{
				return false;
				//echo "Verifique su usuario o contraseña";
				}
			pg_free_result($result);
			pg_close($dbconn);	
	}
}

class carrito{
	public $producto_id;
	public $cliente_id;
	public $esActual = true;

	public function creaCarrito(){
		//session_start();
		//$this->producto_id =$prod;
		$this->cliente_id = $_SESSION['id_user'];
		$esActual=$this->esActual;
		$dbconn = pg_connect("host=localhost dbname=tiendita user=postgres password=hola123.,")
    		or die('No se ha podido conectar: ' . pg_last_error());
    	$query = "INSERT into carrito (usuario_id,actual) VALUES('$this->cliente_id','$esActual')";
    	$result = pg_query($query);
    	if(!$result){
    		echo '<script>alert("Ocurrió un error ")</script>';
    		exit;
    	}
    	pg_free_result($result);
    	$query="SELECT last_value FROM carrito_carrito_id_seq";
    	$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
    	$row=pg_fetch_row($result);
    	$carActual=$row[0];
    	//$oid=pg_last_oid($result);	
		pg_free_result($result);
		pg_close($dbconn);
		$_SESSION['Carrito']=$carActual;
		//return $oid;
	}

}

class car_prod{
	public $pid;
	public $cart_id;
	public $cantidad=0;

	public function addProduct($p_id){
		$this->pid=$p_id;
		$this->cart_id=$_SESSION['Carrito'];
		$this->cantidad++;
		$dbconn = pg_connect("host=localhost dbname=tiendita user=tiendo password=hola123.,")
    		or die('No se ha podido conectar: ' . pg_last_error());
		$query = "SELECT * FROM productos_carrito";
		$query5 = "SELECT * FROM productos_ca";
		$query6 = "SELECT * FROM pros_ca";

		$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
		$cid = array();		
	    $pr_id = array();		
		while ($arr = pg_fetch_array($result, null, PGSQL_ASSOC)){
			//array_push($cid, $arr['producto_id'] );
			//array_push($pr_id, $arr['carrito_id'] );
			if($arr['carrito_id']==$this->cart_id){
				if($arr['producto_id']==$this->pid){	//en el carrito actual, con mas del
														//mismo producto repetido
					$cc = $arr['cantidad']+1;
					$update= "UPDATE productos_carrito SET cantidad = $cc WHERE producto_id=$p_id AND carrito_id = $this->cart_id";
			    	$result = pg_query($update);
			    	if(!$update){
			    		echo '<script>alert("Ocurrió un error ")</script>';
			    		return "EROOOR";
			    		exit;
			    	}
			    	pg_free_result($result);
					pg_close($dbconn);
					return $query5;	
				}
			}
		}
		$query2 = "INSERT into productos_carrito (producto_id,carrito_id,cantidad) VALUES('$this->pid','$this->cart_id',1)";
    	$result = pg_query($query2);
    	if(!$result){
    		echo '<script>alert("Ocurrió un error ")</script>';
    		exit;
    	}
		pg_free_result($result);
		pg_close($dbconn);

		return $query;
	}
}

?>