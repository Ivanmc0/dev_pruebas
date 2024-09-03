<?php
    $edit = 0;
    if($edit = $_ZOOM->get_data( "grw_okr_proyectos", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
       
?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />
<input class="input" type="hidden" name="iDinamic" value="<?= $_MOD['iDinamic']; ?>" />

<div class="row p0 m0">
    <div class="col-12 p0 m0 pL5 p0_oS order-1 order-lg-3 mb20_oS">
        <div class="pAA10">
            <div class="label">¿Estás seguro de eliminar este registro? Esta acción es irreversible y eliminará permanentemente la información.</div>
            <select class="select" name="eliminado">
                <option <?php if($edit['eliminado'] == 0) echo 'selected'; ?> value="0">No</option>
                <option <?php if($edit['eliminado'] == 1) echo 'selected'; ?> value="1">Si</option>
            </select>
        </div>
    </div>
</div>


<?php
    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>