<?php require_once ('../../appInit.php');

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombres'] == '') MsgError('Debe indicar el nombre', 1);
        if($_POST['apellidos'] == '') MsgError('Debe indicar el apellido', 1);
        if($_POST['identificacion_tipo'] == '') MsgError('Debe indicar el tipo de su identificación', 1);
        if($_POST['identificacion'] == '') MsgError('Debe indicar su número de  identificación', 1);
        if($_POST['email'] == '') MsgError('Debe indicar su correo electrónico', 1);
        if ( $_WORKERS->ExistsCompanyEmail ($_POST['email'] )) MsgError('El email corporativo ya existe en nuestros registros.', 1);
        if ( $_WORKERS->ExistsCompanyIdentication ( $_POST['identificacion'], $_SESSION['COMPANY']['id'] )) MsgError('La identificación ya se encuentra registrada en esta empresa', 1);

        $data = [
            'inactivo'            => $_POST['inactivo'],
            // 'trato'               => $_POST['trato'],
            'nombre'              => $_POST['nombres']." ".$_POST['apellidos'],
            'nombres'             => $_POST['nombres'],
            'apellidos'           => $_POST['apellidos'],
            'identificacion_tipo' => $_POST['identificacion_tipo'],
            'identificacion'      => $_POST['identificacion'],
            'email'               => $_POST['email'],
            'celular'             => $_POST['celular'],
            'telefono'            => $_POST['telefono'],
            'id_rol'              => 110,
            'id_empresa'          => $_SESSION['COMPANY']['id'],
        ];


        if($registro = $_ZOOM->insert_data_array($data, 'zoom_users')){
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