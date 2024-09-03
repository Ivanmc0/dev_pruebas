
<!-- <input class="input" type="hidden" name="id_empresa" value="<?= $_MOD['fath']; ?>" /> -->

<div class="row p0 m0">
    <div class="col-12 col-lg-3 p0 m0 pR5 p0_oS order-3 order-lg-1 mb20_oS">
        <div class="pAA10">
            <div class="label">Principal</div>
            <select class="select" name="activo">
                <option value="0">No</option>
                <option value="1">Si</option>
            </select>
        </div>
    </div>
    <div class="col-12 col-lg-6 p0 m0 p0 order-2 order-lg-2"></div>
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
            <input class="input" type="text" name="nombre" maxlength='300'/>
        </div>
    </div>
</div>