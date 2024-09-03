<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once ('../../appInit.php');

    $AddToQuery = '';
    if(isset($_REQUEST['father'])){ $AddToQuery = " AND PRGNTAS.id = ".$_REQUEST['father']; }

     

    $listado = $_GROWI->GET('LELE', 'GetRespuestasLeletog', $AddToQuery  , ['empresa' => 'PRGNTAS.id_empresa'], $ReturnRecord = false);


    if($listado === 0) $listado = [];

    echo json_encode($listado);