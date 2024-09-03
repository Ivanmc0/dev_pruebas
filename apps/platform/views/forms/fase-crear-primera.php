<input class="input" type="hidden" name="id_journey" value="<?= $_MOD['fath']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-4 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Etapa</div>
            <select class="select" name="id_etapa">
                <option value="0">Seleccione</option>
                <?php
                    $datos = $_ZOOM->get_data('grw_val_etapas', ' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ', 1);
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
            <div class="label">Nombre primera Fase</div>
            <input class="input" type="text" name="nombre" />
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Nombre primera Subfase</div>
            <input class="input" type="text" name="nombre_subfase" />
        </div>
    </div>
</div>