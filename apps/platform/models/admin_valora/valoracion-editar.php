<?php require_once ('../../appInit.php');

  

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre', 1);

        $data = [
            'inactivo'     => $_POST['inactivo'],
            'nombre'       => $_POST['nombre'],
            'descripcion'  => $_POST['descripcion'],
            'expectativas' => $_POST['expectativas'],
            'escenarios'   => $_POST['escenarios'],
        ];


        if($registro = $_ZOOM->update_data_array($data, 'grw_val_valoraciones', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>