<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <tbody>
            <?php foreach($modelsN4 AS $modelN4){ ?>
                <tr id="tr-<?= $modelN4["id"]; ?>">
                    <td style="padding:10px !important;">
                        <div class="fR"><i class="<?= ($modelN4["icono"]); ?> primary t18"></i></div>
                        <?= ($modelN4["modulo"]); ?><br>
                        <small>Orden: <?= ($modelN4["orden"]); ?></small>
                    </td>
                    <td width="100" style="padding:10px !important;">
                        <div class="taC">
                            <?php
                                if($access_model["id_modulo"] != ""){
                                    $botones = $_TUCOACH->get_models(" AND model.id_modulo = ".$access_model["id"]." AND id_rol = $rol AND (tipo = 2 || tipo = 3) ", 1);
                                    if($botones){
                                        echo '<div class="btn-group" role="group" aria-label="Basic example">';
                                        foreach($botones AS $boton){
                                            if($_TUCOACH->permission($rol, $boton["id"])){
                                                if($boton["tipo"] == 2) echo '<a href="'.($roution.$boton["directorio"].'/'.$boton["cody"].'_'.$modelN4["id"].'.zoom').'" class="btn btn-outline-primary btn-sm" title="'.($boton["modulo"]).'"><i class="'.($boton["icono"]).' t16"></i></a>';
                                                if($boton["tipo"] == 3) echo '<a href="#" onClick="Zoom.changeDelete(\''.$access_model["tabla"].'\', '.$modelN4["id"].')" class="btn btn-outline-danger btn-sm" title="'.($boton["modulo"]).'"><i class="'.($boton["icono"]).' t16"></i></a>';
                                            }
                                        }
                                        echo '</div>';
                                    }
                                }
                            ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>