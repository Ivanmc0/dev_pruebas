<div class="taC">

    <?php
        if($access_model["id_modulo"] != ""){
            $botones = $_TUCOACH->get_models(" AND model.id_modulo = ".$access_model["id"]." AND id_rol = $rol AND (tipo = 2 || tipo = 3)  ORDER BY model.orden ASC", 1);
            if($botones){
                echo '<div class="btn-group" role="group" aria-label="Basic example">';
                foreach($botones AS $boton){
                    if($_TUCOACH->permission($rol, $boton["id"])){
                        if($boton["tipo"] == 2) echo '<a href="'.($roution.$boton["directorio"].'/'.$boton["cody"].'_'.$listado["id"].'.zoom').'" class="btn btn-outline-blue-grey btn-sm" title="'.($boton["modulo"]).'"><i class="'.($boton["icono"]).' t16"></i></a>';
                        if($boton["tipo"] == 3) echo '<a href="#" onClick="Zoom.changeDelete(\''.$access_model["tabla"].'\', '.$listado["id"].')" class="btn btn-outline-danger btn-sm" title="'.($boton["modulo"]).'"><i class="'.($boton["icono"]).' t16"></i></a>';
                    }
                }
                echo '</div>';
            }
        }
    ?>

</div>