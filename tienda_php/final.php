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
    session_start();  //activamos nuestra variable
    if (!isset($_SESSION["User"])) {
        ##Se descomenta la línea de abajo cuando se implemente con sesiones
        header('Location: index.php');
    }
    $total = $_POST['montoTotal'];
    $us_id = $_SESSION['id_user'];
    $ca_id = $_SESSION['Carrito'];
    $dbconn = pg_connect("host=localhost dbname=tiendita user=tiendo password=hola123.,")
            or die('No se ha podido conectar: ' . pg_last_error());
    
    $update= "UPDATE carrito SET total = $total WHERE usuario_id=$us_id AND carrito_id=$ca_id";
        $result = pg_query($update);
        if(!$result){
            echo '<script>alert("Ocurrió un error ")</script>';
        }
        pg_free_result($result);
        pg_close($dbconn);
    ?>
</head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Bananex</a>
                </div>
                <ul class="nav navbar-nav">
                  <li class="active"><a href="renew.php">Pagina Principal</a></li>
                  <span style="width: 30px;"></span>
                </ul>
                <span class="right"><button class="btn btn-outline-success my-2 my-sm-0 right" onclick="window.location.href='salir.php'" type="submit">Cerrar Sesión</button></span>
             <button class="btn btn-outline-success my-2 my-sm-0 right" onclick="window.location.href='index.php'" type="submit">Generar Factura</button>
            </div>
        </nav>

        <div class="container">
            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Lista de Productos">
            </span>
            <br><br>

            <div class="jumbo">
                <div class="jumbotron" style="height: auto;">
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <b>GRACIAS POR SU COMPRA!</b><br>
                            <?php echo $us_id; ?>
                            <br>
                            <?php echo $ca_id; ?>
                            <br>
                            <?php echo $total; ?>
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>
                </div>
            </div>
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
    </body>
    </html>    