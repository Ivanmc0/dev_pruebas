<?php  require_once ('../../appInit.php');

if($asignacion = $_ZOOM->get_data("grw_val_asignaciones", " AND uuid = '".$_POST["id_asignacion"]."' ", 0)){
    if($encuesta = $_TUCOACH->get_data("grw_val_encuestas", " AND id = '".$asignacion['id_encuesta']."' AND eliminado = 0 ORDER BY id DESC ", 0)){
        $empresa = $_ZOOM->get_data('olc_empresas', ' AND id = ' . $asignacion['id_empresa'], 0);

        $insert = 0;
        $conta  = ['mas' => 0, 'menos' => 0];
        $data   = [];

        foreach ($_POST as $key => $val) {
            if (strpos($key, 'pregunta') !== false) {

                $param       = explode('_', $key);
                $id_encuesta = $param[1];
                $id_pregunta = $param[2];
                $mas_menos   = $param[3];

                if(!isset($data[$id_pregunta])){
                    $data[$id_pregunta] = array(
                        'id_asignacion'            => $asignacion['id'],
                        'id_listaexterna_registro' => $asignacion['id_listaexterna_registro'],
                        'id_encuesta'              => $id_encuesta,
                        'id_pregunta'              => $id_pregunta,
                        'id_empresa'               => $empresa['id'],
                        'fecha'                    => date('Y-m-d H:i:s')
                    );
                }

                if  ($mas_menos){
                    $data[$id_pregunta]['id_respuesta_mas'] = $val;
                    $conta['mas']++;
                } else {
                    $data[$id_pregunta]['id_respuesta_menos'] = $val;
                    $conta['menos']++;
                }

            }
        }


        $preguntas = count($_ZOOM->get_data('grw_val_preguntas', ' AND id_encuesta = ' . $encuesta['id'] . ' AND inactivo = 0 AND eliminado = 0', 1));

        if($conta['mas'] != $conta['menos']){
            if($conta['mas'] > $conta['menos']) MsgError('Te ha quedado un "La que menos" sin responder');
            else                                MsgError('Te ha quedado un "La que más" sin responder');
            die();
        }

        if($preguntas != $conta['mas'] || $preguntas != $conta['menos']){
            MsgError('Te ha quedado al menos una pregunta sin responder');
            die();
        }

		echo '<script>$("#btn-encuesta_'.$encuesta["id"].'").slideUp(1);</script>';
        MsgOk("Estamos almacenando tus respuestas, por favor espera un momento...");

        foreach ($data as $key => $value) {
            $insert = $_ZOOM->insert_data_array($value, 'grw_sol_val_listaexterna');
        }


        $_ZOOM->update_data_array(['completado' => '1'], 'grw_val_asignaciones', 'id', $asignacion['id']);

        if($asignacion["id_trabajador"] != ""){

            echo '<script>setTimeout(function(){ history.back(); }, 1);</script>';
            
        }else{      
            echo '
                <script>
                    window.location.href = "../../gracias/'.$empresa['uuid'].'/";
                </script>
            ';
        }

    } else MsgError("La encuesta que busca no está disponible");
} else MsgError("La investigación que busca no está disponible");