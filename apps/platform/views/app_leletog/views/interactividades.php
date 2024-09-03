<?php
if (isset($geton[5])) {
    $inter = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id_actividad = ' . $geton[5] . ' AND inactivo = 0 AND eliminado = 0', 1);
    // echo '<pre>';
    // print_r($inter);
    // echo '</pre>';
    if ($inter) {

        $respuestas = $_ZOOM->get_data("grw_sol_act_encuestas", "AND id_actividad = " . $geton[5] . " AND id_trabajador = " . $trabajador["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id DESC ", 1);
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
            <div class="ff3 t18 colorVerde mb5">Mis Interactividades</div>
            <!-- <div class="color666 let2 t16">Te invitamos a revisar tus actividades pendientes</div> -->
        </div>

        <div class="general pAA30">
            <form action="externo/encuesta" id="encuesta" name="encuesta" method="post" class="form-horizontal zoom_form mb30">
                <input type="hidden" name="id_empresa" id="id_empresa" value="<?= $empresa['id'] ?>" class="bS1" />
                <input type="hidden" name="id_trabajador" id="id_trabajador" value="<?= $trabajador['id'] ?>" class="bS1" />
                <input type="hidden" name="id_actividad" id="id_actividad" value="<?= $geton[5] ?>" class="bS1" />
                <?php foreach ($inter as $act) { ?>
                    <div class="card mb30">
                        <h5 class="card-header"><?php
                                                if ($act['id_modelo'] == 1) {
                                                    echo 'Encuesta';
                                                    if ($act['id_tipo'] == 1) echo ' evaluativo';
                                                    else if ($act['id_tipo'] == 2) echo ' investigativo';
                                                }

                                                ?></h5>
                        <div class="card-body">
                            <!-- <input type="hidden" name="actividad_<?= $act["id"]; ?>" id="actividad_<?= $act["id"]; ?>" value="<?php $act["id"]; ?>" class="bS1" /> -->
                            <h5 class="card-title"><?= ($act['nombre']); ?></h5>
                            <ul class="list-group list-group-flush">
                                <?php
                                $getPreguntas = $_ZOOM->get_data('grw_lel_preguntas', ' AND id_dinamica = ' . $act['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                                if ($getPreguntas) {
                                    foreach ($getPreguntas as $pre) {
                                ?>
                                        <li class="list-group-item bVerde text-white mb20">
                                            <?= ($pre['nombre']); ?>
                                            <?php $getMods = $_ZOOM->get_data('olc_preguntas_tipos', ' AND id = ' . $pre['id_modo'] . ' AND inactivo = 0 AND eliminado = 0', 0);
                                            if ($getMods)  echo ' <small>(' . ($getMods['nombre']) . ')</small>'; ?>
                                        </li>
                                        <?php
                                        if ($pre['id_modo'] != 5) {
                                            $getRespuestas = $_ZOOM->get_data('grw_lel_respuestas', ' AND id_pregunta = ' . $pre['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                                            if ($getRespuestas) {
                                                foreach ($getRespuestas as $res) {
                                                    if ($pre['id_modo'] == 1 || $pre['id_modo'] == 3) {
                                        ?>
                                                        <div class="col-12 col-lg-6 mb10 mb5_oS">
                                                            <!-- <div class="tab p510 p5_oS bS1 rr10 bHover2 cP method pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?> pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?>_<?= $res["id"]; ?>" father="pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?>" method="<?= $res["id"]; ?>">
                                                                <div class="tabIn pLR20">
                                                                    <div class="colorAzul t16 ff2 mb5"><?= ($res["nombre"]); ?></div>
                                                                </div>
                                                                <div class="tabIn w40x">
                                                                    <div class="taC t20 cP"><i class="iconFA far <?php if (isset($data_respuestas[$act["id"] . "_" . $pre["id"]]) && $res["id"] == $data_respuestas[$act["id"] . "_" . $pre["id"]]['id_respuesta']) echo 'fa-check-circle';
                                                                                                                    else echo 'fa-circle'; ?>  colorRosado"></i></div>
                                                                </div> -->
                                                            <input type="radio" <?php if (isset($data_respuestas[$act["id"] . "_" . $pre["id"]]) && $res["id"] == $data_respuestas[$act["id"] . "_" . $pre["id"]]['id_respuesta']) echo 'checked';
                                                                                ?> name="pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?>" id="pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?>" value="<?= $res["id"]; ?>">
                                                            <label for="pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?>"><?= ($res["nombre"]); ?></label><br>
                                                        </div>


                                                    <?php } else { ?>
                                                        <div class="col-12 col-lg-6 mb10 mb5_oS">
                                                            <!-- <div class="tab p510 p5_oS bS1 rr10 bHover2 cP method2 pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?> pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?>_<?= $res["id"]; ?>" father2="pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?>" method2="<?= $res["id"]; ?>">
                                                                <div class="tabIn pLR20">
                                                                    <div class="colorAzul t16 ff2 mb5"><?= ($res["nombre"]); ?></div>
                                                                </div>
                                                                <div class="tabIn w40x">
                                                                    <div class="taC t20 cP"><i class="iconFA far <?php if (isset($data_respuestas[$act["id"] . "_" . $pre["id"]]) && $res["id"] == $data_respuestas[$act["id"] . "_" . $pre["id"]]['id_respuesta']) echo 'fa-check-circle';
                                                                                                                    else echo 'fa-circle'; ?>  colorRosado"></i></div>
                                                                </div>
                                                            </div> -->
                                                            <input type="checkbox" <?php
                                                                                    if (!empty($data_respuestas[$act["id"] . "_" . $pre["id"]]['respuesta_multiple'])) {
                                                                                        foreach ($data_respuestas[$act["id"] . "_" . $pre["id"]]['respuesta_multiple'] as $value) {
                                                                                            if ($res['id'] == $value) echo 'checked';
                                                                                        }
                                                                                    }
                                                                                    ?> name="pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?>_m[]" value="<?= $res["id"]; ?>" id="pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?>_m[]"><label class="mR5" for="pregunta_<?= $act["id"]; ?>_<?= $pre["id"]; ?>_m[]"> <?= ($res["nombre"]); ?></label><br>
                                                        </div>
                                <?php }
                                                }
                                            } else {
                                                echo '<h5 class="card-title mt10">Sin Respuestas</h5>';
                                            }
                                        } else {
                                            $value = '';
                                            if (isset($data_respuestas[$act["id"] . "_" . $pre["id"]])) $value = $data_respuestas[$act["id"] . "_" . $pre["id"]]['respuesta'];
                                            echo '<input type="text" class="form-control" id="pregunta_' . $act["id"] . '_' . $pre["id"] . '_a" name="pregunta_' . $act["id"] . '_' . $pre["id"] . '_a"  placeholder="Digite su respuesta" value="' . $value . '">';
                                        }
                                    }
                                } else {
                                    echo '<h5 class="card-title mt10">Sin preguntas</h5>';
                                } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
                <div id="rtn-encuesta" class="taC mb20"></div>

                <div class="taC">
                    <button id="btn-encuesta" type="submit" class="dIB bfff bS1 bCRosado tU ff1 let t16 rr10 colorRosado p1020 bHover3 cP">Guardar cambios</button>
                </div>
            </form>
        </div>


<?php    } else echo '<div class="general pAA30"><div class="color666 let2 t16">No tiene actividades</div></div>';
} ?>