<?php require_once ('../../appInit.php');

    

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['id_rol'] == 0)                               MsgError('Debe seleccionar el rol administrativo que quiere asignar', 1);
        if($_POST['id_user'] == 0)                              MsgError('Debe seleccionar al colaborador a quien quiere asignar un rol administrativo', 1);
        if ( $_WORKERS->AmI_Administrator ( $_POST['id_user']))  MsgError('Ya está registrado como administrador.', 1);

        $data = [
            'id_user'    => $_POST['id_user'],
            'id_rol'     => $_POST['id_rol'],
            'id_empresa' => $_SESSION['COMPANY']['id'],
        ];


        if($registro = $_ZOOM->insert_data_array($data, 'zoom__users__roles')){
            $_COMPANY->NewUpdateHasDatos ( $_SESSION['COMPANY']['id'] );
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>