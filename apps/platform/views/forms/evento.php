<?php
    $obt = explode(',', $_MOD['fath']);
?>

<input class="input" type="hidden" name="v" value="<?= $obt[0]; ?>" />
<input class="input" type="hidden" name="x" value="<?= $obt[1]; ?>" />
<input class="input" type="hidden" name="y" value="<?= $obt[2]; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-3 p0 m0 p0_oS order-1 order-lg-3 mb20_oS">
        <div class="pAA10">
            <div class="label">Estado</div>
            <select class="select" name="inactivo">
                <option value="0">Activo</option>
                <option value="1">Inactivo</option>
            </select>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Arquetipo</div>
            <select class="select" name="id_arquetipo">
                <option value="0">Seleccione</option>
                <?php
                    $datos = $_ZOOM->get_data('grw_arquetipos', ' AND id_empresa = '.$_SESSION['COMPANY']['id'].' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ', 1);
                    foreach($datos as $dato){
                        echo '<option value="'.$dato['id'].'">'.$dato['nombre'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Nombre</div>
            <input class="input" type="text" name="nombre" />
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Descripción</div>
            <textarea class="input" type="text" name="descripcion"></textarea>
        </div>
    </div>
</div>