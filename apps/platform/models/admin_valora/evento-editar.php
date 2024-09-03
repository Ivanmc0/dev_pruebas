<?php require_once ('../../appInit.php');

 

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe darle un nombre a la investigación', 1);
        if($_POST['id_arquetipo'] == 0) MsgError('Debe seleccionar un arquetipo', 1);

        $data = [
            'inactivo'     => $_POST['inactivo'],
            'nombre'       => $_POST['nombre'],
            'descripcion'  => $_POST['descripcion'],
            'id_arquetipo' => $_POST['id_arquetipo'],
        ];


        if($registro = $_ZOOM->update_data_array($data, 'grw_val_eventos', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>