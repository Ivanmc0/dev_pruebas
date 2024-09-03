<?php  require_once ('../../appInit.php');

$inter = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id_actividad = ' . $_POST["a"] . ' AND inactivo = 0 AND eliminado = 0', 1);
if($inter){
    foreach ($inter as $key => $encuesta) {

        echo '<div id="rtn_encuesta_respuestas_'.$encuesta["id"].'"></div>';
        echo '<script>lele.encuesta_respuestas('.$encuesta["id"].', '.$_POST["a"].', '.$_POST["t"].', '.$_POST["e"].');</script>';

    }
}