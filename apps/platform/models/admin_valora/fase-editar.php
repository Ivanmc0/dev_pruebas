<?php require_once ('../../appInit.php');

    

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['id_etapa'] == '0') MsgError('Debe seleccionar una etapa para asignar la Fase', 1);
        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre de la Fase', 1);

        $data = [
            'inactivo'    => $_POST['inactivo'],
            'orden'       => $_POST['orden'],
            'nombre'      => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'id_etapa'    => $_POST['id_etapa'],
        ];


        if($registro = $_ZOOM->update_data_array($data, 'grw_val_fases', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>