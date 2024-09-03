<?php
    $edit = 0;
    if($edit = $_ZOOM->get_data( "zoom_users", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){

?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-3 p0 m0 pL5 p0_oS order-1 order-lg-3 mb20_oS">
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
    <div class="col-12 col-lg-6 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Nombres</div>
            <input class="input" type="text" name="nombres" maxlength='100' <?php if($edit['nombres'] != '') echo 'value="'.$edit['nombres'].'"'; ?> />
        </div>
    </div>
    <div class="col-12 col-lg-6 p0 m0 pL5 p0_oS">
        <div class="pAA10">
            <div class="label">Apellidos</div>
            <input class="input" type="text" name="apellidos" maxlength='100'<?php if($edit['apellidos'] != '') echo 'value="'.$edit['apellidos'].'"'; ?> />
        </div>
    </div>
</div>
<div class="row p0 m0">
    <div class="col-12 col-lg-4 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Tipo</div>
            <select class="select" name="identificacion_tipo">
                <option <?php if($edit['inactivo'] == 'CC') echo 'selected'; ?> value="CC">Cédula de ciudadanía</option>
                <option <?php if($edit['inactivo'] == 'CE') echo 'selected'; ?> value="CE">Cédula de extranjería</option>
                <option <?php if($edit['inactivo'] == 'PA') echo 'selected'; ?> value="PA">Pasaporte</option>
                <option <?php if($edit['inactivo'] == 'TR') echo 'selected'; ?> value="TR">Tarjeta de residente</option>
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-8 p0 m0 pL5 p0_oS">
        <div class="pAA10">
            <div class="label">Número de identificación<span class="tag">(solo números)</span></div>
            <input class="input" type="text" name="identificacion" maxlength='100' pattern="[0-9]*" <?php if($edit['identificacion'] != '') echo 'value="'.$edit['identificacion'].'"'; ?> />
        </div>
    </div>
</div>



<div class="pAA10">
    <div class="label">Email corporativo</div>
    <input class="input" type="text" name="email" maxlength='100'<?php if($edit['email'] != '') echo 'value="'.$edit['email'].'"'; ?> />
</div>

<div class="pAA10">
    <div class="label">Teléfono corporativo <span class="tag">(opcional)</span></div>
    <input class="input" type="text" name="telefono" maxlength='50'<?php if($edit['telefono'] != '') echo 'value="'.$edit['telefono'].'"'; ?> />
</div>


<div class="pAA10">
    <div class="label">Celular <span class="tag">(opcional)</span></div>
    <input class="input" type="text" name="celular" maxlength='50'<?php if($edit['celular'] != '') echo 'value="'.$edit['celular'].'"'; ?> />
</div>

<?php
    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>