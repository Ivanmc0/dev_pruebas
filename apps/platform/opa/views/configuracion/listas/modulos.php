<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th>Módulo</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($models AS $model){ ?>
            <tr id="tr-<?= $model["id"]; ?>">
                <td>
                    <div class="fR color"><i class="<?= ($model["icono"]); ?> primary t24"></i></div>
                    <?= ($model["modulo"]); ?>
                    <br><small>Orden: <?= ($model["orden"]); ?> | </small>
                    <small>ID: <?= ($model["id"]); ?></small>
                    <br><small>Código: <?= ($model["cody"]); ?></small>
                    <br><small>Categoría: <?php $thisCat = $_TUCOACH->get_data("zoom_models_cats", " AND id = ".$model["id_categoria"]." ", 0); if($thisCat) echo ($thisCat["categoria"]); ?></small>
                </td>
                <td width="130" class="taC" style="padding:10px !important;">
                    <?php
                        if($access_model["id_modulo"] != ""){
                            $botones = $_TUCOACH->get_models(" AND model.id_modulo = ".$access_model["id"]." AND id_rol = $rol AND (tipo = 2 || tipo = 3) ", 1);
                            if($botones){
                                echo '<div class="btn-group" role="group" aria-label="Basic example">';
                                foreach($botones AS $boton){
                                    if($_TUCOACH->permission($rol, $boton["id"])){
                                        if($boton["tipo"] == 2) echo '<a href="'.($roution.$boton["directorio"].'/'.$boton["cody"].'_'.$model["id"].'.zoom').'" class="btn btn-outline-primary btn-sm" title="'.($boton["modulo"]).'"><i class="'.($boton["icono"]).' t16"></i></a>';
                                        if($boton["tipo"] == 3) echo '<a href="#" onClick="Zoom.changeDelete(\''.$access_model["tabla"].'\', '.$model["id"].')" class="btn btn-outline-danger btn-sm" title="'.($boton["modulo"]).'"><i class="'.($boton["icono"]).' t16"></i></a>';
                                    }
                                }
                                echo '</div>';
                            }
                        }
                    ?>
                </td>
            </tr>
            <?php $modelsN1 = $_TUCOACH->get_data("zoom_models", " AND id_modulo = ".$model["id"]." AND eliminado = 0 ORDER BY orden ASC ", 1); if($modelsN1){ ?>
            <tr>
                <td colspan="2" style="padding:5px !important;">
                    <?php
                        if($modelsN1) include "modulosN1.php";
                    ?>
                </td>
            </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>