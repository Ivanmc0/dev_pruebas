<?php require_once ('../../appInit.php');

  

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre', 1);
        if($_POST['email'] == '') MsgError('Debe indicar el email', 1);

        $data = [
            'inactivo' => $_POST['inactivo'],
            'nombre'   => $_POST['nombre'],
            'email'    => $_POST['email'],
            'celular'  => $_POST['celular'],
            'empresa'  => $_POST['empresa'],
            'cargo'    => $_POST['cargo'],
        ];

        if($registro = $_ZOOM->update_data_array($data, 'grw_val_listasexternas_registros', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>