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
    <form action="modulos/accion-interactividad" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

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
                            <select class="form-control form-group-margin" id="id_modelo" name="id_modelo" <?php if($edit) echo "disabled";?>>
                                <option value="0">Ninguno</option>
                                <?php
                                    $getModelos = $_ZOOM->get_data("olc_modelos", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if ($getModelos) {
                                        foreach ($getModelos as $getModelo) {
                                ?>
                                            <option value="<?= ($getModelo["id"]); ?>" <?php if (($edit && $getThis["id_modelo"] == $getModelo["id"])) echo "selected"; ?>><?= ($getModelo["nombre"]); ?></option>
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
                                            <option value="<?= ($getModeloTipo["id"]); ?>" <?php if (($edit && $getThis["id_tipo"] == $getModeloTipo["id"])) echo "selected"; ?>>
                                                <?= ($getModeloTipo["nombre"]); ?>
                                            </option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Orden</label>
                            <input class="form-control form-group-margin" type="text" id="prioridad" name="prioridad" value="<?php if ($edit) echo ($getThis["prioridad"]); ?>" />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Estado</label>
                            <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                <option value="0" <?php if ($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                <option value="1" <?php if ($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-12">
                            <label class="control-label">Introducción</label>
                            <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if ($edit) echo ($getThis["nombre"]); ?>" />
                        </div>
                    </div>

                    <div class="b_reconocimientos  <?php if (($edit && $getThis["id_modelo"] == 2)) echo "dB"; else echo "dN"; ?>">
                        <div class="row mb20">
                            <div class="col-md-3">
                                <label class="control-label">
                                    Máximo de personas
                                    <small>| Indique cero (0) para ilimitado</small>
                                </label>
                                <input class="form-control form-group-margin" type="text" id="re_limite_personas" name="re_limite_personas" value="<?php if ($edit) echo ($getThis["re_limite_personas"]); else echo 0; ?>" />
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">
                                    Máximo de reconocimientos
                                    <small>| Indique cero (0) para ilimitado</small>
                                </label>
                                <input class="form-control form-group-margin" type="text" id="re_limite_reconocimientos" name="re_limite_reconocimientos" value="<?php if ($edit) echo ($getThis["re_limite_reconocimientos"]); else echo 0; ?>" />
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">
                                    Máximo de reconocimientos por persona
                                    <small>| Indique cero (0) para ilimitado</small>
                                </label>
                                <input class="form-control form-group-margin" type="text" id="re_limite_reconocimientos_persona" name="re_limite_reconocimientos_persona" value="<?php if ($edit) echo ($getThis["re_limite_reconocimientos_persona"]); else echo 0; ?>" />
                            </div>
                            <div class="col-md-3">
                                <label class="control-label">Fecha límite de ajuste</label>
                                <input class="form-control form-group-margin" type="datetime-local" id="re_fecha_cierre" name="re_fecha_cierre" value="<?php if ($edit) echo ($getThis["re_fecha_cierre"]); ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="b_campanas  <?php if (($edit && $getThis["id_modelo"] == 3)) echo "dB"; else echo "dN"; ?>">
                        <div class="row mb20">
                            <div class="col-md-3">
                                <label class="control-label">Fecha límite de ajuste</label>
                                <input class="form-control form-group-margin" type="datetime-local" id="ca_fecha_cierre" name="ca_fecha_cierre" value="<?php if ($edit) echo ($getThis["ca_fecha_cierre"]); ?>" />
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