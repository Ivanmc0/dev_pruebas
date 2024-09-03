<?php
 
    $id_dinamica = $_ZOOM->get_data( "grw_lel_preguntas", " AND id = '".$_MOD['fath']."' AND eliminado = 0 ", 0)["id_dinamica"];
    $tipo      = $_ZOOM->get_data( "grw_lel_dinamicas", " AND id = '".$id_dinamica."' AND eliminado = 0 ", 0)["id_tipo"];
 
?>

<input class="input" type="hidden" name="id_pregunta" value="<?= $_MOD['fath']; ?>" />

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
            <div class="label">Respuesta</div>
            <textarea class="input" type="text" name="nombre"></textarea>
        </div>
    </div>
</div>

<?php if($tipo == 1){ ?>
    <div class="row p0 m0">
        <div class="col-12 col-lg-12 p0 m0 p0_oS">
            <div class="pAA10">
                <div class="label">Correcta</div>
                <select class="select" name="correcta">
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>
        </div>
    </div>
<?php }else{ ?>
    <input class="input" type="hidden" name="correcta" value="0" />
<?php } ?>