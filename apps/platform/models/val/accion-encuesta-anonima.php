<?php  require_once ('../../appInit.php');

$insert = 0;

$_POST["id_anonimo"] = uniqid();

 

foreach ($_POST as $key => $val) {
    if (strpos($key, 'pregunta') !== false) {
        if ($val != '') {

            $param       = explode('_', $key);
            $id_encuesta = $param[1];
            $id_pregunta = $param[2];

            $data = array(
                'id_encuesta'      => $id_encuesta,
                'id_pregunta'      => $id_pregunta,
                'id_empresa'       => $_POST['c'],
                'id_investigacion' => $_POST['i'],
                'id_evento'        => $_POST['e'],
                'id_valoracion'    => $_POST['v'],
                'id_anonimo'       => $_POST['id_anonimo'],
                'fecha'            => date('Y-m-d H:i:s')
            );

            if (isset($param[3])) {

                if ($param[3] == 'a') $data['respuesta'] = $val;
                else $data['id_respuesta_multiple'] = implode(',', $val);

            } else $data['id_respuesta'] = $val;

            $insert = $_ZOOM->insert_data_array($data, 'grw_sol_val_anonima');


        } else {
            $insert = 'campos';
            echo "<div class='colorRojo mb20'>No has completado todas las preguntas requeridas</div>";
        }
    }
}


if($insert == 'campos'){
    // None
} elseif ($insert) {

    echo "<div class='colorVerde ff3'>Actualizado con éxito</div>";
    $empresa = $_ZOOM->get_data('olc_empresas', ' AND id = ' . $data['id_empresa'], 0);
    echo '
        <script>
            window.location.href = "/gracias/'.$empresa['uuid'].'/";
        </script>
    ';

} else{
    echo "<div class='colorRojo'>Error al guardar los datos</div>";
}