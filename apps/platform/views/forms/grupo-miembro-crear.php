<style>
    option          { font-size: 0; }
    option::before  { content: attr(label); font-size: 16px; color: black; }
</style>

<input class="input" type="hidden" name="id_parametro" value="<?= $_MOD['fath']; ?>" />

<div class="row p0 m0">
    <div class="col-12 col-lg-12 p0 m0 p0_oS">
        <div class="pAA10">
            <div class="label">Colaboradores de la empresa</div>
            <select  id="my-multiselect" class="multiselection-" name="miembros[]" multiple="multiple">
                <option value="0">Seleccione</option>
                <?php

                    $cond = " AND USERS.id NOT IN ( SELECT DISTINCT id_trabajador FROM grw_grupos_miembros WHERE id_grupo = ".$_MOD['fath']." AND inactivo = 0 AND eliminado = 0 ) ";

                    if($datos = $_GROWI->GET('COMPANY', 'GetColaborators', $AddToQuery = $cond." ORDER BY inactivo ASC, nombre ASC ", ['empresa' => 'USERS.id_empresa'], $ReturnRecord = false) ){
                        foreach($datos as $key=> $dato){
                            echo '<option value="'.$dato['id'].'">'.$dato['nombre_completo']. ', '.$dato['cargo']['nombre'].' <!--'.$dato['identificacion'].'--></option>';
                        }
                    }
                ?>
            </select>
        </div>
    </div>
</div>

<script>
    var selectElement = document.getElementById('my-multiselect');
    var choices = new Choices(selectElement, {
        removeItemButton: true,
        searchEnabled: true,
        placeholderValue: 'Seleccione a los nuevos miembros del grupo',
        searchPlaceholderValue: 'Buscar...',
    });

</script>