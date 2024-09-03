<?php
 
    $edit = 0;
    if($edit = $_ZOOM->get_data("zoom_users", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){


?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />


<?php


    $seg = $_ZOOM->get_data('grw_segmentaciones', ' AND (id_empresa = ' . $_SESSION['WORKER']['id_empresa'] . ' ) AND inactivo = 0 AND eliminado = 0 ORDER BY id_empresa ASC, nombre ASC', 1);
    if($seg){
        foreach ($seg as $act) {

            $respuesta = $_ZOOM->get_data('grw_sol_seg_perfilado', ' AND id_trabajador = ' . $edit['id'] . ' AND id_parametro = ' . $act['id'] . ' AND inactivo = 0 AND eliminado = 0  ', 0);

         
?>



<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label"><?= $act['nombre']; ?></div>
            <select class="select" name="segmentacion[<?= $act['id']; ?>]">
                <option value="0">Seleccione su respuesta</option>

                    <?php
                        $getOpciones = $_ZOOM->get_data('grw_segmentos', ' AND id_parametro = ' . $act['id'] . ' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC', 1);
                        if ($getOpciones) {
                            foreach ($getOpciones as $opc) {
                                $select = ($respuesta && $respuesta['id_opcion'] == $opc['id']) ? 'selected' : '';

                                echo '<option '.$select.' value="'.$opc['id'].'">'.$opc['nombre'].'</option>';

                            }
                        }
                    ?>
            </select>
        </div>
    </div>
</div>
        <?php
    }

    } else echo '<div class="general pAA30"><div class="color666 let2 t16">No tiene actividades</div></div>';

    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>