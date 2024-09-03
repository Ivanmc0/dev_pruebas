<?php
    $edit = 0;
    if($edit = $_ZOOM->get_data( "grw_val_valoraciones", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-3 p0 m0 pR5 p0_oS order-1 order-lg-3 mb20_oS">
        <div class="pAA10">
            <div class="label">Estado</div>
            <select class="select" name="inactivo">
                <option <?php if($edit['inactivo'] == 0) echo 'selected'; ?> value="0">Activo</option>
                <option <?php if($edit['inactivo'] == 1) echo 'selected'; ?> value="1">Inactivo</option>
            </select>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Nombre</div>
            <input class="input" type="text" name="nombre" <?php if($edit['nombre'] != '') echo 'value="'.$edit['nombre'].'"'; ?> />
        </div>
    </div>
    <!-- <div class="col-12 col-lg-4 p0 m0 pL5 p0_oS">
        <div class="pAA10">
            <div class="label">Categoría</div>
            <select class="select" name="id_tipo">
                <option value="0">Seleccione</option>
                <option <?php if($edit['id_tipo'] == 1) echo 'selected'; ?> value="1">Journey</option>
                <option <?php if($edit['id_tipo'] == 2) echo 'selected'; ?> value="2">Evento</option>
            </select>
        </div>
    </div> -->
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Descripción</div>
            <textarea class="input" type="text" name="descripcion"><?php if($edit['descripcion'] != '') echo $edit['descripcion']; ?></textarea>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Expectativas</div>
            <textarea class="input" type="text" name="expectativas"><?php if($edit['expectativas'] != '') echo $edit['expectativas']; ?></textarea>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Escenarios</div>
            <textarea class="input" type="text" name="escenarios"><?php if($edit['escenarios'] != '') echo $edit['escenarios']; ?></textarea>
        </div>
    </div>
</div>

<?php
    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>