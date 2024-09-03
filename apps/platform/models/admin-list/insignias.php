<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once ('../../appInit.php');

    $listado =  $_GROWI->GET('LELE', 'GetReconocimientos', $AddToQuery = " ORDER BY fecha, inactivo ASC, nombre ASC ", ['empresa' => 'RECONOC.id_empresa'], $ReturnRecord = false);

    if($listado === 0) $listado = [];


    echo json_encode($listado); 