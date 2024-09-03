<?php

    if(count($allion) > 0){
        foreach($allion AS $categoria){
            if($categoria){
                echo '<div class="tab p20 bg-primary colorfff t24"><div class="tabIn">';
                echo ($categoria["nombre"]);
                echo '</div><div class="tabIn taR t18 tB colorfff">'.round($categoria["resultado"],2).'</div></div>';
                echo '<div class="p10 mb30 posR">';
                echo '<div class="posR">';
                echo '<div class="posA b000" style="width:1px; height:100%; left:'.($thisEvaluacion["nivel_minimo"]*$equivalente).'%; z-index:5"></div>';
                foreach($categoria["roles"] AS $rol){
                    echo '<div class="bfff mb3"><div class="bccc">';
                    echo '<div class="p510 colorfff ff2 t12 tB" style="background-color:'.$rol["color"].'; width:'.$rol["resultado"]*$equivalente.'%;">';
                    echo ($rol["nombre"]);
                    echo '<div class="fR">'.round($rol["resultado"], 2).'</div>';
                    echo '</div></div></div>';
                }
                echo '</div></div>';
            }
        }
    } else echo "No se encontraron datos";


?>