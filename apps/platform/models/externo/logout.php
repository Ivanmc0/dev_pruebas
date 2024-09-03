<?php session_start();

    unset($_SESSION["ae_id"]);
    unset($_SESSION["ae_nombre"]);
    unset($_SESSION["ae_identificacion"]);
    unset($_SESSION["ae_email"]);
    unset($_SESSION["ae_celular"]);
    unset($_SESSION["ae_hash"]);


    echo '<span>Cerrando sesión...</span>';
    echo '<script>setTimeout(function(){
            $(".logout").html("¡Hasta pronto!");
          }, 1000);</script>';
    echo '<script>setTimeout(function(){
            location.reload();
          }, 2000);</script>';


?>