<?php require_once ('../../appInit.php');

   

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar un título para la Interactividad', 1);

        $data = [
            'inactivo'     => $_POST['inactivo'],
            'nombre'       => $_POST['nombre'],
            'prioridad'    => $_POST['prioridad'],
            'id_actividad' => $_POST['id_actividad'],
            'id_modelo'    => $_POST['id_modelo'],
            'id_tipo'      => $_POST['id_tipo'],
            'id_empresa'   => $_SESSION['COMPANY']['id'],
        ];

        if($registro = $_ZOOM->insert_data_array($data, 'grw_lel_dinamicas')){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>