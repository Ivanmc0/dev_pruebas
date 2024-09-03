<?php

    header('X-Frame-Options: DENY');

    if(isset($hom) && $hom) $roution = ""; else $roution = "../";

    require_once ($roution.'appInit.php');

    /*--------------------------------------------
        RUN VIEWS
    -----------------------------------------------*/
    include $roution."views/general/head.php";
    include $roution."views/views.php";
    include $roution."views/general/end.php";

?>
