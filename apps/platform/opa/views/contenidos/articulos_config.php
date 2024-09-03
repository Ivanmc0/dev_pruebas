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
                    <input type="hidden" id="carpeta" name="carpeta" value="articulos/" />
                </div>
                <div class="card-body">
                    <div class="row mb20">
                        <div class="col-md-3">
                            <label class="control-label">Visibilidad</label>
                            <select class="form-control form-group-margin" id="visible" name="visible">
                                <option value="0" <?php if($edit && $getThis["visible"] == 0) echo "selected"; ?>>Borrador</option>
                                <option value="1" <?php if($edit && $getThis["visible"] == 1) echo "selected"; ?>>Público</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Categoría</label>
                            <select class="form-control form-group-margin" id="id_categoria" name="id_categoria">
                                <option value="0">Ninguno</option>
                                <?php
                                    $getCategorias = $_TUCOACH->get_data("web_contenidos_categorias_articulos", " AND id_proyecto = ".$proj." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
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
                            <label class="control-label">Galería de fotos asociada</label>
                            <select class="form-control form-group-margin" id="id_galeria" name="id_galeria">
                                <option value="0">Ninguno</option>
                                <?php
                                    $getGalerias = $_TUCOACH->get_data("web_contenidos_galerias", " AND id_proyecto = ".$proj." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
                                    if($getGalerias){
                                        foreach($getGalerias AS $getGal){
                                ?>
                                            <option value="<?= ($getGal["id"]); ?>" <?php if(($edit && $getThis["id_galeria"] == $getGal["id"])) echo "selected"; ?>><?= ($getGal["nombre"]); ?></option>
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
                        <div class="col-md-6">
                            <label class="control-label">Nombre</label>
                            <input class="form-control form-group-margin" type="text" id="nombre" name="nombre" value="<?php if($edit) echo ($getThis["nombre"]); ?>" />
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">URL para SEO</label>
                            <input class="form-control form-group-margin" type="text" id="seo" name="seo" value="<?php if($edit) echo ($getThis["seo"]); ?>" />
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-12">
                            <label class="control-label">Resumen</label>
                            <input class="form-control form-group-margin" type="text" id="resumen" name="resumen" value="<?php if($edit) echo ($getThis["resumen"]); ?>" />
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-12">
                            <label class="control-label">Video (Solo URL de inserción de YouTube o Vimeo)</label>
                            <input class="form-control form-group-margin" type="text" id="video" name="video" value='<?php if($edit) echo (htmlspecialchars_decode($getThis["video"])); ?>' />
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-12 col-md-12">
                            <label class="control-label">Escriba el artículo</label>
                            <div id="contenido"><?= (htmlspecialchars_decode($getThis["contenido"])); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Los siguientes datos son requeridos solo si es un evento</h4>
                </div>
                <div class="card-body">
                    <div class="row mb20">
                        <div class="col-md-4">
                            <label class="control-label">Lugar del evento</label>
                            <input class="form-control form-group-margin" type="text" id="lugar_evento" name="lugar_evento" value="<?php if($edit) echo ($getThis["lugar_evento"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Precio del evento</label>
                            <input class="form-control form-group-margin" type="text" id="precio_evento" name="precio_evento" value="<?php if($edit) echo ($getThis["precio_evento"]); ?>" />
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Fecha del evento</label>
                            <input class="form-control form-group-margin" type="date" id="fecha_evento" name="fecha_evento" value="<?php if($edit) echo ($getThis["fecha_evento"]); ?>" />
                        </div>
                    </div>
                    <div class="row mb20">
                        <div class="col-md-4">
                            <label class="control-label">Hora del evento</label>
                            <input class="form-control form-group-margin" type="time" id="hora_evento" name="hora_evento" value="<?php if($edit) echo ($getThis["hora_evento"]); ?>" />
                        </div>
                        <div class="col-md-8">
                            <label class="control-label">Hora detallada del evento</label>
                            <input class="form-control form-group-margin" type="text" id="detalles_evento" name="detalles_evento" value="<?php if($edit) echo ($getThis["detalles_evento"]); ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="rtn-formion-alt" class="taC mb20"></div>

        <div class="text-center">
            <button class="btn btn-outline-primary" type="button" onClick="history.go(-1); return false;"><i class="la la-arrow-left t14"></i> &nbsp; Volver</button>
            <button class="btn btn-primary" onclick="Zoom.createArticle()"><i class="la la-save t14"></i> &nbsp; Guardar información</button>
        </div>

        <div class="h50"></div>

    </form>

</div>

<?php
        }else echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>';
    } else echo '<div class="card-title t30 taC p50">Ud no pesee permisos para acceder a esta zona</div>';
?>