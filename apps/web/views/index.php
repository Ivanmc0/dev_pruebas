<?php

    header('X-Frame-Options: DENY');

    if(isset($hom) && $hom) $roution = ""; else $roution = "../";
    require_once ($roution.'appInit.php');

    echo "<script>var roution  = '".$roution."', dominion = '".$dominion."', static   = '".$static."';</script>";

    $project = 2;
    $apps = $_RP->loadApps();

    /*--------------------------------------------
        RUN VIEWS
    -----------------------------------------------*/
    include $roution."views/general/head.php";
    include $roution."views/views.php";
    include $roution."views/general/end.php";

?>