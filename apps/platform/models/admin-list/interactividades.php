<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once ('../../appInit.php');

    $addon = '';
    if(isset($_REQUEST['father'])){ $addon = " AND id_actividad = ".$_REQUEST['father']; }

    $AddToQuery = " AND ACTIVI.id = "  .$_REQUEST['father'];
    $listado = $_GROWI->GET('LELE', 'GetInterActividades', $AddToQuery , ['empresa' => 'ACTIV_MODELOS.id_empresa'], $ReturnRecord = false);

    if($listado === 0) $listado = [];

    echo json_encode($listado);