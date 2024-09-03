<?php require_once ('../../appInit.php');

   

    if($mud = $_ZOOM->get_data("zoom_models", " AND cody = '".$_POST['mud']."' AND $app = 1 AND inactivo = 0 AND eliminado = 0 ", 0)){

     
        $modo       = $_POST['modo'];
        $fath       = $_POST['fath'];
        $id_rol     = $_POST['panel'] ? $_SESSION["ADMIN"]['id'] : $_SESSION["WORKER"]['id_rol'];
        $app        = $_POST['app'];
        $condicion  = " AND model.id_modulo = ".$mud['id'];
        $condicion .= ($_POST['modo'] == 1) ? " AND model.tipo = 1 " : " AND (model.tipo = 2 || model.tipo = 3) ";

        $misBotones = '';

        if($botoneshabilitados = $_TUCOACH->getOpcionesPorRol( $id_rol, $app, $condicion )){
            foreach ($botoneshabilitados as $boton) {

                if($modo == 1){
                    $size = 'zm';
                    $perz = '';

                } else if($modo == 2){
                    $size = 'zs';
                    $perz = 'display:none;';
                }

                include '../../views/components/boton_config.php'; // apps/platform/views/components/boton_config.php
                $misBotones .= $unBoton;

            }
        }

        if($modo == 1){
            echo $misBotones;
        } else if($modo == 2){
            $_SESSION["btn-options"][$_POST['mud']] = $misBotones;
        }

    }

?>