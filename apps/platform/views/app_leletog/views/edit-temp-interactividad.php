<?php

    if($geton[1] == 665){

        if ($interactividad = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id = 665 AND inactivo = 0 AND eliminado = 0', 0)) {
?>



        <div class="max1000 mAUTO p50 p30_oS">



        <form action="externo/accion-encuestar-edit-inter" id="encuesta_<?= $interactividad["id"]; ?>" name="encuesta_<?= $interactividad["id"]; ?>" method="post" class="form-horizontal zoom_form">

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
                        
                        $respues = $_ZOOM->get_data('grw_sol_act_encuestas', ' AND id_dinamica = ' . $interactividad['id'] . ' AND id_trabajador = ' . $_SESSION["WORKER"]["id"] . ' AND inactivo = 0 AND eliminado = 0 ', 0);
                        $value = $respues['respuesta'];

                        echo '<input type="hidden" name="id_respues" id="id_respues" value="'.$respues["id"].'" class="bS1" />';
                        echo '<textarea class="dB w100 rr5 bS1 p20 bCeee mb10" rows="6" id="respues" name="respues" placeholder="Digite su respuesta">'.$value.'</textarea>';
                    

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


<?php
        } else echo '<div class="general pAA30"><div class="color666 let2 t16">La actividad que busca no existe</div></div>';
    }
?>