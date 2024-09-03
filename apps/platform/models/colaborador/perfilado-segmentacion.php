<?php require_once ('../../appInit.php');

   

    $colab = $_ZOOM->get_data("zoom_users", " AND uuid = '".$_POST['this']."' AND eliminado = 0 ", 0);


    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if(isset($_POST['segmentacion'])){

            foreach ($_POST['segmentacion'] as $key => $value) {
                if($value == 0) MsgError('Debe seleccionar una respuesta para todas las preguntas', 1);
            }

            foreach ($_POST['segmentacion'] as $key => $value) {

                if($respuesta = $_ZOOM->get_data('grw_sol_seg_perfilado', ' AND id_trabajador = ' . $colab['id'] . ' AND id_parametro = ' . $key . ' AND inactivo = 0 AND eliminado = 0  ', 0)){

                    if($value == $respuesta['id_opcion']) continue;

                    $data = [
                        'id_opcion' => $value,
                    ];

                    $_ZOOM->update_data_array($data, 'grw_sol_seg_perfilado', 'id', $respuesta['id']);

                }else{

                    $data = [
                        'id_trabajador' => $colab['id'],
                        'id_parametro' => $key,
                        'id_opcion' => $value,
                    ];

                    $_ZOOM->insert_data_array($data, 'grw_sol_seg_perfilado');

                }

            }

            echo 1;

        } else MsgError('Error de seguridad, no se encontraron respuestas.', 1);

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.', 1);

    }

?>