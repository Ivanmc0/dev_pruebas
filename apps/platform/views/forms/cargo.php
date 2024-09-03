 

<input class="input" type="hidden" name="id_organigrama" value="<?= $_MOD['fath']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-3 p0 m0 pL5 p0_oS order-1 order-lg-3 mb20_oS">
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
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Nombre</div>
            <input class="input" type="text" name="nombre" />
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
                    $cargos = $_ZOOM->get_data('grw_cargos', ' AND id_empresa = '.$_SESSION['COMPANY']['id'].' AND id_organigrama = '.$_MOD['fath'].' AND eliminado = 0 ORDER BY nivel ASC, nombre ASC ', 1);
                    foreach($cargos as $cargo){
                        echo '<option value="'.$cargo['id'].'">'.$cargo['nombre'].' (nivel. '.$cargo['nivel'].')</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-6 p0 m0 pL5 p0_oS">
        <div class="pAA10">
            <div class="label">Nivel</div>
            <select class="select" name="nivel">
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