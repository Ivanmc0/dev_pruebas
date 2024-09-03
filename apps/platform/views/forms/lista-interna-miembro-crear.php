<input class="input" type="hidden" name="id_publico_listado" value="<?= $_MOD['fath']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Colaborador</div>
            <select class="select" name="id_trabajador">
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