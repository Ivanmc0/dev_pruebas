<?php
$tablus         = $access_model["tabla"];
$edit           = false;
$getThis        = true;

if ($access_model["tipo"] == 2) {
    $getThis    = $_ZOOM->get_data($tablus, " AND id = " . $id . " ORDER BY id DESC ", 0);
    $edit       = true;
    $getModelo      = $_ZOOM->get_data('grw_lel_preguntas', " AND id = " . $getThis['id_pregunta'] . " ORDER BY id DESC ", 0);
    $getMod         = $_ZOOM->get_data('grw_lel_dinamicas', " AND id = " . $getModelo['id_dinamica'] . " ORDER BY id DESC ", 0);
    $tipo           = $getMod['id_tipo'];
} else {
    $getModelo      = $_ZOOM->get_data('grw_lel_preguntas', " AND id = " . $id . " ORDER BY id DESC ", 0);
    $getMod         = $_ZOOM->get_data('grw_lel_dinamicas', " AND id = " . $getModelo['id_dinamica'] . " ORDER BY id DESC ", 0);
    $tipo           = $getMod['id_tipo'];
}



if ($getThis) {
?>

    <div class="content-body">
        <form action="modulos/accion-all" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

            <?php if ($edit) { ?>
                <input type="hidden" id="id" name="id" value="<?= $id; ?>" />

            <?php } else { ?>
                <input type="hidden" id="id_pregunta" name="id_pregunta" value="<?= $id; ?>" />
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
                                <label class="control-label">Orden</label>
                                <input class="form-control form-group-margin" type="text" id="prioridad" name="prioridad" value="<?php if ($edit) echo ($getThis["prioridad"]); ?>" />
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Respuesta</label>
                                <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if ($edit) echo ($getThis["nombre"]); ?>" />
                            </div>
                            <?php if ($tipo == 1) { ?>
                                <div class="col-md-4">
                                    <label class="control-label">Correcta</label>
                                    <select class="form-control form-group-margin" id="correcta" name="correcta">
                                        <option value="0" <?php if ($edit && $getThis["correcta"] == 0) echo "selected"; ?>>No</option>
                                        <option value="1" <?php if ($edit && $getThis["correcta"] == 1) echo "selected"; ?>>Si</option>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="row mb20">
                            <div class="col-md-4">
                                <label class="control-label">Estado</label>
                                <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                    <option value="0" <?php if ($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                    <option value="1" <?php if ($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
                                </select>
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