<?php
    $edit = 0;
    if($edit = $_ZOOM->get_data( "grw_grupos_miembros", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){

?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-3 p0 m0 pR5 p0_oS order-1 order-lg-3 mb20_oS">
        <div class="pAA10">
            <div class="label">Estado</div>
            <select class="select" name="es_lider">
                <option <?php if($edit['es_lider'] == 0) echo 'selected'; ?> value="0">Miembro</option>
                <option <?php if($edit['es_lider'] == 1) echo 'selected'; ?> value="1">Líder</option>
                <option <?php if($edit['es_lider'] == 2) echo 'selected'; ?> value="2">Supervisor</option>
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