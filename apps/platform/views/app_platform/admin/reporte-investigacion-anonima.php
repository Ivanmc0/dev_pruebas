<?php

    // NOTA: DISC no puede ser anónimo.

    // $v = $investigacion['encuesta']['id'] == 1 ? 2 : '';
    // include "reporte-investigacion-nps$v.php";

    if($soluciones = $_GROWI->GET("VALORA", "SolucionesAnonimas", " AND SOL.id_investigacion = '".$investigacion["id"]."' AND SOL.id_encuesta = '".$investigacion['encuesta']['id']."' ", ["empresa" => "SOL.id_empresa"])){


?>


<div class="pAA20 mt10">
    <div class="fR t16 ff2 colorMorado">Participaciones recibidas: <?= count($soluciones); ?></div>
    <div class="t24 ff3 color666">Balance NPS</div>
</div>

<div class="bfff rr20 p30 bShadow3 mb30 mb20_oS">
<div class="">
    <?php
        $consol = [];

        $globbal     = array(
            "votos" => 0,
            "sumatoria" => 0,
            "promedio" => 0,
        );

        $modos = SetPositionArray($_ZOOM->get_data("olc_preguntas_tipos", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1), "id");

        $getPreguntas = $_ZOOM->get_data('grw_val_preguntas', ' AND id_encuesta = '.$investigacion['encuesta']['id'].' AND inactivo = 0 AND eliminado = 0 ORDER BY prioridad ASC', 1);
        if ($getPreguntas) {

            $nps = array(
                "votos" => 0,
                "suman" => 0,
                "omitidos" => 0,
                "restan" => 0,
            );

            foreach ($getPreguntas as $numpre => $pre) {

                $respuestas = $_ZOOM->obtenerRespuestasEncuestaAnonima($pre["id"], 2, $pre["id_modo"], 0, $investigacion["id"], $investigacion['encuesta']['id']);

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

                            if( $respuestas["soluciones"][$key] > 0){
                                if(!$pre["nps"]){

                                    $consol[$pre["id"]][$resp["id"]]["valor"] = $resp["valor"];
                                    $consol[$pre["id"]][$resp["id"]]["conteo"] = $respuestas["soluciones"][$key];

                                }else{

                                    $nps["votos"] += $respuestas["soluciones"][$key];
                                    if($resp["valor"] >= 90) $nps["suman"] += $respuestas["soluciones"][$key];
                                    if($resp["valor"] >= 70 && $resp["valor"] <= 80) $nps["omitidos"] += $respuestas["soluciones"][$key];
                                    if($resp["valor"] <= 60) $nps["restan"] += $respuestas["soluciones"][$key];

                                }
                            }

                            echo '<div class="dIB w20 p5">';
                            echo '<div class="tab bGray rr3 p1020">';
                            $color = $resp["icono"] == 'las la-angry' ? '#fb2233' : ( $resp["icono"] == 'las la-frown' ? '#f5760f' : ( $resp["icono"] == 'las la-meh' ? '#f1ae22' : ( $resp["icono"] == 'las la-smile' ? '#0abe50' : ( $resp["icono"] == 'las la-grin-alt' ? '#089954' : 0 ) ) ) );
                            if($color) echo '<div class="tabIn w40x"><div class="t24 wh30 rr50 colorfff mAUTO" style="background-color:'.$color.';"><div class="vMM"><i class="'.($resp["icono"]).'"></i></div></div></div>';
                            echo '<div class="tabIn"><div class="ff2 t16" style="color:'.$color.';">'.($resp["nombre"]).'</div></div>';
                            echo '<div class="tabIn taR pL20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                            echo '</div>';
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
                        foreach($rad AS $value) $txt .= '<div class="bS1 bCeee p15 t16 bfff mb10">'.$value."</div>";
                    } else $txt = '<div class="taC tU t16 p10">Sin resultados</div>';

                    echo '<div class="tab bGray p20 mb5">';
                    echo '<div class="tabIn">'.$txt.'</div>';
                    echo '</div>';


                }


                if($pre["id_modo"] == 3){
                    if(!$pre["nps"]){

                        $oo = [
                            "votos" => 0,
                            "sumatoria" => 0,
                            "promedio" => 0,
                        ];

                        if(isset($consol[$pre["id"]])){
                            foreach ($consol[$pre["id"]] as $l => $l2) {
                                $oo["votos"] += $l2["conteo"];
                                $oo["sumatoria"] += $l2["valor"]*$l2["conteo"];
                            }
                        }
                        $oo["promedio"] = ($oo["votos"]>0) ? round($oo["sumatoria"]/$oo["votos"], 1) : 0;



                        echo '<div class="tab bGray p1020 ff3 t20 taC mb50">';
                        echo '<div class="tab30">Item: '.($numpre).'</div>';
                        echo '<div class="tab30">Valoraciones: '.($oo["votos"]).'</div>';
                        echo '<div class="tab40">Promedio: '.($oo["promedio"]).'</div>';
                        echo '</div>';

                        $globbal["votos"] += 1;
                        $globbal["sumatoria"] += $oo["promedio"];

                    }else{

                        echo '<div class="tab bGray p1020 ff4 t24 taC mb10">';
                        echo '<div class="tab30">Campos NPS</div>';
                        echo '<div class="tab30">Valoraciones: '.($nps["votos"]).'</div>';
                        echo '<div class="tab40">Valor NPS: '.(($nps["votos"] > 0) ? round((($nps["suman"]-$nps["restan"])/$nps["votos"])*100, 1) : 0).'%</div>';
                        echo '</div>';

                        echo '<div class="tab bGray p1020 ff3 t20 taC mb50">';
                        echo '<div class="tab20"></div>';
                        echo '<div class="tab30">Detractores: '.(($nps["votos"] > 0) ? round(($nps["restan"]/$nps["votos"])*100, 1) : 0).'%</div>';
                        echo '<div class="tab30">Pasivos: '.(($nps["votos"] > 0) ? round(($nps["omitidos"]/$nps["votos"])*100, 1) : 0).'%</div>';
                        echo '<div class="tab20"></div>';
                        echo '</div>';

                    }
                }


            }

            echo '<div class="h50"></div>';
            echo '<div class="tab bGray p1020 ff4 t40 taC mb50">';
            echo '<div class="tabIn">Promedio Items: '.(round($globbal["sumatoria"]/$globbal["votos"], 1)).'</div>';
            echo '</div>';


        }
    ?>
</div>
</div>



<div class="pAA20 mt10">
    <div class="t24 ff3 color666">Soluciones Anónimas</div>
</div>

<div class="bfff rr20 p30 bShadow3 mb30 mb20_oS">
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">ID Anónimo</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($soluciones as $key => $solucion) { ?>
                    <tr>
                        <td class="t12"><?= $solucion["id"]; ?></td>
                        <td class="t12">-</td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php
    } else {
        echo "Aún no hay soluciones anónimas en la investigación.";
    }
?>