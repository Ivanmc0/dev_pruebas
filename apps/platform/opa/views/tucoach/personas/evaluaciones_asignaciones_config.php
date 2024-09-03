<?php
    $tablus = $access_model["tabla"];
    $edit = false;
    if($id != 0) $edit = true;
    if($edit){
        $getThis = $_TUCOACH->get_data($tablus, " AND id = ".$id." ORDER BY id DESC ", 0);
        if($getThis) $edit = true; else $edit = 2;
        if($access_model["tipo"] == 1) $edit = false;
    }
    if($edit === 2){
        echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>';
    } else {
?>

<div class="content-body">

    <form action="configuraciones/accion-all" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <?php
            $getEval = $_TUCOACH->get_data("grw_tuc_p2p_estudios", " AND id = ".$id." AND eliminado = 0 ORDER BY id DESC ", 0);
        ?>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
                    <input type="hidden" id="id_evaluacion" name="id_evaluacion" value="<?= $getEval["id"]; ?>" />
                </div>
                <div class="card-body">

                    <div class="row mb20">
                        <div class="col-md-6">
                            <label class="control-label">Evaluador</label>
                            <select class="form-control form-group-margin" id="id_evaluador" name="id_evaluador" >
                                <option value="0">Ninguno</option>
                                <?php
                                    $getTrabajadores = $_TUCOACH->get_data("zoom_users", " AND id_empresa = ".$getEval["id_empresa"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getTrabajadores){
                                        foreach($getTrabajadores AS $getTrabajador){
                                ?>
                                            <option value="<?= ($getTrabajador["id"]); ?>"><?= ($getTrabajador["nombre"]); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">con el Rol</label>
                            <select class="form-control form-group-margin" id="id_rol" name="id_rol" >
                                <option value="0">Ninguno</option>
                                <?php
                                    $getRoles = $_TUCOACH->get_data("grw_tuc_roles", " AND id_gruporol = ".$getEval["id_gruporol"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getRoles){
                                        foreach($getRoles AS $getRol){
                                ?>
                                            <option value="<?= ($getRol["id"]); ?>"><?= ($getRol["nombre"]); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-6">
                            <label class="control-label">evalua a</label>
                            <select class="form-control form-group-margin" id="id_evaluado" name="id_evaluado" >
                                <option value="0">Ninguno</option>
                                <?php
                                    $getTrabajadores = $_TUCOACH->get_data("zoom_users", " AND id_empresa = ".$getEval["id_empresa"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getTrabajadores){
                                        foreach($getTrabajadores AS $getTrabajador){
                                ?>
                                            <option value="<?= ($getTrabajador["id"]); ?>"><?= ($getTrabajador["nombre"]); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">con el Perfil</label>
                            <select class="form-control form-group-margin" id="id_perfil" name="id_perfil" >
                                <option value="0">Ninguno</option>
                                <?php
                                    $getPerfiles = $_TUCOACH->get_data("grw_perfiles", " AND id_test = ".$getEval["id_test"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getPerfiles){
                                        foreach($getPerfiles AS $getPerfil){
                                ?>
                                            <option value="<?= ($getPerfil["id"]); ?>"><?= ($getPerfil["nombre"]); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="rtn-formion" class="taC mb20"></div>

        <?php include $roution."views/botones_config.php"; ?>

        <div class="h50"></div>

    </form>

</div>

<?php } ?>



