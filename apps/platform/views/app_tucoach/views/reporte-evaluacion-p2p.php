<div class="p30">
    <?php
        $thisAsignacion = $_TUCOACH->get_data("grw_tuc_p2p_asignaciones", " AND id = ".$geton[1]." AND id_evaluador = ".$trabajador["id"]." AND inactivo = 0 AND eliminado = 0 ", 0);
        if($thisAsignacion){
            $thisEvaluacion = $_TUCOACH->get_data("grw_tuc_p2p_estudios", " AND id = ".$thisAsignacion["id_evaluacion"]." AND inactivo = 0 AND eliminado = 0 ", 0);
            if($thisEvaluacion){
                $thisTest               = $_TUCOACH->get_data("grw_tuc_p2p_tests", " AND id = ".$thisEvaluacion["id_test"]." AND inactivo = 0 AND eliminado = 0 ", 0);
                $thisGrupoRespuestas    = $_TUCOACH->get_data("grw_paquete_respuestas", " AND id = ".$thisTest["id_grupopregunta"]." AND inactivo = 0 AND eliminado = 0 ", 0);
                $thisTipoRespuestas     = $_TUCOACH->get_data("grw_paquete_preguntas", " AND id_grupopregunta = ".$thisGrupoRespuestas["id"]." AND inactivo = 0 AND eliminado = 0 ORDER by desde DESC ", 1);
                $thisEvaluado           = $_TUCOACH->get_data("zoom_users", " AND id = ".$thisAsignacion["id_evaluado"]." AND inactivo = 0 AND eliminado = 0 ORDER by id DESC ", 0);
    ?>
                <div class="t24 tU colorMorado ff3 mb10">Evaluación: <?= ($thisEvaluacion["nombre"]); ?></div>
                <div class="bBS1 mb20"></div>

    <?php
        $conteo     = 0;
        $comportas  = array();
        $thisCategorias = $_TUCOACH->get_data("grw_tuc_p2p_categorias", " AND id_perfil = ".$thisAsignacion["id_perfil"]." AND inactivo = 0 AND eliminado = 0 ", 1);
        if($thisCategorias){
            foreach($thisCategorias AS $thisCategoria){
                $thisCompetencias = $_TUCOACH->get_data("grw_tuc_p2p_competencias", " AND id_categoria = ".$thisCategoria["id"]." AND inactivo = 0 AND eliminado = 0 ", 1);
                if($thisCompetencias){
                    foreach($thisCompetencias AS $thisCompetencia){
                        $thisComportamientos = $_TUCOACH->get_data("grw_tuc_p2p_comportamientos", " AND id_competencia = ".$thisCompetencia["id"]." AND inactivo = 0 AND eliminado = 0 ", 1);
                        if($thisComportamientos){
                            foreach($thisComportamientos AS $thisComportamiento){
                                $compotas[$conteo]["id_comportamiento"]     = $thisComportamiento["id"];
                                $compotas[$conteo]["comportamiento"]        = $thisComportamiento["nombre"];
                                $conteo++;
                            }
                        }
                    }
                }
            }
        }
        shuffle($compotas);
    ?>


                <div class="tab bGray bS1 rr40 mb20">
                    <div class="tabIn tab100_oS p1020 ff3 colorMorado tU taC_oS">Criterios de calificación</div>
                    <div class="tabIn tab100_oS p10 taR taC_oS">
                        <?php
                            if($thisTest && $thisTipoRespuestas){
                                foreach($thisTipoRespuestas AS $thisTipoRespuesta){
                                    echo '<div class="dIB bMorado rr20 colorfff ff2 p510 mb5_oS">';
                                    echo ($thisTipoRespuesta["desde"]);
                                    if($thisTipoRespuesta["hasta"] != "" && $thisTipoRespuesta["desde"] != $thisTipoRespuesta["hasta"]) echo " - ".($thisTipoRespuesta["hasta"]);
                                    echo " / ".($thisTipoRespuesta["nombre"]);
                                    echo '</div> ';
                                }
                            }
                        ?>
                    </div>
                </div>

                <div class="pAA20">
                    <div class="dIB ff1 color666">Evaluaste a:</div>
                    <div class="dIB ff3 colorMorado t16 pLR5"><?= ($thisEvaluado["nombre"]); ?></div>
                    <div class="dIB ff2 t14"><?= ($thisEvaluado["cargo"]); ?></div>
                </div>

                    <div class="p2040 bS1 mb20">
                        <?php if(count($compotas) > 0){ foreach($compotas AS $compota){ ?>
                            <div class="row bBS1 align-items-center">
                                <div class="col-12 col-md-8 col-lg-9 p30 ff2">
                                    <?= ($compota["comportamiento"]); ?>
                                </div>
                                <div class="col-12 col-md-4 col-lg-3 mb20_oS">
                                    <div class="form-group">
                                        <?php
                                           $respuesta   = $_TUCOACH->get_data("grw_sol_p2p_estudio", " AND id_comportamiento = ".$compota['id_comportamiento']." AND id_asignacion = ".$thisAsignacion["id"]." AND inactivo = 0 AND eliminado = 0 ORDER by id DESC ", 0);
                                           $pregunta    = $_TUCOACH->get_data("grw_paquete_preguntas", " AND desde <= ".$respuesta["solucion"]." AND hasta >= ".$respuesta["solucion"]." AND id_grupopregunta = ".$thisGrupoRespuestas['id']." AND inactivo = 0 AND eliminado = 0 ORDER by id DESC ", 0);
                                        ?>
                                        <input type="range" class="form-control-range" step="<?= ($thisGrupoRespuestas["saltos"]); ?>" value="<?= $respuesta["solucion"]; ?>" min="<?= ($thisGrupoRespuestas["inicio"]); ?>" max="<?= ($thisGrupoRespuestas["fin"]); ?>">
                                        <div id="rtn-resp-<?= $compota["id_comportamiento"]; ?>" class="ff3 colorMorado taC mt5">
                                            <?= ($respuesta["solucion"]); ?>
                                            <?= " - ".($pregunta["nombre"]); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }} ?>
                    </div>

                </form>


    <?php
            } else echo "Error encontrando la evaluación";
        } else echo "Error encontrando la asignación";
    ?>

</div>

