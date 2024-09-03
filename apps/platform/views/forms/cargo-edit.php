<?php
 
    $edit = 0;
    if($edit = $_ZOOM->get_data("grw_cargos", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
        

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
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Nombre</div>
            <input class="input" type="text" name="nombre" <?php if($edit['nombre'] != '') echo 'value="'.$edit['nombre'].'"'; ?> />
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-6 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Dependencia</div>
            <select class="select" name="id_cargo">
                <option value="-1">Sin dependencia</option>
                <?php
                    $cargos = $_ZOOM->get_data('grw_cargos', ' AND id_empresa = '.$_SESSION['COMPANY']['id'].' AND id_organigrama = '.$edit['id_organigrama'].' AND eliminado = 0 ORDER BY nivel ASC, nombre ASC ', 1);
                    foreach($cargos as $cargo){
                        $select = ($edit['id_cargo'] == $cargo['id']) ? 'selected' : '';
                        echo '<option '.$select.' value="'.$cargo['id'].'">'.$cargo['nombre'].' (nivel. '.$cargo['nivel'].')</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-6 p0 m0 pL5 p0_oS">
        <div class="pAA10">
            <div class="label">Nivel</div>
            <select class="select" name="nivel">
                <option <?php if($edit['nivel'] == 1) echo 'selected'; ?> value="1">1</option>
                <option <?php if($edit['nivel'] == 2) echo 'selected'; ?> value="2">2</option>
                <option <?php if($edit['nivel'] == 3) echo 'selected'; ?> value="3">3</option>
                <option <?php if($edit['nivel'] == 4) echo 'selected'; ?> value="4">4</option>
                <option <?php if($edit['nivel'] == 5) echo 'selected'; ?> value="5">5</option>
                <option <?php if($edit['nivel'] == 6) echo 'selected'; ?> value="6">6</option>
                <option <?php if($edit['nivel'] == 7) echo 'selected'; ?> value="7">7</option>
                <option <?php if($edit['nivel'] == 8) echo 'selected'; ?> value="8">8</option>
                <option <?php if($edit['nivel'] == 9) echo 'selected'; ?> value="9">9</option>
                <option <?php if($edit['nivel'] == 10) echo 'selected'; ?> value="10">10</option>
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