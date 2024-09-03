<?php  require_once ('../../appInit.php');

    if ($interactividad) {

        $respuestas = $_ZOOM->get_data("grw_sol_act_encuestas", "AND id_dinamica = " . $interactividad["id"] . " AND id_trabajador = " . $_SESSION["WORKER"]["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id DESC ", 1);
        if ($respuestas) {
            foreach ($respuestas as $per) {
                $data_respuestas[$per['id_dinamica'] . "_" . $per['id_pregunta']]['id_respuesta']            = $per['id_respuesta'];
                $data_respuestas[$per['id_dinamica'] . "_" . $per['id_pregunta']]['respuesta']               = $per['respuesta'];
                $data_respuestas[$per['id_dinamica'] . "_" . $per['id_pregunta']]['respuesta_multiple']      = !empty($per['id_respuesta_multiple']) ? explode(',', $per['id_respuesta_multiple']) : 0;
            }

        }

        echo '
            <div class="taC pAA10">
                <div class="dIB colorVerde bS1 p1030 rr10 bCVerde bHover3 cP" data-toggle="modal" data-target="#modalCrearEncuesta'.$interactividad['id'].'">
                    Realizar encuesta
                </div>
            </div>
        ';

?>



<div class="modal fade" id="modalCrearEncuesta<?= $interactividad['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalCrearEncuesta<?= $interactividad['id']; ?>Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="border:0">
        <div class="modal-content" style="border:0">
            <div class="posR p30 beee">
                <button type="button" class="bfff wh30 rr50 posA color333 bHover3 cP bShadow" style="right:-10px; top:-10px;" data-dismiss="modal" aria-label="Close">
                    <div class="vMM t14"><i class="fas fa-times"></i></div>
                </button>

                <div class="">

                    <div class="ff3 colorVerde t20 mb10">Encuesta</div>
                    <div class="ff2 color999 t16 mb20">Realiza el siguiente cuestionario.</div>



            <form action="externo/accion-encuestar" id="encuesta_<?= $interactividad["id"]; ?>" name="encuesta_<?= $interactividad["id"]; ?>" method="post" class="form-horizontal zoom_form">

                <input type="hidden" name="id_empresa" id="id_empresa" value="<?= $_SESSION["COMPANY"]["id"] ?>" class="bS1" />
                <input type="hidden" name="id_trabajador" id="id_trabajador" value="<?= $_SESSION["WORKER"]["id"] ?>" class="bS1" />
                <input type="hidden" name="id_actividad" id="id_actividad" value="<?= $interactividad["id_actividad"] ?>" class="bS1" />
                <input type="hidden" name="id_dinamica" id="id_dinamica" value="<?= $interactividad["id"] ?>" class="bS1" />

                <div class="card mb30">
                    <div class="card-header">
                        <div class="fR t12 color999">
                            <?php
                                if ($interactividad['id_modelo'] == 1) {
                                    echo 'Material';
                                    if ($interactividad['id_tipo'] == 1) echo ' evaluativo';
                                    else if ($interactividad['id_tipo'] == 2) echo ' investigativo';
                                }
                            ?>
                        </div>
                        <div class="dIB color333 t16 tB">
                            <div class="t12 color999 mb5">Encuesta</div>
                            <?= ($interactividad['nombre']); ?>
                        </div>
                    </div>
                    <div class="card-body" style="padding-bottom:10px;">
                        <?php
                            $getPreguntas = $_ZOOM->get_data('grw_lel_preguntas', ' AND id_dinamica = ' . $interactividad['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                            if ($getPreguntas) {
                                echo '<input type="hidden" name="cant_preg" value="'.count($getPreguntas).'" class="bS1" />';
                                foreach ($getPreguntas as $pre) {

                                    echo '<div class="bS1 bCeee bGray p15 rr5 mb10" style="padding-bottom:5px;">';

                                        echo '<div class="ff2 t14 mb20">';
                                        $getMods = $_ZOOM->get_data('olc_preguntas_tipos', ' AND id = ' . $pre['id_modo'].' AND inactivo = 0 AND eliminado = 0', 0);
                                        if($getMods) echo '<small class="color999 fR">' . ($getMods['nombre']).'</small>';
                                        echo '<div class="">'.($pre['nombre']).'</div>';
                                        echo '</div>';

                                        if ($pre['id_modo'] != 5) {
                                            $getRespuestas = $_ZOOM->get_data('grw_lel_respuestas', ' AND id_pregunta = ' . $pre['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                                            if ($getRespuestas) {
                                                foreach ($getRespuestas as $res) {
                                                    if ($pre['id_modo'] == 1 || $pre['id_modo'] == 3) {
                                                        $checkion = "";
                                                        if (isset($data_respuestas[$interactividad["id"] . "_" . $pre["id"]]) && $res["id"] == $data_respuestas[$interactividad["id"] . "_" . $pre["id"]]['id_respuesta']) $checkion = 'checked';
                                                        $namion = "pregunta_".$interactividad["id"]."_".$pre["id"];
                                                        $idion  = "pregunta_".$interactividad["id"]."_".$pre["id"]."_".$res["id"];

                                                        echo '<label class="tab cP p1020 rr5 bS1 mb10 bHover4" for="'.$idion.'">';
                                                        echo '<div class="tabIn w30x"><input type="radio" '.$checkion.' name="'.$namion.'" id="'.$idion.'" value="'.$res["id"].'"></div>';
                                                        echo '<div class="tabIn">'.($res["nombre"]).'</div>';
                                                        echo '</label>';
                                                    } else {

                                                        $checkion = "";
                                                        if (!empty($data_respuestas[$interactividad["id"] . "_" . $pre["id"]]['respuesta_multiple'])) {
                                                            foreach ($data_respuestas[$interactividad["id"] . "_" . $pre["id"]]['respuesta_multiple'] as $value) {
                                                                if ($res['id'] == $value) $checkion =  'checked';
                                                            }
                                                        }
                                                        $namion = "pregunta_".$interactividad["id"]."_".$pre["id"]."_".$res["id"];
                                                        $namion = "pregunta_".$interactividad["id"]."_".$pre["id"]."_multiple[]";

                                                        echo '<label class="tab cP p1020 rr5 bS1 mb10 bHover4" ---for="'.$namion.'">';
                                                        echo '<div class="tabIn w30x"><input type="checkbox" '.$checkion.' name="'.$namion.'" id="'.$namion.'" value="'.$res["id"].'"></div>';
                                                        echo '<div class="tabIn">'.($res["nombre"]).'</div>';
                                                        echo '</label>';
                                                    }
                                                }
                                            } else {
                                                echo '<h5 class="card-title mt10">Sin Respuestas</h5>';
                                            }
                                        } else {
                                            $value = '';
                                            if (isset($data_respuestas[$interactividad["id"] . "_" . $pre["id"]])) $value = ($data_respuestas[$interactividad["id"] . "_" . $pre["id"]]['respuesta']);
                                            echo '<textarea class="dB w100 rr5 bS1 p20 bCeee mb10" rows="6" id="pregunta_' . $interactividad["id"] . '_' . $pre["id"] . '_a" name="pregunta_' . $interactividad["id"] . '_' . $pre["id"] . '_a"  placeholder="Digite su respuesta">'.$value.'</textarea>';
                                        }

                                    echo '</div>';

                                }

                            } else {
                                echo '<h5 class="card-title mt10">Sin preguntas</h5>';
                            }
                        ?>
                    </div>

                    <div id="rtn-encuesta_<?= $interactividad["id"]; ?>" class="taC mb10"></div>

                    <div class="taC mb15 ">
                        <button id="btn-encuesta_<?= $interactividad["id"]; ?>" type="submit" class="dIB bVerde bS1 bCVerde ff1 t16 rr20 colorfff p1030 bHover3 cP">Guardar cambios</button>
                    </div>

                </div>



            </form>



                </div>
            </div>
        </div>
    </div>
</div>


<?php
    } else echo '<div class="general pAA30"><div class="color666 let2 t16">La actividad que busca no existe</div></div>';

?>