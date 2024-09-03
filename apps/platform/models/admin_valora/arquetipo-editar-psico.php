<?php require_once ('../../appInit.php');

     

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        $data = [
            'descr_psico_intereses'    => $_POST['descr_psico_intereses'],
            'descr_psico_valores'      => $_POST['descr_psico_valores'],
            'descr_psico_estilovida'   => $_POST['descr_psico_estilovida'],
            'descr_psico_personalidad' => $_POST['descr_psico_personalidad'],
            'descr_psico_otro'         => $_POST['descr_psico_otro'],
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