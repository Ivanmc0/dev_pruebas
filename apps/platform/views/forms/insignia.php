<div class="row p0 m0">
    <div class="col-12 col-lg-3 p0 m0 p0_oS mb20_oS">
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
            <div class="label">Insignia al:</div>
            <input class="input" type="text" name="nombre" />
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Forma</div>
            <select class="select" name="forma">
                <option value="0">Seleccione</option>
                <option value="pica">Pica</option>
            </select>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Color</div>
            <select class="select" name="color">
                <option value="0">Seleccione</option>
                <?php
                    if($datos = $_ZOOM->get_data('olc_colores', ' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ', 1)){
                        foreach($datos as $dato){
                            echo '<option value="'.$dato['nombre'].'" style="background-color:'.$dato['nombre'].';">'.$dato['nombre'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Icono</div>
            <select class="select" name="icono">
                <option value="0">Seleccione</option>
                <?php
                    if($datos = $_ZOOM->get_data('olc_iconos', ' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ', 1)){
                        foreach($datos as $dato){
                            echo '<option value="'.$dato['icono'].'">'.$dato['nombre'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
</div>