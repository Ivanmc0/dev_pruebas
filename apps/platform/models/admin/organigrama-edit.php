<?php require_once ('../../appInit.php');

    

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre', 1);
        if ( $_LELE->CompanyHasOrgnigramaPrincipal ( $_SESSION['COMPANY']['id'], $_POST['activo'] ) ) MsgError('La empresa ya tiene un organigrama principal.', 1);
        
        $data = [
            'inactivo'            => $_POST['inactivo'],
            'activo'              => $_POST['activo'],
            'nombre'              => $_POST['nombre'],
        ];


        if($registro = $_ZOOM->update_data_array($data, 'grw_organigramas', 'uuid', $_POST['this'])){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>