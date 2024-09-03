<?php require_once ('../../appInit.php');
 
    if($_PLATFORM->PermissionValidationModel ($_POST['app'], $_POST['event'], $_POST["panel"])){

        if($_POST['nombre'] == '') MsgError('Debe indicar el nombre', 1);
        if($_POST['id_categoria'] == '0') MsgError('Debe seleccionar una categoría', 1);
        if($_POST['descripcion'] == '') MsgError('Debe indicar una descripción de la actividad', 1);

        $data = [
            'inactivo'     => $_POST['inactivo'],
            'nombre'       => $_POST['nombre'],
            'id_categoria' => $_POST['id_categoria'],
            'descripcion'  => $_POST['descripcion'],
            'id_empresa'   => $_SESSION['COMPANY']['id'],
        ];


        if($registro = $_ZOOM->insert_data_array($data, 'grw_lel_actividades')){

            $dataIn = [
                'id_proceso_tipo'        => 3,
                'id_proceso'             => $registro,
                'asignaciones_actividad' => 1,
                'permisos_reporte'       => 1,
                'fecha_desde'            => '2024-01-01 00:00:00',
                'fecha_hasta'            => '2024-12-31 23:59:59',
            ];

            $_ZOOM->insert_data_array($dataIn, 'grw_procesos');
            $_COMPANY->NewUpdateHasDatos ( $_SESSION['COMPANY']['id'] );
            echo 1;

        } else {
            MsgError('Error al intentar guardar el registro', 1);
        }

    } else {

        // Error de permisos
        MsgError('Error de seguridad, no se puede continuar.');

    }

?>