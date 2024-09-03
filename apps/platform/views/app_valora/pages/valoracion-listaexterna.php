<div class="general pAA80 pAA40_oS">





    <?php if($asignacion['completado'] != 1 ){ ?>


        <h5 class="ff0 tU t12 mb10">Encuesta</h5>
    <h1 class="ff3 cPrimary t30 mb20 mb10_oS"><?= ($encuesta["nombre"]); ?></h1>
    <h3 class="ff1 color666 t16 mb50 mb30_oS"><?= ($encuesta["descripcion"]); ?></h3>

    <h5 class="ff2 color666 t16 mb30 mb20_oS"><?= ($encuesta["introduccion"]); ?></h5>


        <form action="val/accion-encuesta-listaexterna" id="encuesta_<?= $encuesta["uuid"]; ?>" name="encuesta_<?= $encuesta["uuid"]; ?>" method="post" class="form-horizontal zoom_form">

            <div>
                <?php
                    $getPreguntas = $_ZOOM->get_data('grw_val_preguntas', ' AND id_encuesta = ' . $encuesta['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
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
                                        if($encuesta["id"] == 3 || $encuesta["id"] == 11) echo '<div class="row align-items-center p0 m0">';
                                        foreach ($getRespuestas as $key => $res) {
                                            if($encuesta["id"] == 3 || $encuesta["id"] == 11 && $key == 0) echo '<div class="col-12 col-lg-1 p0 m0"></div>';
                                            if ($pre['id_modo'] == 1 || $pre['id_modo'] == 3) {

                                                $namion = "pregunta_".$encuesta["id"]."_".$pre["id"];
                                                $idion  = "pregunta_".$encuesta["id"]."_".$pre["id"]."_".$res["id"];

                                                if($pre["id"] == 301) echo '<div class="col-3 col-sm-2 col-lg-2 p5 m0">';
                                                elseif($encuesta["id"] == 3 || $encuesta["id"] == 11) echo '<div class="col-3 col-sm-2 col-lg-1 p5 m0">';
                                                if($pre["id"] == 301){

                                                    echo '<label class="w100 p10 rr5 bS1 mb10 bHover2" for="'.$idion.'">';
                                                    echo '<div class="taC pAA10"><img src="'.($dominion."resources/emoticons/".$res["imagen"]).'" /></div>';
                                                    echo '<div class="taC pAA10">'.($res["nombre"]).'</div>';
                                                    echo '<div class="mAUTO taC w30x"><input type="radio" name="'.$namion.'" id="'.$idion.'" value="'.$res["id"].'"></div>';
                                                    echo '</label>';

                                                }else{
                                                    echo '<label class="tab cP p10 rr5 bS1 mb10 bHover2" for="'.$idion.'">';
                                                    echo '<div class="tabIn w30x"><input type="radio" name="'.$namion.'" id="'.$idion.'" value="'.$res["id"].'"></div>';
                                                    echo '<div class="tabIn pAA10">'.($res["nombre"]).'</div>';
                                                    echo '</label>';
                                                }
                                                if($encuesta["id"] == 3 || $encuesta["id"] == 11) echo '</div>';

                                            } else {

                                                $namion = "pregunta_".$encuesta["id"]."_".$pre["id"]."_multiple[]";
                                                $class = "pregunta_".$encuesta["id"]."_".$pre["id"];

                                                echo '<label class="tab cP p1020 rr5 bS1 mb10 bHover2" ---for="'.$namion.'">';
                                                echo '<div class="tabIn w30x"><input type="checkbox" class="'.$class.'" name="'.$namion.'" id="'.$namion.'" value="'.$res["id"].'"></div>';
                                                echo '<div class="tabIn">'.($res["nombre"]).'</div>';
                                                echo '</label>';



                                            }
                                        }
                                        if($encuesta["id"] == 3 || $encuesta["id"] == 11) echo '</div>';
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
            <input type="hidden" name="id_empresa" value="<?= $empresa["id"]; ?>">
            <input type="hidden" name="id_listaexterna_registro" value="<?= $asignacion["id_listaexterna_registro"]; ?>">
            <input type="hidden" name="id_encuesta" value="<?= $asignacion["id_encuesta"]; ?>">
            <input type="hidden" name="asignacion" value="<?= $asignacion["uuid"]; ?>">

            <div id="rtn-encuesta_<?= $encuesta["uuid"]; ?>" class="taC mb10"></div>

            <div class="taC mb15">
                <button id="btn-encuesta_<?= $encuesta["uuid"]; ?>" type="submit" class="bPrimary colorfff p1030 ff4 t18 bHover cP">Enviar</button>
            </div>

        </form>


    <?php }else{ ?>

        <h1 class="ff3 cPrimary t30">Esta encuesta ya ha sido atendida.</h1>
        <div class="h60"></div>
        <div class="h60"></div>
        <div class="h60"></div>
        <div class="h60"></div>

    <?php } ?>



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