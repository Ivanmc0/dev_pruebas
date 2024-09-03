<?php require_once ('../../appInit.php');

   

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre del arquetipo', 1);
        if($_POST['cita'] == '') MsgError('Debe indicar una cita que represente el arquetipo', 1);
        if($_POST['id_color'] == 0) MsgError('Debe seleccionar un color que represente el arquetipo', 1);

        $data = [
            'inactivo' => $_POST['inactivo'],
            'nombre'   => $_POST['nombre'],
            'cita'     => $_POST['cita'],
            'id_color' => $_POST['id_color'],
        ];


        if($registro = $_ZOOM->update_data_array($data, 'grw_arquetipos', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>