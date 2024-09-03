<?php require_once ('../../appInit.php');

  

    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        $data = [
            'descr_demo_edad'           => $_POST['descr_demo_edad'],
            'descr_demo_genero'         => $_POST['descr_demo_genero'],
            'descr_demo_socioeconomico' => $_POST['descr_demo_socioeconomico'],
            'descr_demo_ubicacion'      => $_POST['descr_demo_ubicacion'],
            'descr_demo_otro'           => $_POST['descr_demo_otro'],
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