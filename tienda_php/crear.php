<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

  <title>Cursos</title>
  
   <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
   <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
   <link rel="stylesheet" href="css/bootstrap-theme.css"> 
   <link rel="stylesheet" href="css/miestilo.css">
     

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery.js"></script>
      <script src="js/jquery-1.7.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php 
    $noUser="";
    $noMail="";
    if(isset($_POST['crearCuenta'])){
        $correo = $_POST["correo"];
        $usuario = $_POST["Username"];
        $dbconn = pg_connect("host=localhost dbname=tiendita user=postgres password=hola123.,")
        or die('No se ha podido conectar: ' . pg_last_error());
        $query = "SELECT * FROM usuarios";
        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
        $user = array();    
        $mail = array();
        while ($arr = pg_fetch_array($result, null, PGSQL_ASSOC)){
          array_push($user, $arr['usuario']);
          array_push($mail, $arr['email']);
        }
        pg_free_result($result);
        pg_close($dbconn);
        if (in_array($usuario, $user)){
          $noUser=' <div>El nombre de usuario no está disponible</div>';
        }elseif(in_array($correo, $mail)){
          $noMail = ' <div>Ya existe una cuenta asociada a esta cuenta de correo</div>';
       }else{
          session_start();
          $_SESSION=$_POST;
          header('Location: guardar.php');
        ?>
        <!-- <form id="mysubmit" action="guardar.php" method="POST">
          <input type="text" id="Nombre" name="Nombre">
          <input type="text" name="ApP" id="ApP">
          <input type="text" name="ApM" id="ApM">
          <input type="email" name="correo" id="correo">  
          <input type="text" name="User" id="User" maxlength="15">    
          <input type="Password" name="Pass" id="Pass" minlength="8">
          <input type="text" name="Dir" id="Dir">
          <input type="text" name="Pais" id="Pais">
          <input type="text" name="Ciu" id="Ciu">
        </form>  -->
          <?php
       }}
     ?>
   
</head>
<body>

  
        <div class="row">   <!-- Menu de arriba-->    
        <section id="nav">
        <ul class="nav nav-pills ">
          <li class="btn-xsm "><a href="index.php">Inicio</a></li> 
          
          <li class="btn-xsm"><a href="Nosotros.html">¿Quienes somos?</a></li>
        

        </section>

            

<br>
            <div class="panel panel-info">
            <div class="panel-heading">

            CREA UNA CUENTA 

              
<form method="POST" action="<?php $_PHP_SELF ?>">

<br><br><label for="Nombre">Nombre:</label>
    <input type="text" id="Nombre" name="Nombre" required/>

<br><br><label for="Apellido Paterno">Apellido Paterno:</label>
    <input type="text" name="ApP" id="ApP" required/>

<br><br><label for="Apellido Materno">Apellido Materno:</label>
    <input type="text" name="ApM" id="ApM" required/>
<br><br>
    <label for="correo">E-mail:</label> 
    <input type="email" name="correo" id="correo" required/><?php echo $noMail; ?>

<br><br><label for="User">User:</label>
    <input type="text" name="Username" id="Username" minlength="5" required/><?php echo $noUser; ?>

<br><br><label>Password:</label>
    <input type="Password" name="Password" id="Password" minlength="8" required/>
    
<br><br><label>Direccion:</label>
    <input type="text" name="Dir" id="Dir" required/>

<br><br><label>Pais:</label>
    <input type="text" name="Pais" id="Pais" required/>

<br><br><label>Ciudad:</label>
    <input type="text" name="Ciu" id="Ciu" required/>

<br><br>
    <button type="submit" name="crearCuenta">Crear Cuenta</button>

</form>

  
              </div>
            </div>
            </div>

              


              
</section>

  <footer>
        <div class="row">
          <div id="footer">
          <center><img src="img/tarjetas.jpg" height="30" width="93" alt=""></center>
          <h4 id="der">Contáctanos</h4>
          <p >Derechos reservados</p>
          <p id="cop">Copyright ©</p>
          </div>
        </div>

    </footer>
       
  </body>
</html>
