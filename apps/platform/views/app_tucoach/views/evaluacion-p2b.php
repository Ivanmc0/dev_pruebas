<div class="p30">
    <?php
        $thisAsignacion = $_TUCOACH->get_data("grw_tuc_p2b_asignaciones", " AND id = ".$geton[1]." AND id_evaluador = ".$trabajador["id"]." AND inactivo = 0 AND eliminado = 0 ", 0);
        if($thisAsignacion){
        if($thisAsignacion["realizado"] == 0){
            $thisEvaluacion = $_TUCOACH->get_data("grw_tuc_p2b_estudios", " AND id = ".$thisAsignacion["id_evaluacion"]." AND inactivo = 0 AND eliminado = 0 ", 0);
            if($thisEvaluacion){
                $thisGTest              = $_TUCOACH->get_data("grw_tuc_paquetests", " AND id = ".$thisEvaluacion["id_grupotests"]." AND inactivo = 0 AND eliminado = 0 ", 0);
    ?>
                <div class="t24 tU colorMorado ff3 mb10">Evaluación: <?= ($thisEvaluacion["nombre"]); ?></div>
                <div class="bBS1 mb20"></div>

    <?php
        $tests = $_TUCOACH->get_grupo_tests(" AND multi.id = ".$thisEvaluacion["id_grupotests"]." ORDER BY id DESC ", 1);
        if($tests){
            foreach($tests AS $test){

                $evalion[$test["id"]]["GRespuestas"]["id"] = $test["id_grupopregunta"];
                $thisGrupoRespuestas = $_TUCOACH->get_data("grw_paquete_respuestas", " AND id = ".$test["id_grupopregunta"]." AND inactivo = 0 AND eliminado = 0 ", 0);
                if($thisGrupoRespuestas){
                    $evalion[$test["id"]]["GRespuestas"]["nombre"]          = $thisGrupoRespuestas["nombre"];
                    $evalion[$test["id"]]["GRespuestas"]["inicio"]          = $thisGrupoRespuestas["inicio"];
                    $evalion[$test["id"]]["GRespuestas"]["fin"]             = $thisGrupoRespuestas["fin"];
                    $evalion[$test["id"]]["GRespuestas"]["saltos"]          = $thisGrupoRespuestas["saltos"];
                    $evalion[$test["id"]]["GRespuestas"]["equivalencia"]    = $thisGrupoRespuestas["equivalencia"];
                    $thisTipoRespuestas = $_TUCOACH->get_data("grw_paquete_preguntas", " AND id_grupopregunta = ".$thisGrupoRespuestas["id"]." AND inactivo = 0 AND eliminado = 0 ORDER by desde DESC ", 1);
                    if($thisTipoRespuestas){
                        foreach($thisTipoRespuestas AS $thisTipoRespuesta){
                            $evalion[$test["id"]]["GRespuestas"]["tipos"][$thisTipoRespuesta["id"]]["nombre"]   = $thisTipoRespuesta["nombre"];
                            $evalion[$test["id"]]["GRespuestas"]["tipos"][$thisTipoRespuesta["id"]]["desde"]    = $thisTipoRespuesta["desde"];
                            $evalion[$test["id"]]["GRespuestas"]["tipos"][$thisTipoRespuesta["id"]]["hasta"]    = $thisTipoRespuesta["hasta"];
                        }
                    }
                }

                $conteo     = 0;
                $comportas  = array();
                $thisCategorias = $_TUCOACH->get_data("grw_tuc_p2b_categorias", " AND id_test = ".$test["id"]." AND inactivo = 0 AND eliminado = 0 ", 1);
                if($thisCategorias){
                    foreach($thisCategorias AS $thisCategoria){
                        $thisCompetencias = $_TUCOACH->get_data("grw_tuc_p2b_competencias", " AND id_categoria = ".$thisCategoria["id"]." AND inactivo = 0 AND eliminado = 0 ", 1);
                        if($thisCompetencias){
                            foreach($thisCompetencias AS $thisCompetencia){
                                $thisComportamientos = $_TUCOACH->get_data("grw_tuc_p2b_comportamientos", " AND id_competencia = ".$thisCompetencia["id"]." AND inactivo = 0 AND eliminado = 0 ", 1);
                                if($thisComportamientos){
                                    foreach($thisComportamientos AS $thisComportamiento){
                                        $evalion[$test["id"]]["comportamientos"][$thisComportamiento["id"]]["id_comportamiento"]     = $thisComportamiento["id"];
                                        $evalion[$test["id"]]["comportamientos"][$thisComportamiento["id"]]["comportamiento"]        = $thisComportamiento["nombre"];
                                        $conteo++;
                                    }
                                }
                            }
                        }
                    }
                }
                shuffle($evalion[$test["id"]]["comportamientos"]);
            }
        }
        // echo '<div class"taL"><pre>';
        // print_r($evalion);
        // echo '</pre></div>';

    ?>




                <div class="pAA20">
                    <div class="dIB ff1 color666">Estás evaluando a:</div>
                    <div class="dIB ff3 colorMorado t16 pLR5"><?= ($empresa["nombre"]); ?></div>
                </div>

                <form action="modulos/accion-evaluacion-empresa" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

                    <input type="hidden" name="id_asignacion" value="<?= $thisAsignacion["id"]; ?>">


                    <?php
                        if(count($evalion) > 0){
                            foreach($evalion AS $testion){
                                $resps = $testion["GRespuestas"];
                    ?>
                                <div class="bGray p10 bS1 taC rr10 mb20">
                                    <div class="p510 ff3 colorMorado tU">Criterios de calificación</div>
                                    <div class="p510">
                                        <?php
                                            $reversed = array_reverse($resps["tipos"]);
                                            foreach($reversed AS $thisTipoRespuesta){
                                                echo '<div class="dIB bMorado rr20 colorfff ff2 p510 t12 mb5">';
                                                echo ($thisTipoRespuesta["desde"]);
                                                if($thisTipoRespuesta["hasta"] != "" && $thisTipoRespuesta["desde"] != $thisTipoRespuesta["hasta"]) echo " - ".($thisTipoRespuesta["hasta"]);
                                                echo " - ".($thisTipoRespuesta["nombre"]);
                                                echo '</div> ';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="p2040 bS1 mb20">
                                    <div class="row bBS1 align-items-center tU ff3 pAA10">
                                        <div class="col-12 col-md-8 col-lg-7 mb10_oS">Afirmaciones</div>
                                        <div class="col-12 col-md-4 col-lg-5 dN_oS">En la Empresa</div>
                                        <!-- <div class="col-12 col-md-4 col-lg-3 dN_oS">En el Proceso</div> -->
                                    </div>
                    <?php
                                foreach($testion["comportamientos"] AS $compota){
                    ?>
                                <div class="row bBS1 align-items-center">
                                    <div class="col-12 col-md-7 col-lg-8 p30 p10_oS t16 ff2 mb10_oS">
                                        <?= ($compota["comportamiento"]); ?>
                                    </div>
                                    <div class="col-12 col-md-5 col-lg-4 mb20_oS">
                                        <div class="form-group">
                                            <input type="hidden" name="comportamientos[<?= $compota["id_comportamiento"]; ?>][id]" value="<?= $compota["id_comportamiento"]; ?>">
                                            <div class="dN_oPC ff3 mb5">En la Empresa</div>
                                            <input type="range"
                                                name="comportamientos[<?= $compota["id_comportamiento"]; ?>][solucion]"
                                                class="form-control-range" id="resp-<?= $compota["id_comportamiento"]; ?>"
                                                step="<?= ($resps["saltos"]); ?>"
                                                value="<?= ($resps["inicio"]); ?>"
                                                min="<?= ($resps["inicio"]); ?>"
                                                max="<?= ($resps["fin"]); ?>"
                                                onchange="Ion.getCriterio(this.value, <?= $compota['id_comportamiento']; ?>, <?= $resps['id']; ?>);">
                                            <div id="rtn-resp-<?= $compota["id_comportamiento"]; ?>" class="taC mt5"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 col-lg-3 mb20_oS dN"> <!-- OCULTO -->
                                        <div class="form-group">
                                        <div class="dN_oPC ff3 mb5">En el Proceso</div>
                                            <input type="range"
                                                name="comportamientos[<?= $compota["id_comportamiento"]; ?>][solucion2]"
                                                class="form-control-range" id="resp-<?= $compota["id_comportamiento"]; ?>"
                                                step="<?= ($resps["saltos"]); ?>"
                                                value="100<?php //echo ($resps["inicio"]); ?>"
                                                min="<?= ($resps["inicio"]); ?>"
                                                max="<?= ($resps["fin"]); ?>"
                                                onchange="Ion.getCriterio2(this.value, <?= $compota['id_comportamiento']; ?>, <?= $resps['id']; ?>);">
                                            <div id="rtn-resp2-<?= $compota["id_comportamiento"]; ?>" class="taC mt5"></div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                                }
                    ?>
                    </div>
                    <?php
                            }
                        }
                    ?>


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

