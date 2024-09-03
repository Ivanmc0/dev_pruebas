 

<!-- <input class="input" type="hidden" name="id_empresa" value="<?= $_MOD['fath']; ?>" /> -->

<div class="row p0 m0">

    <div class="col-12 col-lg-3 p0 m0 pR5 p0_oS order-1 order-lg-3 mb20_oS">
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
    <div class="col-12 col-lg-8 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Nombre</div>
            <input class="input" type="text" name="nombre" />
        </div>
    </div>
    <div class="col-12 col-lg-4 p0 m0 pL5 p0_oS">
        <div class="pAA10">
            <div class="label">Categoría</div>
            <select class="select" name="id_categoria">
                <option value="0">Seleccione</option>
                <?php
                    $datos = $_ZOOM->get_data('grw_lel_categorias', ' AND id_empresa = '.$_SESSION['COMPANY']['id'].' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ', 1);
                    foreach($datos as $dato){
                        echo '<option value="'.$dato['id'].'">'.$dato['nombre'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Descripción</div>
            <textarea class="input" type="text" name="descripcion"></textarea>
        </div>
    </div>
</div>