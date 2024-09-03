<?php
    $edit = false;
    if($id != 0) $edit = true;
    if($edit){
        $getThis = $_TUCOACH->get_data("zoom_models", " AND id = ".$id." ORDER BY id DESC ", 0);
        if($getThis) $edit = true; else $edit = 2;
    }
    if($edit === 2){
        echo '<div class="taC p40 t24">¡No se encontró la configuración buscaba!</div>';
    } else {
?>

<div class="content-body">

    <form action="configuraciones/accion-funciones" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

        <?php if($edit){ ?>
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
        <?php } ?>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                </div>
                <div class="card-body">

                    <div class="row mb20">
                        <div class="col-md-4">
                            <label class="control-label">Nombre del Módulo</label>
                            <input class="form-control form-group-margin" type="text" id="modulo" name="modulo" value="<?php if($edit) echo ($getThis["modulo"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Icono <a href="https://themewagon.github.io/Ready-Bootstrap-Dashboard/icons.html" target="_blank" class="t10">Ver iconos</a></label>
                            <input class="form-control form-group-margin" type="text" id="icono" name="icono" value="<?php if($edit) echo ($getThis["icono"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Tipo</label>
                            <select class="form-control form-group-margin" id="tipo" name="tipo">
                                <option value="0" <?php if($edit && $getThis["tipo"] == 0) echo "selected"; ?>>Menú</option>
                                <option value="1" <?php if($edit && $getThis["tipo"] == 1) echo "selected"; ?>>Crear</option>
                                <option value="2" <?php if($edit && $getThis["tipo"] == 2) echo "selected"; ?>>Editar</option>
                                <option value="3" <?php if($edit && $getThis["tipo"] == 3) echo "selected"; ?>>Eliminar</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Orden</label>
                            <input class="form-control form-group-margin" type="number" id="orden" name="orden" value="<?php if($edit) echo ($getThis["orden"]); ?>" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label class="control-label">Código de acceso / URL</label>
                            <input class="form-control form-group-margin" type="text" id="cody" name="cody" value="<?php if($edit) echo ($getThis["cody"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Directorio</label>
                            <input class="form-control form-group-margin" type="text" id="directorio" name="directorio" value="<?php if($edit) echo ($getThis["directorio"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">DB Tabla</label>
                            <input class="form-control form-group-margin" type="text" id="tabla" name="tabla" value="<?php if($edit) echo ($getThis["tabla"]); ?>" />
                        </div>
                        <div class="col-md-2">
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

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-header">
                            <h4 class="card-title">Si solo si esta función es <strong>tipo Menú Nivel 1</strong></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <label class="control-label">Categoría del Menú</label>
                                    <select class="form-control form-group-margin" id="id_categoria" name="id_categoria">
                                        <option value="0" <?php if($edit && $getThis["id_categoria"] == 0) echo "selected"; ?>>Ninguna</option>
                                        <?php
                                            $getCats = $_TUCOACH->get_data("zoom_models_cats", " AND inactivo = 0 AND eliminado = 0 ORDER BY orden DESC ", 1);
                                            if($getCats){
                                                foreach($getCats AS $getCat){
                                        ?>
                                                    <option value="<?= ($getCat["id"]); ?>" <?php if($edit && $getThis["id_categoria"] == $getCat["id"]) echo "selected"; ?>><?= ($getCat["categoria"]); ?></option>
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
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-header">
                            <h4 class="card-title">Si solo si esta función tiene <strong>un padre</strong></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <label class="control-label">Pertenece a:</label>
                                    <select class="form-control form-group-margin" id="id_modulo" name="id_modulo">
                                        <option value="0" <?php if($edit && $getThis["id_modulo"] == 0) echo "selected"; ?>>Ninguno</option>
                                        <?php
                                            $getMods = $_TUCOACH->get_data("zoom_models", " AND id_modulo = 0 AND inactivo = 0 AND eliminado = 0 ORDER BY orden ASC ", 1);
                                            if($getMods){
                                                foreach($getMods AS $getMod){
                                                    if($edit && $getThis["id_modulo"] == $getMod["id"]) $sely = "selected"; else $sely = "";
                                                    echo '<option value="'.($getMod["id"]).'" '.$sely.'>'.($getMod["modulo"]).' (N1)</option>';
                                                    $getModsN1 = $_TUCOACH->get_data("zoom_models", " AND id_modulo = ".$getMod["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY orden ASC ", 1);
                                                    if($getModsN1){
                                                        foreach($getModsN1 AS $getModN1){
                                                            if($edit && $getThis["id_modulo"] == $getModN1["id"]) $sely = "selected"; else $sely = "";
                                                            echo '<option value="'.($getModN1["id"]).'" '.$sely.'> -- '.($getModN1["modulo"]).' (N2)</option>';
                                                            $getModsN2 = $_TUCOACH->get_data("zoom_models", " AND id_modulo = ".$getModN1["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY orden ASC ", 1);
                                                            if($getModsN2){
                                                                foreach($getModsN2 AS $getModN2){
                                                                    if($edit && $getThis["id_modulo"] == $getModN2["id"]) $sely = "selected"; else $sely = "";
                                                                    echo '<option value="'.($getModN2["id"]).'" '.$sely.'> --- --- '.($getModN2["modulo"]).' (N3)</option>';
                                                                    $getModsN3 = $_TUCOACH->get_data("zoom_models", " AND id_modulo = ".$getModN2["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY orden ASC ", 1);
                                                                    if($getModsN3){
                                                                        foreach($getModsN3 AS $getModN3){
                                                                            if($edit && $getThis["id_modulo"] == $getModN3["id"]) $sely = "selected"; else $sely = "";
                                                                            echo '<option value="'.($getModN3["id"]).'" '.$sely.'> ---- ---- '.($getModN3["modulo"]).' (N4)</option>';
                                                                            $getModsN4 = $_TUCOACH->get_data("zoom_models", " AND id_modulo = ".$getModN3["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY orden ASC ", 1);
                                                                            if($getModsN4){
                                                                                foreach($getModsN4 AS $getModN4){
                                                                                    if($edit && $getThis["id_modulo"] == $getModN4["id"]) $sely = "selected"; else $sely = "";
                                                                                    echo '<option value="'.($getModN4["id"]).'" '.$sely.'> ----- ----- '.($getModN4["modulo"]).' (N5)</option>';
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-header">
                            <h4 class="card-title">Si solo si esta función tiene <strong>una vista</strong></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <label class="control-label">Archivo</label>
                                    <input class="form-control form-group-margin" type="text" id="archivo" name="archivo" value="<?php if($edit) echo ($getThis["archivo"]); ?>" />
                                </div>
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

<?php } ?>



