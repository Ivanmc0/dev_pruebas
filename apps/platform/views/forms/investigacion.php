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
    <div class="col-12 col-lg-6 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Encuesta</div>
            <select class="select" name="id_encuesta">
                <option value="0">Seleccione</option>
                <?php
                    $datos = $_ZOOM->get_data('grw_val_encuestas', ' AND id_empresa = '.$_SESSION['COMPANY']['id'].' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ', 1);
                    foreach($datos as $dato){
                        echo '<option value="'.$dato['id'].'">'.$dato['nombre'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-6 p0 m0 pL5 p0_oS">
        <div class="pAA10">
            <div class="label">Tipo de público</div>
            <select class="select" id="id_publico" name="id_publico">
                <option value="0">Seleccione</option>
                <?php
                    $datos = $_ZOOM->get_data('olc_publicos', ' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ', 1);
                    foreach($datos as $dato){
                        echo '<option value="'.$dato['id'].'">'.$dato['nombre'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>

<div class="publicoExterno dN">
    <div class="row p0 m0">
        <div class="col-12 col-lg-12 p0 m0 p0_oS">
            <div class="pAA10">
                <div class="label">Listas de público externo</div>
                <select class="select" name="id_publico_listado">
                    <option value="0">Seleccione</option>
                    <?php
                        $datos = $_ZOOM->get_data('grw_val_listas', ' AND id_empresa = '.$_SESSION['COMPANY']['id'].' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ', 1);
                        foreach($datos as $dato){
                            echo '<option value="'.$dato['id'].'">'.$dato['nombre'].'</option>';
                        }
                    ?>
                </select>
            </div>
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