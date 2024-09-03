<?php require_once ('../../appInit.php');

 

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe darle un nombre a la investigación', 1);
        if($_POST['id_encuesta'] == 0) MsgError('Debe seleccionar una encuesta', 1);
        if($_POST['id_publico'] == 0) MsgError('Debe seleccionar un tipo de público', 1);
        if($_POST['id_publico'] == 2 && $_POST['id_publico_listado'] == 0) MsgError('Debe seleccionar una lista de público externo', 1);

        $data = [
            'inactivo'           => $_POST['inactivo'],
            'nombre'             => $_POST['nombre'],
            'descripcion'        => $_POST['descripcion'],
            'id_valoracion'      => $_POST['v'],
            'id_evento'          => $_POST['e'],
            'id_publico'         => $_POST['id_publico'],
            'id_publico_listado' => $_POST['id_publico_listado'],
            'id_encuesta'        => $_POST['id_encuesta'],
            'id_empresa'         => $_SESSION['COMPANY']['id'],
        ];

     
        if($registro = $_ZOOM->insert_data_array($data, 'grw_val_investigaciones')){
            echo 1;
        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>