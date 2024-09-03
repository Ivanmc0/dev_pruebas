<?php require_once('../../../appInit.php');

$insert_data    = 0;
$insert         = 0;

foreach ($_POST as $key => $val) {
    if (strpos($key, 'opcion') !== false) {
        if ($val != '') {
            $param      = explode('_', $key);
            $id_param   = $param[1];
            $getData    = $_ZOOM->get_data('grw_sol_seg_perfilado', ' AND id_parametro = ' . $id_param . ' AND id_trabajador = ' . $_POST['id_trabajador'], 0);
            if ($getData) {
                $data   = array( 'id_opcion' => $val );
                $insert = $_ZOOM->update_data_array($data, 'grw_sol_seg_perfilado', 'id', $getData['id']);
            } else {
                $data = array(
                    'id_parametro' => $id_param,
                    'id_opcion' => $val,
                    'id_trabajador' => $_POST['id_trabajador'],
                    'id_empresa' => $_POST['id_empresa'],
                    'fecha' => date('Y-m-d H:i:s')
                );
                $insert = $_ZOOM->insert_data_array($data, 'grw_sol_seg_perfilado');
            }
            $insert_data += $insert;
        } else {
            echo "<div class='colorRojo'>Todos los campos son obligatorios</div>";
            die();
        }
    }
}

if ($insert_data > 0) {
    echo "<div class='colorVerde ff3'>Actualizado con éxito</div>";
    echo '<script>setTimeout(function(){ window.location.href = "../mi-perfil-empresarial/"; }, 1500);</script>';
} else echo "<div class='colorRojo'>Error al guardar los datos</div>";