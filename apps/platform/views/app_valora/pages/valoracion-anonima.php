<div class="general pAA80 pAA40_oS">

    <h5 class="ff0 tU t12 mb10">Encuesta</h5>
    <h1 class="ff3 cPrimary t30 mb20 mb10_oS"><?= ($encuesta["nombre"]); ?></h1>
    <h3 class="ff1 color666 t16 mb50 mb30_oS"><?= ($encuesta["descripcion"]); ?></h3>

    <h5 class="ff2 color666 t16 mb30 mb20_oS"><?= ($encuesta["introduccion"]); ?></h5>



    <form action="val/accion-encuesta-anonima" id="encuesta_<?= $encuesta["uuid"]; ?>" name="encuesta_<?= $encuesta["uuid"]; ?>" method="post" class="form-horizontal zoom_form">

        <div>
            <?php
                $getPreguntas = $_ZOOM->get_data('grw_val_preguntas', ' AND id_encuesta = ' . $encuesta['id'] . ' AND inactivo = 0 AND eliminado = 0 ORDER BY prioridad ASC ', 1);
                if ($getPreguntas) {
                    foreach ($getPreguntas as $pre) {

                        echo '<div class="bfff p20 rr20 bShadow3 mb30">';

                            echo '<div class="ff2 t14 mb20">';
                            $getMods = $_ZOOM->get_data('olc_preguntas_tipos', ' AND id = ' . $pre['id_modo'].' AND inactivo = 0 AND eliminado = 0', 0);
                            // if($getMods) echo '<small class="color999 fR">' . ($getMods['nombre']).'</small>';
                            echo '<div class="t16">'.($pre['nombre']).'</div>';
                            echo '</div>';

                            if ($pre['id_modo'] != 5) {
                                $getRespuestas = $_ZOOM->get_data('grw_val_respuestas', ' AND id_pregunta = ' . $pre['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                                if ($getRespuestas) {
                                    if($encuesta["id"] == 3 || $encuesta["id"] == 1 || $encuesta["id"] == 21 || $encuesta["id"] == 22) echo '<div class="row align-items-center justify-content-center p0 m0">';
                                    foreach ($getRespuestas as $key => $res) {
                                        // if($encuesta["id"] == 3) echo '<div class="col-12 col-lg-1 p0 m0"></div>';
                                        if ($pre['id_modo'] == 1 || $pre['id_modo'] == 3) {

                                            $namion = "pregunta_".$encuesta["id"]."_".$pre["id"];
                                            $idion  = "pregunta_".$encuesta["id"]."_".$pre["id"]."_".$res["id"];

                                            if(
                                                $encuesta["id"] == 1 || $pre["id"] == 215
                                                || $pre["id"] == 402 || $pre["id"] == 403 || $pre["id"] == 404 || $pre["id"] == 405 || $pre["id"] == 406 || $pre["id"] == 407 || $pre["id"] == 408
                                                || $pre["id"] == 412 || $pre["id"] == 413 || $pre["id"] == 414 || $pre["id"] == 415 || $pre["id"] == 416 || $pre["id"] == 417
                                            ){

                                                $color = $res["icono"] == 'las la-angry' ? '#fb2233' : ( $res["icono"] == 'las la-frown' ? '#f5760f' : ( $res["icono"] == 'las la-meh' ? '#f1ae22' : ( $res["icono"] == 'las la-smile' ? '#0abe50' : ( $res["icono"] == 'las la-grin-alt' ? '#089954' : 0 ) ) ) );
                                                
                                                echo '<div class="col-4 col-sm-2 col-lg-2 p5 m0">';

                                                echo '<label class="dB cP p2010 rr5 bS1 mb10 bHover2 taC" for="'.$idion.'">';
                                                echo '<div class="ff3 t16 mb10" style="color:'.$color.';">'.($res["nombre"]).'</div>';

                                                echo '<div class="t80 wh100 wh50_oS rr50 colorfff mAUTO mb10" style="background-color:'.$color.';"><div class="vMM"><i class="'.($res["icono"]).'"></i></div></div>';
                                                echo '<div class="w100 taC"><input type="radio" name="'.$namion.'" id="'.$idion.'" value="'.$res["id"].'"></div>';
                                                echo '</label>';

                                                echo '</div>';

                                            } else {

                                                if($encuesta["id"] == 3) echo '<div class="col-3 col-sm-2 col-lg-1 p5 m0">';
                                                if($pre["id"] == 401 || $pre["id"] == 411) echo '<div class="col-3 col-sm-2 col-lg-1 p5 m0">';
                                                
                                                echo '<label class="tab cP p10 rr5 bS1 mb10 bHover2" for="'.$idion.'">';
                                                echo '<div class="tabIn w30x"><input type="radio" name="'.$namion.'" id="'.$idion.'" value="'.$res["id"].'"></div>';
                                                echo '<div class="tabIn pAA10">'.($res["nombre"]).'</div>';
                                                echo '</label>';

                                                if($encuesta["id"] == 3) echo '</div>';
                                                if($pre["id"] == 401 || $pre["id"] == 411) echo '</div>';

                                            }

                                        } else {

                                            $namion = "pregunta_".$encuesta["id"]."_".$pre["id"]."_multiple[]";
                                            $class = "pregunta_".$encuesta["id"]."_".$pre["id"];

                                            echo '<label class="tab cP p1020 rr5 bS1 mb10 bHover2" ---for="'.$namion.'">';
                                            echo '<div class="tabIn w30x"><input type="checkbox" class="'.$class.'" name="'.$namion.'" id="'.$namion.'" value="'.$res["id"].'"></div>';
                                            echo '<div class="tabIn">'.($res["nombre"]).'</div>';
                                            echo '</label>';



                                        }
                                    }
                                    if($encuesta["id"] == 3 || $encuesta["id"] == 1 || $encuesta["id"] == 21 || $encuesta["id"] == 22) echo '</div>';
                                } else {
                                    echo '<h5 class="card-title mt10">Sin Respuestas</h5>';
                                }
                            } else {
                                $value = '';
                                echo '<textarea class="dB w100 rr5 bS1 p20 mb10" rows="6" maxlength="450" id="pregunta_' . $encuesta["id"] . '_' . $pre["id"] . '_a" name="pregunta_' . $encuesta["id"] . '_' . $pre["id"] . '_a"  placeholder="Indique su respuesta"></textarea>';
                            }

                        echo '</div>';

                    }

                } else {
                    echo '<h5 class="card-title mt10">Sin preguntas</h5>';
                }
            ?>
        </div>
        <input type="hidden" name="c" value="<?= $empresa["id"]; ?>">
        <input type="hidden" name="i" value="<?= isset($investigacion["id"]) ? $investigacion["id"] : 14; ?>">
        <input type="hidden" name="e" value="<?= isset($investigacion["id_evento"]) ? $investigacion["id_evento"] : 19; ?>">
        <input type="hidden" name="v" value="<?= isset($investigacion["id_valoracion"]) ? $investigacion["id_valoracion"] : 19; ?>">

        <div id="rtn-encuesta_<?= $encuesta["uuid"]; ?>" class="taC mb10"></div>

        <div class="taC mb15">
            <button id="btn-encuesta_<?= $encuesta["uuid"]; ?>" type="submit" class="bPrimary colorfff p1030 ff4 t18 bHover cP">Enviar</button>
        </div>

    </form>


</div>

<script>
    var limit = 3;
    $("input.pregunta_5_203").on("change", function() {
        // if($(this).siblings(":checked").length >= limit) {
            if ($('input.pregunta_5_203:checked').length > limit) {

            //this.checked = false;
            $(this).prop("checked", false);
            // alert("allowed only 3");
        }
    });
    $("input.pregunta_5_204").on("change", function() {
        // if($(this).siblings(":checked").length >= limit) {
            if ($('input.pregunta_5_204:checked').length > limit) {

            //this.checked = false;
            $(this).prop("checked", false);
            // alert("allowed only 3");
        }
    });
</script>