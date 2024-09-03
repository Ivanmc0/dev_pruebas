<?php
 
    $edit = 0;
    if($edit = $_ZOOM->get_data("zoom_users", " AND uuid = '".$_MOD['gist']."' AND eliminado = 0 ", 0)){
       

?>

<input class="input" type="hidden" name="this" value="<?= $_MOD['gist']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Mi Cargo</div>
            <select class="select" name="id_cargo">
                <option value="0">Seleccione su cargo</option>
                <?php
                    $orga = $_ZOOM->get_data('grw_organigramas', ' AND id_empresa = '.$_SESSION['COMPANY']['id'].' AND activo = 1 AND inactivo = 0 AND eliminado = 0 ', 0);
                    if($datos = $_ZOOM->get_data('grw_cargos', ' AND id_empresa = '.$_SESSION['COMPANY']['id'].' AND id_organigrama = '.$orga['id'].' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ', 1)){
                        foreach($datos as $dato){
                            $select = ($edit['id_cargo'] == $dato['id']) ? 'selected' : '';
                            echo '<option '.$select.' value="'.$dato['id'].'">'.$dato['nombre'].'</option>';
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
            <div class="label">Mi Jefe Directo</div>
            <select class="select" name="id_jefe">
                <option value="0">Seleccione a su jefe directo</option>
                <option value="-1">No tengo un jefe directo</option>
                <?php
                    if($datos = $_ZOOM->get_data('zoom_users', ' AND id_empresa = '.$_SESSION['COMPANY']['id'].' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ', 1)){
                        foreach($datos as $dato){
                            $select = ($edit['id_jefe'] == $dato['id']) ? 'selected' : '';
                            echo '<option '.$select.' value="'.$dato['id'].'">'.$dato['nombre'].'</option>';
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