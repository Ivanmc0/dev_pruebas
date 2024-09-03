

<h1 class="color000 ff3 t50 mb15">Bienvenido <?= $_SESSION["WORKER"]["nombre"]; ?>,</h1>
<h4 class="color666 ff2 t20 mb30">Esto es un resumen de lo que tenemos para ti hoy</h4>

<?php

    $segunda_linea  = [];
    $PeriodoInicial = '2024-01-01 00:00:00';
    $PeriodoFinal   = '2024-12-31 23:59:59';

    if($menu = $_PLATFORM->getOpcionesUsuario($_SESSION["ADMIN"]['id'], $app, " AND model.id_categoria IN ( 0, 1012, 1013, 1014, 1015, 1016, 1017 ) AND model.tipo = 0 ")){

        $datos_company = $_COMPANY->GetDatosPanelControl($_SESSION["COMPANY"]['id']);
        
        
        echo '<div class="row align-items-center mb50">';

        foreach ($menu AS $opcion) {
            if(isset($opcion["hijos"])){
                foreach ($opcion["hijos"] AS $hijo) {
                    if(isset($hijo["hijos"])){
                        foreach ($hijo["hijos"] AS $hijo2) {
                            if(isset($datos_company[$hijo2['id']])){
                                $hijo2["indicador"] = $datos_company[$hijo2['id']];
                                $modelo             = $hijo2;
                                echo '<div class="col-12 col-md-6 col-lg-4 col-xl-4 mb20">';
                                include $roution."views/components/modelo-linea-1.php";
                                echo '</div>';
                            } else $segunda_linea[] = $hijo2;
                        }
                    }else{
                        if(isset($datos_company[$hijo['id']])){
                            $hijo["indicador"] = $datos_company[$hijo['id']];
                            $modelo            = $hijo;
                            echo '<div class="col-12 col-md-6 col-lg-4 col-xl-4 mb20">';
                            include $roution."views/components/modelo-linea-1.php";
                            echo '</div>';
                        } else $segunda_linea[] = $hijo;
                    }
                }
            }
        }
        echo '</div>';


        echo '<h5 class="color333 ff2 t18 mb30">Otras funcionalidades</h5>';

        if(count($segunda_linea) > 0){
            echo '<div class="row">';
            foreach ($segunda_linea AS $modelo) {
                echo '<div class="col-12 col-md-6 col-lg-4 col-xl-6 mb20">';
                include $roution."views/components/modelo-linea-2.php";
                echo '</div>';
            }
            echo '</div>';
        }


    } else echo '<div class="p50 taC t30 ff0 tU">¡Oh! No tienes módulos habilitados.</div>';

?>