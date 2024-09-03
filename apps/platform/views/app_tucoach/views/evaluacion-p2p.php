<div class="p30">
    <?php
        $thisAsignacion = $_TUCOACH->get_data("grw_tuc_p2p_asignaciones", " AND id = ".$geton[1]." AND id_evaluador = ".$trabajador["id"]." AND inactivo = 0 AND eliminado = 0 ", 0);
        if($thisAsignacion){
        if($thisAsignacion["realizado"] == 0){
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
        // shuffle($compotas);
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
                    <div class="dIB ff1 color666">Estás evaluando a:</div>
                    <div class="dIB ff3 colorMorado t16 pLR5"><?= ($thisEvaluado["nombre"]); ?></div>
                    <div class="dIB ff2 t14"><?= ($thisEvaluado["cargo"]); ?></div>
                </div>

                <form action="modulos/accion-evaluacion" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

                    <input type="hidden" name="id_asignacion" value="<?= $thisAsignacion["id"]; ?>">

                    <div class="p2040 bS1 mb20">
                        <?php if(count($compotas) > 0){ foreach($compotas AS $compota){ ?>
                            <div class="row bBS1 align-items-center">
                                <div class="col-12 col-md-8 col-lg-9 p30 ff2">
                                    <?= ($compota["comportamiento"]); ?>
                                </div>
                                <div class="col-12 col-md-4 col-lg-3 mb20_oS">
                                    <div class="form-group">
                                        <input type="hidden" name="id_comportamiento[<?= $compota["id_comportamiento"]; ?>]" value="<?= $compota["id_comportamiento"]; ?>">
                                        <input type="range" name="valor_comportamiento_<?= $compota["id_comportamiento"]; ?>" class="form-control-range" id="resp-<?= $compota["id_comportamiento"]; ?>" step="<?= ($thisGrupoRespuestas["saltos"]); ?>" value="<?= ($thisGrupoRespuestas["inicio"]); ?>" min="<?= ($thisGrupoRespuestas["inicio"]); ?>" max="<?= ($thisGrupoRespuestas["fin"]); ?>" onchange="Ion.getCriterio(this.value, <?= $compota['id_comportamiento']; ?>, <?= $thisGrupoRespuestas['id']; ?>);">
                                        <div id="rtn-resp-<?= $compota["id_comportamiento"]; ?>" class="taC mt5"></div>
                                    </div>
                                </div>
                            </div>
                        <?php }} ?>
                    </div>

                    <div id="rtn-formion" class="taC mb20"></div>
                    <div class="taC">
                        <button type="submit" class="btn btn-primary"><i class="ft-unlock"></i> Guardar evaluación</button>
                    </div>

                </form>


    <?php
            } else echo "Error encontrando la evaluación";
        } else echo "Esta evaluación ya fue realizada";
        } else echo "Error encontrando la asignación";
    ?>

</div>

