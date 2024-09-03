<?php
    require_once('../../../../class/classCampai.php');
    $_CAMPAI = new Campai();

    $edit = false;
    if($id != 0) $edit = true;
    if($edit){
        $getThis = $_CAMPAI->get_data("presentaciones", " AND id_presentacion = ".$id." ORDER BY id_presentacion DESC ", 0);
        if($getThis) $edit = true; else $edit = 2;
    }
    if($edit === 2){
        echo '<div class="taC p40 t24">¡No se encontró la configuración buscaba!</div>';
    } else {
?>

<div class="content-body">

    <form action="configuraciones/accion-all-campai" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <?php if($edit){ ?>
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
        <?php } ?>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="presentaciones" />
                </div>
                <div class="card-body">

                    <div class="row mb20">
                        <div class="col-md-4">
                            <label class="control-label">Precio</label>
                            <input class="form-control form-group-margin" type="text" id="precio" name="precio" value="<?php if($edit) echo ($getThis["precio"]); ?>" />
                        </div><!--
                        <div class="col-md-2">
                            <label class="control-label">Inicio</label>
                            <input class="form-control form-group-margin" type="number" id="inicio" name="inicio" value="<?php if($edit) echo ($getThis["inicio"]); ?>" />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Fin</label>
                            <input class="form-control form-group-margin" type="number" id="fin" name="fin" value="<?php if($edit) echo ($getThis["fin"]); ?>" />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Saltos</label>
                            <input class="form-control form-group-margin" type="number" id="saltos" name="saltos" value="<?php if($edit) echo ($getThis["saltos"]); ?>" />
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Estado</label>
                            <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                <option value="0" <?php if($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                <option value="1" <?php if($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
                            </select>
                        </div>-->
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



