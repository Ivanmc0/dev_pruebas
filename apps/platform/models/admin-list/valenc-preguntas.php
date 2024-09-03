<?php

    header('Content-Type: application/json; charset=utf-8');

    require_once ('../../appInit.php');

    $addon = '';
    if(isset($_REQUEST['father'])){ $addon = " AND id_encuesta = ".$_REQUEST['father']; }

    $listado = $_ZOOM->get_data( "grw_val_preguntas", $addon." AND eliminado = 0 ORDER BY inactivo ASC, prioridad ASC, nombre ASC ", 1);

    if($listado === 0) $listado = [];

    echo json_encode($listado);