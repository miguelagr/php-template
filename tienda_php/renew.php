<?php 

 require 'classes.php';
 session_start();
  if( !isset($_SESSION["User"]) ||  !isset($_SESSION["Pass"])){

    header('Location: index.php');
  }
    $cart = new carrito;
    $cart->creaCarrito();
  
  header('Location: index.php');  
 ?>