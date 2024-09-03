<?php session_start();

    session_destroy();
    echo '<span class="coloreee">Cerrando sesión...</span>';
    echo '
        <script>setTimeout(function(){
            $("#rtn_logout").html("¡Hasta pronto!");
        } , 2000);</script>
    ';
    echo "<script>setTimeout('location.reload()', 2000)</script>";

?>