<?php require_once ('../../appInit.php');

 

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar el texto de la nota', 1);
        if($_POST['id_color'] == 0) MsgError('Debe seleccionar un color de fondo para la nota', 1);

        $data = [
            'inactivo'      => $_POST['inactivo'],
            'nombre'        => $_POST['nombre'],
            'id_color'      => $_POST['id_color'],
        ];


        if($registro = $_ZOOM->update_data_array($data, 'grw_val_eventos_textos', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>