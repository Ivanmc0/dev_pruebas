<?php require_once ('../../appInit.php');

  

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe darle un nombre a la investigación', 1);
        if($_POST['id_arquetipo'] == 0) MsgError('Debe seleccionar un arquetipo', 1);

        $data = [
            'inactivo'      => $_POST['inactivo'],
            'nombre'        => $_POST['nombre'],
            'descripcion'   => $_POST['descripcion'],
            'id_valoracion' => $_POST['v'],
            'id_x'          => $_POST['x'],
            'id_y'          => $_POST['y'],
            'id_arquetipo' => $_POST['id_arquetipo'],
            'id_empresa'    => $_SESSION['COMPANY']['id'],
        ];


        if($registro = $_ZOOM->insert_data_array($data, 'grw_val_eventos')){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>