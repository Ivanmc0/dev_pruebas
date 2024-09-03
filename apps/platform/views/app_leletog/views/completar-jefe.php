<div class="bfff p40 p20_oS bBS1 mb20">
    <div class="ff3 t18 colorVerde mb5">Actualizando Mi Posición Organizacional</div>
</div>
<?php

    $mi_cargo       = $_LELE->validation_cargo($_SESSION["WORKER"]["id"]);
    $cargos         = $_LELE->CARGOS;
    $trabajadores   = $_ZOOM->get_data("zoom_users"," AND id != ".$_SESSION["WORKER"]["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0  AND eliminado = 0 ORDER BY nombre ASC ", 1);
    //$thisCargo      = $_ZOOM->get_data("___olc_trabajadores_carg0"," AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id_trabajador = ".$_SESSION["WORKER"]["id"]." AND inactivo = 0  AND eliminado = 0 ORDER BY id DESC ", 0);
    $thisCargo      = $_WORKERS->getCargo(" AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id = ".$_SESSION["WORKER"]["id"]." AND inactivo = 0  AND eliminado = 0", true);

    // echo '<pre>';
    // // print_r($cargos);
    // print_r($thisCargo);
    // print_r($mi_cargo);
    // echo '</pre>';

?>

<div class="general pAA30">
    <form action="externo/completar-jefe" id="jefe" name="jefe" method="post" class="form-horizontal zoom_form mb30">

        <input type="hidden" name="id_empresa" id="id_empresa" value="<?= $empresa['id'] ?>" class="bS1" />
        <input type="hidden" name="id_trabajador" id="id_trabajador" value="<?= $trabajador['id'] ?>" class="bS1" />
        <?php if($thisCargo){ ?><input type="hidden" name="id" id="id" value="<?= $thisCargo['id'] ?>" class="bS1" /><?php } ?>



        <div class="card mb30">
            <div class="card-header">
                <div class="dIB color333 tB">Mi Cargo</div>
            </div>
            <div class="card-body p30">
                <select name="id_cargo" class="dB bfff w100 rr40 bS1 p20">
                    <option value="">Seleccione</option>
                    <?php
                        if ($cargos) {
                            foreach ($cargos as $cargo) {
                    ?>
                                <option value="<?= $cargo["id"]; ?>" <?php if(isset($mi_cargo["cargo"]) && $cargo["id"] == $mi_cargo["cargo"]["id"]) echo "selected"; ?>>
                                    <?= $cargo["nombre"]; ?>
                                </option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="card mb30">
            <div class="card-header">
                <div class="dIB color333 tB">Mi Jefe Directo</div>
            </div>
            <div class="card-body p30">
                <select name="id_jefe" class="dB bfff w100 rr40 bS1 p20">
                    <option value="">Seleccione</option>
                    <option value="-1" <?php if(isset($mi_cargo["jefe"]) && ($mi_cargo["jefe"]["id"] < 0)) echo "selected"; ?>>Sin jefe</option>
                    <?php
                        if ($trabajadores) {
                            foreach ($trabajadores as $trabajador) {
                    ?>
                                <option value="<?= $trabajador["id"]; ?>" <?php if(isset($mi_cargo["jefe"]) && $trabajador["id"] == $mi_cargo["jefe"]["id"]) echo "selected"; ?>>
                                    <?= ($trabajador["nombre"]); ?>
                                </option>
                    <?php
                            }
                        }
                    ?>
                </select>
            </div>
        </div>

        <div id="rtn-jefe" class="taC mb20"></div>

        <div class="taC">
            <button id="btn-jefe" type="submit" class="dIB bfff bS1 bCVerde ff1 t16 rr20 colorVerde p1030 bHover1 cP">Guardar cambios</button>
        </div>
    </form>
</div>