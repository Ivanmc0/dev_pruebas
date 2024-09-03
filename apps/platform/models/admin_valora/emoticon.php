<?php require_once ('../../appInit.php');

  

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe darle un nombre a la emoción', 1);
        if($_POST['id_icono'] == 0) MsgError('Debe seleccionar un color de fondo para la nota', 1);

        $data = [
            'inactivo'      => $_POST['inactivo'],
            'nombre'        => $_POST['nombre'],
            'id_valoracion' => $_POST['v'],
            'id_evento'     => $_POST['e'],
            'id_icono'      => $_POST['id_icono'],
            'id_empresa'    => $_SESSION['COMPANY']['id'],
        ];

        



        if($registro = $_ZOOM->insert_data_array($data, 'grw_val_eventos_emoticons')){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>