<?php require_once ('../../appInit.php');

    

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre', 1);

        $data = [
            'inactivo'       => $_POST['inactivo'],
            'nombre'         => $_POST['nombre'],
            'id_parametro' => $_POST['id_parametro'],
            'id_empresa'     => $_SESSION['COMPANY']['id'],
        ];


        if($registro = $_ZOOM->insert_data_array($data, 'grw_segmentos')){
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