<?php require_once ('../../appInit.php');

 

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['id_cargo'] == '0') MsgError('Debe seleccionar su cargo', 1);
        if($_POST['id_jefe'] == '0') MsgError('Debe indicar quien es su jefe directo', 1);

        $data = [
            'id_cargo' => $_POST['id_cargo'],
            'id_jefe'  => $_POST['id_jefe'],
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