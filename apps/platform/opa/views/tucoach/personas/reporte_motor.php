<?php

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    $baly               = false;
    $motor              = 1;
    $error              = "ERROR: Consultando";
    $resultadoFinal     = 0;
    $allion             = array();
    $rolesVale          = array();
    $equivalente        = "";


    $thisEvaluacion     = $_TUCOACH->get_data("grw_tuc_p2p_estudios", " AND id = ".$reporte["id_evaluacion"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
    $thisEvaluado       = $_TUCOACH->get_data("zoom_users", " AND id = ".$reporte["id_trabajador"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
    $thisEmpresa        = $_TUCOACH->get_data("olc_empresas", " AND id = ".$thisEvaluacion["id_empresa"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
    $thisTest           = $_TUCOACH->get_data("grw_tuc_p2p_tests", " AND id = ".$thisEvaluacion["id_test"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
    $thisPerfilesAsig   = $_TUCOACH->get_data("grw_tuc_p2p_asignaciones", " AND id_evaluado = ".$thisEvaluado["id"]." AND id_evaluacion = ".$thisEvaluacion["id"]." AND inactivo = 0 AND eliminado = 0 GROUP BY id_perfil ORDER BY id DESC ", 1);
    $thisAsignaciones   = $_TUCOACH->get_data("grw_tuc_p2p_asignaciones", " AND id_evaluado = ".$thisEvaluado["id"]." AND id_evaluacion = ".$thisEvaluacion["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
    $thisRolesAsig      = $_TUCOACH->get_data("grw_tuc_p2p_asignaciones", " AND id_evaluado = ".$thisEvaluado["id"]." AND id_evaluacion = ".$thisEvaluacion["id"]." AND inactivo = 0 AND eliminado = 0 GROUP BY id_rol ORDER BY id DESC ", 1);
    $thisGrupoPreguntas = $_TUCOACH->get_data("grw_paquete_respuestas", " AND id = ".$thisTest["id_grupopregunta"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);

    // echo '<pre>';
    // print_r($thisRolesAsig);
    // echo '</pre>';


    if($thisEvaluacion == 0)        $motor = $error."la evaluación";
    if($thisEvaluado == 0)          $motor = $error."al evaluado";
    if($thisEmpresa == 0)           $motor = $error."la empresa";
    if($thisTest == 0)              $motor = $error."el test";
    if($thisPerfilesAsig == 0)      $motor = $error."las asignaciones agrupadas por Perfiles";
    if($thisAsignaciones == 0)      $motor = $error."las asignaciones";
    if($thisRolesAsig == 0)         $motor = $error."las asignaciones agrupadas por Roles";
    if($thisGrupoPreguntas == 0)    $motor = $error."el grupo de preguntas";

    $equivalente        = $thisGrupoPreguntas["equivalencia"];


    if($motor === 1){

        $baly = true;

        if($thisRolesAsig){
            foreach($thisRolesAsig AS $thisIDRol){
                $rolesAsignados     = 0;
                $rolesQueEvaluaron  = 0;
                $thisRol = $_TUCOACH->get_data("grw_tuc_roles", " AND id = ".$thisIDRol["id_rol"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
                if($thisRol){
                    foreach($thisAsignaciones AS $thisAsignacion){
                        if($thisAsignacion["id_rol"] == $thisRol["id"]){
                            $rolesAsignados++;
                            if($thisAsignacion["realizado"]){
                                $rolesQueEvaluaron++;
                                $rolesVale[$thisRol["id"]]["id"]        = $thisRol["id"];
                                $rolesVale[$thisRol["id"]]["nombre"]    = $thisRol["nombre"];
                                $rolesVale[$thisRol["id"]]["color"]     = $thisRol["color"];
                                $rolesVale[$thisRol["id"]]["auto"]      = $thisRol["auto"];
                                $rolesVale[$thisRol["id"]]["color"]     = $thisRol["color"];
                                $rolesVale[$thisRol["id"]]["valor"]     = $thisRol["valor"];
                            }
                        }
                    }
                }
            }
        }

        $valorRolesDefecto      = 0;
        $valorRolesEvaluaron    = 0;

        foreach($rolesVale AS $rolesVal) $valorRolesDefecto += $rolesVal["valor"];

        foreach($rolesVale AS $rolesVal){
            $valorRolFinal = ($rolesVal["valor"]*100)/$valorRolesDefecto;
            $rolesVale[$rolesVal["id"]]["valorFinal"] = $valorRolFinal;
            $valorRolesEvaluaron += $valorRolFinal;
        }

        if(count($rolesVale) > 0){
            if($thisPerfilesAsig){
                $valorRolesDefectoCats  = 0;
                $resultadoFinal         = 0;
                foreach($thisPerfilesAsig AS $thisPerfilesAsigIn){
                    $thisCategorias = $_TUCOACH->get_data("grw_tuc_p2p_categorias", " AND id_perfil = ".$thisPerfilesAsigIn["id_perfil"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                    if($thisCategorias){
                        $sumatoria_categorias = 0;
                        foreach($thisCategorias AS $thisCategoria){
                            $allion[$thisCategoria["id"]]["id"] = $thisCategoria["id"];
                            $allion[$thisCategoria["id"]]["nombre"] = $thisCategoria["nombre"];
                            $thisCompetencias = $_TUCOACH->get_data("grw_tuc_p2p_competencias", " AND id_categoria = ".$thisCategoria["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                            if($thisCompetencias){
                                $sumatoria_competencias             = 0;
                                $sumatoria_porcentaje_competencias  = 0;
                                $temSumatoriaSolsCats               = array();
                                foreach($thisCompetencias AS $thisCompetencia){
                                    $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["id"]     = $thisCompetencia["id"];
                                    $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["nombre"] = $thisCompetencia["nombre"];
                                    $thisComportamientos = $_TUCOACH->get_data("grw_tuc_p2p_comportamientos", " AND id_competencia = ".$thisCompetencia["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                                    if($thisComportamientos){
                                        $sumatoria_comportamientos  = 0;
                                        $sumatoria_soluciones_valor = 0;
                                        $temSumatoriaSols           = array();
                                        foreach($thisComportamientos AS $thisComportamiento){
                                            $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["id"]     = $thisComportamiento["id"];
                                            $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["nombre"] = $thisComportamiento["nombre"];
                                            $sumatoria_roles            = 0;
                                            $sumatoria_roles_con_valor  = 0;
                                            foreach($rolesVale AS $losRoles){
                                                if(!isset($temSumatoriaSols[$losRoles["id"]])) $temSumatoriaSols[$losRoles["id"]] = 0;
                                                $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["roles"][$losRoles["id"]]["id"]     = $losRoles["id"];
                                                $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["roles"][$losRoles["id"]]["nombre"] = $losRoles["nombre"];
                                                $soluciones = $_TUCOACH->get_solution(" AND res.id_comportamiento = ".$thisComportamiento["id"]." AND asi.id_evaluado = ".$thisEvaluado["id"]." AND asi.id_rol = ".$losRoles["id"]." AND asi.id_perfil = ".$thisPerfilesAsigIn["id_perfil"]." ", 1);
                                                if($soluciones){
                                                    $cantSol                = 0;
                                                    $sumatoria_soluciones   = 0;
                                                    foreach($soluciones AS $solucion){
                                                        $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["roles"][$losRoles["id"]]["soluciones"][$cantSol]["id"]          = $cantSol;
                                                        $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["roles"][$losRoles["id"]]["soluciones"][$cantSol]["solucion"]    = $solucion["solucion"];
                                                        $sumatoria_soluciones += $solucion["solucion"];
                                                        $cantSol++;
                                                    }
                                                    $promedio_soluciones        = $sumatoria_soluciones/count($soluciones);
                                                    $sumatoria_soluciones_valor = ($promedio_soluciones/100)*$rolesVale[$losRoles["id"]]["valorFinal"];
                                                    $eqPromedio_soluciones      = $promedio_soluciones * $equivalente;
                                                    $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["roles"][$losRoles["id"]]["sumatoria_rol"]  = $sumatoria_soluciones;
                                                    $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["roles"][$losRoles["id"]]["eqPromedio_rol"] = $eqPromedio_soluciones;
                                                    $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["roles"][$losRoles["id"]]["resultado"]      = $promedio_soluciones;
                                                    $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["roles"][$losRoles["id"]]["color"]          = $losRoles["color"];
                                                    $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["roles"][$losRoles["id"]]["auto"]           = $losRoles["auto"];
                                                }
                                                $sumatoria_roles += $promedio_soluciones;
                                                $sumatoria_roles_con_valor += $sumatoria_soluciones_valor;
                                                $temSumatoriaSols[$losRoles["id"]] += $promedio_soluciones;
                                                $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["roles"][$losRoles["id"]]["id"]           = $losRoles["id"];
                                                $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["roles"][$losRoles["id"]]["nombre"]       = $losRoles["nombre"];
                                                $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["roles"][$losRoles["id"]]["color"]        = $losRoles["color"];
                                                $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["roles"][$losRoles["id"]]["auto"]         = $losRoles["auto"];
                                                $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["roles"][$losRoles["id"]]["resultado"]    = $temSumatoriaSols[$losRoles["id"]] / count($thisComportamientos);
                                            }
                                            $promedio_roles_sin_valor   = $sumatoria_roles/count($rolesVale);
                                            $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["sumatoria_comportamiento"]             = $sumatoria_roles;
                                            $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["promedio_comportamiento_sin_valor"]    = $promedio_roles_sin_valor;
                                            $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["resultado"]                            = $sumatoria_roles_con_valor;
                                            $sumatoria_comportamientos          += $sumatoria_roles_con_valor;
                                        }
                                        $promedio_comportamientos     = $sumatoria_comportamientos/count($thisComportamientos);
                                        $porcentaje_comportamientos   = ($promedio_comportamientos/100)*$thisCompetencia["valor"];
                                        $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["sumatoria_compe"]            = $sumatoria_comportamientos;
                                        $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["promedio_compe_porcentaje"]  = $porcentaje_comportamientos;
                                        $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["resultado"]                  = $promedio_comportamientos;
                                        foreach($rolesVale AS $losRoles){
                                            if(!isset($temSumatoriaSolsCats[$losRoles["id"]])) $temSumatoriaSolsCats[$losRoles["id"]] = 0;
                                            $vllion = $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["roles"][$losRoles["id"]]["resultado"];
                                            $temSumatoriaSolsCats[$losRoles["id"]] += $vllion;
                                            $allion[$thisCategoria["id"]]["roles"][$losRoles["id"]]["id"]           = $losRoles["id"];
                                            $allion[$thisCategoria["id"]]["roles"][$losRoles["id"]]["nombre"]       = $losRoles["nombre"];
                                            $allion[$thisCategoria["id"]]["roles"][$losRoles["id"]]["color"]        = $losRoles["color"];
                                            $allion[$thisCategoria["id"]]["roles"][$losRoles["id"]]["auto"]         = $losRoles["auto"];
                                            $allion[$thisCategoria["id"]]["roles"][$losRoles["id"]]["resultado"]    = $temSumatoriaSolsCats[$losRoles["id"]] / count($thisCompetencias);
                                        }
                                    }
                                    $sumatoria_competencias += $promedio_comportamientos;
                                    $sumatoria_porcentaje_competencias += $porcentaje_comportamientos;
                                }
                                $promedio_competencias          = $sumatoria_competencias/count($thisCompetencias);
                                $allion[$thisCategoria["id"]]["sumatoria_categoria"]        = $sumatoria_competencias;
                                $allion[$thisCategoria["id"]]["resultado"]                  = $sumatoria_porcentaje_competencias;
                            }
                            $sumatoria_categorias += $promedio_competencias;
                        }
                        $promedio_categorias   = $sumatoria_categorias/count($thisCategorias);
                    }
                }
                $resultadoFinal = $promedio_categorias;
            }
        }
    }
?>
