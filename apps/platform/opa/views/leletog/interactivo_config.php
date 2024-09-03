<?php
$tablus         = $access_model["tabla"];
$edit           = false;
$getThis        = true;
if ($access_model["tipo"] == 2) {
    $getThis    = $_ZOOM->get_data($tablus, " AND id = " . $id . " ORDER BY id DESC ", 0);
    $edit       = true;
}

if ($getThis) {
?>

    <div class="content-body">
        <form action="modulos/accion-all" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

            <?php if ($edit) { ?>
                <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
            <?php } else { ?>
                <input type="hidden" id="id_actividad" name="id_actividad" value="<?= $id; ?>" />
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
                                <label class="control-label">Modelo</label>
                                <select class="form-control form-group-margin" id="id_modelo" name="id_modelo">
                                    <option value="0">Ninguno</option>
                                    <?php
                                    $getModelos = $_ZOOM->get_data("olc_modelos", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if ($getModelos) {
                                        foreach ($getModelos as $getModelo) {
                                    ?>
                                            <option value="<?= ($getModelo["id"]); ?>" <?php if (($edit && $getThis["id_modelo"] == $getModelo["id"]) || ($edit == false && $id == $getModelo["id"])) echo "selected"; ?>><?= ($getModelo["nombre"]); ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Tipo de modelo</label>
                                <select class="form-control form-group-margin" id="id_tipo" name="id_tipo">
                                    <option value="0">Ninguno</option>
                                    <?php
                                    $getModTipos = $_ZOOM->get_data("olc_modelos_tipos", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if ($getModTipos) {
                                        foreach ($getModTipos as $getModeloTipo) {
                                    ?>
                                            <option value="<?= ($getModeloTipo["id"]); ?>" <?php if (($edit && $getThis["id_tipo"] == $getModeloTipo["id"]) || ($edit == false && $id == $getModeloTipo["id"])) echo "selected"; ?>><?= ($getModeloTipo["nombre"]); ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Estado</label>
                                <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                    <option value="0" <?php if ($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                    <option value="1" <?php if ($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
                                </select>
                            </div>
                            <!-- <div class="col-md-4">
                                <label class="control-label">Modo de modelo</label>
                                <select class="form-control form-group-margin" id="id_modo" name="id_modo">
                                    <option value="0">Ninguno</option>
                                    <?php
                                    $getModModelo = $_ZOOM->get_data("olc_preguntas_tipos", " AND id_tipo = ".$getThis["id_tipo"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if ($getModModelo) {
                                        foreach ($getModModelo as $getModeloMod) {
                                    ?>
                                            <option value="<?= ($getModeloMod["id"]); ?>" <?php if (($edit && $getThis["id_modo"] == $getModeloMod["id"]) || ($edit == false && $id == $getModeloMod["id"])) echo "selected"; ?>><?= ($getModeloMod["nombre"]); ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div> -->
                        </div>
                        <div class="row mb20">
                            <div class="col-md-4">
                                <label class="control-label">Orden</label>
                                <input class="form-control form-group-margin" type="text" id="prioridad" name="prioridad" value="<?php if ($edit) echo ($getThis["prioridad"]); ?>" />
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Introducción</label>
                                <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if ($edit) echo ($getThis["nombre"]); ?>" />
                            </div>
                            
                        </div>
                    </div>
                </div>



            </div>
    </div>

    <div id="rtn-formion" class="taC mb20"></div>

    <?php include $roution . "views/botones_config.php"; ?>

    <div class="h50"></div>

    </form>

    </div>

<?php } else echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>'; ?>