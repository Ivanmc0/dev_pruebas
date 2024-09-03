<?php require_once ('../../appInit.php');

     

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre del proyecto', 1);
        if($_POST['id_responsable'] == '0') MsgError('Debe seleccionar un responsable', 1);
        if($_POST['id_semana_desde'] == '0') MsgError('Debe seleccionar la semana de inicio', 1);
        if($_POST['id_semana_hasta'] == '0') MsgError('Debe seleccionar la semana de cierre', 1);

        $data = [
            'inactivo'        => $_POST['inactivo'],
            'nombre'          => $_POST['nombre'],
            'descripcion'     => $_POST['descripcion'],
            'id_responsable'  => $_POST['id_responsable'],
            'id_semana_desde' => $_POST['id_semana_desde'],
            'id_semana_hasta' => $_POST['id_semana_hasta'],
        ];


        if($registro = $_ZOOM->update_data_array($data, 'grw_okr_proyectos', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>