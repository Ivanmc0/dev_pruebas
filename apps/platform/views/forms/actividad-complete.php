<?php
    $edit = 0;
    if($edit = $_ZOOM->get_data( "grw_lel_actividades", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
        if($process = $_ZOOM->get_data("grw_procesos", " AND id_proceso_tipo = 3 AND id_proceso = ".$edit["id"]." AND eliminado = 0 ", 0)){
 
?>

<input class="input" type="hidden" name="this" value="<?= $process['uuid']; ?>" />

<div class="row p0 m0">
    <div class="col-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Visibilidad</div>
            <select class="select" name="visible">
            <option <?php if($process['visible'] == 0) echo 'selected'; ?> value="0">En construcción</option>
            <option <?php if($process['visible'] == 1) echo 'selected'; ?> value="1">Publicado</option>
            </select>
        </div>
    </div>
</div>

<?php

        } else {
            echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
            MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
        }

    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>