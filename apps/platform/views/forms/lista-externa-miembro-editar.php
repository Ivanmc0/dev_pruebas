<?php
    $edit = 0;
    if($edit = $_ZOOM->get_data( "grw_val_listasexternas_registros", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-3 p0 m0 p0_oS order-1 order-lg-3 mb20_oS">
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
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Email</div>
            <input class="input" type="text" name="email" <?php if($edit['email'] != '') echo 'value="'.$edit['email'].'"'; ?> />
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Celular</div>
            <input class="input" type="text" name="celular" <?php if($edit['celular'] != '') echo 'value="'.$edit['celular'].'"'; ?> />
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Empresa</div>
            <input class="input" type="text" name="empresa" <?php if($edit['empresa'] != '') echo 'value="'.$edit['empresa'].'"'; ?> />
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Cargo</div>
            <input class="input" type="text" name="cargo" <?php if($edit['cargo'] != '') echo 'value="'.$edit['cargo'].'"'; ?> />
        </div>
    </div>
</div>



<?php
    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>