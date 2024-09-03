<?php require_once ('../../appInit.php');

 

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        $data = [
            'visible'     => $_POST['visible'],
        ];

        if($registro = $_ZOOM->update_data_array($data, 'grw_procesos', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>