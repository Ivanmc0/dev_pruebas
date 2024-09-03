<?php

    if($geton[0] == "" || $geton[0] == "tablero"){

        $mode = 2;
        include $roution."views/general/header-mode-$mode.php";
		include $roution."views/app_valora/workers/dashboard.php";
        include $roution."views/general/footer-mode-$mode.php";


    } elseif($geton[0] == "encuesta"){

        if($asignacion = $_ZOOM->get_data("grw_val_asignaciones", " AND uuid = '".$geton[1]."' ", 0)){
            if($encuesta = $_TUCOACH->get_data("grw_val_encuestas", " AND id = '".$asignacion['id_encuesta']."' AND eliminado = 0 ORDER BY id DESC ", 0)){

                include $roution."views/general/header-mode-2.php";
                include $roution."views/app_valora/pages/disc.php";
                include $roution."views/general/footer-mode-2.php";

            }
        }
    
    } elseif($geton[0] == "disc"){

        if($asignacion = $_ZOOM->get_data("grw_val_asignaciones", " AND uuid = '".$geton[1]."' ", 0)){
            if($encuesta = $_TUCOACH->get_data("grw_val_encuestas", " AND id = '".$asignacion['id_encuesta']."' AND eliminado = 0 ORDER BY id DESC ", 0)){
                if($empresa = $_TUCOACH->get_data("olc_empresas", " AND id = '".$encuesta["id_empresa"]."' AND eliminado = 0 ORDER BY id DESC ", 0)){

                    include $roution."views/general/header-mode-4.php";
                    include $roution."views/app_valora/pages/disc.php";
                    include $roution."views/general/footer-mode-4.php";

                }
            }
        }

    } elseif($geton[0] == "e"){

        if($asignacion = $_ZOOM->get_data("grw_val_asignaciones", " AND uuid = '".$geton[1]."' ", 0)){
            if($encuesta = $_TUCOACH->get_data("grw_val_encuestas", " AND id = '".$asignacion['id_encuesta']."' AND eliminado = 0 ORDER BY id DESC ", 0)){
                if($empresa = $_TUCOACH->get_data("olc_empresas", " AND id = '".$encuesta["id_empresa"]."' AND eliminado = 0 ORDER BY id DESC ", 0)){

                    include $roution."views/general/header-mode-4.php";
                    include $roution."views/app_valora/pages/valoracion-listaexterna.php";
                    include $roution."views/general/footer-mode-4.php";

                }
            }
        }

    } elseif($geton[0] == "a"){

        if($investigacion = $_ZOOM->get_data("grw_val_investigaciones", " AND uuid = '".$geton[1]."' ", 0)){
            if($encuesta = $_TUCOACH->get_data("grw_val_encuestas", " AND id = '".$investigacion['id_encuesta']."' AND eliminado = 0 ORDER BY id DESC ", 0)){
                if($empresa = $_TUCOACH->get_data("olc_empresas", " AND id = '".$investigacion["id_empresa"]."' AND eliminado = 0 ORDER BY id DESC ", 0)){

                    include $roution."views/general/header-mode-4.php";
                    include $roution."views/app_valora/pages/valoracion-anonima.php";
                    include $roution."views/general/footer-mode-4.php";

                }
            }
        }

    } elseif($geton[0] == "reporte-encuesta"){

        if($encuesta = $_TUCOACH->get_data("grw_val_encuestas", " AND uuid = '".$geton[1]."' AND eliminado = 0 ORDER BY id DESC ", 0)){
            $empresa = $_TUCOACH->get_data("olc_empresas", " AND id = '".$encuesta["id_empresa"]."' AND eliminado = 0 ORDER BY id DESC ", 0);
        }

        include $roution."views/general/header-mode-4.php";
        include $roution."views/app_valora/pages/reporte-encuesta.php";
        include $roution."views/general/footer-mode-4.php";

    } elseif($geton[0] == "gracias" && $empresa = $_TUCOACH->get_data("olc_empresas", " AND uuid = '".$geton[1]."' AND eliminado = 0 ORDER BY id DESC ", 0)){

        include $roution."views/general/header-mode-4.php";
        include $roution."views/app_valora/pages/gracias.php";
        include $roution."views/general/footer-mode-4.php";

    } else{

        if($encuesta = $_TUCOACH->get_data("grw_val_encuestas", " AND uuid = '".$geton[0]."' AND eliminado = 0 ORDER BY id DESC ", 0)){
            $empresa = $_TUCOACH->get_data("olc_empresas", " AND id = '".$encuesta["id_empresa"]."' AND eliminado = 0 ORDER BY id DESC ", 0);
        }

        include $roution."views/general/header-mode-4.php";
        include $roution."views/app_valora/pages/valoracion-anonima.php";
        include $roution."views/general/footer-mode-4.php";

    }