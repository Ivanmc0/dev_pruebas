<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once ('../../appInit.php');

    $addon = '';
    if(isset($_REQUEST['father'])){ $addon = " AND id_parametro = ".$_REQUEST['father']; }
    
    $AddToQuery = " AND PARAMETROS.id = " . $_REQUEST['father'];
    $listado = $_GROWI->GET('LELE', 'GetSegmento', $AddToQuery , ['empresa' => 'OPCIONES.id_empresa'], $ReturnRecord = false);

    if($listado === 0) $listado = [];


    echo json_encode($listado);