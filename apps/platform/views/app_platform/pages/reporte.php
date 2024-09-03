<?php
    if(!$this_proceso = $_GROWI->GetCampos ( "olc_procesos", "nombre, id_app", " codigo = '".$geton[1]."'  ", 0 )){
        echo '<div class="taC tU t16 ff0 colorGrowi t30 pAA80">Error cargando el proceso.</div>';
    }

    if(!$thisApp = $_GROWI->GetCampos ( "olc_apps", "name, app, logo, color", " id = '".$this_proceso["id_app"]."'  ", 0 )){
        echo '<div class="taC tU t16 ff0 colorGrowi t30 pAA80">Error cargando la app del proceso.</div>';
    }

    $prmtrs = [
        'ACT' => [
            'class'             => 'LELE',
            'function'          => 'ReportACT',
            'addToQuery'        => " AND ACTIV.uuid = '".$geton[2]."' ",
            'parametersToQuery' => [ 'empresa' => 'ACTIV.id_empresa', 'QuerySolutions' => " AND ACT.uuid = '".$geton[2]."' " ],
            'returnRecord'      => false
        ],
    ];


    if($report = $_GROWI->GET($prmtrs[$geton[1]]["class"], $prmtrs[$geton[1]]["function"], $prmtrs[$geton[1]]["addToQuery"], $prmtrs[$geton[1]]["parametersToQuery"], $prmtrs[$geton[1]]["returnRecord"])){

        echo '<div class="app-'.$thisApp['app'].' mb50">';

        include 'reporte/head.php';

        echo '<div class="general1600" style="z-index:2">';

        include 'reporte/header.php';



        echo '</div>';
        echo '</div>';

    }else{

        echo '<div class="taC tU t16 ff0 colorGrowi t30 pAA80">Error cargando el proceso.</div>';

    }

    // Debug::Mostrar($report);


    // echo "Error 602<hr>";
    // die();



?>





    <div class="general1600" style="z-index:2">
        <?php
            if($report) {
                echo '<h4 class="tU t30 tB teal ">'.($report["nombre"]).'</h4>';
                echo '<div class="tab bValora colorfff p10 mb20">';
                echo '<div class="tabIn t14 ff3">dinamicas: '.($report["balance"]["c_dinamicas"])."</div>";
                echo '<div class="tabIn t14 ff3">Solucionadores: '.($report["balance"]["c_solucionadores"])."</div>";
                echo '<div class="tabIn t14 ff3">sumatoria: '.($report["balance"]["sumatoria"])."%</div>";
                echo '<div class="tabIn t14 ff3">Total: '.($report["balance"]["total"])."%</div>";
                echo "</div>";

                if($report["dinamicas"]) {
                    foreach($report["dinamicas"] AS $dynamic){
        ?>
                        <div class="card">
                            <div class="card-content collapse show">

                                <div class="card-header bGray">
                                    <div id="rtn_list" class="fR taR"></div>
                                    <h4 class="card-title">
                                        <div class="tab">
                                            <div class="tabIn"><?= ($dynamic["nombre"]); ?></div>
                                            <div class="tabIn taR t14">
                                                <i>
                                                    <?= $dynamic["modelo"]["nombre"]; ?>
                                                    de tipo
                                                    <?= $dynamic["tipo_modelo"]["nombre"]; ?>
                                                </i>
                                            </div>
                                        </div>

                                        <?php
                                            echo '<div class="tab bValora colorfff p10">';
                                            echo '<div class="tabIn t14 ff3">Preguntas: '.($dynamic["balance"]["c_preguntas"])."</div>";
                                            echo '<div class="tabIn t14 ff3">Sumatoria: '.($dynamic["balance"]["sumatoria"])."</div>";
                                            echo '<div class="tabIn t14 ff3">Solucionadores: '.($dynamic["balance"]["c_solucionadores"])."</div>";
                                            echo '<div class="tabIn t14 ff3">Total: '.($dynamic["balance"]["total"])."%</div>";
                                            echo "</div>";
                                        ?>
                                    </h4>
                                </div>
                                <div class="card-body">

                                    <?php
                                        if($dynamic["modelo"]["id"] == 3){

                                            if($aportes = $_ZOOM->get_data("grw_sol_act_campanias", " AND id_dinamica = ".$dynamic['id']." ORDER BY id DESC ", 1)){

                                                echo '<div style="max-height:400px; overflow:auto">';
                                                foreach($aportes AS $aporte){
                                                    echo '<div class="tab bGray p20 mb5">';
                                                    echo '<div class="tabIn w200x">'.$trabajadores[$aporte["id_trabajador"]]["nombre"].'</div>';
                                                    echo '<div class="tabIn pLR20">'.$aporte["comentarios"].'</div>';
                                                    echo '<div class="tabIn w100x taR">'.$aporte["fecha"].'</div>';
                                                    echo '</div>';
                                                }
                                                echo '</div>';

                                            } else echo '<div class="taC tU t16 p10">No hay participaciones aún</div>';

                                        }else if($dynamic["modelo"]["id"] == 2){

                                            if($recos = $_ZOOM->get_data("grw_sol_act_reconocimientos", " AND id_dinamica = ".$dynamic['id']." ORDER BY id DESC ", 1)){

                                                $rcedores = [];
                                                $rcimientos = [];
                                                $rnocidos = [];
                                                $maxmos = $reconocimientos;

                                                echo '<div class="tB t16 mb10">Listado de Reconocimientos ('.(count($recos)).')</div>';
                                                echo '<div style="max-height:400px; overflow:auto">';
                                                echo '<div class="tab bGray p20 mb5">';
                                                echo '<div class="tabIn w150x"><div class="t12">Reconocedor</div></div>';
                                                echo '<div class="tabIn w150x"><div class="t12">Reconocimiento</div></div>';
                                                echo '<div class="tabIn w150x"><div class="t12">Reconocido</div></div>';
                                                echo '<div class="tabIn pLR20"><div class="t12">Justificación</div></div>';
                                                echo '<div class="tabIn w100x"><div class="t12">Fecha</div></div>';
                                                echo '</div>';

                                                foreach($recos AS $reco){
                                                    if(isset($rcedores[$reco["id_trabajador"]])){
                                                        $rcedores[$reco["id_trabajador"]]["cantidad"]++;
                                                    }else{
                                                        $rcedores[$reco["id_trabajador"]]["nombre"] = $trabajadores[$reco["id_trabajador"]]["nombre"];
                                                        $rcedores[$reco["id_trabajador"]]["cantidad"] = 1;
                                                    }
                                                    if(isset($rnocidos[$reco["id_reconocido"]])){
                                                        $rnocidos[$reco["id_reconocido"]]["cantidad"]++;
                                                    }else{
                                                        $rnocidos[$reco["id_reconocido"]]["nombre"] = $trabajadores[$reco["id_reconocido"]]["nombre"];
                                                        $rnocidos[$reco["id_reconocido"]]["cantidad"] = 1;
                                                    }
                                                    if(isset($rcimientos[$reco["id_reconocimiento"]])){
                                                        $rcimientos[$reco["id_reconocimiento"]]["cantidad"]++;
                                                    }else{
                                                        $rcimientos[$reco["id_reconocimiento"]]["nombre"] = $reconocimientos[$reco["id_reconocimiento"]]["nombre"];
                                                        $rcimientos[$reco["id_reconocimiento"]]["cantidad"] = 1;
                                                    }

                                                    foreach ($maxmos as $key => $maxmo) {
                                                        if($reco["id_reconocimiento"] == $maxmo["id"]){
                                                            if(isset($maxmos[$key]["trabajadores"][$reco["id_reconocido"]])){
                                                                $maxmos[$key]["trabajadores"][$reco["id_reconocido"]]["cantidad"]++;
                                                            }else{
                                                                $maxmos[$key]["trabajadores"][$reco["id_reconocido"]]["nombre"] = $trabajadores[$reco["id_reconocido"]]["nombre"];
                                                                $maxmos[$key]["trabajadores"][$reco["id_reconocido"]]["cantidad"] = 1;
                                                            }
                                                        }
                                                    }

                                                    echo '<div class="tab bGray p20 mb5">';
                                                    echo '<div class="tabIn w150x">'.$trabajadores[$reco["id_trabajador"]]["nombre"].'</div>';
                                                    echo '<div class="tabIn w150x">'.$reconocimientos[$reco["id_reconocimiento"]]["nombre"].'</div>';
                                                    echo '<div class="tabIn w150x">'.$trabajadores[$reco["id_reconocido"]]["nombre"].'</div>';
                                                    echo '<div class="tabIn pLR20">'.$reco["comentarios"].'</div>';
                                                    echo '<div class="tabIn w100x taR">'.$reco["fecha"].'</div>';
                                                    echo '</div>';
                                                }
                                                echo '</div>';

                                                echo '<div class="h30"></div>';


                                                echo '<div class="row">';

                                                echo '<div class="col-12 col-lg-3">';
                                                echo '<div class="tB t14 mb10">Top Reconocedores ('.(count($rcedores)).')</div>';
                                                echo '<div style="max-height:400px; overflow:auto">';
                                                echo '<div class="tab bGray p20 mb5">';
                                                echo '<div class="tabIn w150x"><div class="t12">Reconocedor</div></div>';
                                                echo '<div class="tabIn w100x taR"><div class="t12">Cantidad</div></div>';
                                                echo '</div>';
                                                $rcedores = array_sort($rcedores, 'cantidad', SORT_DESC);
                                                foreach($rcedores AS $rcedor){
                                                    echo '<div class="tab bGray p20 mb5">';
                                                    echo '<div class="tabIn w150x">'.$rcedor["nombre"].'</div>';
                                                    echo '<div class="tabIn w100x taR">'.$rcedor["cantidad"].'</div>';
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                                echo '</div>';

                                                echo '<div class="col-12 col-lg-3">';
                                                echo '<div class="tB t14 mb10">Top Reconocidos ('.(count($rnocidos)).')</div>';
                                                echo '<div style="max-height:400px; overflow:auto">';
                                                echo '<div class="tab bGray p20 mb5">';
                                                echo '<div class="tabIn w150x"><div class="t12">Reconocido</div></div>';
                                                echo '<div class="tabIn w100x taR"><div class="t12">Cantidad</div></div>';
                                                echo '</div>';
                                                $rnocidos = array_sort($rnocidos, 'cantidad', SORT_DESC);
                                                foreach($rnocidos AS $rnocido){
                                                    echo '<div class="tab bGray p20 mb5">';
                                                    echo '<div class="tabIn w150x">'.$rnocido["nombre"].'</div>';
                                                    echo '<div class="tabIn w100x taR">'.$rnocido["cantidad"].'</div>';
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                                echo '</div>';

                                                echo '<div class="col-12 col-lg-3">';
                                                echo '<div class="tB t14 mb10">Top Reconocimientos ('.(count($rcimientos)).')</div>';
                                                echo '<div style="max-height:400px; overflow:auto">';
                                                echo '<div class="tab bGray p20 mb5">';
                                                echo '<div class="tabIn w150x"><div class="t12">Reconocimiento</div></div>';
                                                echo '<div class="tabIn w100x taR"><div class="t12">Cantidad</div></div>';
                                                echo '</div>';
                                                $rcimientos = array_sort($rcimientos, 'cantidad', SORT_DESC);
                                                foreach($rcimientos AS $rcimiento){
                                                    echo '<div class="tab bGray p20 mb5">';
                                                    echo '<div class="tabIn w150x">'.$rcimiento["nombre"].'</div>';
                                                    echo '<div class="tabIn w100x taR">'.$rcimiento["cantidad"].'</div>';
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                                echo '</div>';

                                                echo '<div class="col-12 col-lg-3">';
                                                echo '<div class="tB t14 mb10">Top Colaboradores x Reconocimiento ('.(count($rcimientos)).')</div>';
                                                echo '<div style="max-height:400px; overflow:auto">';
                                                echo '<div class="tab bGray p20 mb5">';
                                                echo '<div class="tabIn w150x"><div class="t12">Reconocimiento</div></div>';
                                                echo '<div class="tabIn"><div class="t12">Reconocido</div></div>';
                                                echo '<div class="tabIn w100x taR"><div class="t12">Cantidad</div></div>';
                                                echo '</div>';
                                                foreach ($maxmos as $key => $maxmo) {
                                                    if(isset($maxmo["trabajadores"])){
                                                        $maxmoOrd = array_sort($maxmo["trabajadores"], 'cantidad', SORT_DESC);
                                                        $print = 1;
                                                        foreach($maxmoOrd AS $max){
                                                            if($print > 0){
                                                                echo '<div class="tab bGray p1020 mb5 success">';
                                                                echo '<div class="tabIn w150x">'.$maxmo["nombre"].'</div>';
                                                                echo '<div class="tabIn">'.$max["nombre"].'</div>';
                                                                echo '<div class="tabIn w100x taR">'.$max["cantidad"].'</div>';
                                                                echo '</div>';
                                                                $print--;
                                                            }else{
                                                                echo '<div class="tab bGray p510 mb5">';
                                                                echo '<div class="tabIn t10 w150x pL10">'.$maxmo["nombre"].'</div>';
                                                                echo '<div class="tabIn t10 pLR10">'.$max["nombre"].'</div>';
                                                                echo '<div class="tabIn t10 w100x pR10 taR">'.$max["cantidad"].'</div>';
                                                                echo '</div>';
                                                            }
                                                        }
                                                    }
                                                }
                                                echo '</div>';
                                                echo '</div>';



                                                echo '</div>';

                                            } else echo '<div class="taC tU t16 p10">No hay reconocimientos otorgados aún</div>';


                                        }else if($dynamic["modelo"]["id"] == 1){
                                    ?>

                                    <div class="">
                                        <?php
                                            // $getPreguntas = $_ZOOM->get_data('grw_lel_preguntas', ' AND id_dinamica = '.$dynamic["id"].' AND inactivo = 0 AND eliminado = 0', 1);
                                            if ($dynamic["preguntas"]) {
                                                foreach ($dynamic["preguntas"] as $question) {


                                                    echo '<div class="tab beee p20">';
                                                    echo '<div class="tabIn t18 ff3">'.($question["nombre"]);
                                                    echo '<div class="tab bValora2 p10">';
                                                    echo '<div class="tabIn t14 ff3">Correctas: '.($question["balance"]["correctas"])."</div>";
                                                    echo '<div class="tabIn t14 ff3">Incorrectas: '.($question["balance"]["incorrectas"])."</div>";
                                                    echo '<div class="tabIn t14 ff3">Soluciones: '.($question["balance"]["c_soluciones"])."</div>";
                                                    echo '<div class="tabIn t14 ff3">Solucionadores: '.($question["balance"]["c_solucionadores"])."</div>";
                                                    echo '<div class="tabIn t14 ff3">sumatoria: '.($question["balance"]["sumatoria"])."</div>";
                                                    echo '<div class="tabIn t14 ff3">Total: '.($question["balance"]["total"])."%</div>";
                                                    echo "</div>";
                                                    echo "</div>";
                                                    echo '<div class="tabIn t14 ff3 taR"><i>'.($question["tipo"]["nombre"])."</i></div>";
                                                    echo "</div>";

                                                    if($question["tipo"]["id"] == 1){
                                                        if($question["respuestas"]){
                                                            foreach($question["respuestas"] AS $key => $answer){
                                                                // if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                if($answer["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                echo '<div class="tabIn taR pLR20">Soluciones: '.$answer["balance"]["c_soluciones"].'</div>';
                                                                echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                                echo '</div>';
                                                            }
                                                        }
                                                    }elseif($question["tipo"]["id"] == 2){
                                                        if($question["respuestas"]){
                                                            foreach($question["respuestas"] AS $key => $answer){
                                                                if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                if($answer["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                echo '<div class="tabIn taR pLR20">Soluciones: '.$answer["balance"]["c_soluciones"].'</div>';
                                                                echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                                echo '</div>';
                                                            }
                                                        }
                                                    }elseif($question["tipo"]["id"] == 3){
                                                        if($respuestas){
                                                            foreach($respuestas["respuestas"] AS $key => $answer){
                                                                if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                echo '<div class="tabIn taR pL20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                echo '</div>';
                                                            }
                                                        }
                                                    }elseif($question["tipo"]["id"] == 4){
                                                        if($respuestas){
                                                            foreach($respuestas["respuestas"] AS $key => $answer){
                                                                if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                echo '<div class="tabIn taR pL20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                echo '</div>';
                                                            }
                                                        }
                                                    }elseif($question["tipo"]["id"] == 5){

                                                        if(isset($respuestas["soluciones"])){
                                                            $txt = "";
                                                            $rad = explode("|", ($respuestas["soluciones"]));
                                                            foreach($rad AS $value) $txt .= '<div class="bS1 p510 t12 beee mb3">'.$value."</div>";
                                                        } else $txt = '<div class="taC tU t16 p10">Sin resultados</div>';

                                                        echo '<div class="tab bGray p20 mb5">';
                                                        echo '<div class="tabIn">'.$txt.'</div>';
                                                        echo '</div>';


                                                    }

                                                    /*
                                                    $grupos = $_ZOOM->get_data("grw_segmentaciones", " AND ( id_empresa = ".$report["id_empresa"].") AND eliminado = 0 ORDER BY id_empresa ASC, id ASC ", 1);
                                                    if($grupos){
                                                        $cou1 = 1;
                                                        echo '<div class="bGray p20 mb30">';
                                                        echo '<div class="tB mb5">Soluciones por parámetros</div>';
                                                        echo '<ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified" id="" role="tablist">';
                                                        foreach ($grupos as $key => $grupo) {
                                                            $act1 = $cou1 == 1 ? "active" : "" ;
                                                            $act2 = $cou1 == 1 ? "true" : "false" ;
                                                            echo '
                                                                <li class="nav-item">
                                                                    <a class="nav-link '.$act1.'" id="tabN1-'.$question["id"].'-'.$grupo["id"].'-tab" data-toggle="tab" href="#tabN1-'.$question["id"].'-'.$grupo["id"].'"
                                                                        role="tab" aria-controls="tabN1-'.$question["id"].'-'.$grupo["id"].'" aria-selected="'.$act2.'">'.($grupo["nombre"]).'</a>
                                                                </li>
                                                            ';
                                                            $cou1++;
                                                        }
                                                        echo '</ul><div class="tab-content bfff" id="">';
                                                        $cou1 = 1;
                                                        foreach ($grupos as $key => $grupo) {

                                                            $act3 = $cou1 == 1 ? "show active" : "" ;
                                                            echo '
                                                                <div class="tab-pane fade '.$act3.'" id="tabN1-'.$question["id"].'-'.$grupo["id"].'" role="tabpanel"
                                                                    aria-labelledby="tabN1-'.$question["id"].'-'.$grupo["id"].'-tab">
                                                            ';
                                                            $parametros = $_ZOOM->get_data("grw_segmentos", " AND id_parametro = '".$grupo["id"]."' AND eliminado = 0 ORDER BY id ASC ", 1);
                                                            if($parametros){

                                                                $cou2 = 1;
                                                                echo '<ul class="nav nav-tabs nav-underline no-hover-bg" id="" role="tablist">';
                                                                foreach ($parametros as $key => $parametro) {

                                                                    $act11 = $cou2 == 1 ? "active" : "" ;
                                                                    $act22 = $cou2 == 1 ? "true" : "false" ;
                                                                    echo '
                                                                        <li class="nav-item">
                                                                            <a class="nav-link '.$act11.'" id="tabN1-'.$question["id"].'-'.$grupo["id"].'-'.$parametro["id"].'-tab" data-toggle="tab" href="#tabN1-'.$question["id"].'-'.$grupo["id"].'-'.$parametro["id"].'"
                                                                                role="tab" aria-controls="tabN1-'.$question["id"].'-'.$grupo["id"].'-'.$parametro["id"].'" aria-selected="'.$act22.'">'.($parametro["nombre"]).'</a>
                                                                        </li>
                                                                    ';
                                                                    $cou2++;

                                                                }

                                                                echo '</ul><div class="tab-content bfff" id="">';

                                                                $cou2 = 1;

                                                                foreach ($parametros as $key => $parametro) {
                                                                    $act33 = $cou2 == 1 ? "show active" : "" ;

                                                                    echo '
                                                                        <div class="tab-pane fade '.$act33.'" id="tabN1-'.$question["id"].'-'.$grupo["id"].'-'.$parametro["id"].'" role="tabpanel"
                                                                            aria-labelledby="tabN1-'.$question["id"].'-'.$grupo["id"].'-'.$parametro["id"].'-tab">
                                                                    ';

                                                                        $respuestas = $_ZOOM->obtenerRespuestas($question["id"], $dynamic["id_tipo"], $question["tipo"]["id"], $parametro["id"]);

                                                                        // echo '<div class="tab beee p20">';
                                                                        // echo '<div class="tabIn t18 ff3">'.($question["nombre"])."</div>";
                                                                        // echo '<div class="tabIn t14 ff3 taR"><i>'.($modos[$question["tipo"]["id"]]["nombre"])."</i></div>";
                                                                        // echo "</div>";

                                                                        if($question["tipo"]["id"] == 1){
                                                                            if($respuestas){
                                                                                foreach($respuestas["respuestas"] AS $key => $answer){
                                                                                    if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                    if($answer["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                                                    echo '<div class="tab bGray p1020 mb5">';
                                                                                    echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                                    echo '<div class="tabIn taR pLR20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                    echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                                                    echo '</div>';
                                                                                }
                                                                            } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                        }elseif($question["tipo"]["id"] == 2){
                                                                            if($respuestas){
                                                                                foreach($respuestas["respuestas"] AS $key => $answer){
                                                                                    if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                    if($answer["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                                                    echo '<div class="tab bGray p1020 mb5">';
                                                                                    echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                                    echo '<div class="tabIn taR pLR20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                    echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                                                    echo '</div>';
                                                                                }
                                                                            } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                        }elseif($question["tipo"]["id"] == 3){
                                                                            if($respuestas){
                                                                                foreach($respuestas["respuestas"] AS $key => $answer){
                                                                                    if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                    echo '<div class="tab bGray p1020 mb5">';
                                                                                    echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                                    echo '<div class="tabIn taR pL20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                    echo '</div>';
                                                                                }
                                                                            } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                        }elseif($question["tipo"]["id"] == 4){
                                                                            if($respuestas){
                                                                                foreach($respuestas["respuestas"] AS $key => $answer){
                                                                                    if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                    if($answer["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                                                    echo '<div class="tab bGray p1020 mb5">';
                                                                                    echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                                    echo '<div class="tabIn taR pLR20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                    echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                                                    echo '</div>';
                                                                                }
                                                                            } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                        }elseif($question["tipo"]["id"] == 5){
                                                                            echo '<div class="tab bGray p20 mb5">';
                                                                            echo '<div class="tabIn">';
                                                                            if(isset($respuestas["soluciones"])){
                                                                                $txt = "";
                                                                                $rad = explode("|", ($respuestas["soluciones"]));
                                                                                foreach($rad AS $value) $txt .= '<div class="bS1 p510 t12 beee mb3">'.$value."</div>";
                                                                                echo $txt;
                                                                            } else echo '<div class="taC tU t16 p10">Sin resultados</div>';
                                                                            echo '</div>';
                                                                            echo '</div>';
                                                                            // echo '<pre>';
                                                                            // print_r($respuestas);
                                                                            // echo '</pre>';
                                                                        }


                                                                    echo '</div>';
                                                                    $cou2++;
                                                                }
                                                                echo '</div>';
                                                            }
                                                            echo '</div>';
                                                            $cou1++;
                                                        }
                                                        echo '</div>';
                                                        echo '</div>';

                                                    }
                                                    */


                                                }
                                            }
                                        ?>
                                    </div>

                                    <?php } ?>

                                </div>
                            </div>
                        </div>
        <?php
                    }
                } else echo '<div class="taC p40 t24">No se puede establecer un balance aún!</div>';
            } else echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>';
        ?>

    </div>