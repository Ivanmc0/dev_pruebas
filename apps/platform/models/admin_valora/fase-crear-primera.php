<?php require_once ('../../appInit.php');

   
    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['id_etapa'] == '0') MsgError('Debe seleccionar una etapa para asignar la Fase', 1);
        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre de la Fase', 1);
        if($_POST['nombre_subfase'] == '') MsgError('Debe indicar el nombre de la Subfase', 1);

        $data = [
            'inactivo'   => 0,
            'orden'      => 1,
            'nombre'     => $_POST['nombre'],
            'id_journey' => $_POST['id_journey'],
            'id_etapa'   => $_POST['id_etapa'],
            'id_empresa' => $_SESSION['COMPANY']['id'],
        ];


        if($registro = $_ZOOM->insert_data_array($data, 'grw_val_fases')){

            $dataIn = [
                'id_fase'    => $registro,
                'orden'      => 1,
                'nombre'     => $_POST['nombre_subfase'],
                'id_empresa' => $_SESSION['COMPANY']['id'],
            ];

            $_ZOOM->insert_data_array($dataIn, 'grw_val_subfases');

            echo 1;

        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>