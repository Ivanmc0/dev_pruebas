<?php

    header('Content-Type: application/json; charset=utf-8');
    require_once ('../../appInit.php');


    $AddToQuery = '';
    if(isset($_REQUEST['father'])){ $AddToQuery = " AND TRABAJ.id_grupo = ".$_REQUEST['father']." ORDER BY TRABAJ.es_lider DESC, USERS.inactivo ASC, USERS.nombre ASC "; }


    $listado = $_GROWI->GET('COMPANY', 'GetGruposCorporativosIntegrantes', $AddToQuery, ['empresa' => 'TRABAJ.id_empresa'], $ReturnRecord = false);

    if($listado === 0) $listado = [];


    echo json_encode($listado);