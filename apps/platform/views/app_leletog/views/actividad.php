<?php

    $actividad  = $_ZOOM->get_data('grw_lel_actividades', ' AND id = ' . $geton[3] . ' AND inactivo = 0 AND eliminado = 0', 0);
    if($actividad) {
        $categoria  = $_ZOOM->get_data('grw_lel_categorias', ' AND id = ' . $actividad["id_categoria"] . ' AND inactivo = 0 AND eliminado = 0', 0);
        $inter      = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id_actividad = ' . $actividad["id"] . ' AND inactivo = 0 AND eliminado = 0', 1);

    // echo '<pre>';
    // print_r($inter);
    // echo '</pre>';
    if ($inter) {

        $respuestas = $_ZOOM->get_data("grw_sol_act_encuestas", "AND id_actividad = " . $geton[3] . " AND id_trabajador = " . $trabajador["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id DESC ", 1);
        if ($respuestas) {
            foreach ($respuestas as $per) {
                $data_respuestas[$per['id_dinamica'] . "_" . $per['id_pregunta']]['id_respuesta']            = $per['id_respuesta'];
                $data_respuestas[$per['id_dinamica'] . "_" . $per['id_pregunta']]['respuesta']               = $per['respuesta'];
                $data_respuestas[$per['id_dinamica'] . "_" . $per['id_pregunta']]['respuesta_multiple']      = !empty($per['id_respuesta_multiple']) ? explode(',', $per['id_respuesta_multiple']) : 0;
            }
            // echo '<pre>';
            // print_r($data_respuestas);
            // echo '</pre>';
        }

?>

        <div class="bfff p40 p20_oS bBS1 mb20">
            <div class="ff3 t18 colorVerde mb5">Actividad</div>
            <div class="color666 let2 t16">Categoría: <?= ($categoria["nombre"]); ?></div>
        </div>

        <div class="general pAA30">

            <div class=" mb30">
                <div class="ff3 t24 colorVerde let2 mb10"><?= ($actividad["nombre"]); ?></div>
                <div class="ff2 t18 magion color333 w80 mb5"><?= ($actividad["descripcion"]); ?></div>
                <div class="ff1 t16 magion color999 w90"><?= ($actividad["resumen"]); ?></div>
            </div>

            <form action="externo/encuesta" id="encuesta" name="encuesta" method="post" class="form-horizontal zoom_form mb30">
                <input type="hidden" name="id_empresa" id="id_empresa" value="<?= $empresa['id'] ?>" class="bS1" />
                <input type="hidden" name="id_trabajador" id="id_trabajador" value="<?= $trabajador['id'] ?>" class="bS1" />
                <input type="hidden" name="id_actividad" id="id_actividad" value="<?= $geton[3] ?>" class="bS1" />
                <?php foreach ($inter as $act) { ?>
                    <div class="card mb30">
                        <div class="card-header">
                            <div class="fR t12 color999">
                                <?php
                                    if ($act['id_modelo'] == 1) {
                                        echo 'Material';
                                        if ($act['id_tipo'] == 1) echo ' evaluativo';
                                        else if ($act['id_tipo'] == 2) echo ' investigativo';
                                    }
                                ?>
                            </div>
                            <div class="dIB color333 t16 tB">
                                <div class="t12 color999 mb5">Encuesta</div>
                                <?= ($act['nombre']); ?>
                            </div>
                        </div>
                        <div class="card-body" style="padding-bottom:10px;">
                            <?php
                                $getPreguntas = $_ZOOM->get_data('grw_lel_preguntas', ' AND id_dinamica = ' . $act['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                                if ($getPreguntas) {
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
                                                            if (isset($data_respuestas[$act["id"] . "_" . $pre["id"]]) && $res["id"] == $data_respuestas[$act["id"] . "_" . $pre["id"]]['id_respuesta']) $checkion = 'checked';
                                                            $namion = "pregunta_".$act["id"]."_".$pre["id"];
                                                            $idion  = "pregunta_".$act["id"]."_".$pre["id"]."_".$res["id"];

                                                            echo '<label class="tab cP p1020 rr5 bS1 mb10 bHover4" for="'.$idion.'">';
                                                            echo '<div class="tabIn w30x"><input type="radio" '.$checkion.' name="'.$namion.'" id="'.$idion.'" value="'.$res["id"].'"></div>';
                                                            echo '<div class="tabIn">'.($res["nombre"]).'</div>';
                                                            echo '</label>';
                                                        } else {

                                                            $checkion = "";
                                                            if (!empty($data_respuestas[$act["id"] . "_" . $pre["id"]]['respuesta_multiple'])) {
                                                                foreach ($data_respuestas[$act["id"] . "_" . $pre["id"]]['respuesta_multiple'] as $value) {
                                                                    if ($res['id'] == $value) $checkion =  'checked';
                                                                }
                                                            }
                                                            $namion = "pregunta_".$act["id"]."_".$pre["id"]."_".$res["id"];
                                                            $namion = "pregunta_".$act["id"]."_".$pre["id"]."_multiple[]";

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
                                                if (isset($data_respuestas[$act["id"] . "_" . $pre["id"]])) $value = ($data_respuestas[$act["id"] . "_" . $pre["id"]]['respuesta']);
                                                echo '<textarea class="dB w100 rr5 bS1 p20 bCeee mb10" rows="6" id="pregunta_' . $act["id"] . '_' . $pre["id"] . '_a" name="pregunta_' . $act["id"] . '_' . $pre["id"] . '_a"  placeholder="Digite su respuesta">'.$value.'</textarea>';
                                            }

                                        echo '</div>';

                                    }

                                } else {
                                    echo '<h5 class="card-title mt10">Sin preguntas</h5>';
                                }
                            ?>
                        </div>

                    </div>

                <?php } ?>

                <div id="rtn-encuesta" class="taC mb20"></div>

                <div class="taC">
                    <button id="btn-encuesta" type="submit" class="dIB bVerde bS1 bCVerde ff1 t16 rr20 colorfff p1030 bHover2 cP">Guardar cambios</button>
                </div>
            </form>
        </div>


<?php
        } else echo '<div class="general pAA30"><div class="color666 let2 t16">La actividad que busca no existe</div></div>';
    }
?>