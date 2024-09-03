<div class="content-body">
    <?php
        $tablus     = $access_model["tabla"];
        $getThis    = $_ZOOM->get_data($tablus, " AND id = " . $id . " ORDER BY id DESC ", 0);
        if($getThis) {

            $trabajadores = SetPositionArray($_ZOOM->get_data("zoom_users", " AND id_empresa = " . $getThis["id_empresa"] . " AND eliminado = 0 ORDER BY id ASC ", 1), 'id');
            $reconocimientos = SetPositionArray($_ZOOM->get_data("grw_reconocimientos", " AND id_empresa = " . $getThis["id_empresa"] . " AND eliminado = 0 ORDER BY id ASC ", 1), 'id');

            echo '<h4 class="tU t30 tB teal mb20">'.($getThis["nombre"]).'</h4>';
            $tipos      = array();
            $modos      = array();
            $_tipos     = $_ZOOM->get_data("olc_modelos_tipos", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
            foreach ($_tipos as $key => $_tipo) {
                $tipos[$_tipo["id"]]["id"]      = $_tipo["id"];
                $tipos[$_tipo["id"]]["nombre"]  = $_tipo["nombre"];
            }
            $_modos      = $_ZOOM->get_data("olc_preguntas_tipos", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
            foreach ($_modos as $key => $_modo) {
                $modos[$_modo["id"]]["id"]      = $_modo["id"];
                $modos[$_modo["id"]]["nombre"]  = $_modo["nombre"];
            }

            $listados   = $_ZOOM->get_data("grw_lel_dinamicas", " AND id_actividad = " . $id . " AND eliminado = 0 ORDER BY prioridad ASC ", 1);
            if($listados) {
                foreach($listados AS $listado){
    ?>
                    <div class="card">
                        <div class="card-content collapse show">

                            <div class="card-header bGray">
                                <div id="rtn_list" class="fR taR"></div>
                                <h4 class="card-title">
                                    <div class="tab">
                                    <div class="tabIn"><?= ($listado["nombre"]); ?></div>
                                    <div class="tabIn taR t14"><i><?= ($listado["id_modelo"] == 3) ? 'Campaña de mejoramiento' : (($listado["id_modelo"] == 2) ? 'Reconocimientos' : 'Encuesta'); ?> de tipo <?= ($tipos[$listado["id_tipo"]]["nombre"]); ?></i></div>
                                    </div>
                                </h4>
                            </div>
                            <div class="card-body">

                                <?php
                                    if($listado["id_modelo"] == 3){

                                        if($aportes = $_ZOOM->get_data("grw_sol_act_campanias", " AND id_dinamica = ".$listado['id']." ORDER BY id DESC ", 1)){

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

                                    }else if($listado["id_modelo"] == 2){

                                        if($recos = $_ZOOM->get_data("grw_sol_act_reconocimientos", " AND id_dinamica = ".$listado['id']." ORDER BY id DESC ", 1)){

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


                                    }else if($listado["id_modelo"] == 1){
                                ?>

                                <div class="">
                                    <?php
                                        $getPreguntas = $_ZOOM->get_data('grw_lel_preguntas', ' AND id_dinamica = '.$listado["id"].' AND inactivo = 0 AND eliminado = 0', 1);
                                        if ($getPreguntas) {
                                            foreach ($getPreguntas as $pre) {

                                                $respuestas = $_ZOOM->obtenerRespuestas($pre["id"], $listado["id_tipo"], $pre["id_modo"], 0);

                                                echo '<div class="tab beee p20">';
                                                echo '<div class="tabIn t18 ff3">'.($pre["nombre"])."</div>";
                                                echo '<div class="tabIn t14 ff3 taR"><i>'.($modos[$pre["id_modo"]]["nombre"])."</i></div>";
                                                echo "</div>";

                                                if($pre["id_modo"] == 1){
                                                    if($respuestas){
                                                        foreach($respuestas["respuestas"] AS $key => $resp){
                                                            if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                            if($resp["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                            echo '<div class="tab bGray p1020 mb5">';
                                                            echo '<div class="tabIn">'.($resp["nombre"]).'</div>';
                                                            echo '<div class="tabIn taR pLR20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                            echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }elseif($pre["id_modo"] == 2){
                                                    if($respuestas){
                                                        foreach($respuestas["respuestas"] AS $key => $resp){
                                                            if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                            if($resp["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                            echo '<div class="tab bGray p1020 mb5">';
                                                            echo '<div class="tabIn">'.($resp["nombre"]).'</div>';
                                                            echo '<div class="tabIn taR pLR20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                            echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }elseif($pre["id_modo"] == 3){
                                                    if($respuestas){
                                                        foreach($respuestas["respuestas"] AS $key => $resp){
                                                            if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                            echo '<div class="tab bGray p1020 mb5">';
                                                            echo '<div class="tabIn">'.($resp["nombre"]).'</div>';
                                                            echo '<div class="tabIn taR pL20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }elseif($pre["id_modo"] == 4){
                                                    if($respuestas){
                                                        foreach($respuestas["respuestas"] AS $key => $resp){
                                                            if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                            echo '<div class="tab bGray p1020 mb5">';
                                                            echo '<div class="tabIn">'.($resp["nombre"]).'</div>';
                                                            echo '<div class="tabIn taR pL20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }elseif($pre["id_modo"] == 5){

                                                    if(isset($respuestas["soluciones"])){
                                                        $txt = "";
                                                        $rad = explode("|", ($respuestas["soluciones"]));
                                                        foreach($rad AS $value) $txt .= '<div class="bS1 p510 t12 beee mb3">'.$value."</div>";
                                                    } else $txt = '<div class="taC tU t16 p10">Sin resultados</div>';

                                                    echo '<div class="tab bGray p20 mb5">';
                                                    echo '<div class="tabIn">'.$txt.'</div>';
                                                    echo '</div>';


                                                }

                                                $grupos = $_ZOOM->get_data("grw_segmentaciones", " AND ( id_empresa = ".$getThis["id_empresa"].") AND eliminado = 0 ORDER BY id_empresa ASC, id ASC ", 1);
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
                                                                <a class="nav-link '.$act1.'" id="tabN1-'.$pre["id"].'-'.$grupo["id"].'-tab" data-toggle="tab" href="#tabN1-'.$pre["id"].'-'.$grupo["id"].'"
                                                                    role="tab" aria-controls="tabN1-'.$pre["id"].'-'.$grupo["id"].'" aria-selected="'.$act2.'">'.($grupo["nombre"]).'</a>
                                                            </li>
                                                        ';
                                                        $cou1++;
                                                    }
                                                    echo '</ul><div class="tab-content bfff" id="">';
                                                    $cou1 = 1;
                                                    foreach ($grupos as $key => $grupo) {

                                                        $act3 = $cou1 == 1 ? "show active" : "" ;
                                                        echo '
                                                            <div class="tab-pane fade '.$act3.'" id="tabN1-'.$pre["id"].'-'.$grupo["id"].'" role="tabpanel"
                                                                aria-labelledby="tabN1-'.$pre["id"].'-'.$grupo["id"].'-tab">
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
                                                                        <a class="nav-link '.$act11.'" id="tabN1-'.$pre["id"].'-'.$grupo["id"].'-'.$parametro["id"].'-tab" data-toggle="tab" href="#tabN1-'.$pre["id"].'-'.$grupo["id"].'-'.$parametro["id"].'"
                                                                            role="tab" aria-controls="tabN1-'.$pre["id"].'-'.$grupo["id"].'-'.$parametro["id"].'" aria-selected="'.$act22.'">'.($parametro["nombre"]).'</a>
                                                                    </li>
                                                                ';
                                                                $cou2++;

                                                            }

                                                            echo '</ul><div class="tab-content bfff" id="">';

                                                            $cou2 = 1;

                                                            foreach ($parametros as $key => $parametro) {
                                                                $act33 = $cou2 == 1 ? "show active" : "" ;

                                                                echo '
                                                                    <div class="tab-pane fade '.$act33.'" id="tabN1-'.$pre["id"].'-'.$grupo["id"].'-'.$parametro["id"].'" role="tabpanel"
                                                                        aria-labelledby="tabN1-'.$pre["id"].'-'.$grupo["id"].'-'.$parametro["id"].'-tab">
                                                                ';

                                                                    $respuestas = $_ZOOM->obtenerRespuestas($pre["id"], $listado["id_tipo"], $pre["id_modo"], $parametro["id"]);

                                                                    // echo '<div class="tab beee p20">';
                                                                    // echo '<div class="tabIn t18 ff3">'.($pre["nombre"])."</div>";
                                                                    // echo '<div class="tabIn t14 ff3 taR"><i>'.($modos[$pre["id_modo"]]["nombre"])."</i></div>";
                                                                    // echo "</div>";

                                                                    if($pre["id_modo"] == 1){
                                                                        if($respuestas){
                                                                            foreach($respuestas["respuestas"] AS $key => $resp){
                                                                                if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                if($resp["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                                echo '<div class="tabIn">'.($resp["nombre"]).'</div>';
                                                                                echo '<div class="tabIn taR pLR20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                                                echo '</div>';
                                                                            }
                                                                        } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                    }elseif($pre["id_modo"] == 2){
                                                                        if($respuestas){
                                                                            foreach($respuestas["respuestas"] AS $key => $resp){
                                                                                if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                if($resp["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                                echo '<div class="tabIn">'.($resp["nombre"]).'</div>';
                                                                                echo '<div class="tabIn taR pLR20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                                                echo '</div>';
                                                                            }
                                                                        } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                    }elseif($pre["id_modo"] == 3){
                                                                        if($respuestas){
                                                                            foreach($respuestas["respuestas"] AS $key => $resp){
                                                                                if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                                echo '<div class="tabIn">'.($resp["nombre"]).'</div>';
                                                                                echo '<div class="tabIn taR pL20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                echo '</div>';
                                                                            }
                                                                        } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                    }elseif($pre["id_modo"] == 4){
                                                                        if($respuestas){
                                                                            foreach($respuestas["respuestas"] AS $key => $resp){
                                                                                if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                if($resp["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                                echo '<div class="tabIn">'.($resp["nombre"]).'</div>';
                                                                                echo '<div class="tabIn taR pLR20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                                                echo '</div>';
                                                                            }
                                                                        } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                    }elseif($pre["id_modo"] == 5){
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
