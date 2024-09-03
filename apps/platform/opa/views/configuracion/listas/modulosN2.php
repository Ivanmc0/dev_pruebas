<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <tbody>
            <?php foreach($modelsN2 AS $modelN2){ ?>
            <tr id="tr-<?= $modelN2["id"]; ?>">
                <td class="vM" width="125">
                    <i class="la la-angle-double-right t30 primary"></i>
                    <i class="la la-angle-double-right t30 primary"></i>
                </td>
                <td style="padding:10px !important;">
                    <div class="fR"><i class="<?= ($modelN2["icono"]); ?> primary t20"></i></div>
                    <?= ($modelN2["modulo"]); ?>
                    <br><small>Orden: <?= ($modelN2["orden"]); ?> | </small>
                    <small>ID: <?= ($modelN2["id"]); ?></small>
                    <br><small>Código: <?= ($modelN2["cody"]); ?></small>
                </td>
                <td width="118" style="padding:10px !important;">
                    <div class="taC">
                        <?php
                            if($access_model["id_modulo"] != ""){
                                $botones = $_TUCOACH->get_models(" AND model.id_modulo = ".$access_model["id"]." AND id_rol = $rol AND (tipo = 2 || tipo = 3) ", 1);
                                if($botones){
                                    echo '<div class="btn-group" role="group" aria-label="Basic example">';
                                    foreach($botones AS $boton){
                                        if($_TUCOACH->permission($rol, $boton["id"])){
                                            if($boton["tipo"] == 2) echo '<a href="'.($roution.$boton["directorio"].'/'.$boton["cody"].'_'.$modelN2["id"].'.zoom').'" class="btn btn-outline-primary btn-sm" title="'.($boton["modulo"]).'"><i class="'.($boton["icono"]).' t16"></i></a>';
                                            if($boton["tipo"] == 3) echo '<a href="#" onClick="Zoom.changeDelete(\''.$access_model["tabla"].'\', '.$modelN2["id"].')" class="btn btn-outline-danger btn-sm" title="'.($boton["modulo"]).'"><i class="'.($boton["icono"]).' t16"></i></a>';
                                        }
                                    }
                                    echo '</div>';
                                }
                            }
                        ?>
                    </div>
                </td>
            </tr>
            <?php $modelsN3 = $_TUCOACH->get_data("zoom_models", " AND id_modulo = ".$modelN2["id"]." AND eliminado = 0 ORDER BY orden ASC ", 1); if($modelsN3){ ?>
            <tr>
                <td colspan="3" style="padding:5px !important;">
                    <?php
                        if($modelsN3) include "modulosN3.php";
                    ?>
                </td>
            </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>