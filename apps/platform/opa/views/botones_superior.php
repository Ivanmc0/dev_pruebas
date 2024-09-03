<?php
    if($id != 0) $conPara = "_".$id; else $conPara = "";
    echo '<div class="btn-group" role="group" aria-label="Basic example">';
    if($id != 0) echo '<button class="btn btn-outline-blue-grey btn-sm" type="button" onClick="history.go(-1); return false;"><i class="la la-arrow-left t14"></i> &nbsp; Volver</button>';
    $botones = $_TUCOACH->get_models(" AND model.id_modulo = ".$access_model["id"]." AND id_rol = $rol AND tipo = 1 ", 1);
    if($botones){
        foreach($botones AS $boton){
            if($_TUCOACH->permission($rol, $boton["id"])){
                echo '<a href="'.($roution.$boton["directorio"]."/".$boton["cody"].$conPara.".zoom").'" class="btn btn-blue-grey btn-sm"><i class="'.($boton["icono"]).' t14"></i> '.($boton["modulo"]).'</a>';
            }
        }
    }
    echo '</div>';
?>