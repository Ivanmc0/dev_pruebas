<?php

    if(count($allion) > 0){
        foreach($allion AS $categoria){
            if($categoria){
                echo '<div class="p20 bg-primary colorfff t24">';
                echo ($categoria["nombre"]);
                echo '</div>';
                foreach($categoria["competencias"] AS $competencia){
                    echo '<div class="tab beee p1530 primary t18"><div class="tabIn">';
                    echo ($competencia["nombre"]);
                    echo '</div></div>';
                    echo '<div class="mb30">';

                    foreach($competencia["comportamientos"] AS $comportamiento){
                        echo '<div class="tab p2030 t16"><div class="tabIn">';
                        echo ($comportamiento["nombre"]);
                        echo '</div><div class="tabIn taR t18 tB primary">'.round($comportamiento["resultado"],2).'</div></div>';
                        echo '<div class="pLR30"><div class="posR">';
                        echo '<div class="posA b000" style="width:1px; height:100%; left:'.($thisEvaluacion["nivel_minimo"]*$equivalente).'%; z-index:5"></div>';
                        foreach($comportamiento["roles"] AS $rol){
                            echo '<div class="bfff mb3"><div class="bccc">';
                            echo '<div class="p510 colorfff ff2 t12 tB" style="background-color:'.$rol["color"].'; width:'.$rol["resultado"]*$equivalente.'%;">';
                            echo ($rol["nombre"]);
                            echo '<div class="fR">'.round($rol["resultado"], 2).'</div>';
                            echo '</div></div></div>';
                        }
                        echo '</div></div>';
                    }
                    echo '</div>';
                }
            }
        }
    } else echo "No se encontraron datos";


?>