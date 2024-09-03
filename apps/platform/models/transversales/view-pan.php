<?php require_once '../../appInit.php';

    $rol       = $_ZOOM->get_data("zoom_roles", " AND uuid = '".$_POST['id']."' AND inactivo = 0 AND eliminado = 0 ", 0);
    $rolesUser = $_PLATFORM->RolesUsuario($_SESSION["WORKER"]['id']);

    if(isset($rol['id']) AND isset($rolesUser[$rol['id']])){

        $_SESSION["ADMIN"] = $rolesUser[$rol['id']];

        echo '<script>location.href = "'.$_SESSION["COMPANY"]["GROWI"].'panel-control/";</script>';

    }else{

        echo '<script>setTimeout(function() { location.reload(); },  1)</script>';

    }