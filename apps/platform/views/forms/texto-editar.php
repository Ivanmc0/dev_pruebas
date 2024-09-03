<?php
    $edit = 0;
    if($edit = $_ZOOM->get_data( "grw_val_eventos_textos", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
 
?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-3 p0 m0 p0_oS order-1 order-lg-3 mb20_oS">
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
        <div class="label">Color de fondo</div>
            <select class="select" name="id_color">
                <option value="0">Seleccione</option>
                <?php
                    $datos = $_ZOOM->get_data('olc_colores', ' AND background = 1 AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ', 1);
                    foreach($datos as $dato){
                        $select = ($edit['id_color'] == $dato['id']) ? 'selected' : '';
                        echo '<option '.$select.' value="'.$dato['id'].'" style="background:'.$dato['nombre'].'">'.$dato['background_nombre'].'</option>';
                    }
                ?>
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

<?php
    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>