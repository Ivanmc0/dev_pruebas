<?php  require_once ('../../appInit.php');

$insert = 0;
$conteo_preguntas = 0;

foreach ($_POST as $key => $val) {
    if (strpos($key, 'pregunta') !== false) {
        $conteo_preguntas++;
        if ($val != '') {

            $param = explode('_', $key);
            $id_dinamica = $param[1];
            $id_pregunta = $param[2];

            $data = array(
                'id_dinamica' => $id_dinamica,
                'id_pregunta' => $id_pregunta,
                'id_trabajador' => $_POST['id_trabajador'],
                'id_empresa' => $_POST['id_empresa'],
                'id_actividad' => $_POST['id_actividad'],
                'fecha' => date('Y-m-d H:i:s')
            );

            if (isset($param[3])) {
                if ($param[3] == 'a') $data['respuesta'] = $val;
                else {
                    $data['id_respuesta_multiple'] = implode(',', $val);
                }
            } else $data['id_respuesta'] = $val;

            $insert = $_ZOOM->insert_data_array($data, 'grw_sol_act_encuestas');

        } else {
            $insert = 'campos';
            echo "<div class='colorRojo'>Responda todas las preguntas requeridas</div>";
            $die();
        }
    }
}


if ($conteo_preguntas != $_POST["cant_preg"]) $insert = 'campos';

if($insert == 'campos'){

    echo "<div class='colorRojo'>Responda todas las preguntas requeridas</div>";

} elseif ($insert) {
    echo "<div class='colorVerde ff3'>Actualizado con éxito</div>";
    echo '
        <script>
            setTimeout( function(){
                $("#modalCrearEncuesta'.$_POST["id_dinamica"].'").modal("hide");
                document.getElementById("encuesta_'.$_POST["id_dinamica"].'").reset();
                lele.get_interactividad_encuesta('.$_POST["id_dinamica"].', '.$_POST["id_actividad"].', '.$_POST["id_trabajador"].', '.$_POST["id_empresa"].');
                $("#rtn-encuesta'.$_POST["id_dinamica"].'").html("");
            }, 1);
        </script>
    ';

} else{
    echo "<div class='colorRojo'>Error al guardar los datos</div>";
}