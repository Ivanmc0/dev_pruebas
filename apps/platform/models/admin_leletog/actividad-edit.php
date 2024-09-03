<?php require_once ('../../appInit.php');

     

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre', 1);
        if($_POST['id_categoria'] == '0') MsgError('Debe seleccionar una categoría', 1);
        if($_POST['descripcion'] == '') MsgError('Debe indicar una descripción de la actividad', 1);

        $data = [
            'inactivo'     => $_POST['inactivo'],
            'nombre'       => $_POST['nombre'],
            'id_categoria' => $_POST['id_categoria'],
            'descripcion'  => $_POST['descripcion'],
        ];


        if($registro = $_ZOOM->update_data_array($data, 'grw_lel_actividades', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>