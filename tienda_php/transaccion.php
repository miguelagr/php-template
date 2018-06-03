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
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <?php
    //require 'classes.php';
    session_start();  //activamos nuestra variable
    if (!isset($_SESSION["User"])) {
        ##Se descomenta la línea de abajo cuando se implemente con sesiones
        header('Location: index.php');
    }
    $total = $_POST['subtotal'];
    ?>
</head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Bananex</a>
                </div>
                <ul class="nav navbar-nav">
                  <li class="active"><a href="index.php">Home</a></li>
                  <span style="width: 30px;"></span>
                </ul>
                <span class="right"><button class="btn btn-outline-success my-2 my-sm-0 right" onclick="window.location.href='salir.php'" type="submit">Cerrar Sesión</button></span>
             <button class="btn btn-outline-success my-2 my-sm-0 right" onclick="window.location.href='compras.php'" type="submit">Sigue Comprando!</button>
            </div>
        </nav>

        <div class="container">
            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Lista de Productos">
            <button class="btn btn-primary" style="pointer-events: none;" type="button" disabled>Información de la compra</button>
            </span>
            <br><br>

            <div class="jumbo">
                <div class="jumbotron" style="height: auto;">
                    <div class="row">
                        <div class="col-md-2">
                            Producto
                        </div>
                        <div class="col-md-2">
                            Cantidad
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-2">
                            Total
                        </div>
                    </div>
                
        <?php 
            $dbconn = pg_connect("host=localhost dbname=tiendita user=tiendo password=hola123.,")
            or die('No se ha podido conectar: ' . pg_last_error());
            $id_c = $_SESSION['Carrito'];
            $query = "SELECT * FROM productos_carrito WHERE carrito_id= $id_c";
            $compras = pg_query($query) or die('La consulta fallo: ' . pg_last_error()); 
            while($arr = pg_fetch_array($compras, null, PGSQL_ASSOC)) {
                $producto_id=$arr['producto_id'];
                $cantidad = $arr['cantidad'];
                $query = "SELECT * FROM products WHERE producto_id= $producto_id";
                $producto = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
                $row_producto = pg_fetch_assoc($producto);
            ?>
                    <div class="row">
                        <div class="col-md-2">
                            <?php echo $row_producto['nombre'];
                             ?>
                        </div>
                        <div class="col-md-2">
                            <?php echo $cantidad; ?>
                        </div>
                    </div>
            <?php
            }
            pg_free_result($compras);   
            pg_close($dbconn);
        ?>  
                    <hr style="width: 100%; color: black; height: 2px; background-color: black;">
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-2">
                            $<?php echo $total ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-3">
                    <form method="POST" action="final.php">
                        <input type="hidden" name="montoTotal" value="<?php echo $total ?>">
                        <input type="submit" name="finalizar" value="Finalizar Compra">
                    </form>
                </div>  
            </div>
            <br><br>
        </div>  <!-- FIN DEL CONTAINER-->

        <footer>
            <div class="row" id="footer">
                <!--<div id="footer"> -->
                <div class="col-md-3">
                    <h4>Contáctanos</h4>
                </div>
                <div class="col-md-6">
                    <center><img src="img/tarjetas.jpg" height="30" width="93" alt=""></center>
                    <p >Derechos reservados</p>
                </div>
                <div class="col-md-3">
                    <p>Copyright ©</p>
                </div>
            </div>
        </footer>
        <script>
            $('.collapse').collapse('hide')
        </script>

    </body>
</html>