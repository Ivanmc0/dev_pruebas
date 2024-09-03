<?php
 
    $obt = explode(',', $_MOD['fath']);
?>
<input class="input" type="hidden" name="v" value="<?= $obt[0]; ?>" />
<input class="input" type="hidden" name="e" value="<?= $obt[1]; ?>" />

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
            <div class="label">Color de fondo</div>
            <select class="select" name="id_color">
                <option value="0">Seleccione</option>
                <?php
                    $datos = $_ZOOM->get_data('olc_colores', ' AND background = 1 AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ', 1);
                    foreach($datos as $dato){
                        echo '<option value="'.$dato['id'].'" style="background:'.$dato['nombre'].'">'.$dato['background_nombre'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Texto</div>
            <input class="input" type="text" name="nombre" />
        </div>
    </div>
</div>