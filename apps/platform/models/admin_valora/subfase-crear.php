<?php require_once ('../../appInit.php');

    

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre de la Fase', 1);

        $data = [
            'inactivo'   => 0,
            'orden'      => 1,
            'nombre'     => $_POST['nombre'],
            'id_fase'    => $_POST['id_fase'],
            'id_empresa' => $_SESSION['COMPANY']['id'],
        ];


        if($registro = $_ZOOM->insert_data_array($data, 'grw_val_subfases')){

            echo 1;

        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>