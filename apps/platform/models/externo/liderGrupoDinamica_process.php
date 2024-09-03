<?php

$getResponse     = $data["pregunta"] != 0 ? true : false;
$data_respuestas = [];

if($dinamica){

    if($dinamica['id_modelo'] == 1){

        if ($respuestas = $_ZOOM->get_data("grw_sol_act_encuestas", " AND id_actividad = ".$data["actividad"]." AND id_dinamica = ".$dinamica["id"]." AND id_trabajador = ".$miembro["id"]." AND id_empresa = ".$data["empresa"]." AND eliminado = 0 ORDER BY id DESC ", 1)){
            foreach ($respuestas as $per) {
                $data_respuestas[$per['id_dinamica']."_".$per['id_pregunta']]['id_respuesta']       = $per['id_respuesta'];
                $data_respuestas[$per['id_dinamica']."_".$per['id_pregunta']]['respuesta']          = $per['respuesta'];
                $data_respuestas[$per['id_dinamica']."_".$per['id_pregunta']]['respuesta_multiple'] = !empty($per['id_respuesta_multiple']) ? explode(',', $per['id_respuesta_multiple']) : 0;
            }
        }

    } elseif ($dinamica['id_modelo'] == 2) {

        $data_respuestas = [
            "contador"   => 0,
            "respuesta"  => '',
            "respuestas" => [],
        ];

        if ($respuestas = $_ZOOM->get_data("grw_sol_act_reconocimientos", " AND id_actividad = ".$data["actividad"]." AND id_dinamica = ".$dinamica["id"]." AND id_trabajador = ".$miembro["id"]." AND id_empresa = ".$data["empresa"]." AND eliminado = 0 ORDER BY id DESC ", 1)){
            foreach ($respuestas as $per) {
                $data_respuestas["contador"]  += 1;
                $data_respuestas["respuesta"] .= '<div class="mb3">';
                $data_respuestas["respuesta"] .= '<i class="'.$insignias[$per['id_reconocimiento']]["icono"].' t16" style="color:'.$insignias[$per['id_reconocimiento']]["color"].'"></i> ';
                $data_respuestas["respuesta"] .= '<div class="dIB w80x taC p3 colorfff t12 rr10" style="background:'.$insignias[$per['id_reconocimiento']]["color"].'"><div class="truncate-1">'.$insignias[$per['id_reconocimiento']]["nombre"].'</div></div>';
                $data_respuestas["respuesta"] .= '<div class="dIB t12 mL5 w150x"><div class="truncate-1"> '.$wrkrs[$per['id_reconocido']]["nombre"].'</div></div>';
                $data_respuestas["respuesta"] .= '</div>';
            }
        }

    } elseif ($dinamica['id_modelo'] == 3) {

        $data_respuestas = [
            "contador"   => 0,
            "respuesta"  => '',
            "respuestas" => [],
        ];

        if ($respuestas = $_ZOOM->get_data("grw_sol_act_campanias", " AND id_actividad = ".$data["actividad"]." AND id_dinamica = ".$dinamica["id"]." AND id_trabajador = ".$miembro["id"]." AND id_empresa = ".$data["empresa"]." AND eliminado = 0 ORDER BY id DESC ", 1)){
            foreach ($respuestas as $per) {
                $data_respuestas["contador"]  += 1;
                $data_respuestas["respuesta"] .= '<div class="truncate-1 mb3"><i class="las la-comment-dots t14 colorMorado2"></i> '.$per['comentarios'].'</div>';
            }
        }

    }

    if(!empty($data_respuestas)){

        $dica = [
            "nombre"    => $dinamica['nombre'],
            "id_modelo" => $dinamica['id_modelo'],
            "id_tipo"   => $dinamica['id_tipo'],
            "response"  => '',
        ];

        if($dinamica['id_modelo'] == 2 || $dinamica['id_modelo'] == 3){

            $result = $data_respuestas["contador"];
            $anws   = $data_respuestas["respuesta"];

        }elseif($dinamica['id_modelo'] == 1){

            if ($getPreguntas = $_ZOOM->get_data('grw_lel_preguntas', ' AND id_dinamica = ' . $dinamica['id'] . ' AND inactivo = 0 AND eliminado = 0', 1)) {
                $preguntas_correctas = 0;
                $preguntas_totales   = 0;
                $respuestas_totales  = 0;
                foreach ($getPreguntas as $key => $pre) {

                    $getMods = $_ZOOM->get_data('olc_preguntas_tipos', ' AND id = ' . $pre['id_modo'].' AND inactivo = 0 AND eliminado = 0', 0);

                    $dica["preguntas"][$pre["id"]] = [
                        "id"      => $pre['id'],
                        "p"       => $key+1,
                        "nombre"  => $pre['nombre'],
                        "id_modo" => $pre['id_modo'],
                        "modo"    => $getMods['nombre'],
                    ];

                    if ($dinamica['id_tipo'] == 1) {
                        $getRespuestas = $_ZOOM->get_data('grw_lel_respuestas', ' AND id_pregunta = ' . $pre['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                        if ($getRespuestas) {
                            $respuestas_correctas   = 0;
                            $total_correctas        = 0;
                            foreach ($getRespuestas as $res) {

                                $dica["preguntas"][$pre["id"]]["respuestas"][$res["id"]] = [
                                    "id"       => $res['id'],
                                    "nombre"   => $res['nombre'],
                                    "correcta" => $res['correcta'],
                                    "solucion" => 0,
                                ];

                                if ($pre['id_modo'] == 1) {
                                    if (isset($data_respuestas[$dinamica["id"]."_".$pre["id"]]) && $res["id"] == $data_respuestas[$dinamica["id"]."_".$pre["id"]]['id_respuesta']){
                                        if($res["correcta"]) $respuestas_correctas++;
                                        $dica["preguntas"][$pre["id"]]["respuestas"][$res["id"]]["solucion"] = 1;
                                        if($getResponse && $data["pregunta"] == $pre["id"]) $dica["response"] .= $res["nombre"];
                                    }
                                    if($res["correcta"]){
                                        $total_correctas++;
                                    }

                                } else if($pre['id_modo'] == 2) {

                                    if (!empty($data_respuestas[$dinamica["id"]."_".$pre["id"]]['respuesta_multiple'])) {
                                        foreach ($data_respuestas[$dinamica["id"]."_".$pre["id"]]['respuesta_multiple'] as $value) {
                                            if ($res['id'] == $value){
                                                if($res["correcta"]) $respuestas_correctas++;
                                                $dica["preguntas"][$pre["id"]]["respuestas"][$res["id"]]["solucion"] = 1;
                                                $corr = $res["correcta"] ? '<i class="las la-check-circle t12 colorVerde"></i>' : '<i class="las la-times-circle t12 colorRojo"></i>';
                                                if($getResponse && $data["pregunta"] == $pre["id"]) $dica["response"] .= '<div class="mb3">'.$corr.' '.$res["nombre"].'</div>';
                                            }
                                        }
                                    }
                                    if($res["correcta"]){
                                        $total_correctas++;
                                    }
                                }
                            }

                            $evaluacion_respuesta = 0;
                            if($total_correctas > 0) $evaluacion_respuesta = ($respuestas_correctas/$total_correctas)*100;

                            $dica["preguntas"][$pre["id"]]["respuestas_correctas"] = $respuestas_correctas;
                            $dica["preguntas"][$pre["id"]]["total_correctas"]      = $total_correctas;
                            $dica["preguntas"][$pre["id"]]["resultado"]            = round($evaluacion_respuesta);

                            if($getResponse && $data["pregunta"] == $pre["id"]) $dica["response"] .= '<div class="p5 w60x beee rr10 taC t10 bS1 bCeee ff3">'.$dica["preguntas"][$pre["id"]]["resultado"].'%</div>';



                            $preguntas_correctas += $evaluacion_respuesta;
                            $preguntas_totales   += 1;

                        }
                    } else if ($dinamica['id_tipo'] == 2) {
                        if ($pre['id_modo'] != 5) {
                            $getRespuestas = $_ZOOM->get_data('grw_lel_respuestas', ' AND id_pregunta = ' . $pre['id'] . ' AND inactivo = 0 AND eliminado = 0', 1);
                            if ($getRespuestas) {
                                foreach ($getRespuestas as $res) {

                                    $dica["preguntas"][$pre["id"]]["respuestas"][$res["id"]] = [
                                        "id"       => $res['id'],
                                        "nombre"   => $res['nombre'],
                                        "correcta" => $res['correcta'],
                                        "solucion" => 0,
                                    ];

                                    if ($pre['id_modo'] == 1 || $pre['id_modo'] == 3) {
                                        if (isset($data_respuestas[$dinamica["id"]."_".$pre["id"]]) && $res["id"] == $data_respuestas[$dinamica["id"]."_".$pre["id"]]['id_respuesta']){
                                            $dica["preguntas"][$pre["id"]]["respuestas"][$res["id"]]["solucion"] = 1;
                                            $respuestas_totales += 1;
                                            if($getResponse && $data["pregunta"] == $pre["id"]) $dica["response"] .= '<div class="mb3">'.$res["nombre"].'</div>';
                                        }
                                    } else {
                                        if (!empty($data_respuestas[$dinamica["id"]."_".$pre["id"]]['respuesta_multiple'])) {
                                            foreach ($data_respuestas[$dinamica["id"]."_".$pre["id"]]['respuesta_multiple'] as $value) {
                                                if ($res['id'] == $value){
                                                    $dica["preguntas"][$pre["id"]]["respuestas"][$res["id"]]["solucion"] = 1;
                                                    $respuestas_totales += 1;
                                                    if($getResponse && $data["pregunta"] == $pre["id"]) $dica["response"] .= '<div class="mb3">- '.$res["nombre"].'</div>';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            $value = '';
                            if (isset($data_respuestas[$dinamica["id"]."_".$pre["id"]])) $value = ($data_respuestas[$dinamica["id"]."_".$pre["id"]]['respuesta']);
                            $dica["preguntas"][$pre["id"]]["respuesta"] = $value;
                            if($getResponse && $data["pregunta"] == $pre["id"]) $dica["response"] .= '<div class="mb3">'.$value.'</div>';

                            if ($value) $respuestas_totales += 1;
                        }
                    }

                }

                if($preguntas_totales > 0){
                    $nota         = round($preguntas_correctas/$preguntas_totales);
                    $dica["nota"] = $nota;
                }

                if($respuestas_totales > 0){
                    $dica["invest"] = $respuestas_totales;
                }

            }

            $result = isset($dica["nota"]) ? $dica["nota"]."%" : (isset($dica["invest"]) ? '<i class="las la-check-double t24 colorVerde"></i>' : '');
            $anws   = isset($dica["response"]) ? $dica["response"] : '';

        }

    }

}