<div class="bfff p40 p20_oS bBS1 mb20">
    <div class="ff3 t18 colorVerde mb5">Actualizando mi Perfil Empresarial</div>
</div>
<?php
    // $mi_perfil = $_LELE->validation_perfil($_SESSION["WORKER"]["id"], $_SESSION["COMPANY"]["id"]);
    // echo '<pre>';
    // print_r($perfil);
    // print_r($mi_perfil);
    // echo '</pre>';

    if ($perfil) {
        foreach ($perfil as $per) {
            $data_perfil[$per['id_parametro']]['id_opcion'] = $per['id_opcion'];
        }
    }
    $inter = $_ZOOM->get_data('grw_segmentaciones', ' AND (id_empresa = ' . $trabajador['id_empresa'] . ' ) AND inactivo = 0 AND eliminado = 0 ORDER BY id_empresa ASC, nombre ASC', 1);
    if($inter){
?>

<div class="general pAA30">
    <form action="externo/perfil" id="perfil" name="perfil" method="post" class="form-horizontal zoom_form mb30">

        <input type="hidden" name="id_empresa" id="id_empresa" value="<?= $empresa['id'] ?>" class="bS1" />
        <input type="hidden" name="id_trabajador" id="id_trabajador" value="<?= $trabajador['id'] ?>" class="bS1" />

        <?php foreach ($inter as $act) { ?>
            <div class="card mb30">
                <div class="card-header">
                    <div class="fR t12 color999"><?php if($act["id_empresa"] == 0) echo "Parámetro general"; else echo "Parámetro específico"; ?></div>
                    <div class="dIB color333 tB"><?= ($act['nombre']); ?></div>
                </div>
                <div class="card-body p15" style="padding-bottom:5px;">
                    <input type="hidden" name="opcion_<?= $act["id"]; ?>" id="opcion_<?= $act["id"]; ?>" value="<?php if (isset($data_perfil[$act['id']])) echo $data_perfil[$act['id']]['id_opcion']; ?>" class="bS1" />
                    <?php
                        $getOpciones = $_ZOOM->get_data('grw_segmentos', ' AND id_parametro = ' . $act['id'] . ' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC', 1);
                        if ($getOpciones) {
                            foreach ($getOpciones as $opc) {
                    ?>
                                <div class="tab p1020 bS1 rr5 mb10 bHover2 cP method opcion_<?= $act["id"]; ?> opcion_<?= $act["id"]; ?>_<?= $opc["id"]; ?> <?php if(isset($data_perfil[$act['id']]) && $opc["id"] == $data_perfil[$act['id']]['id_opcion']) echo "sele"; ?>" father="opcion_<?= $act["id"]; ?>" method="<?= $opc["id"]; ?>">
                                    <div class="tabIn">
                                        <div class="color666 t14 ff1"><?= ($opc["nombre"]); ?></div>
                                    </div>
                                    <div class="tabIn w40x">
                                        <div class="taR t20 cP"><i class="iconFA far color999 <?php if(isset($data_perfil[$act['id']]) && $opc["id"] == $data_perfil[$act['id']]['id_opcion']) echo 'fa-check-circle'; else echo 'fa-circle'; ?>"></i></div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        <?php } ?>

        <div id="rtn-perfil" class="taC mb20"></div>

        <div class="taC">
            <button id="btn-perfil" type="submit" class="dIB bfff bS1 bCVerde ff1 t16 rr20 colorVerde p1030 bHover1 cP">Guardar cambios</button>
        </div>
    </form>
</div>

<?php
    } else echo '<div class="general pAA30"><div class="color666 let2 t16">No tiene actividades</div></div>';
?>