<?php
 
    $edit = 0;
    if($edit = $_ZOOM->get_data("grw_reconocimientos", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
 

?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-3 p0 m0 p0_oS mb20_oS">
        <div class="pAA10">
            <div class="label">Estado</div>
            <select class="select" name="inactivo">
            <option <?php if($edit['inactivo'] == 0) echo 'selected'; ?> value="0">Activo</option>
            <option <?php if($edit['inactivo'] == 1) echo 'selected'; ?> value="1">Inactivo</option>
            </select>
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Nombre</div>
            <input class="input" type="text" name="nombre" <?php if($edit['nombre'] != '') echo 'value="'.$edit['nombre'].'"'; ?> />
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Forma</div>
            <select class="select" name="forma">
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
                            $select = ($edit['color'] == $dato['nombre']) ? 'selected' : '';
                            echo '<option '.$select.' value="'.$dato['nombre'].'">'.$dato['nombre'].'</option>';
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
                            $select = ($edit['icono'] == $dato['icono']) ? 'selected' : '';
                            echo '<option '.$select.' value="'.$dato['icono'].'">'.$dato['nombre'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
</div>


<?php
    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>