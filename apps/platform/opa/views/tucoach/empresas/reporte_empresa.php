<?php

    $motor              = 1;
    $error              = "ERROR: Consultando ";
    $resultadoFinal     = 0;

    $thisEmpresa        = $_TUCOACH->get_data("olc_empresas", " AND id = ".$thisEvaluacion["id_empresa"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
    $thisGSegmentos     = $_TUCOACH->get_data("grw_tuc_segmentaciones_grupo", " AND id = ".$thisEvaluacion["id_segmentos"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
    $thisGTests         = $_TUCOACH->get_data("grw_tuc_paquetests", " AND id = ".$thisEvaluacion["id_grupotests"]." AND  eliminado = 0 ORDER BY id DESC ", 0);
    $thisTests          = $_TUCOACH->get_grupo_tests(" AND multi.id = ".$thisGTests["id"]." ORDER BY id DESC ", 1);

    $thisAsignaciones   = $_TUCOACH->get_data("grw_tuc_p2b_asignaciones", " AND id_evaluacion = ".$thisEvaluacion["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
    $thisAsignacionesOK = $_TUCOACH->get_data("grw_tuc_p2b_asignaciones", " AND id_evaluacion = ".$thisEvaluacion["id"]." AND realizado = 1 AND perfil_completo = 1 AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);

    if($thisEvaluacion == 0)        $motor = $error."la evaluación";
    if($thisGSegmentos == 0)        $motor = $error."el grupo de segmentos";
    if($thisEmpresa == 0)           $motor = $error."la empresa";
    if($thisGTests == 0)            $motor = $error."el grupo tests";
    if($thisTests == 0)             $motor = $error."los tests";
    if($thisAsignaciones == 0)      $motor = $error."no hay asignaciones a la evaluación realizadas";

    if($motor === 1){

        $segmentions = array();
        if($thisGSegmentos){
            $thisSegmentos = $_TUCOACH->get_data("grw_tuc_segmentaciones", " AND id_gruposegmento = ".$thisGSegmentos["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
            if($thisSegmentos){
                foreach($thisSegmentos AS $thisSegmento){
                    $segmentions[$thisSegmento["id"]]["id"]        = $thisSegmento["id"];
                    $segmentions[$thisSegmento["id"]]["nombre"]    = ($thisSegmento["nombre"]);
                    $thisOpciones = $_TUCOACH->get_data("grw_tuc_segmentaciones_opciones", " AND id_segmento = ".$thisSegmento["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                    if($thisOpciones){
                        foreach($thisOpciones AS $thisOpcion){
                            $segmentions[$thisSegmento["id"]]["seg_opciones"][$thisOpcion["id"]]["id"]          = $thisOpcion["id"];
                            $segmentions[$thisSegmento["id"]]["seg_opciones"][$thisOpcion["id"]]["nombre"]      = ($thisOpcion["nombre"]);
                            $segmentions[$thisSegmento["id"]]["seg_opciones"][$thisOpcion["id"]]["sumatoria"]   = 0;
                        }
                    }
                }
            }
        }

        // echo '<pre>';
        // print_r($segmentions);
        // echo'</pre>';

        $activion   = true;
        $activion2  = true;
        $c1_sumatoria_test  = 0;
        $c1_sumatoria_test2 = 0;
        $c1_equivalencia_test  = 0;
        $c1_equivalencia_test2 = 0;
        $co1 = "";
        $co2 = "";
        $co3 = "";

        $allion = array();
        $segion = array();
        if(count($segmentions) > 0){
            if($thisTests){
                $tempTest = array();
                foreach($thisTests AS $thisTest){
                    $thisGPreg = $_TUCOACH->get_data("grw_paquete_respuestas", " AND id = ".$thisTest["id_grupopregunta"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
                    $c1_sumatoria_categorias  = 0;
                    $c1_sumatoria_categorias2 = 0;
                    if($activion) $allion[$thisTest["id"]]["id"]            = $thisTest["id"];
                    if($activion) $allion[$thisTest["id"]]["nombre"]        = ($thisTest["nombre"]);
                    if($activion) $allion[$thisTest["id"]]["eq"]            = $thisGPreg["equivalencia"];
                    $thisCategorias = $_TUCOACH->get_data("grw_tuc_p2b_categorias", " AND id_test = ".$thisTest["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                    if($thisCategorias){
                        $tempCateg = array();
                        foreach($thisCategorias AS $thisCategoria){
                            $c1_sumatoria_competencias          = 0;
                            $c1_sumatoria_competencias2         = 0;
                            $c1_sumatoria_competencias_valor    = 0;
                            $c1_sumatoria_competencias2_valor   = 0;
                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["id"] = $thisCategoria["id"];
                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["nombre"] = ($thisCategoria["nombre"]);
                            $thisCompetencias = $_TUCOACH->get_data("grw_tuc_p2b_competencias", " AND id_categoria = ".$thisCategoria["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                            if($thisCompetencias){
                                $tempComport = array();
                                foreach($thisCompetencias AS $thisCompetencia){
                                    $c1_sumatoria_comportamientos = 0;
                                    $c1_sumatoria_comportamientos2 = 0;
                                    $c2_sumatoria_comportamientos = 0;
                                    $c2_sumatoria_comportamientos2 = 0;
                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["id"]     = $thisCompetencia["id"];
                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["valor"]  = $thisCompetencia["valor"];
                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["nombre"] = ($thisCompetencia["nombre"]);
                                    $thisComportamientos = $_TUCOACH->get_data("grw_tuc_p2b_comportamientos", " AND id_competencia = ".$thisCompetencia["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                                    if($thisComportamientos){
                                        foreach($thisComportamientos AS $thisComportamiento){
                                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["id"]     = $thisComportamiento["id"];
                                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["nombre"] = ($thisComportamiento["nombre"]);

                                            // SOLUCIONES POR COMPORTAMIENTO
                                            $c1_sumatoria_soluciones = 0;
                                            $c1_sumatoria_soluciones2 = 0;
                                            $g_soluciones = $_TUCOACH->get_solution_empresa(" AND res.id_comportamiento = ".$thisComportamiento["id"]." AND asi.id_evaluacion = $id ", 1);
                                            if($g_soluciones){
                                                foreach($g_soluciones AS $gSolucion){
                                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["g_soluciones"][$gSolucion["id_resultado"]]["id"]  = $gSolucion["id_resultado"];
                                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["g_soluciones"][$gSolucion["id_resultado"]]["solucion"]          = $gSolucion["solucion"];
                                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["g_soluciones"][$gSolucion["id_resultado"]]["solucion2"]         = $gSolucion["solucion2"];
                                                    $c1_sumatoria_soluciones += $gSolucion["solucion"];
                                                    $c1_sumatoria_soluciones2 += $gSolucion["solucion2"];
                                                }
                                            }
                                            $g_promedio   = $c1_sumatoria_soluciones/count($g_soluciones);
                                            $g_promedio2  = $c1_sumatoria_soluciones2/count($g_soluciones);
                                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["g_soluciones"]["sumatoria"]     = $c1_sumatoria_soluciones;
                                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["g_soluciones"]["sumatoria2"]    = $c1_sumatoria_soluciones2;
                                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["g_soluciones"]["promedio"]      = $g_promedio;
                                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["g_soluciones"]["promedio2"]     = $g_promedio2;


                                            // SOLUCIONES POR SEGMENTO
                                            foreach($segmentions AS $segmentation){
                                                $sumatoria_segmentos = 0;
                                                $sumatoria_segmentos2 = 0;
                                                foreach($segmentation["seg_opciones"] AS $opcion){
                                                    $sumatoria_segmentos = 0;
                                                    $sumatoria_segmentos2 = 0;
                                                    if($activion2) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["id"]     = $opcion["id"];
                                                    if($activion2) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["nombre"] = ($opcion["nombre"]);
                                                    $soluciones = $_TUCOACH->get_solution_empresa_segmento(" AND asi.id_evaluacion = $id AND res.id_comportamiento = ".$thisComportamiento["id"]." AND perf.solucion = ".$opcion["id"]."  AND perf.id_segmento = ".$segmentation["id"]." ", 1);
                                                    if($soluciones){
                                                        foreach($soluciones AS $solucion){
                                                            if($activion2) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["soluciones"][$solucion["id_resultado"]]["id"]  = $solucion["id_resultado"];
                                                            if($activion2) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["soluciones"][$solucion["id_resultado"]]["solucion"]          = $solucion["solucion"];
                                                            if($activion2) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["soluciones"][$solucion["id_resultado"]]["solucion2"]         = $solucion["solucion2"];
                                                            $sumatoria_segmentos += $solucion["solucion"];
                                                            $sumatoria_segmentos2 += $solucion["solucion2"];
                                                        }
                                                    }
                                                    $promedio   = $sumatoria_segmentos/count($soluciones);
                                                    $promedio2  = $sumatoria_segmentos2/count($soluciones);
                                                    if($activion2) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["sumatoria"]    = $sumatoria_segmentos;
                                                    if($activion2) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["sumatoria2"]   = $sumatoria_segmentos2;
                                                    $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["promedio"]     = $promedio;
                                                    $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["promedio2"]    = $promedio2;
                                                    $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["conteo"]       = count($soluciones);
                                                    $segion[$thisTest["id"]][$thisCategoria["id"]][$thisCompetencia["id"]][$thisComportamiento["id"]][$opcion["id"]]["resultados1"] = $promedio;
                                                    $segion[$thisTest["id"]][$thisCategoria["id"]][$thisCompetencia["id"]][$thisComportamiento["id"]][$opcion["id"]]["resultados2"] = $promedio2;

                                                }
                                                // if($activion2) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["id"]           = $segmentation["id"];
                                                // if($activion2) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["nombre"]       = ($segmentation["nombre"]);
                                            }

                                            foreach($segmentions AS $segmentation){
                                                foreach($segmentation["seg_opciones"] AS $opcion){
                                                    if(!isset($tempComport[$opcion["id"]]["sumatoria"]) || $co1 != $thisCompetencia["id"]){
                                                        $tempComport[$opcion["id"]]["sumatoria"] = 0;
                                                        $tempComport[$opcion["id"]]["sumatoria2"] = 0;
                                                        $tempComport[$opcion["id"]]["conteo"] = 0;
                                                    }
                                                    $vllion1 = $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["promedio"];
                                                    $vllion2 = $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["seg_opciones"][$opcion["id"]]["promedio2"];
                                                    $tempComport[$opcion["id"]]["id"] = $opcion["id"];
                                                    $tempComport[$opcion["id"]]["sumatoria"] += $vllion1;
                                                    $tempComport[$opcion["id"]]["sumatoria2"] += $vllion2;
                                                    $tempComport[$opcion["id"]]["conteo"]++;
                                                }
                                            }
                                            $co1 = $thisCompetencia["id"];

                                            $c1_sumatoria_comportamientos   += $g_promedio;
                                            $c1_sumatoria_comportamientos2  += $g_promedio2;

                                        }
                                    }

                                    foreach($tempComport AS $tempCompo){
                                        $tempComport[$tempCompo["id"]]["promedio"] = $tempComport[$tempCompo["id"]]["sumatoria"]/$tempComport[$tempCompo["id"]]["conteo"];
                                        $tempComport[$tempCompo["id"]]["promedio2"] = $tempComport[$tempCompo["id"]]["sumatoria2"]/$tempComport[$tempCompo["id"]]["conteo"];
                                        $tempComport[$tempCompo["id"]]["equivalencia"] = $tempComport[$tempCompo["id"]]["promedio"]/100*$thisCompetencia["valor"];
                                        $tempComport[$tempCompo["id"]]["equivalencia2"] = $tempComport[$tempCompo["id"]]["promedio2"]/100*$thisCompetencia["valor"];
                                    }

                                    $segion[$thisTest["id"]][$thisCategoria["id"]][$thisCompetencia["id"]]["sicmundus_compe"] = $tempComport;
                                    $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["sicmundus_compe"] = $tempComport;

                                    foreach($segmentions AS $segmentation){
                                        foreach($segmentation["seg_opciones"] AS $opcion){
                                            if(!isset($tempCateg[$opcion["id"]]["sumatoria"]) || $co2 != $thisCategoria["id"]){
                                                $tempCateg[$opcion["id"]]["sumatoria"] = 0;
                                                $tempCateg[$opcion["id"]]["sumatoria2"] = 0;
                                                $tempCateg[$opcion["id"]]["conteo"] = 0;
                                            }
                                            $vllion1 = $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["sicmundus_compe"][$opcion["id"]]["equivalencia"];
                                            $vllion2 = $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["sicmundus_compe"][$opcion["id"]]["equivalencia2"];
                                            $tempCateg[$opcion["id"]]["id"] = $opcion["id"];
                                            $tempCateg[$opcion["id"]]["sumatoria"] += $vllion1;
                                            $tempCateg[$opcion["id"]]["sumatoria2"] += $vllion2;
                                            $tempCateg[$opcion["id"]]["conteo"]++;
                                        }
                                    }
                                    $co2 = $thisCategoria["id"];




                                    $g_promedio_comportamiento          = $c1_sumatoria_comportamientos/count($thisComportamientos);
                                    $g_promedio_comportamiento2         = $c1_sumatoria_comportamientos2/count($thisComportamientos);
                                    $g_promedio_comportamiento_valor    = $g_promedio_comportamiento/100*$thisCompetencia["valor"];
                                    $g_promedio_comportamiento2_valor   = $g_promedio_comportamiento2/100*$thisCompetencia["valor"];
                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["sumatoria"]     = $c1_sumatoria_comportamientos;
                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["sumatoria2"]    = $c1_sumatoria_comportamientos2;
                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["promedio"]                     = $g_promedio_comportamiento;
                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["promedio2"]                    = $g_promedio_comportamiento2;
                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["promedio_valor"]      = $g_promedio_comportamiento_valor;
                                    if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["promedio2_valor"]     = $g_promedio_comportamiento2_valor;
                                    $c1_sumatoria_competencias          += $g_promedio_comportamiento;
                                    $c1_sumatoria_competencias2         += $g_promedio_comportamiento2;
                                    $c1_sumatoria_competencias_valor    += $g_promedio_comportamiento_valor;
                                    $c1_sumatoria_competencias2_valor   += $g_promedio_comportamiento2_valor;

                                }


                            }

                            $segion[$thisTest["id"]][$thisCategoria["id"]]["sicmundus_cate"] = $tempCateg;
                            $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["sicmundus_cate"] = $tempCateg;

                            foreach($segmentions AS $segmentation){
                                foreach($segmentation["seg_opciones"] AS $opcion){
                                    if(!isset($tempTest[$opcion["id"]]["sumatoria"]) || $co3 != $thisTest["id"]){
                                        $tempTest[$opcion["id"]]["sumatoria"] = 0;
                                        $tempTest[$opcion["id"]]["sumatoria2"] = 0;
                                        $tempTest[$opcion["id"]]["conteo"] = 0;
                                    }
                                    $vllion1 = $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["sicmundus_cate"][$opcion["id"]]["sumatoria"];
                                    $vllion2 = $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["sicmundus_cate"][$opcion["id"]]["sumatoria2"];
                                    $tempTest[$opcion["id"]]["id"] = $opcion["id"];
                                    $tempTest[$opcion["id"]]["sumatoria"] += $vllion1;
                                    $tempTest[$opcion["id"]]["sumatoria2"] += $vllion2;
                                    $tempTest[$opcion["id"]]["conteo"]++;
                                }
                            }
                            $co3 = $thisTest["id"];

                            $g_promedio_competencia     = $c1_sumatoria_competencias/count($thisCompetencias);
                            $g_promedio_competencia2    = $c1_sumatoria_competencias2/count($thisCompetencias);
                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["sumatoria"]         = $c1_sumatoria_competencias;
                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["sumatoria2"]        = $c1_sumatoria_competencias2;
                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["promedio"]          = $g_promedio_competencia;
                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["promedio2"]         = $g_promedio_competencia2;
                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["promedio_valor"]    = $c1_sumatoria_competencias_valor;
                            if($activion) $allion[$thisTest["id"]]["categorias"][$thisCategoria["id"]]["promedio2_valor"]   = $c1_sumatoria_competencias2_valor;
                            if($activion) $c1_sumatoria_categorias    += $c1_sumatoria_competencias_valor;
                            if($activion) $c1_sumatoria_categorias2   += $c1_sumatoria_competencias2_valor;;

                        }
                    }

                    foreach($tempTest AS $tempTe){
                        $tempTest[$tempTe["id"]]["promedio"] = $tempTest[$tempTe["id"]]["sumatoria"]/$tempTest[$tempTe["id"]]["conteo"];
                        $tempTest[$tempTe["id"]]["promedio2"] = $tempTest[$tempTe["id"]]["sumatoria2"]/$tempTest[$tempTe["id"]]["conteo"];
                    }

                    $segion[$thisTest["id"]]["sicmundus_test"] = $tempTest;
                    $allion[$thisTest["id"]]["sicmundus_test"] = $tempTest;

                    $g_promedio_categoria   = $c1_sumatoria_categorias/count($thisCategorias);
                    $g_promedio_categoria2  = $c1_sumatoria_categorias2/count($thisCategorias);
                    $g_equivalencia         = $g_promedio_categoria*$thisGPreg["equivalencia"];
                    $g_equivalencia2        = $g_promedio_categoria2*$thisGPreg["equivalencia"];
                    if($activion) $allion[$thisTest["id"]]["sumatoria"]             = $c1_sumatoria_categorias;
                    if($activion) $allion[$thisTest["id"]]["sumatoria2"]            = $c1_sumatoria_categorias2;
                    if($activion) $allion[$thisTest["id"]]["promedio_categoria"]    = $g_promedio_categoria;
                    if($activion) $allion[$thisTest["id"]]["promedio_categoria2"]   = $g_promedio_categoria2;
                    if($activion) $allion[$thisTest["id"]]["equivalencia"]          = $g_equivalencia;
                    if($activion) $allion[$thisTest["id"]]["equivalencia2"]         = $g_equivalencia2;
                    $c1_sumatoria_test      += $g_promedio_categoria;
                    $c1_sumatoria_test2     += $g_promedio_categoria2;
                    $c1_equivalencia_test   += $g_equivalencia;
                    $c1_equivalencia_test2  += $g_equivalencia2;

                }
            }

            $g_promedio_test                                  = $c1_sumatoria_test/count($thisTests);
            $g_promedio_test2                                 = $c1_sumatoria_test2/count($thisTests);
            $g_equivalencia_test                              = $c1_equivalencia_test/count($thisTests);
            $g_equivalencia_test2                             = $c1_equivalencia_test2/count($thisTests);
            if($activion) $allion["sumatoria"]                = $c1_sumatoria_test;
            if($activion) $allion["sumatoria2"]               = $c1_sumatoria_test2;
            if($activion) $allion["sumatoria_equivalencia"]   = $c1_equivalencia_test;
            if($activion) $allion["sumatoria2_equivalencia"]  = $c1_equivalencia_test2;
            if($activion) $allion["promedio_test"]            = $g_promedio_test;
            if($activion) $allion["promedio_test2"]           = $g_promedio_test2;
            if($activion) $allion["equivalencia_test"]        = $g_equivalencia_test;
            if($activion) $allion["equivalencia_test2"]       = $g_equivalencia_test2;

        }
    }

    //echo "<script>console.log(".json_encode($allion).");</script>";
    //echo "<script>console.log(".json_encode($segmentions).");</script>";

?>

<!-- <pre><?php print_r($segmentions); ?></pre> -->
<!-- <pre><?php print_r($allion); ?></pre> -->
<!-- <pre><?php print_r($tempComport); ?></pre> -->
<!-- <pre><?php print_r($tempCateg); ?></pre> -->
<!-- <pre><?php print_r($tempTest); ?></pre> -->
<!-- <pre><?php print_r($segion); ?></pre> -->
