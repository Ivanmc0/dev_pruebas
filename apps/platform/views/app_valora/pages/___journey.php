<div class="p50 p30_oS">

    <h5 class="ff0 tU t12 mb10">JOURNEY</h5>
    <h1 class="ff3 cPrimary t30 mb20"><?= ($journey["nombre"]); ?></h1>
    <h3 class="ff1 color666 t16 mb50"><?= ($journey["descripcion"]); ?></h3>

    <?php

        $eventos = $_VALORA->GetEvents('eve.id_valoracion = '.$journey["id"]);

        

        if($strJourney = $_VALORA->LoadJourney($geton[1])){

            echo '<div class="table-responsive">';
            echo '<table class="table table-striped- table-bordered table-hover">';

            echo '<thead>';
            echo '<tr>';
            echo '<th>Etapas</th>';
            foreach ($strJourney["etapas"] as $key => $etapa) {

                echo '<th colspan="'.count($etapa["fases"]).'">'.$etapa["nombre"].'</th>';
            }
            echo '</tr>';

            echo '<tr>';
            echo '<th>Fases</th>';
            foreach ($strJourney["etapas"] as $key => $etapa) {
                foreach ($etapa["fases"] as $key2 => $fase) {
                    echo '<th>'.($fase["nombre"]).'</th>';
                }
            }
            echo '</tr>';
            echo '<tr>';
            echo '<th>Subfases</th>';
            foreach ($strJourney["etapas"] as $key => $etapa) {
                foreach ($etapa["fases"] as $key2 => $fase) {
                    foreach ($fase["subfases"] as $key3 => $subfase) {
                        echo '<th>'.($subfase["nombre"]).'</th>';
                    }
                }
            }
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            if ($strJourney["referentes"]){
                foreach ($strJourney["referentes"] as $key => $referente) {
                    echo '<tr>';
                    echo '<td>'.($referente["nombre"]).'</td>';
                    foreach ($strJourney["etapas"] as $key => $etapa) {
                        foreach ($etapa["fases"] as $key2 => $fase) {
                            foreach ($fase["subfases"] as $key3 => $subfase) {
                                echo '<td style="vertical-align:middle">';
                                if(isset($eventos[$subfase["id"].'_'.$referente["id"]])){
                                    $x       = $subfase["id"];
                                    $y       = $referente["id"];
                                    $momento = $eventos[$x.'_'.$y]["eventos"];
                                    foreach ($momento as $evento) {
                                        include 'app_valora/components/evento.php';
                                    }
                                }
                                echo '<div class="taC"><a href="javascript:void(0);" class="bRojo4 color666 p310 rr10 dIB t10 bHover"><i class="las la-plus-circle"></i> Evento</a></div>';
                                echo '</td>';
                            }
                        }
                    }
                    echo '</tr>';
                }
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';

        }else {
            echo '<div class="alert alert-warning taC" role="alert">No fue posible cargar el Journey solicitado, no se encontraron datos.</div>';
        }


    ?>

</div>