<?php
    $tablus = $access_model["tabla"];
    $edit = false;
    if($id != 0) $edit = true;
    if($edit){
        $getThis = $_TUCOACH->get_data($tablus, " AND id = ".$id." ORDER BY id DESC ", 0);
        if($getThis) $edit = true; else $edit = 2;
    }
    if($edit === 2){
        echo '<div class="taC p40 t24">¡No se encontró la configuración buscaba!</div>';
    } else {

?>

<div class="content-body">

    <form action="configuraciones/accion-all" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <?php if($edit){ ?>
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
        <?php } ?>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
                </div>
                <div class="card-body">

                    <div class="row mb20">
                        <div class="col-md-4">
                            <label class="control-label">Nombre</label>
                            <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if($edit) echo ($getThis["nombre"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Mínimo requerido</label>
                            <input class="form-control form-group-margin" type="text" id="nivel_minimo" name="nivel_minimo" value="<?php if($edit) echo ($getThis["nivel_minimo"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Estado</label>
                            <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                <option value="0" <?php if($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                <option value="1" <?php if($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-4">
                            <label class="control-label">Empresa</label>
                            <select class="form-control form-group-margin" id="id_empresa" name="id_empresa">
                                <option value="0">Seleccione</option>
                                <?php
                                    $getEmpresas = $_TUCOACH->get_data("olc_empresas", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getEmpresas){
                                        foreach($getEmpresas AS $getEmpresa){
                                ?>
                                            <option value="<?= ($getEmpresa["id"]); ?>" <?php if($edit && $getThis["id_empresa"] == $getEmpresa["id"]) echo "selected"; ?>><?= ($getEmpresa["nombre"]); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Tests</label>
                            <select class="form-control form-group-margin" id="id_test" name="id_test">
                                <option value="0">Seleccione</option>
                                <?php
                                    $getTests = $_TUCOACH->get_data("grw_tuc_p2p_tests", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getTests){
                                        foreach($getTests AS $getTest){
                                ?>
                                            <option value="<?= ($getTest["id"]); ?>" <?php if($edit && $getThis["id_test"] == $getTest["id"]) echo "selected"; ?>><?= ($getTest["nombre"]); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Grupo de roles</label>
                            <select class="form-control form-group-margin" id="id_gruporol" name="id_gruporol">
                                <option value="0">Seleccione</option>
                                <?php
                                    $getGrupos = $_TUCOACH->get_data("grw_tuc_roles_grupos", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getGrupos){
                                        foreach($getGrupos AS $getGrupo){
                                ?>
                                            <option value="<?= ($getGrupo["id"]); ?>" <?php if($edit && $getThis["id_gruporol"] == $getGrupo["id"]) echo "selected"; ?>><?= ($getGrupo["nombre"]); ?></option>
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



