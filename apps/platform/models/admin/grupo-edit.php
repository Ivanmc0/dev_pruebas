<?php require_once ('../../appInit.php');

    // Debug::Mostrar($_POST);

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nom_grupo'] == '') MsgError('Debe indicar el nombre', 1);

        $data = [
            'inactivo'     => $_POST['inactivo'],
            'nom_grupo'    => $_POST['nom_grupo'],
            'descrp_grupo' => $_POST['descrp_grupo'],
        ];

        if($registro = $_ZOOM->update_data_array($data, 'grw_grupos', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>