<?php
    $tablus         = $access_model["tabla"];
    $edit           = false;
    $getThis        = true;
    if($access_model["tipo"] == 2){
        $getThis    = $_ZOOM->get_data($tablus, " AND id = ".$id." ORDER BY id DESC ", 0);
        $edit       = true;
    }

    if($getThis){
?>

<div class="content-body">
    <form action="modulos/accion-all" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <?php if($edit){ ?>
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
        <?php }else{ ?>
            <input type="hidden" id="id_empresa" name="id_empresa" value="<?= $id; ?>" />
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
                            <label class="control-label">¿Organigrama principal?</label>
                            <select class="form-control form-group-margin" id="activo" name="activo">
                                <option value="0" <?php if($edit && $getThis["activo"] == 0) echo "selected"; ?>>No</option>
                                <option value="1" <?php if($edit && $getThis["activo"] == 1) echo "selected"; ?>>Si</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-8">
                            <label class="control-label">Nombre</label>
                            <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if($edit) echo ($getThis["nombre"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Estado</label>
                            <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                <option value="0" <?php if($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                <option value="1" <?php if($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
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

<?php } else echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>'; ?>