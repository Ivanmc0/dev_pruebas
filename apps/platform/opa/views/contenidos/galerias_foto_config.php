<?php
    $proj = "";
    $edit = false;
    $tablus = $access_model["tabla"];

    if($access_model["tipo"] == 1){
        $proj = $id;
        $edit = false;
    }else if($access_model["tipo"] == 2) {
        $getThis    = $_TUCOACH->get_data($tablus, " AND id = ".$id." ORDER BY id DESC ", 0);
        $proj       = $getThis["id_proyecto"];
        $edit       = true;
    }

    if($edit == false || $getThis){
?>

<div class="content-body">

    <form action="contenidos/accion-fotosonly" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
        <input type="hidden" id="carpeta" name="carpeta" value="galerias/" />

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
                </div>
                <div class="card-body">

                    <div class="row mb20">
                        <div class="col-md-3">
                            <label class="control-label">Prioridad</label>
                            <input class="form-control form-group-margin" type="text" id="prioridad" name="prioridad" value="<?php if($edit) echo ($getThis["prioridad"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Estado</label>
                            <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                <option value="0" <?php if($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                <option value="1" <?php if($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center mb20">
                        <div class="col-md-3">
                            <?php
                                if($getThis["imagen"] != "")    $thisImagen = $rutaStatic.'galerias/s/'.($getThis["imagen"]);
                                else                            $thisImagen = $sinImagen;
                            ?>
                            <img src="<?= $thisImagen; ?>" class="w100" />
                        </div>
                        <div class="col-md-9">
                            <label class="control-label">Imagen</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagen" name="imagen">
                                <label class="custom-file-label" for="imagen" aria-describedby="inputGroupFileAddon02">Seleccione una imagen</label>
                            </div>
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

<?php
    }else echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>';
?>