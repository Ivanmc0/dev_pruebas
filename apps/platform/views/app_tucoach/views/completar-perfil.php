<div class="p30">
    <?php
        $thisAsignacion = $_TUCOACH->get_data("grw_tuc_p2b_asignaciones", " AND id = ".$geton[1]." AND id_evaluador = ".$trabajador["id"]." AND inactivo = 0 AND eliminado = 0 ", 0);
        if($thisAsignacion){
        // if($thisAsignacion["realizado"] == 0){
        if(true){
            $thisEvaluacion = $_TUCOACH->get_data("grw_tuc_p2b_estudios", " AND id = ".$thisAsignacion["id_evaluacion"]." AND inactivo = 0 AND eliminado = 0 ", 0);
            if($thisEvaluacion){
    ?>
                <div class="t24 tU colorMorado ff3 mb10">Completando perfil</div>
                <div class="bBS1 mb20"></div>

    <?php
        $conteo         = 0;
        $segmetaciones  = array();
        $thisGSegmentos = $_TUCOACH->get_data("grw_tuc_segmentaciones_grupo", " AND id = ".$thisEvaluacion["id_segmentos"]." AND inactivo = 0 AND eliminado = 0 ", 1);
        if($thisGSegmentos){
            foreach($thisGSegmentos AS $thisGSegmento){
                $segmetaciones["id"]       = $thisGSegmento["id"];
                $segmetaciones["nombre"]   = $thisGSegmento["nombre"];
                $thisSegmentos = $_TUCOACH->get_data("grw_tuc_segmentaciones", " AND id_gruposegmento = ".$thisGSegmento["id"]." AND inactivo = 0 AND eliminado = 0 ", 1);
                if($thisSegmentos){
                    foreach($thisSegmentos AS $thisSegmento){
                        $segmetaciones["segmentos"][$thisSegmento["id"]]["id"]      = $thisSegmento["id"];
                        $segmetaciones["segmentos"][$thisSegmento["id"]]["nombre"]  = $thisSegmento["nombre"];
                        $thisOpciones = $_TUCOACH->get_data("grw_tuc_segmentaciones_opciones", " AND id_segmento = ".$thisSegmento["id"]." AND inactivo = 0 AND eliminado = 0 ", 1);
                        if($thisOpciones){
                            foreach($thisOpciones AS $thisOpcion){
                                $segmetaciones["segmentos"][$thisSegmento["id"]]["opciones"][$thisOpcion["id"]]["id"]       = $thisOpcion["id"];
                                $segmetaciones["segmentos"][$thisSegmento["id"]]["opciones"][$thisOpcion["id"]]["nombre"]   = $thisOpcion["nombre"];
                            }
                        }
                    }
                }
            }
        }
        // echo "<pre>";
        // print_r($segmetaciones);
        // echo "</pre>";
    ?>

                <form action="modulos/accion-completar-perfil" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

                    <input type="hidden" name="id_asignacion" value="<?= $thisAsignacion["id"]; ?>">
                    <input type="hidden" name="id_trabajador" value="<?= $thisAsignacion["id_evaluador"]; ?>">
                    <input type="hidden" name="total" value="<?= count($thisSegmentos); ?>">

                    <div class="p2040 bS1 mb20">
                        <?php if(count($segmetaciones) > 0){ foreach($segmetaciones["segmentos"] AS $segmentos){ ?>
                            <div class="row bBS1 align-items-center pAA20 t16">
                                <div class="col-12 col-md-6 col-lg-5 ff2">
                                    <?= ($segmentos["nombre"]); ?>
                                </div>
                                <div class="col-12 col-md-6 col-lg-7 taR taC_oS">
                                    <div class="">
                                        <?php if(count($segmentos["opciones"]) > 0){ foreach($segmentos["opciones"] AS $option){ ?>
                                            <label class="pLR10 m0 cP">
                                                <input type="hidden" name="respuestas[<?= ($segmentos["id"]); ?>][segmento]" value="<?= ($segmentos["id"]); ?>">
                                                <input type="radio" name="respuestas[<?= ($segmentos["id"]); ?>][opcion]" value="<?= ($option["id"]); ?>"> <?= ($option["nombre"]); ?>
                                            </label>
                                        <?php }} ?>
                                    </div>
                                </div>
                            </div>
                        <?php }} ?>
                    </div>

                    <div id="rtn-formion" class="taC mb20"></div>
                    <div class="taC">
                        <button type="submit" class="btn btn-info">Completar Perfil</button>
                    </div>

                </form>


    <?php
            } else echo "Error encontrando la evaluación";
        } else echo "Esta evaluación ya fue realizada";
        } else echo "Error encontrando la asignación";
    ?>

</div>

