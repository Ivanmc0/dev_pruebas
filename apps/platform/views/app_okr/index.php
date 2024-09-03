<?php

    if($_TOKENS->CookiesExists()){

        $trabajador = $_SESSION['WORKER'];
        $empresa    = $_SESSION['COMPANY'];
        $today      = $_TUCOACH->get_data("olc_semanas", " AND fecha_hasta >= '".date('Y-m-d')."' AND ano = '".date('Y')."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);

        if($geton[0] == ""){

            $PeriodoInicial = '2024-01-01 00:00:00';
            $PeriodoFinal   = '2024-12-31 23:59:59';

            $asignaciones = $_WORKERS->MyDashBoardOKR( $_SESSION['WORKER']['id']);

            $asignaciones["encurso"] = $_WORKERS->GetProcess('PYT', $_SESSION["COMPANY"]["id"], $_SESSION["WORKER"]["id"], $PeriodoInicial,  $PeriodoFinal )["pyts"];

            $setTabs      = [
                'tab'      => 'Mis Proyectos',
                'folder'   => 'app_okr',
                'cols'     => 'col-12 col-xl-4 mb30 mb20_oS',
                'file'     => 'proyecto.php',
                'colsR'    => 'col-12 col-xl-6 mb30 mb20_oS',
                'fileR'    => 'proyecto-reporte.php',
                'function' => 'ListadoReportesOKR',
            ];

            $mode = 2;
            $view = $roution."views/app_okr/views/proyectos.php";
            include $roution."views/general/header-mode-".$mode.".php";
            include $view;
            include $roution."views/general/footer-mode-".$mode.".php";

        } elseif($geton[0] == "proyecto"){

            $proyecto  = $_TUCOACH->get_data("grw_okr_proyectos", " AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id = ".$_SESSION["thisProject"]." AND inactivo = 0 AND eliminado = 0 ", 0);
            $listWeeks = $_TUCOACH->get_data("olc_semanas", " AND id >= ".$proyecto["id_semana_desde"]." AND id <= ".$proyecto["id_semana_hasta"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
            $estado    = array("Pendiente", "En proceso", "Finalizado");
            $week      = $today;
            $mode      = 3;

            include $roution."views/general/header-mode-".$mode.".php";

            if($geton[1] == "balance" && isset($_SESSION["thisProject"])){

                if(isset($geton[2]) && $geton[2] == "editar"){
                    include $roution."views/app_okr/views/modal/proyecto_editar.php";
                }else{
                    include $roution."views/app_okr/views/proyecto.php";
                    include $roution."views/app_okr/views/modal/objetivo_crear.php";
                }

            } else if($geton[1] == "balance-por-semanas" && isset($_SESSION["thisProject"])){

                include $roution."views/app_okr/views/balance-por-semanas.php";

            } else if($geton[1] == "tareas" && isset($_SESSION["thisProject"])){

                include $roution."views/app_okr/views/tareas.php";

            } else if($geton[1] == "tareas-semana" && isset($_SESSION["thisProject"])){

                include $roution."views/app_okr/views/tareas-semana.php";

            } else if($geton[1] == "tareas-terceros" && isset($_SESSION["thisProject"])){

                include $roution."views/app_okr/views/tareas-terceros.php";

            } else if($geton[1] == "tareas-personales" && isset($_SESSION["thisProject"])){



                if(isset($geton[3]) && $geton[3] == "editar"){
                    include $roution."views/app_okr/views/modal/tareapersonal_editar.php";
                }else{
                    include $roution."views/app_okr/views/tareas-personales.php";
                    include $roution."views/app_okr/views/modal/tareapersonal_crear.php";
                }


            } else if($geton[1] == "responsabilidades" && isset($_SESSION["thisProject"])){

                include $roution."views/app_okr/views/responsabilidades.php";

            } else if($geton[1] == "responsabilidades-terceros" && isset($_SESSION["thisProject"])){

                include $roution."views/app_okr/views/responsabilidades-terceros.php";

            } else if($geton[1] == "objetivo" && isset($_SESSION["thisProject"])){

                if(isset($geton[3]) && $geton[3] == "editar"){
                    include $roution."views/app_okr/views/modal/objetivo_editar.php";
                }else{
                    include $roution."views/app_okr/views/objetivo.php";
                    include $roution."views/app_okr/views/modal/kr_crear.php";
                }

            } else if($geton[1] == "kr" && isset($_SESSION["thisProject"])){

                if(isset($geton[3]) && $geton[3] == "editar"){
                    include $roution."views/app_okr/views/modal/kr_editar.php";
                }else{
                    include $roution."views/app_okr/views/kr.php";
                    include $roution."views/app_okr/views/modal/accion_crear.php";
                }

            } else if($geton[1] == "accizen" && isset($_SESSION["thisProject"])){

                if(isset($geton[3]) && $geton[3] == "editar"){
                    include $roution."views/app_okr/views/modal/accion_editar.php";
                }else{
                    include $roution."views/app_okr/views/accion.php";
                    include $roution."views/app_okr/views/modal/sprint_crear.php";
                }

            } else if($geton[1] == "sprint" && isset($_SESSION["thisProject"])){

                if(isset($geton[3]) && $geton[3] == "editar"){
                    include $roution."views/app_okr/views/modal/sprint_editar.php";
                }else{
                    include $roution."views/app_okr/views/sprint.php";
                    include $roution."views/app_okr/views/modal/tarea_crear.php";
                }

            } else if($geton[1] == "tarea" && isset($_SESSION["thisProject"])){

                if(isset($geton[3]) && $geton[3] == "editar"){
                    include $roution."views/app_okr/views/modal/tarea_editar.php";
                }else{
                    include $roution."views/app_okr/views/tarea.php";
                }

            } else if($geton[1] == "week" && isset($_SESSION["thisProject"])){

                include $roution."views/app_okr/views/week.php";

            } else echo '<script>location.href="'.$dominion.'";</script>';

            include $roution."views/app_okr/views/modal/corresponsables.php";
            include $roution."views/general/footer-mode-".$mode.".php";

        } else echo '<script>location.href="'.$dominion.'";</script>';

    } else {

        include $roution."views/general/header-mode-1.php";
        include $roution."views/pages/blank.php";
        include $roution."views/general/footer-mode-1.php";

    }

?>

<div id="rtn_task_on"></div>
<div id="rtn_tasks"></div>