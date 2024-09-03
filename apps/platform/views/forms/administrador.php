

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Rol Administrativo</div>
            <select class="select" name="id_rol">
                <option value="0">Seleccione</option>
                <?php
                    if($datos = $_ZOOM->get_data('zoom_roles', ' AND id IN (120, 130, 1010, 1020, 1030, 1040, 1050) AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC, rol ASC ', 1)){
                        foreach($datos as $dato){
                            echo '<option value="'.$dato['id'].'">'.$dato['rol'].'</option>';
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
            <div class="label">Colaborador</div>
            <select class="select" name="id_user">
                <option value="0">Seleccione</option>
                <?php
                    if($datos =$_GROWI->GET('COMPANY', 'GetColaborators', $AddToQuery = " ORDER BY inactivo ASC, nombre ASC ", ['empresa' => 'USERS.id_empresa'], $ReturnRecord = false) ){
                        foreach($datos as $key=> $dato){
                            echo '<option value="'.$dato['id'].'">'.$dato['nombre_completo']. ' ( '.$dato['cargo']['nombre'].' )</option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
</div>