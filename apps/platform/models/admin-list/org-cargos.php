<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once ('../../appInit.php');

    $AddToQuery  = '';
    if(isset($_REQUEST['father'])){ $AddToQuery  = " AND id_organigrama = ".$_REQUEST['father']; }

 
    $listado = $_GROWI->GET('COMPANY', 'GetCargos', $AddToQuery , ['empresa' => 'CARGOS.id_empresa'], $ReturnRecord = false);

    if($listado === 0) $listado = [];


    echo json_encode($listado); 