<?php

    if($geton[0] == ""){

        include $roution."views/general/header-mode-1.php";
        include $roution."views/app_platform/users/login.php";
        include $roution."views/general/footer-mode-1.php";

    } elseif($geton[0] == "s"){//Support
        include $roution."views/general/header-mode-1.php";
        include $roution."views/app_platform/users/login.php";
        include $roution."views/general/footer-mode-1.php";

    } elseif($geton[0] == "recuperar"){

        include $roution."views/general/header-mode-1.php";
        include $roution."views/app_platform/users/recover.php";
        include $roution."views/general/footer-mode-1.php";

    } elseif($geton[0] == "reset"){
        $UserToken = $geton[1];
        include $roution."views/general/header-mode-1.php";
        include $roution."views/app_platform/users/reset.php";
        include $roution."views/general/footer-mode-1.php";

    } elseif( $geton[0] == "reporte" && $_TOKENS->CookiesExists()){

        $mode       = 2;
        $builder    = 1;

        include $roution."views/general/header-mode-$mode.php";
        include $roution."views/app_platform/pages/reporte.php";
        include $roution."views/general/footer-mode-$mode.php";

    } elseif( $geton[0] == "tablero" && $_TOKENS->CookiesExists()){

        $trabajador = $_SESSION["WORKER"];
        $empresa    = $_SESSION["COMPANY"];
        $mode       = 2;

        include $roution."views/general/header-mode-$mode.php";
        include $roution."views/app_platform/worker/dashboard.php";
        include $roution."views/general/footer-mode-$mode.php";

    } elseif( $geton[0] == "jj" && $_TOKENS->CookiesExists()){

        $trabajador = $_SESSION["WORKER"];
        $empresa    = $_SESSION["COMPANY"];
        $mode       = 2;

        include $roution."views/general/header-mode-$mode.php";
        include $roution."views/app_platform/worker/jj.php";
        include $roution."views/general/footer-mode-$mode.php";

    } elseif( $geton[0] == "ion" && $_TOKENS->CookiesExists()){

        $trabajador = $_SESSION["WORKER"];
        $empresa    = $_SESSION["COMPANY"];
        $mode       = 2;

        include $roution."views/general/header-mode-$mode.php";
        include $roution."views/app_platform/worker/ion.php";
        include $roution."views/general/footer-mode-$mode.php";

    } elseif( $geton[0] == "perfil" && $_TOKENS->CookiesExists()){

        $trabajador = $_SESSION["WORKER"];
        $empresa    = $_SESSION["COMPANY"];
        $mode       = 2;

        include $roution."views/general/header-mode-$mode.php";
        include $roution."views/app_platform/worker/perfil.php";
        include $roution."views/general/footer-mode-$mode.php";

    } elseif( $geton[0] == "grupo" && $_TOKENS->CookiesExists()){

        $mode       = 2;
        $builder    = true;

        include $roution."views/general/header-mode-$mode.php";
        include $roution."views/app_platform/worker/grupo.php";
        include $roution."views/general/footer-mode-$mode.php";

    } elseif( $geton[0] == "beneficios" && $_TOKENS->CookiesExists()){

            $mode       = 2;
            $builder    = true;

            include $roution."views/general/header-mode-$mode.php";
            include $roution."views/app_platform/worker/beneficios.php";
            include $roution."views/general/footer-mode-$mode.php";

    } elseif( $geton[0] == "reconocimientos" && $_TOKENS->CookiesExists()){

        $mode       = 2;
        $builder    = true;

        include $roution."views/general/header-mode-$mode.php";
        include $roution."views/app_platform/worker/reconocimientos.php";
        include $roution."views/general/footer-mode-$mode.php";


    } elseif( $geton[0] == "panel-control" && $_TOKENS->CookiesExists() && $_SESSION['WORKER']['admin'] == 1 && isset($_SESSION['ADMIN'])){

        $mode = 3;

        if( !isset($geton[1]) ){

            include $roution."views/general/header-mode-$mode.php";
            include $roution."views/app_platform/admin/control-panel.php";
            include $roution."views/general/footer-mode-$mode.php";

        } elseif(isset($geton[1]) && !isset($geton[3]) && !isset($geton[4])){

            include $roution."views/general/header-mode-$mode.php";
            include $roution."views/app_platform/admin/lists.php";
            include $roution."views/general/footer-mode-$mode.php";

        } elseif(isset($geton[3]) && !isset($geton[4])){

            include $roution."views/general/header-mode-$mode.php";
            include $roution."views/app_platform/admin/details.php";
            include $roution."views/general/footer-mode-$mode.php";

        } elseif(isset($geton[4])){

            $mode = 2;
            $builder = true;
            include $roution."views/general/header-mode-$mode.php";
            include $roution."views/app_platform/admin/$geton[3].php";
            include $roution."views/general/footer-mode-$mode.php";

        } else echo '<script>location.href="'.$dominion.'tablero/";</script>';

    }

    else echo '<script>location.href="'.$dominion.'";</script>';