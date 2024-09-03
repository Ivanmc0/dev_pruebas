<?php require_once('../../../appInit.php');

$interactividades = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id_actividad = ' . $_POST["a"] . ' AND inactivo = 0 AND eliminado = 0', 1);
if($interactividades){
    foreach ($interactividades as $key => $interactividad) {

        echo '<div id="rtn_encuesta_respuestas_'.$interactividad["id"].'"></div>';
        
        echo '<div id="interactividad_'.$interactividad["id"].'">';

        if($interactividad["id_modelo"] == 1) echo '<script>lele.get_interactividad_encuesta('.$interactividad["id"].', '.$_POST["a"].', '.$_POST["t"].', '.$_POST["e"].');</script>';
        if($interactividad["id_modelo"] == 2) echo '<script>lele.actividad_detalle_reconocimientos('.$interactividad["id"].', '.$_POST["a"].', '.$_POST["t"].', '.$_POST["e"].');</script>';
        if($interactividad["id_modelo"] == 3) echo '<script>lele.actividad_detalle_campana('.$interactividad["id"].', '.$_POST["a"].', '.$_POST["t"].', '.$_POST["e"].');</script>';
        
        echo '</div>';

        echo '<div id="rtn_interactividad_'.$interactividad["id"].'"></div>';

    }
}

echo '
    <script>
        setTimeout( function(){
            Ion.init();
            console.log("Modal Done");
        }, 3000);
    </script>
';