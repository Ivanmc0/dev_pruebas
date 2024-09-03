<?php

    $edit = 0;
    if($edit = $_ZOOM->get_data("zoom_users", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){

?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />

<!--<div class="row p0 m0">
    <div class="col-12 col-lg-4 p0 m0 pR5 p0_oS order-3 order-lg-1">
         <div class="pAA10">
            <div class="label">Trato</div>
            <select class="select" name="trato">
                <option>Ninguno</option>
                <option value="Sr.">Sr. - Señor</option>
                <option value="Sra.">Sra. - Señora</option>
                <option value="Srta.">Srta. - Señorita</option>
                <option value="Dir.">Dir. - Director / Directora</option>
                <option value="Dr.">Dr. - Doctor</option>
                <option value="Dra.">Dra. - Doctora</option>
                <option value="Ing.">Ing. - Ingeniero / Ingeniera</option>
                <option value="Lic.">Lic. - Licenciado / Licenciada</option>
                <option value="Arq.">Arq. - Arquitecto / Arquitecta</option>
            </select>
        </div>
    </div>
</div>-->

<div class="row p0 m0">
    <div class="col-12 col-lg-6 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Nombres</div>
            <input class="input" type="text" name="nombres" maxlength='100'<?php if($edit['nombres'] != '') echo 'value="'.$edit['nombres'].'"'; ?> />
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
            <div class="label">Tipo de documento</div>
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
            <div class="label">Número de identificación</div>
            <input class="input" type="text" name="identificacion" maxlength='100'<?php if($edit['identificacion'] != '') echo 'value="'.$edit['identificacion'].'"'; ?> />
        </div>
    </div>
</div>

<div class="pAA10">
    <div class="label">Email corporativo <span>(para actualizar su email, debe solicitarlo a RRHH).</span></div>
    <input class="input" readonly type="text" <?php if($edit['email'] != '') echo 'value="'.$edit['email'].'"'; ?> />
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