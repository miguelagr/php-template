<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" name=s"viewport" content="width=device-width, initial-scale=1.0">

    <title>Tienda </title>
    
     <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
     <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
     <link rel="stylesheet" href="css/bootstrap-theme.css"> 
     <link rel="stylesheet" href="css/miestilo2.css">


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery.js"></script>
         <script src="js/jquery-1.7.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<?php
        session_start();  //activamos nuestra variable
    if (!isset($_SESSION["User"])) {
        echo "Hola";
        ##Se descomenta la línea de abajo cuando se implemente con sesiones
        ##header('Location: index.html');
    }
    if (isset($_POST["agregar"])){

    }
?>
</head>
<body>
<!-- Barra de navegacion superior -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Bananex</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.html">Home</a></li>
      <li class="active"><a href="#">Page 1</a></li>
      <li class="active"><a href="#">Page 2</a></li>
    </ul>
    <button class="btn btn-outline-success my-2 my-sm-0 right" type="submit">Carrito</button>
  </div>
</nav>

<body>
<!-- Termina Barra de navegacion superior -->
<div class="container bo">
    <div class="row jumbo">
        <div class="jumbotron">
          <div class="container">
            <h2>Conoce nuestros productos</h2>      
            <p></p>
         </div>
        </div>
    </div>

    <div class="row">
        
        <?php
        $dbconn = pg_connect("host=localhost dbname=tiendita user=postgres password=hola123.,")
            or die('No se ha podido conectar: ' . pg_last_error());
        $query = "SELECT * FROM products ORDER BY producto_id ASC";
        $result = pg_query($query) or die('Ocurrió un Error ' . pg_last_error());
        while ($arr = pg_fetch_array($result, null, PGSQL_ASSOC)){
        ?>

         <div class="col-md-3 prods">
            
             <div class="card container" style="width:230px">
                <img class="card-img-top" src="<?php echo $arr["imagen"]; ?>" alt="Card image" style="width:100%">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $arr["nombre"]; ?></h4>
                  <p class="card-text">Descripción: <?php echo $arr['descripcion']; ?><br>Precio: <?php echo $arr['precio']; ?></p>
                  <form action="<?php $_PHP_SELF ?>" method="POST">
                  <input class="btn btn-primary" type="submit" name="agregar" id="<?php echo $arr["producto_id"]; ?>" value="<?php if($arr["inventario"] < 1){ echo "AGOTADO!"; ?>" <?php echo "disabled"; ?>> 
                  <?php }else{ echo "Agregar al carrito"; ?>
                    ">
                  <?php } ?>
                  <input type="hidden" name="id" value="<?php echo $arr["producto_sid"]; ?>" hidden>
                  </form>
                </div>
            </div>

        </div>
        <?php } 
        // Liberando el conjunto de resultados
        pg_free_result($result);
        // Cerrando la conexión
        pg_close($dbconn);
        ?>

<!--
        
    -->
    </div>
    <br>
</div>


<footer>
    <div class="row" id="footer">
        <!--<div id="footer"> -->
        <div class="col-md-3">
            <h4>Contáctanos</h4>
        </div>
        <div class="col-md-6">
            <center><img src="img/tarjetas.jpg" height="30" width="93" alt=""></center>
-            <p >Derechos reservados</p>
        </div>
        <div class="col-md-3">
            <p>Copyright ©</p>
        </div>
    </div>
</footer>
<script>
$( ".btn-primary" ).click(function() {
    alert($(this).attr("id"));
    //<?php ?> $(this).attr("id")
    <?php
        $dbconn = pg_connect("host=localhost dbname=tiendita user=postgres password=hola123.,")
            or die('No se ha podido conectar: ' . pg_last_error());
        //$query = "SELECT * FROM productos WHERE nombre LIKE ''";
        //$result = pg_query($query) or die('Ocurrió un Error ' . pg_last_error());
        //while ($arr = pg_fetch_array($result, null, PGSQL_ASSOC)){
        ?>
});
</script>
  </body>
</html>