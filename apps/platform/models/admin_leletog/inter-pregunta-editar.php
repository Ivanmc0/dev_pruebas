<?php require_once ('../../appInit.php');

    

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar una pregunta', 1);
        if($_POST['id_modo'] == 0) MsgError('Debe indicar la modalidad de la pregunta', 1);


        $data = [
            'inactivo'  => $_POST['inactivo'],
            'nombre'    => $_POST['nombre'],
            'prioridad' => $_POST['prioridad'],
            'id_modo'   => $_POST['id_modo'],
        ];


        if($registro = $_ZOOM->update_data_array($data, 'grw_lel_preguntas', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>