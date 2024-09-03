<?php require_once ('../../appInit.php');

    $cond           = isset($_POST["cond"]) && $_POST["cond"] != "" ? $_POST["cond"] : "";
    $cond2          = isset($_POST["cond2"]) && $_POST["cond2"] != "" ? $_POST["cond2"] : "";
    $duo            = isset($_POST["duo"]) && $_POST["duo"] ? 1 : 0;
    $test["eq"]     = 20;
    $thisEvaluacion = $_TUCOACH->get_data("grw_tuc_p2b_estudios", " AND id = ".$_POST["id"]." AND eliminado = 0 ORDER BY id DESC ", 0);

    if($thisEvaluacion){

        echo ' <button class="btn btn-primary btn-sm" onClick="Zoom.modalGraph(\'graficar-personas-empresa\', '.$thisEvaluacion["id"].', \'\', \'\', '.$duo.', \'\')" style="margin-top:-11px"><i class="la la-area-chart"></i></button>';

        echo '<div class="dIB t24 tU tB color000 pLR10">';
        echo "Evaluación: ".($thisEvaluacion["nombre"]);
        echo '</div>';

        $testG      = $_TUCOACH->get_data("grw_tuc_paquetests", " AND id = ".$thisEvaluacion["id_grupotests"]." AND  eliminado = 0 ORDER BY id DESC ", 0);
        $ross       = $_TUCOACH->get_data( $cond." AND EMP.id = {$thisEvaluacion["id_empresa"]} AND ASIG.id_evaluacion = {$thisEvaluacion["id"]} ORDER BY CAT.id DESC ", $cond2." AND EMP.id = {$thisEvaluacion["id_empresa"]} AND ASIG.id_evaluacion = {$thisEvaluacion["id"]} ");

        // echo '<pre>';
        // print_r($ross[1]);
        // echo '</pre>';

        echo '<div class="tab bfff p2040 bBS1 primary rr10 t30"><div class="tabIn tB tU">';
        echo '<button class="btn btn-primary btn-sm mL10" onClick="Zoom.modalGraph(\'graficar-personas-empresa\', '.$thisEvaluacion["id"].', \'\', \'\', '.$duo.', \'categoria:0\')" style="margin-top:-5px"><i class="la la-area-chart"></i></button>';
        echo " &nbsp;Test: ".($testG["nombre"]);
        echo '</div>';
        echo '<div class="tabIn w100x taR t24 primary">
        <div class="wh80 rr50 taC bg-amber bg-darken-2 colorfff" style="padding-top:20px;">
        <div class="tB">'.round($ross[0]["calculos"][1]["promedio"],2).'</div>
        <hr style="margin:3px 0;">
        <div class="t14 ff1">'.round(($test["eq"]*$ross[0]["calculos"][1]["promedio"]),1).'%'.'</div>
        </div></div>';
        if($duo) echo '<div class="tabIn w100x taR t24 primary"><div class="wh80 rr50 taC bg-cyan bg-darken-1 colorfff" style="padding-top:20px;"><div class="tB">'.round($ross[0]["calculos"][2]["promedio"],2).'</div><hr style="margin:3px 0;"><div class="t14 ff1">'.round(($test["eq"]*$ross[0]["calculos"][2]["promedio"]),1).'%'.'</div></div></div>';
        echo '</div>';
        echo '<div class="p20">';

        foreach($ross[1] AS $categoria){
            if(isset($categoria["nombre"])){
                if($categoria){
                    echo '<div class="tab bg-primary p2040 colorfff t24 mb5"><div class="tabIn">';
                    echo '<button class="btn btn-secondary btn-sm" onClick="Zoom.modalGraph(\'graficar-personas-empresa\', '.$thisEvaluacion["id"].', \'\', \'\', '.$duo.', \'categoria:'.$categoria["id"].',competencia:0\')" style="margin-top:-5px"><i class="la la-area-chart"></i></button>';
                    echo ' &nbsp;'.($categoria["nombre"]);
                    echo '</div>';
                    echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-amber bg-darken-2 colorfff" style="padding-top:13px;"><div class="tB">'.round($categoria["calculos"][1]["promedio"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$categoria["calculos"][1]["promedio"]),1).'%'.'</div></div></div>';
                    if($duo) echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-cyan bg-darken-1 colorfff" style="padding-top:13px;"><div class="tB">'.round($categoria["calculos"][2]["promedio"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$categoria["calculos"][2]["promedio"]),1).'%'.'</div></div></div>';
                    echo '</div>';
                    echo '<div class="bl-competencias p10 bg-primary bg-accent-1 mb30">';

                    foreach($categoria["competencias"] AS $competencia){
                        if(isset($competencia["nombre"])){
                            echo '<div class="tab bccc p1530 primary tB t18"><div class="tabIn">';
                            echo '<button class="btn btn-primary btn-sm" onClick="Zoom.modalGraph(\'graficar-personas-empresa\', '.$thisEvaluacion["id"].', \'\', \'\', '.$duo.', \'categoria:'.$categoria["id"].',competencia:'.$competencia["id"].',comportamiento:0\')" style="margin-top:-5px"><i class="la la-area-chart"></i></button>';
                            echo ' &nbsp;'.($competencia["nombre"]);
                            echo '</div>';
                            echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-amber bg-darken-2 colorfff" style="padding-top:13px;"><div class="tB">'.round($competencia["calculos"][1]["promedio"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$competencia["calculos"][1]["promedio"]),1).'%'.'</div></div></div>';
                            if($duo) echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-cyan bg-darken-1 colorfff" style="padding-top:13px;"><div class="tB">'.round($competencia["calculos"][2]["promedio"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$competencia["calculos"][2]["promedio"]),1).'%'.'</div></div></div>';
                            echo '</div>';
                            echo '<div class="bl-comportamientos bGray bS1 mb10">';

                            foreach($competencia["comportamientos"] AS $comportamiento){
                                if(isset($comportamiento["nombre"])){
                                    echo '<div class="tab p2030 t16" style="border-top:1px solid #ccc;"><div class="tabIn">';
                                    echo ($comportamiento["nombre"]);
                                    echo '<br><small>Evaluadores: '.($comportamiento["calculos"][1]["cantidad"]).'</small>';
                                    echo '</div>';
                                    echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-amber bg-darken-2 colorfff" style="padding-top:13px;"><div class="tB">'.round($comportamiento["calculos"][1]["promedio"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$comportamiento["calculos"][1]["promedio"]),2).'%'.'</div></div></div>';
                                    if($duo) echo '<div class="tabIn w80x taR t18 primary"><div class="wh60 rr50 taC bg-cyan bg-darken-1 colorfff" style="padding-top:13px;"><div class="tB">'.round($comportamiento["calculos"][2]["promedio"],2).'</div><hr style="margin:3px 0;"><div class="t10 ff1">'.round(($test["eq"]*$comportamiento["calculos"][2]["promedio"]),2).'%'.'</div></div></div>';
                                    echo '</div>';
                                    echo '<div class="bl-segmentos p10 mb10" style="margin-top:-20px; max-height:300px; overflow:auto"><div class="bS1 bfff p5">';

                                    foreach ($comportamiento["segmentos"] as $key => $segmento){
                                        echo '<div class="tab p5">';
                                        echo '<div class="tabIn w100x t12">'.($segmento["nombre"]).'</div>';
                                        echo '<div class="tabIn">';

                                        foreach ($segmento["opciones"] as $key => $opcion){
                                            echo '
                                                <div class="bS1 rr20 p510 mb5 t12">
                                                    <div class="tab">
                                                        <div class="tabIn">
                                                            <small class="ff2">'.($opcion["nombre"]).'</small>
                                                            <small class="amber darken-2">('.($opcion["calculos"][1]["cantidad"]).')</small>';
                                                            if($duo) echo '<small class="cyan darken-1">('.($opcion["calculos"][2]["cantidad"]).')</small>';
                                                        echo '</div>
                                                        <div class="tabIn w70x taR">
                                                            <div class="dIB rr10 t10 bg-amber bg-darken-2 colorfff p310">'.round($opcion["calculos"][1]["promedio"],2).'</div>';
                                                            if($duo) echo ' <div class="dIB rr10 t10 bg-cyan bg-darken-1 colorfff p310">'.round($opcion["calculos"][2]["promedio"],2).'</div>';
                                                        echo '</div>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                    echo '</div></div>';
                                }
                            }
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                }
            }
        }
        echo '</div>';
    }

?>