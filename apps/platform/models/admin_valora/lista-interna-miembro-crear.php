<?php require_once ('../../appInit.php');

    

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['id_trabajador'] == '0') MsgError('Debe seleccionar un colaborador para hacerlo miembro de esta lista', 1);

        $data = [
            'inactivo'           => 0,
            'id_trabajador'      => $_POST['id_trabajador'],
            'id_publico_listado' => $_POST['id_publico_listado'],
            'id_empresa'         => $_SESSION['COMPANY']['id'],
        ];


        if($registro = $_ZOOM->insert_data_array($data, 'grw_val_listasinternas_registros')){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>