<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once ('../../appInit.php');

    $listado = $_ZOOM->get_data( "grw_val_valoraciones", " AND id_empresa = ".$_SESSION['COMPANY']['id']." AND eliminado = 0 ORDER BY inactivo ASC, nombre ASC ", 1);

    if($listado === 0) $listado = [];

    foreach ($listado as $key => $list) {
        $listado[$key]['tipo'] = $list['id_tipo'] == 1 ? 'Journey' : 'Evento';
    }

    echo json_encode($listado);