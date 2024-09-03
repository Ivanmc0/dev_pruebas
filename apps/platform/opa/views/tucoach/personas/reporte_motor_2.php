<?php

    $motor              = 1;
    $error              = "ERROR: Consultando ";
    $resultadoFinal     = 0;

    $thisEvaluacion     = $_TUCOACH->get_data("grw_tuc_p2p_estudios", " AND id = ".$reporte["id_evaluacion"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
    $thisEvaluado       = $_TUCOACH->get_data("zoom_users", " AND id = ".$reporte["id_trabajador"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
    $thisEmpresa        = $_TUCOACH->get_data("olc_empresas", " AND id = ".$thisEvaluacion["id_empresa"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
    $thisTest           = $_TUCOACH->get_data("grw_tuc_p2p_tests", " AND id = ".$thisEvaluacion["id_test"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
    $thisPerfilesAsig   = $_TUCOACH->get_data("grw_tuc_p2p_asignaciones", " AND id_evaluado = ".$thisEvaluado["id"]." AND id_evaluacion = ".$thisEvaluacion["id"]." AND inactivo = 0 AND eliminado = 0 GROUP BY id_perfil ORDER BY id DESC ", 1);
    $thisAsignaciones   = $_TUCOACH->get_data("grw_tuc_p2p_asignaciones", " AND id_evaluado = ".$thisEvaluado["id"]." AND id_evaluacion = ".$thisEvaluacion["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
    $thisRolesAsig      = $_TUCOACH->get_data("grw_tuc_p2p_asignaciones", " AND id_evaluado = ".$thisEvaluado["id"]." AND id_evaluacion = ".$thisEvaluacion["id"]." AND inactivo = 0 AND eliminado = 0 GROUP BY id_rol ORDER BY id DESC ", 1);
    $thisGrupoPreguntas = $_TUCOACH->get_data("grw_paquete_respuestas", " AND id = ".$thisTest["id_grupopregunta"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);

    if($thisEvaluacion == 0)        $motor = $error."la evaluación";
    if($thisEvaluado == 0)          $motor = $error."al evaluado";
    if($thisEmpresa == 0)           $motor = $error."la empresa";
    if($thisTest == 0)              $motor = $error."el test";
    if($thisPerfilesAsig == 0)      $motor = $error."las asignaciones agrupadas por Perfiles";
    if($thisAsignaciones == 0)      $motor = $error."las asignaciones";
    if($thisRolesAsig == 0)         $motor = $error."las asignaciones agrupadas por Roles";
    if($thisGrupoPreguntas == 0)    $motor = $error."el grupo de preguntas";

    if($motor === 1){

        $rolesVale = array();
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
            if($thisPerfilesAsig){
                $valorRolesDefectoCats = 0;
                foreach($thisPerfilesAsig AS $thisIDPerfil){
                    $thisCategorias = $_TUCOACH->get_data("grw_tuc_p2p_categorias", " AND id_perfil = ".$thisIDPerfil["id_perfil"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                    if($thisCategorias){
                        $cCats = 0;
                        foreach($thisCategorias AS $thisCategoria){
                            $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["id"]       = $thisCategoria["id"];
                            $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["nombre"]   = $thisCategoria["nombre"];
                            $thisCompetencias = $_TUCOACH->get_data("grw_tuc_p2p_competencias", " AND id_categoria = ".$thisCategoria["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                            if($thisCompetencias){
                                $cCompe = 0;
                                foreach($thisCompetencias AS $thisCompetencia){
                                    $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["id"]       = $thisCompetencia["id"];
                                    $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["nombre"]   = $thisCompetencia["nombre"];
                                    $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["valor"]    = $thisCompetencia["valor"];
                                    $thisComportamientos = $_TUCOACH->get_data("grw_tuc_p2p_comportamientos", " AND id_competencia = ".$thisCompetencia["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                                    if($thisComportamientos){
                                        $cComps = 0;
                                        foreach($thisComportamientos AS $thisComportamiento){
                                            $solucion = $_TUCOACH->get_solution(" AND res.id_comportamiento = ".$thisComportamiento["id"]." AND asi.id_evaluado = ".$thisEvaluado["id"]." AND asi.id_rol = ".$rolesVal["id"]." AND asi.id_perfil = ".$thisIDPerfil["id_perfil"]." ", 0);
                                            if($solucion){
                                                $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["id"]       = $thisComportamiento["id"];
                                                $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["nombre"]   = $thisComportamiento["nombre"];
                                                $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["solucion"] = $solucion["solucion"];
                                                $cComps += $solucion["solucion"];
                                            }
                                        }
                                        $cCompsProm     = $cComps/count($thisComportamientos);
                                        $cCompsValor    = ($cCompsProm/100)*$thisCompetencia["valor"];
                                        $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["sumatoria"]                 = $cComps;
                                        $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["resultado_comportamientos"] = $cCompsProm;
                                        $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["promedio_valor"]            = $cCompsValor;
                                    }
                                    $cCompe += $cCompsValor;
                                }
                                $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["resultado_competencias"] = $cCompe;
                            }
                            $cCats      += $cCompe;
                        }
                        $cCatsProm   = $cCats/count($thisCategorias);
                        $cRolsValor  = ($cCatsProm/100)*$valorRolFinal;
                        $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["resultado_categorias"] = $cCatsProm;
                        $rolesVale[$rolesVal["id"]]["categorias"][$thisCategoria["id"]]["resultado_cat_rol"]    = $cRolsValor;
                        $valorRolesDefectoCats += $cCatsProm;
                    }
                }
                $resultadoFinal += $cRolsValor;
            }
        }
    }
?>