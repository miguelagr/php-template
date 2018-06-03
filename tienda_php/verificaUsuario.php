<?php
  require 'classes.php';
  if( !isset($_POST["User"]) ||  !isset($_POST["Pass"])){

    header('Location: index.php');
  }
  $login = new login;
  $login->user = $_POST["User"];
  $login->pass = $_POST["Pass"];
  $estaLogeado=$login->login();

  if($estaLogeado == true){
    $cart = new carrito;
    $cart->creaCarrito();
    
  }else{
    session_start();
    $_SESSION['login']=false;

  }


  header('Location: index.php');  

 ?>
