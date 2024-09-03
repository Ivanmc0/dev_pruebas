<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once ('../../appInit.php');

    $AddToQuery = '';
    if(isset($_REQUEST['father'])){ $AddToQuery = " AND PREGS.id_dinamica = ".$_REQUEST['father'] . ' ORDER BY PREGS.inactivo ASC, PREGS.prioridad ASC, PREGS.nombre ASC'; }

    $listado = $_GROWI->GET('LELE', 'GetPreguntas', $AddToQuery , ['empresa' => 'PREGS.id_empresa'], $ReturnRecord = false);

    if($listado === 0) $listado = [];

    echo json_encode($listado);