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

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-header">
                <h4 class="card-title">Asignación de <strong>Zonas y Funciones</strong> al Rol: <strong><?= ($getThis["rol"]); ?></strong></h4>
                <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
            </div>
            <div class="card-body">
                <div class="row mb20">
                    <div class="col-md-2dot4 mb20">
                        <?php


                            foreach (explode(",", $getThis["apps"]) as $key => $value) {
                                if(!isset($addon)) $addon = " AND ( $value = 1 ";
                                else $addon .= " OR $value = 1 ";
                            }
                            $addon .= " ) ";



                    if($cats = $_TUCOACH->get_data("zoom_models_cats", " AND eliminado = 0 ORDER BY orden ASC ", 1)){
                        foreach ($cats as $cat) {

                            if($models = $_TUCOACH->get_data("zoom_models", $addon." AND id_categoria = ".$cat["id"]." AND id_modulo = 0 AND inactivo = 0 AND eliminado = 0 ORDER BY orden ASC ", 1)){
                                echo '<div class="pAA10">';
                                echo '<div class="bg-blue-grey colorfff p510 mb5">'.$cat["categoria"].'</div>';
                                foreach($models AS $model){
                                    $relrol = $_TUCOACH->get_data("zoom__models__roles", " AND id_modulo = ".$model["id"]." AND id_rol = ".$getThis["id"]." AND eliminado = 0 ORDER BY id DESC ", 0);
                        ?>
                                    <div class="tab bS1 bCeee" style="margin-bottom:-1px;">
                                        <div class="tabIn p10 cP rHover1 nivel-1 mod-<?= $model['id']; ?>" onclick="Zoom.getChildren(1, <?= $model['id']; ?>, <?= $getThis['id']; ?>)"><i class="<?= ($model["icono"]); ?> blue-grey"></i> &nbsp;<?= ($model["modulo"]); ?></div>
                                        <div class="tabIn bLS1 cP rHover2 w40x taC modicon-<?= $model['id']; ?>" onclick="Zoom.assignModels(<?= $model['id']; ?>, <?= $getThis['id']; ?>)">
                                            <?php if($relrol && $relrol["inactivo"] == 0){ ?>
                                                <i class="la la-check success"></i>
                                            <?php }else{ ?>
                                                <i class="la la-close danger"></i>
                                            <?php } ?>
                                        </div>
                                    </div>
                        <?php
                                }
                                echo '</div>';

                            }
                        }
                    }
                        ?>
                    </div>
                    <div class="col-md-2dot4 mb20">
                        <div id="list-2"></div>
                    </div>
                    <div class="col-md-2dot4 mb20">
                        <div id="list-3"></div>
                    </div>
                    <div class="col-md-2dot4 mb20">
                        <div id="list-4"></div>
                    </div>
                    <div class="col-md-2dot4 mb20">
                        <div id="list-5"></div>
                    </div>
                    <div class="col-md-2dot4 mb20">
                        <div id="list-6"></div>
                    </div>
                    <div class="col-md-2dot4 mb20">
                        <div id="list-7"></div>
                    </div>
                    <div class="col-md-2dot4 mb20">
                        <div id="list-8"></div>
                    </div>
                    <div class="col-md-2dot4 mb20">
                        <div id="list-9"></div>
                    </div>
                    <div class="col-md-2dot4 mb20">
                        <div id="list-10"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-header">
                <h4 class="card-title">Asignación de <strong>Proyectos</strong> al Rol: <strong><?= ($getThis["rol"]); ?></strong></h4>
                <input type="hidden" id="tabla" name="tabla" value="<?= $tablus; ?>" />
            </div>
            <div class="card-body">
                <div class="row mb20">
                    <div class="col-12">
                        <?php
                            $projects = $_TUCOACH->get_data("zoom_projects", " AND inactivo = 0 AND eliminado = 0 ORDER BY proyecto ASC ", 1);
                            if($projects){
                                foreach($projects AS $project){
                                    $relrolProj = $_TUCOACH->get_data("zoom__project__roles", " AND id_proyecto = ".$project["id"]." AND id_rol = ".$getThis["id"]." AND eliminado = 0 ORDER BY id DESC ", 0);
                        ?>
                                    <div class="tab bS1 bCeee" style="margin-bottom:-1px;">
                                        <div class="tabIn p10"><?= ($project["proyecto"]); ?></div>
                                        <div class="tabIn bLS1 cP rHover2 w40x taC proicon-<?= $project['id']; ?>" onclick="Zoom.assignProjects(<?= $project['id']; ?>, <?= $getThis['id']; ?>)">
                                            <?php if($relrolProj && $relrolProj["inactivo"] == 0){ ?>
                                                <i class="la la-check success"></i>
                                            <?php }else{ ?>
                                                <i class="la la-close danger"></i>
                                            <?php } ?>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <button class="btn btn-outline-blue-grey" type="button" onClick="history.go(-1); return false;"><i class="la la-arrow-left t14"></i> &nbsp; Volver</button>
    </div>
    <div class="h50"></div>

</div>

<?php } ?>