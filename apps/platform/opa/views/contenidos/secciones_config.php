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

    $progresa = $_TUCOACH->get_projects(" AND relrol.id_proyecto = ".$proj." AND relrol.id_rol = ".$_SESSION["zoom_rol"]." ", 0);
    if($progresa) {
        if($edit == false || $getThis){
?>



<div class="content-body">

    <form id="formion" name="formion" class="form-horizontal zoom_form">

        <?php if($edit){ ?>
            <input type="hidden" id="id" name="id" value="<?= $id; ?>" />
            <input type="hidden" id="id_proyecto" name="id_proyecto" value="<?= $getThis["id_proyecto"]; ?>" />
        <?php }else{ ?>
            <input type="hidden" id="id" name="id" value="0" />
            <input type="hidden" id="id_proyecto" name="id_proyecto" value="<?= $id; ?>" />
        <?php } ?>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Ingrese los datos para <?= ($access_model["modulo"]); ?></h4>
                    <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
                    <input type="hidden" id="carpeta" name="carpeta" value="secciones/" />
                </div>
                <div class="card-body">
                    <div class="row mb20">
                        <div class="col-md-3">
                            <label class="control-label">Zona / Página</label>
                            <select class="form-control form-group-margin" id="id_categoria" name="id_categoria">
                                <option value="0">Ninguno</option>
                                <?php
                                    $getCategorias = $_TUCOACH->get_data("contenidos_categorias_secciones", " AND id_proyecto = ".$proj." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getCategorias){
                                        foreach($getCategorias AS $getCategoria){
                                ?>
                                            <option value="<?= ($getCategoria["id"]); ?>" <?php if(($edit && $getThis["id_categoria"] == $getCategoria["id"])) echo "selected"; ?>><?= ($getCategoria["nombre"]); ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Estado</label>
                            <select class="form-control form-group-margin" id="inactivo" name="inactivo">
                                <option value="0" <?php if($edit && $getThis["inactivo"] == 0) echo "selected"; ?>>Activo</option>
                                <option value="1" <?php if($edit && $getThis["inactivo"] == 1) echo "selected"; ?>>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb30">
                        <div class="col-md-9">
                            <label class="control-label">Título 1</label>
                            <input class="form-control form-group-margin" type="text" id="titulo1" name="titulo1" value="<?php if($edit) echo ($getThis["titulo1"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">URL 1</label>
                            <input class="form-control form-group-margin" type="text" id="url1" name="url1" value="<?php if($edit) echo ($getThis["url1"]); ?>" />
                        </div>
                    </div>
                    <div class="row mb30">
                        <div class="col-md-9">
                            <label class="control-label">Título 2</label>
                            <input class="form-control form-group-margin" type="text" id="titulo2" name="titulo2" value="<?php if($edit) echo ($getThis["titulo2"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">URL 2</label>
                            <input class="form-control form-group-margin" type="text" id="url2" name="url2" value="<?php if($edit) echo ($getThis["url2"]); ?>" />
                        </div>
                    </div>
                    <div class="row mb30">
                        <div class="col-md-9">
                            <label class="control-label">Título 3</label>
                            <input class="form-control form-group-margin" type="text" id="titulo3" name="titulo3" value="<?php if($edit) echo ($getThis["titulo3"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">URL 3</label>
                            <input class="form-control form-group-margin" type="text" id="url3" name="url3" value="<?php if($edit) echo ($getThis["url3"]); ?>" />
                        </div>
                    </div>
                    <div class="row mb30">
                        <div class="col-md-9">
                            <label class="control-label">Título 4</label>
                            <input class="form-control form-group-margin" type="text" id="titulo4" name="titulo4" value="<?php if($edit) echo ($getThis["titulo4"]); ?>" />
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">URL 4</label>
                            <input class="form-control form-group-margin" type="text" id="url4" name="url4" value="<?php if($edit) echo ($getThis["url4"]); ?>" />
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-12 col-md-6">
                            <label class="control-label">Texto 1</label>
                            <div id="texto1"><?= (htmlspecialchars_decode($getThis["texto1"])); ?></div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="control-label">Texto 2</label>
                            <div id="texto2"><?= (htmlspecialchars_decode($getThis["texto2"])); ?></div>
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-12 col-md-6">
                            <label class="control-label">Texto 3</label>
                            <div id="texto3"><?= (htmlspecialchars_decode($getThis["texto3"])); ?></div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="control-label">Texto 4</label>
                            <div id="texto4"><?= (htmlspecialchars_decode($getThis["texto4"])); ?></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div id="rtn-formion-alt" class="taC mb20"></div>

        <div class="text-center">
            <button class="btn btn-outline-primary" type="button" onClick="history.go(-1); return false;"><i class="la la-arrow-left t14"></i> &nbsp; Volver</button>
            <button class="btn btn-primary" onclick="Zoom.createSection()"><i class="la la-save t14"></i> &nbsp; Guardar información</button>
        </div>

        <div class="h50"></div>

    </form>

</div>

<?php
        }else echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>';
    } else echo '<div class="card-title t30 taC p50">Ud no pesee permisos para acceder a esta zona</div>';
?>