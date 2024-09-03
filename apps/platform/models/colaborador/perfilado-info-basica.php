<?php require_once ('../../appInit.php');



    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombres'] == '') MsgError('Debe indicar el nombre', 1);
        if($_POST['apellidos'] == '') MsgError('Debe indicar el apellido', 1);
        if($_POST['identificacion_tipo'] == '') MsgError('Debe indicar el tipo de su identificación', 1);
        if($_POST['identificacion'] == '') MsgError('Debe indicar su número de  identificación', 1);

        $data = [
            'nombres'             => $_POST['nombres'],
            'apellidos'           => $_POST['apellidos'],
            'nombre'              => $_POST['nombres']." ".$_POST['apellidos'],
            'identificacion_tipo' => $_POST['identificacion_tipo'],
            'identificacion'      => $_POST['identificacion'],
            'celular'             => $_POST['celular'],
            'telefono'            => $_POST['telefono']
        ];


        if($registro = $_ZOOM->update_data_array($data, 'zoom_users', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>