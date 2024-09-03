<?php require_once ('../../appInit.php');

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if(!isset($_POST['miembros'])) MsgError('Debe seleccionar al menos un nuevo miembro', 1);

        $data = [
            'inactivo'     => 0,
            'id_empresa'   => $_SESSION['COMPANY']['id'],
            'id_grupo'     => $_POST['id_parametro'],
        ];

        foreach ($_POST['miembros'] as $key => $value) {

            $dataNew = $data;
            $dataNew["id_trabajador"] = $value;

            $_ZOOM->insert_data_array($dataNew, 'grw_grupos_miembros');

        }

        echo 1;

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>