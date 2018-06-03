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
    if (isset($_POST['eliminarProducto'])){
        $cart_id_act=$_SESSION['Carrito'];
        $pro = $_POST['id'];
        echo "<script>alert('Eliminar Producto')</script>";
        echo "<script>alert($cart_id_act)</script>";
        echo "<script>alert($pro)</script>";
        $dbconn = pg_connect("host=localhost dbname=tiendita user=tiendo password=hola123.,")
            or die('No se ha podido conectar: ' . pg_last_error());
        $query = "DELETE FROM productos_carrito WHERE producto_id = $pro AND carrito_id=$cart_id_act";
        $delete = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
        if(!$delete){
                echo "<script>alert('Ocurríó un Error')</script>";
        }else{
            echo "<script>alert('El producto se ha eliminado del carrito')</script>";
        }
        pg_free_result($delete);
        pg_close($dbconn);
        #echo "<script>alert('eliminar Producto')</script>";
        #echo "<script>alert($pro)</script>";
    }
    if (isset($_POST['quitarUnidad'])){
        $cart_id_act=$_SESSION['Carrito'];
        $pro = $_POST['id'];
        $nuevaCant = $_POST['count']-1;
        echo "<script>alert('Quitar Pieza')</script>";
        echo "<script>alert($cart_id_act)</script>";
        echo "<script>alert($pro)</script>";
        echo "<script>alert($nuevaCant)</script>";
        $dbconn = pg_connect("host=localhost dbname=tiendita user=tiendo password=hola123.,") or die('No se ha podido conectar: ' . pg_last_error());
        $query ="UPDATE productos_carrito SET cantidad = $nuevaCant WHERE producto_id=$pro AND carrito_id = $cart_id_act";
        $removePiece = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
        if(!$removePiece){
                echo "<script>alert('Ocurrió un Error')</script>";
        }else{
            echo "<script>alert('Carrito Actualizado!')</script>";
        }
        pg_free_result($removePiece);
        pg_close($dbconn);
        #echo "<script>alert('Quitar Pieza')</script>";
        #echo "<script>alert($nuevaCant)</script>";
    }
    
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

        <div class="container bo">
            <div class="row jumbo">
                <div class="jumbotron col-md-3" style="height: auto;">
                    <h3>Carrito de <?php echo $_SESSION['User'] ?></h3>
                </div>
            </div>

            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Lista de Productos">
            <button class="btn btn-primary" style="pointer-events: none;" type="button" disabled>Lista de Productos</button>
            </span>

<div id="accordion">
  <?php 
    $dbconn = pg_connect("host=localhost dbname=tiendita user=tiendo password=hola123.,")
            or die('No se ha podido conectar: ' . pg_last_error());
    $id_c = $_SESSION['Carrito'];
    $query = "SELECT count(producto_id) FROM productos_carrito WHERE carrito_id= $id_c";
    $cuentaProductos = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
    $row=pg_fetch_row($cuentaProductos);
    pg_free_result($cuentaProductos);
    $query = "SELECT * FROM productos_carrito WHERE carrito_id= $id_c";
    $id_productos = pg_query($query) or die('La consulta fallo: ' . pg_last_error());     
    $sub_total=0;
    $numProds=0;
    if($row[0]<1){ ?>
        <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Productos:
            </button>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
                El carrito se encuentra vacío.
          </div>
        </div>
      </div>
    <?php }else{
        while($arr = pg_fetch_array($id_productos, null, PGSQL_ASSOC)) {
        $numProds++;
        $producto_id=$arr['producto_id'];
        $query = "SELECT * FROM products WHERE producto_id= $producto_id";
        $producto = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
        $row_producto = pg_fetch_assoc($producto);
    ?>  
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" id="enlaces" data-toggle="collapse" data-target="#<?php echo $numProds; ?>" aria-expanded="false" aria-controls="collapseTwo">
              <?php echo $row_producto['nombre']; ?>
            </button>
          </h5>
        </div>
        <div id="<?php echo $numProds; ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
            Caracteristicas de la compra:
            <div class="container row">
                <div class="col-md-1">
                </div>
                <div class="col-md-5" style="padding: 10px;">
                    Cantidad:           <?php echo $arr['cantidad']; ?><br>
                    Precio por Unidad:  $<?php echo $row_producto['precio']; ?><br>
                </div> 
                 <div class="col-md-3">
                    Subtotal: $<?php echo $arr['cantidad']*$row_producto['precio'];
                    $sub_total+=$arr['cantidad']*$row_producto['precio'];
                     ?>
                </div>     
                <div class="col-md-3">
                    <form method="POST" action="<?php $_PHP_SELF ?>">
                        <input type="hidden" name="id" value="<?php echo $producto_id; ?>" hidden>
                        <input type="submit" name="eliminarProducto" value="Eliminar Producto">
                    </form><br>
                    <form method="POST" action="<?php $_PHP_SELF ?>">
                        <input type="hidden" name="id" value="<?php echo $producto_id; ?>" hidden>
                        <input type="hidden" name="count" value="<?php echo $arr['cantidad']; ?>" hidden>
                        <input type="submit" name="quitarUnidad" value="Quitar 1 Pieza">
                    </form>
                </div>           
            </div>  
          </div>
        </div>
      </div>
        <?php } ?>
        <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" id="enlaces" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Subtotal:
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <div class="container row">
                <div class="col-md-1">
                </div>
                <div class="col-md-3">
                    <b>Subtotal: $<?php echo $sub_total; ?></b>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <form action="transaccion.php" method="POST">
                        <input type="hidden" name="subtotal" value="<?php echo $sub_total; ?>">
                        <input type="submit" name="comprar" value="Comprar">
                    </form>
                </div>
        </div>
      </div>
    </div>
  </div>
        <?php
        }
        pg_free_result($id_productos);   
        pg_close($dbconn);
         ?>
    </div>
</div>
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
            $('.collapse').collapse('hide')
        </script>
    </body>
