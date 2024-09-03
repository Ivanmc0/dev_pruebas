<?php
 
    header('Content-Type: application/json; charset=utf-8');

    require_once ('../../appInit.php');

    $listado =  $_GROWI->GET('COMPANY', 'GetColaborators', $AddToQuery = " ORDER BY fecha, inactivo ASC, nombre ASC ", ['empresa' => 'USERS.id_empresa'], $ReturnRecord = false);
 

    if($listado === 0) $listado = [];

    echo json_encode($listado); 