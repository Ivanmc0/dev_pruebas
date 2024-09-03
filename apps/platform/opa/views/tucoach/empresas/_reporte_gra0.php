<?php
    $allion = array();

    if($thisPerfilesAsig){
        $valorRolesDefectoCats  = 0;
        $resultadoFinal         = 0;
        foreach($thisPerfilesAsig AS $thisPerfilesAsigIn){
            $ion++;
            $thisCategorias = $_TUCOACH->get_data("grw_tuc_p2p_categorias", " AND id_perfil = ".$thisPerfilesAsigIn["id_perfil"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
            if($thisCategorias){
                $sumatoria_categorias = 0;
                foreach($thisCategorias AS $thisCategoria){
$allion[$thisCategoria["id"]]["id"] = $thisCategoria["id"];
$allion[$thisCategoria["id"]]["nombre"] = $thisCategoria["nombre"];
                    echo '<div class="row"><div class="col-12"><div class="p20 bg-primary colorfff t24">';
                    echo ($thisCategoria["nombre"]);
                    echo '</div></div></div>';
                    $thisCompetencias = $_TUCOACH->get_data("grw_tuc_p2p_competencias", " AND id_categoria = ".$thisCategoria["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                    if($thisCompetencias){
                        $sumatoria_competencias             = 0;
                        $sumatoria_porcentaje_competencias  = 0;
                        $temSumatoriaSolsCats               = array();
                        foreach($thisCompetencias AS $thisCompetencia){

$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["id"]     = $thisCompetencia["id"];
$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["nombre"] = $thisCompetencia["nombre"];

                            echo '<div class="row"><div class="col-12"><div class="beee p1530 primary t18">';
                            echo ($thisCompetencia["nombre"]);
                            echo '</div></div></div>';
                            $thisComportamientos = $_TUCOACH->get_data("grw_tuc_p2p_comportamientos", " AND id_competencia = ".$thisCompetencia["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
                            if($thisComportamientos){
                                $sumatoria_comportamientos  = 0;
                                $sumatoria_soluciones_valor = 0;
                                $temSumatoriaSols           = array();
                                foreach($thisComportamientos AS $thisComportamiento){

$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["id"]     = $thisComportamiento["id"];
$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["nombre"] = $thisComportamiento["nombre"];

                                    echo '<div class="p20"><div class="row align-items-center"><div class="col-4 t16">';
                                    echo ($thisComportamiento["nombre"]);
                                    echo '</div>';
                                    echo '<div class="col-8">';
                                    $sumatoria_roles            = 0;
                                    $sumatoria_roles_con_valor  = 0;
                                    foreach($rolesVale AS $losRoles){

$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["roles"][$losRoles["id"]]["id"]     = $losRoles["id"];
$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["roles"][$losRoles["id"]]["nombre"] = $losRoles["nombre"];

                                        echo '<div class="p5 bfff"><div class="bccc">';

                                        $soluciones = $_TUCOACH->get_solution(" AND res.id_comportamiento = ".$thisComportamiento["id"]." AND asi.id_rol = ".$losRoles["id"]." AND asi.id_perfil = ".$thisPerfilesAsigIn["id_perfil"]." ", 1);
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

                                            echo '<div class="p510 colorfff ff2 t12 tB" style="background-color:'.($losRoles["color"]).'; width:'.$eqPromedio_soluciones.'%;">';
                                            echo ($losRoles["nombre"]);
                                            echo '<div class="fR">'.round($promedio_soluciones, 2).'</div>';
                                            echo '</div>';
                                        }
                                        echo '</div></div>';
                                        $sumatoria_roles += $promedio_soluciones;
                                        $sumatoria_roles_con_valor += $sumatoria_soluciones_valor;

                                        $temSumatoriaSols[$losRoles["id"]] += $promedio_soluciones;

$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["roles"][$losRoles["id"]]["id"]               = $losRoles["id"];
$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["roles"][$losRoles["id"]]["nombre"]           = $losRoles["nombre"];
$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["roles"][$losRoles["id"]]["resultado_rol"]    = $temSumatoriaSols[$losRoles["id"]] / count($thisComportamientos);




                                    }



                                    $promedio_roles_sin_valor   = $sumatoria_roles/count($rolesVale);
                                    $eqResultado                = $promedio_roles * $equivalente;




$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["sumatoria_comportamiento"]             = $sumatoria_roles;
$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["promedio_comportamiento_sin_valor"]    = $promedio_roles_sin_valor;
$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["comportamientos"][$thisComportamiento["id"]]["resultado"]                            = $sumatoria_roles_con_valor;

echo '<div class="bS1 p5 taC mb20"><strong>COMPORTAMIENTO |</strong> Resultado: '.$sumatoria_roles_con_valor.' -> sin valr: '.$promedio_roles_sin_valor.'</div>';

                                    echo '</div></div></div>';
                                    $sumatoria_comportamientos          += $sumatoria_roles_con_valor;




                                }

                                $promedio_comportamientos     = $sumatoria_comportamientos/count($thisComportamientos);
                                $porcentaje_comportamientos   = ($promedio_comportamientos/100)*$thisCompetencia["valor"];

$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["sumatoria_compe"]            = $sumatoria_comportamientos;
$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["promedio_compe_porcentaje"]  = $porcentaje_comportamientos;
$allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["resultado"]                  = $promedio_comportamientos;


echo '<div class="bS1 p10 taC mb20"><strong>COMPETENCIA |</strong>Resultado: '.$promedio_comportamientos.'</div>';
echo '<div class="bS1 p10 taC mb20"><strong>Graficos</strong><hr>';
foreach($rolesVale AS $losRoles){

    $vllion = $allion[$thisCategoria["id"]]["competencias"][$thisCompetencia["id"]]["roles"][$losRoles["id"]]["resultado_rol"];

    echo '<div class="p510 colorfff ff2 t12 tB" style="background-color:'.($losRoles["color"]).'; width:'.$vllion*$equivalente.'%;">';
    echo ($losRoles["nombre"]);
    echo '<div class="fR">'.round($vllion, 2).'</div>';
    echo '</div>';


    $temSumatoriaSolsCats[$losRoles["id"]] += $vllion;

    $allion[$thisCategoria["id"]]["roles"][$losRoles["id"]]["id"]               = $losRoles["id"];
    $allion[$thisCategoria["id"]]["roles"][$losRoles["id"]]["nombre"]           = $losRoles["nombre"];
    $allion[$thisCategoria["id"]]["roles"][$losRoles["id"]]["resultado_rol"]    = $temSumatoriaSolsCats[$losRoles["id"]] / count($thisCompetencias);


}
echo '</div>';

                            }
                            $sumatoria_competencias += $promedio_comportamientos;
                            $sumatoria_porcentaje_competencias += $porcentaje_comportamientos;
                        }

                        $promedio_competencias          = $sumatoria_competencias/count($thisCompetencias);

$allion[$thisCategoria["id"]]["sumatoria_categoria"]        = $sumatoria_competencias;
$allion[$thisCategoria["id"]]["resultado"]                  = $sumatoria_porcentaje_competencias;

                        echo '<div class="bS1 p10 taC mb20"><strong>CATEGORÍA |</strong> Resultado: '.$sumatoria_porcentaje_competencias.'</div>';
                        echo '<div class="bS1 p10 taC mb20"><strong>Graficos</strong><hr>';
                        foreach($rolesVale AS $losRoles){

                            $vllionCat = $allion[$thisCategoria["id"]]["roles"][$losRoles["id"]]["resultado_rol"];

                            echo '<div class="p510 colorfff ff2 t12 tB" style="background-color:'.($losRoles["color"]).'; width:'.$vllionCat*$equivalente.'%;">';
                            echo ($losRoles["nombre"]);
                            echo '<div class="fR">'.round($vllionCat, 2).'</div>';
                            echo '</div>';

                        }
                        echo '</div>';

                    }
                    $sumatoria_categorias += $promedio_competencias;
                }
                $promedio_categorias   = $sumatoria_categorias/count($thisCategorias);
                echo '<div class="bS1 p10 taC mb20"><strong>Resultado Final:</strong> '.$promedio_categorias.'</div>';
            }
        }
        $resultadoFinal = $promedio_categorias;
    }



?>