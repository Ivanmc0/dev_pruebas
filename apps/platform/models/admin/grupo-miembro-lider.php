<?php require_once ('../../appInit.php');

    // Debug::Mostrar($_POST);

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        // Debug::Mostrar( $_POST, 1);

        if($_POST['es_lider'] == '') MsgError('Error de tipo de miembro', 1);

        if($registro = $_ZOOM->update_data_array(["es_lider" => $_POST['es_lider']], 'grw_grupos_miembros', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>