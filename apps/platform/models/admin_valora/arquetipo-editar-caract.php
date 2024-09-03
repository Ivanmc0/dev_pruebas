<?php require_once ('../../appInit.php');

     

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        $data = [
            'motivaciones'          => $_POST['motivaciones'],
            'comportamiento_compra' => $_POST['comportamiento_compra'],
            'desafios'              => $_POST['desafios'],
            'objetivos'             => $_POST['objetivos'],
            'influencias'           => $_POST['influencias'],
            'ejemplos'              => $_POST['ejemplos'],
            'canales'               => $_POST['canales'],
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