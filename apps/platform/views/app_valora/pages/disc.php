<div class="general pAA80 pAA40_oS">

    <h5 class="ff0 tU t12 mb10">DISC</h5>


    <?php if($asignacion['completado'] != 1 ){ ?>

        <h1 class="ff3 cPrimary t30 mb20 mb10_oS"><?= ($encuesta["nombre"]); ?></h1>
        <h3 class="ff1 color666 t16 mb50 mb30_oS"><?= ($encuesta["descripcion"]); ?></h3>

        <h5 class="ff2 color666 t16 mb30 mb20_oS"><?= ($encuesta["introduccion"]); ?></h5>

        <form action="val/accion-encuesta-disc" id="encuesta_<?= $encuesta["uuid"]; ?>" name="encuesta_<?= $encuesta["uuid"]; ?>" method="post" class="form-horizontal zoom_form">

            <div>
                <?php
                    $cc = 0;
                    $getPreguntas = $_ZOOM->get_data('grw_val_preguntas', ' AND id_encuesta = ' . $encuesta['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                    if ($getPreguntas) {
                        foreach ($getPreguntas as $pre) {
                            $cc++;

                            echo '<div class="bfff p20 rr20 bShadow3 mb30">';

                                echo '<div class="ff2 t14 mb20">';
                                // echo '<div class="t16">Pregunta '.($cc).'</div>';
                                echo '<div class="t16">'.$pre['nombre'].' '.$cc.'</div>';
                                echo '</div>';

                                    $getRespuestas = $_ZOOM->get_data('grw_val_respuestas', ' AND id_pregunta = ' . $pre['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                                    if ($getRespuestas) {
                                        echo '<div class="row align-items-center p0 m0 rr10 bVerde4">';
                                        echo '<div class="col-12 col-lg-4 p0 m0 p515 p10_oS">';
                                        echo '<div class="t18 ff4 colorVerde">Seleccione la que más</div>';
                                        echo '<div class="t12 ff1 color666">se asemeje a usted en el ambiente de trabajo</div>';
                                        echo '</div>';

                                        foreach ($getRespuestas as $key => $res) {

                                            $namion = "pregunta_".$encuesta["id"]."_".$pre["id"]."_1";
                                            $idion  = "pregunta_".$encuesta["id"]."_".$pre["id"]."_".$res["id"]."_1";

                                            echo '<div class="col-6 col-sm-2 col-lg-2 p510 p5_oS m0">';
                                            echo '<div class="h10 dN_oS"></div><label class="tab cP p10 rr5 bS1 mb10 bHover4" for="'.$idion.'">';
                                            echo '<div class="tabIn w30x"><input class="csid" type="radio" name="'.$namion.'" id="'.$idion.'" value="'.$res["id"].'"></div>';
                                            echo '<div class="tabIn pAA10">'.($res["nombre"]).'</div>';
                                            echo '</label>';
                                            echo '</div>';

                                        }
                                        echo '</div>';

                                        echo '<div class="row align-items-center p0 m0 rr10 bRojo4">';
                                        echo '<div class="col-12 col-lg-4 p0 m0 p515 p10_oS">';
                                        echo '<div class="t18 ff4 colorRojo">Seleccione la que menos</div>';
                                        echo '<div class="t12 ff1 color666">se asemeje a usted en el ambiente de trabajo</div>';
                                        echo '</div>';

                                        foreach ($getRespuestas as $key => $res) {

                                            $namion = "pregunta_".$encuesta["id"]."_".$pre["id"]."_0";
                                            $idion  = "pregunta_".$encuesta["id"]."_".$pre["id"]."_".$res["id"]."_0";

                                            echo '<div class="col-6 col-sm-2 col-lg-2 p510 p5_oS m0">';
                                            echo '<div class="h10 dN_oS"></div><label class="tab cP p10 rr5 bS1 mb10 bHover4" for="'.$idion.'">';
                                            echo '<div class="tabIn w30x"><input class="csid" type="radio" name="'.$namion.'" id="'.$idion.'" value="'.$res["id"].'"></div>';
                                            echo '<div class="tabIn pAA10">'.($res["nombre"]).'</div>';
                                            echo '</label>';
                                            echo '</div>';

                                        }
                                        echo '</div>';
                                    } else {
                                        echo '<h5 class="card-title mt10">Sin Respuestas</h5>';
                                    }

                            echo '</div>';

                        }

                    } else {
                        echo '<h5 class="card-title mt10">Sin preguntas</h5>';
                    }
                ?>
            </div>
            <input type="hidden" name="id_asignacion" value="<?= $geton[1]; ?>">

            <div id="rtn-encuesta_<?= $encuesta["uuid"]; ?>" class="taC mb20"></div>

            <div class="taC mb15">
                <button id="btn-encuesta_<?= $encuesta["uuid"]; ?>" type="submit" class="bPrimary colorfff p1030 ff4 t18 bHover cP">Enviar</button>
            </div>

        </form>

    <?php }else{ ?>

        <div class="pAA150 pAA30_oS">
            <h1 class="ff3 cPrimary t30">Este DISC ya ha sido realizado.</h1>
            <h1 class="ff1 color666 t20">Gracias por su participación.</h1>
        </div>


    <?php } ?>


</div>