<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">	

	<title>BANANEX</title>
	
	 <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
	 <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
	 <link rel="stylesheet" href="css/bootstrap-theme.css">	
	 <link rel="stylesheet" href="css/miestilo.css">


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->


</head>
<body>

  <?php require 'classes.php'; ?>
<div class="row">
					<!-- Menu de arriba-->		
				<section id="nav">
				<ul class="nav nav-pills ">
  				<li class="active "><a href="#">Inicio</a></li>	
  				
  				<li class="btn-xsm"><a href="Nosotros.html">¿Quienes somos?</a></li>
  			
  			
	<div class="menu1">
	<form class="form-inline" action="verificaUsuario.php" method="POST">
     <?php 
      session_start();
      
        if (isset($_SESSION['User'])) { 
            if(isset($_SESSION['Saludo'])){
              if($_SESSION['Saludo']==true){ ?>
                <script>alert("Bienvenido <?php echo $_SESSION['User'] ?> ")</script>
                <?php
                $_SESSION['Saludo']=false;
              }
            }
        ?>
       <div class="form-group">
        <h4 style="padding-left: 30px; padding-right: 30px;">Logueado como <?php echo $_SESSION['User'] ?> </h4>
      </div>
      <span>
      <button type="button" class="btn btn-default" onclick="window.location.href='compras.php'">Ir a la Tienda</button>
      <button type="button" class="btn btn-default" onclick="window.location.href='salir.php'">Cerrar Sesión</button>
      </span>
      <?php }else{ 
        if(isset($_SESSION['login'])){
          if($_SESSION['login']==false){
        ?>
          <script>alert("Usuario y/o contraseña no válidos")</script>
        <?php
          unset($_SESSION['login']);
          }
        }
        ?>
    <div class="form-group">
      <input type="text" name="User" class="form-control" id="exampleInputEmail3" placeholder="Username">
    </div>
    <div class="form-group">
      <input type="password" name="Pass" class="form-control" id="exampleInputPassword3" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-default">Iniciar Sesion</button>
  <?php }

 // session_start();
   ?>
 
 <li class="btn-xsm"><a href="crear.php">Crear Cuenta</a><a style="padding-left: 3.1cm" href="admin.php">Administrador</a></li>

    </form>
    </div>
  </ul>
    <!-- Carousel-->

</div>
</section>

            <div class="row">
                <div class="span12">
                    <div id="homeCarousel" class="carousel slide">
                        <div class="carousel-inner">
 						<div class="active item">
 							<div class="i1">
                               <img src="img/ban1.jpg" height="443" width="1670">        <div class="carousel-caption">
                             
                                </div>  
                             </div>
                             </div>
 								
                             <div class="item" id="i2">            	
							 <img src="img/tien2.jpg" height="102" width="1670">  
                                 <div class="carousel-caption">
                                 
                                 </div>
                             </div>
 								 <div class="item" id="i3">
 			                    <img src="img/ban3.jpg" height="302" width="1300">  
                                 <div class="carousel-caption">
                                  
                                 </div>
                             </div>
 
                        </div>
                        <a class="carousel-control left" href="#homeCarousel" data-slide="prev">&lsaquo;</a>
                        <a class="carousel-control right" href="#homeCarousel" data-slide="next">&rsaquo;</a>


                    </div>
                </div>  	 
            </div>
        </div>

        <script src="js/jquery-1.7.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
    $(document).ready(function(){
        $('.carousel').carousel({
            interval: 2500
        });
    });
</script>

<br><br>


	<div class="row">
						<div class="col-md-7">
								
							
						<div class="panel panel-default">
						<div class="panel-heading">






    <img src="img/ban8.jpg" height="500" width="815" alt="">
<br><br>
   
  
</form>
	
							</div>
						</div>
						</div>

							
<aside>		

							<div class="col-md-5">

<a class="twitter-timeline" data-height="500" data-theme="dark" href="https://twitter.com/ombu_shop?lang=es">Tweets by Tienda</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>




</div>
</div>		
	</aside>

							
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