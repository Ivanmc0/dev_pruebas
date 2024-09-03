<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once ('../../appInit.php');

    $listado = $_ZOOM->get_data( "grw_val_listas", " AND id_empresa = ".$_SESSION['COMPANY']['id']." AND interna = 1 AND eliminado = 0 ORDER BY inactivo ASC, nombre ASC ", 1);

    if($listado === 0) $listado = [];

    echo json_encode($listado);