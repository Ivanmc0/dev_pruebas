<?php
  
    $inter = $_ZOOM->get_data( "grw_lel_dinamicas", " AND id = '".$_MOD['fath']."' AND eliminado = 0 ", 0);
?>

<input class="input" type="hidden" name="id_dinamica" value="<?= $_MOD['fath']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-3 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Estado</div>
            <select class="select" name="inactivo">
                <option value="0">Activo</option>
                <option value="1">Inactivo</option>
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-3 p0 m0 pL5 p0_oS">
        <div class="pAA10">
            <div class="label">Orden</div>
            <select class="select" name="prioridad">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Pregunta</div>
            <textarea class="input" type="text" name="nombre"></textarea>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Modalidad de pregunta</div>
            <select class="select" name="id_modo">
                <option value="0">Seleccione una opción</option>
                <?php
                    $datos = $_ZOOM->get_data('olc_preguntas_tipos', ' AND id_tipo = '.$inter['id_tipo'].' AND eliminado = 0 ORDER BY id ASC ', 1);
                    foreach($datos as $dato){
                        echo '<option value="'.$dato['id'].'">'.$dato['nombre'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>