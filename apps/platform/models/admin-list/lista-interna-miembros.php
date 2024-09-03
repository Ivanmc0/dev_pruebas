<?php

header('Content-Type: application/json; charset=utf-8');

require_once ('../../appInit.php');

$addon = '';
if(isset($_REQUEST['father'])){ $addon = " AND id_publico_listado = ".$_REQUEST['father']; }

if($listado = $_ZOOM->get_data( "grw_val_listasinternas_registros", $addon." AND eliminado = 0 ORDER BY inactivo ASC, id ASC ", 1)){

    foreach($listado as $key => $dato){
        if($colab = $_GROWI->GET('COMPANY', 'GetColaborators', $AddToQuery = " AND USERS.id = ".$dato["id_trabajador"]."  ORDER BY inactivo ASC, nombre ASC ", ['empresa' => 'USERS.id_empresa'], $ReturnRecord = true) ){
            $listado["$key"]['nombre']         = $colab['nombre_completo'];
            $listado["$key"]['cargo']          = $colab['cargo']['nombre'];
            $listado["$key"]['identificacion'] = $colab['identificacion_completa'];
        }else{
            unset($listado["$key"]);
        }
    }

}

if($listado === 0) $listado = [];

echo json_encode($listado);