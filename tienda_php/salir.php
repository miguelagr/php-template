<?php
    session_start(); //Activamos variable

    unset( $_SESSION["User"] ); //quitamos esl cuadrito de nombre se referencia y su contenido
     unset( $_SESSION["Pass"] ); //quitamos esl cuadrito de nombre se referencia y su contenido
     unset($_SESSION["id_user"]);
    session_destroy();  //eliminar toda la variable de sesion

    if(!isset($_SESSION["User"] )){

        header("Location: index.php");
    }
    //else {
    //}

 ?>
