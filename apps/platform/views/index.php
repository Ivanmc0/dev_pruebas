<?php

    header('X-Frame-Options: DENY');

    $roution = (isset($hom) && $hom) ? "" : "../";

    require_once ($roution.'appInit.php');

    echo "<script>var roution  = '".$roution."', dominion = '".$dominion."', static   = '".$static."';</script>";


    if( $_TOKENS->CookiesExists() && $app == 'platform' && !isset($geton[0])){



    } else if(isset($_COVER)) $_CLIENTE = $_COMPANY->GetCompany($_COVER, 'subdominio');



    /*--------------------------------------------
        RUN VIEWS
    -----------------------------------------------*/
    include $roution."views/general/head.php";
    include $roution."views/views.php";
    include $roution."views/general/end.php";



