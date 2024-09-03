<?php
    $edit = 0;
    if($edit = $_ZOOM->get_data( "grw_val_investigaciones", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
 
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
    <div class="col-12 col-lg-6 p0 m0 pR5 p0_oS">
        <div class="pAA10">
            <div class="label">Encuesta</div>
            <select class="select" name="id_encuesta">
                <option value="0">Seleccione</option>
                <?php
                    $datos = $_ZOOM->get_data('grw_val_encuestas', ' AND id_empresa = '.$_SESSION['COMPANY']['id'].' AND id_tipo = 1 AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ', 1);
                    foreach($datos as $dato){
                        $select = ($edit['id_encuesta'] == $dato['id']) ? 'selected' : '';
                        echo '<option '.$select.' value="'.$dato['id'].'">'.$dato['nombre'].'</option>';
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
                        $select = ($edit['id_publico'] == $dato['id']) ? 'selected' : '';
                        echo '<option '.$select.' value="'.$dato['id'].'">'.$dato['nombre'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>

<div class="publicoExterno <?php if($edit['id_publico'] == 1) echo 'dN'; ?>">
    <div class="row p0 m0">
        <div class="col-12 col-lg-12 p0 m0 p0_oS">
            <div class="pAA10">
                <div class="label">Listas de público externo</div>
                <select class="select" name="id_publico_listado">
                    <option value="0">Seleccione</option>
                    <?php
                        $datos = $_ZOOM->get_data('grw_val_listas', ' AND id_empresa = '.$_SESSION['COMPANY']['id'].' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ', 1);
                        foreach($datos as $dato){
                            $select = ($edit['id_publico_listado'] == $dato['id']) ? 'selected' : '';
                            echo '<option '.$select.' value="'.$dato['id'].'">'.$dato['nombre'].'</option>';
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
            <input class="input" type="text" name="nombre" <?php if($edit['nombre'] != '') echo 'value="'.$edit['nombre'].'"'; ?> />
        </div>
    </div>
</div>

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Descripción</div>
            <textarea class="input" type="text" name="descripcion"><?php if($edit['descripcion'] != '') echo $edit['descripcion']; ?></textarea>
        </div>
    </div>
</div>

<?php
    } else {
        echo '<script>$("#btn-'.$iDinamic.'").hide();</script>';
        MsgError('Error de seguridad: no se ha encontrado el registro solicitado.');
    }
?>