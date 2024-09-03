<?php require_once ('../../appInit.php');

     

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre de la insignia', 1);
        if($_POST['forma'] == 0) MsgError('Debe indicar una forma para la insignia', 1);
        if($_POST['color'] == 0) MsgError('Debe seleccionar un color para la insignia', 1);
        if($_POST['icono'] == 0) MsgError('Debe seleccionar un icono', 1);

        $data = [
            'inactivo'   => $_POST['inactivo'],
            'nombre'     => $_POST['nombre'],
            'forma'      => $_POST['forma'],
            'color'      => $_POST['color'],
            'icono'      => $_POST['icono'],
            'id_empresa' => $_SESSION['COMPANY']['id'],
        ];


        if($registro = $_ZOOM->insert_data_array($data, 'grw_reconocimientos')){
            
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>