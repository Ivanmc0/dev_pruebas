<?php require_once('../../../appInit.php');

$insert_data    = 0;
$insert         = 0;

$respuestas = $_ZOOM->get_data("grw_sol_act_encuestas", "AND id_actividad = " . $_POST["a"] . " AND id_trabajador = " . $_POST["t"] . " AND id_empresa = " . $_POST["e"] . " AND eliminado = 0 ORDER BY id DESC ", 1);
if ($respuestas) {
    foreach ($respuestas as $per) {
        $data_respuestas[$per['id_dinamica'] . "_" . $per['id_pregunta']]['id_respuesta']            = $per['id_respuesta'];
        $data_respuestas[$per['id_dinamica'] . "_" . $per['id_pregunta']]['respuesta']               = $per['respuesta'];
        $data_respuestas[$per['id_dinamica'] . "_" . $per['id_pregunta']]['respuesta_multiple']      = !empty($per['id_respuesta_multiple']) ? explode(',', $per['id_respuesta_multiple']) : 0;
    }
}


if($interactividad = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id = ' . $_POST["enc"] . ' AND inactivo = 0 AND eliminado = 0', 0)){



    if ($interactividad['id_modelo'] == 1) {
        if ($interactividad['id_tipo'] == 1) $material = ' evaluativo';
        else if ($interactividad['id_tipo'] == 2) $material = ' investigativo';
    }

    echo '
        <div class="card mb30">
            <div class="card-header">
                <div class="fR t12 color999">Material '.$material.'</div>
                <div class="dIB color333 t16 tB">
                    <div class="t12 color999 mb5">Encuesta</div>
                    '.($interactividad['nombre']).'
                </div>
            </div>
            <div class="card-body" style="padding-bottom:10px;">
           
    ';


    if($estado = $_ZOOM->interactividad_estado($interactividad['id'], $_SESSION["lele_id"])){
        if($estado["status_1"] < $estado["inter"]){

            require_once 'interactividad_encuesta_form.php';

        }else{

            if ($getPreguntas = $_ZOOM->get_data('grw_lel_preguntas', ' AND id_dinamica = ' . $interactividad['id'] . ' AND inactivo = 0 AND eliminado = 0', 1)) {
                $preguntas_correctas    = 0;
                $preguntas_totales      = 0;
                foreach ($getPreguntas as $key => $pre) {
                    $getMods = $_ZOOM->get_data('olc_preguntas_tipos', ' AND id = ' . $pre['id_modo'].' AND inactivo = 0 AND eliminado = 0', 0);
                    echo '
                        <div class="tab mb10">
                            <div class="tabIn p10 w100x bS1 bCeee rr5 taC t30 bfff colorVerde">
                                P'.($key+1);
                                if($getMods) echo '<small class="dB mt10 color999 t10">' . ($getMods['nombre']).'</small>';
                    echo '
                            </div>
                            <div class="tabIn pL10">
                                <div class="bS1 bCeee bGray p15 rr5">
                                    <div class="ff2 t14 mb15">
                    ';

                        echo '<div class="">'.($pre['nombre']).'</div>';
                        echo '</div>';

                        if ($interactividad['id_tipo'] == 1) {
                            $getRespuestas = $_ZOOM->get_data('grw_lel_respuestas', ' AND id_pregunta = ' . $pre['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                            if ($getRespuestas) {
                                $respuestas_correctas   = 0;
                                $total_correctas        = 0;
                                echo '<div class="mb10">';
                                foreach ($getRespuestas as $res) {
                                    if ($pre['id_modo'] == 1) {
                                        $checkion = "bfff";
                                        if (isset($data_respuestas[$interactividad["id"] . "_" . $pre["id"]]) && $res["id"] == $data_respuestas[$interactividad["id"] . "_" . $pre["id"]]['id_respuesta']){
                                            if($res["correcta"]) $respuestas_correctas++;
                                            $checkion = 'bVerde colorfff';
                                        }
                                        if($res["correcta"]){
                                            $correcta = '<i class="t12 fas fa-check" title="Respuesta Correcta"></i> &nbsp;';
                                            $total_correctas++;
                                        } else $correcta = '<i class="t12 fas fa-times" title="Respuesta Incorrecta"></i> &nbsp;';

                                        echo '<div class="p5 dIB"><div class="p1020 rr20 '.$checkion.'">'.$correcta.''.($res["nombre"]).'</div></div>';


                                    } else if($pre['id_modo'] == 2) {

                                        $checkion = "bfff";
                                        if (!empty($data_respuestas[$interactividad["id"] . "_" . $pre["id"]]['respuesta_multiple'])) {
                                            foreach ($data_respuestas[$interactividad["id"] . "_" . $pre["id"]]['respuesta_multiple'] as $value) {
                                                if ($res['id'] == $value){
                                                    if($res["correcta"]) $respuestas_correctas++;
                                                    $checkion =  'bVerde colorfff';
                                                }
                                            }
                                        }

                                        if($res["correcta"]){
                                            $correcta = '<i class="t12 fas fa-check" title="Respuesta Correcta"></i> &nbsp;';
                                            $total_correctas++;
                                        } else $correcta = '<i class="t12 fas fa-times" title="Respuesta Incorrecta"></i> &nbsp;';

                                        echo '<div class="p5 dIB"><div class="p1020 rr20 '.$checkion.'">'.$correcta.''.($res["nombre"]).'</div></div>';

                                    }
                                }
                                echo '</div>';

                                $evaluacion_respuesta = 0;
                                if($total_correctas > 0) $evaluacion_respuesta = ($respuestas_correctas/$total_correctas)*100;
                                echo '<div class="tab bfff rr10 bS1 bCeee taC">';
                                echo '<div class="tab50 p10 ff3 color000"><span class="ff1 color666">Aciertos:</span> '.$respuestas_correctas.' / '.$total_correctas.'</div>';
                                echo '<div class="tab50 p10 ff3 color000" style="border-left:1px solid #eee"><span class="ff1 color666">Resultado:</span> '.round($evaluacion_respuesta).'%</div>';
                                echo '</div>';

                                $preguntas_correctas += $evaluacion_respuesta;
                                $preguntas_totales   += 1;

                            } else {
                                echo '<h5 class="card-title mt10">Sin Respuestas</h5>';
                            }
                        } else if ($interactividad['id_tipo'] == 2) {
                            if ($pre['id_modo'] != 5) {
                                $getRespuestas = $_ZOOM->get_data('grw_lel_respuestas', ' AND id_pregunta = ' . $pre['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                                if ($getRespuestas) {
                                    foreach ($getRespuestas as $res) {
                                        if ($pre['id_modo'] == 1 || $pre['id_modo'] == 3) {
                                            $checkion = "bfff";
                                            if (isset($data_respuestas[$interactividad["id"] . "_" . $pre["id"]]) && $res["id"] == $data_respuestas[$interactividad["id"] . "_" . $pre["id"]]['id_respuesta']) $checkion = 'bVerde colorfff';
                                            echo '<div class="p5 dIB"><div class="p1020 rr20 '.$checkion.'">'.($res["nombre"]).'</div></div>';

                                        } else {

                                            $checkion = "bfff";
                                            if (!empty($data_respuestas[$interactividad["id"] . "_" . $pre["id"]]['respuesta_multiple'])) {
                                                foreach ($data_respuestas[$interactividad["id"] . "_" . $pre["id"]]['respuesta_multiple'] as $value) {
                                                    if ($res['id'] == $value) $checkion =  'bVerde colorfff';
                                                }
                                            }
                                            echo '<div class="p5 dIB"><div class="p1020 rr20 '.$checkion.'">'.($res["nombre"]).'</div></div>';

                                        }
                                    }
                                } else {
                                    echo '<h5 class="card-title mt10">Sin Respuestas</h5>';
                                }
                            } else {
                                $value = '';
                                if (isset($data_respuestas[$interactividad["id"] . "_" . $pre["id"]])) $value = ($data_respuestas[$interactividad["id"] . "_" . $pre["id"]]['respuesta']);
                                echo '<div class="bfff rr5 p20">'.$value.'</div>';
                            }
                        }


                    echo '</div>';
                    echo '</div></div>';

                }

                if($preguntas_totales > 0){
                    $nota = ($preguntas_correctas/$preguntas_totales);
                    echo '<div class="tab bfff rr5 bS1 bCeee taC t18 colorVerde">';
                    echo '<div class="tabIn p10 ff3"><span class="">Resultado:</span> '.round($nota).'%</div>';
                    echo '</div>';
                }

            } else {
                echo '<h5 class="card-title mt10">Sin preguntas</h5>';
            }

        }
    }

            
            


    echo '
            </div>
        </div>
    ';

}