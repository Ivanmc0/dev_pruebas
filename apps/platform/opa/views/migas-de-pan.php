<?php

    $ccc = 0;
    if($access_model["id_modulo"] != ""){
        $miga = $_TUCOACH->get_models(" AND model.id = ".$access_model["id_modulo"]." ", 0);
        if($miga){
            $migas[$ccc] = ($miga["modulo"]);
            $ccc++;
            if($miga["id_modulo"] != ""){
                $miga = $_TUCOACH->get_models(" AND model.id = ".$miga["id_modulo"]." ", 0);
                if($miga){
                    $migas[$ccc] = ($miga["modulo"]);
                    $ccc++;
                    if($miga["id_modulo"] != ""){
                        $miga = $_TUCOACH->get_models(" AND model.id = ".$miga["id_modulo"]." ", 0);
                        if($miga){
                            $migas[$ccc] = ($miga["modulo"]);
                            $ccc++;
                            if($miga["id_modulo"] != ""){
                                $miga = $_TUCOACH->get_models(" AND model.id = ".$miga["id_modulo"]." ", 0);
                                if($miga){
                                    $migas[$ccc] = ($miga["modulo"]);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

?>