<?php

    if($geton[0] == "bancow-2024"){

        $empresa = $_TUCOACH->get_data("olc_empresas", " AND id = 15180 AND eliminado = 0 ORDER BY id DESC ", 0);

        include $roution."views/general/header-mode-4.php";

        if(isset($geton[1]) && $geton[1] == "balance") 	include $roution."views/app_leletog/views/bancow24/balance.php";
        if(isset($geton[1]) && $geton[1] == "ranking") 	include $roution."views/app_leletog/views/bancow24/ranking.php";

        include $roution."views/general/footer-mode-4.php";

    }else if($geton[0] == "graph"){

        $empresa = $_TUCOACH->get_data("olc_empresas", " AND id = 2 AND eliminado = 0 ORDER BY id DESC ", 0);


        include $roution."views/general/header-mode-4.php";

        if(isset($geton[1]) && $geton[1] == "import") 	include $roution."views/app_leletog/views/graph/import.php";

        include $roution."views/general/footer-mode-4.php";

    }else if($_TOKENS->CookiesExists()){

        $mode       = 2;
        $empresa    = $_SESSION["COMPANY"];
        $trabajador = $_SESSION["WORKER"];
        $perfil     = $_ZOOM->get_data("grw_sol_seg_perfilado", " AND id_trabajador = ".$trabajador["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND eliminado = 0 ORDER BY id DESC ", 1);

        if($geton[0] == "" || $geton[0] == "tablero"){

            $asignaciones = $_WORKERS->MyDashBoardLeletog( $_SESSION['WORKER']['id'] );

            if(isset($asignaciones["encurso"]) && $asignaciones["encurso"]){
                usort($asignaciones["encurso"], function($a, $b) {
                    return $a['totales']['avance'] <=> $b['totales']['avance'];
                });
            }

            $setTabs = [
                'tab'      => 'Mis Actividades',
                'folder'   => 'app_leletog',
                'cols'     => 'col-12 col-xl-4 col-xxl-4 mb30 mb20_oS',
                'file'     => 'actividad.php',
                'colsR'    => 'col-12 col-xl-3 mb30 mb20_oS',
                'fileR'    => 'actividad-reporte.php',
                'function' => 'ListadoReportesLeletog',
            ];

        }

        include $roution."views/general/header-mode-$mode.php";

        if($geton[0] == "" || $geton[0] == "tablero")   include $roution."views/app_leletog/views/mi-tablero.php";
        if($geton[0] == "detalle-categoria") 			include $roution."views/app_leletog/views/categoria-detalle.php";
        if($geton[0] == "detalle-actividad") 			include $roution."views/app_leletog/views/actividad-detalle.php";
        if($geton[0] == "interactividad") 			    include $roution."views/app_leletog/views/edit-temp-interactividad.php";

        if($geton[0] == "lider")		include $roution."views/app_leletog/views/actividad-lider2.php";
        if($geton[0] == "organizacion")	include $roution."views/app_leletog/views/organizacion.php";
        if($geton[0] == "reconocimientos")	include $roution."views/app_leletog/views/reconocimientos.php";
        if($geton[0] == "reconocimiento")	include $roution."views/app_leletog/views/reconocimiento.php";

        if($geton[0] == "mi-perfil-empresarial")	include $roution."views/app_leletog/views/mi-perfil-empresarial.php";
        if($geton[0] == "completar-perfil")	include $roution."views/app_leletog/views/completar-perfil.php";
        if($geton[0] == "completar-jefe")	include $roution."views/app_leletog/views/completar-jefe.php";

        include $roution."views/general/footer-mode-$mode.php";

	} else {

		include $roution."views/general/header-mode-1.php";
		include $roution."views/pages/blank.php";
		include $roution."views/general/footer-mode-1.php";

	}