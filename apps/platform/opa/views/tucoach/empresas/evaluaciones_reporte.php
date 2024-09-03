<?php
    $thisEvaluacion     = $_TUCOACH->get_data("grw_tuc_p2b_estudios", " AND id = ".$id." AND eliminado = 0 ORDER BY id DESC ", 0);

    if($thisEvaluacion){
        require_once('reporte_empresa.php');
        if($motor === 1){
?>

<!-- <pre><?php print_r($allion); ?></pre> -->

    <br>
    <div class="content-body">

        <div class="card" style="overflow:auto;">
            <div class="card-content collapse show">
                <div class="card-header">
                    <h4 class="card-title">Evaluado</h4>
                </div>
                <div class="p20">
                    <div class="fR taR">
                        <div class="color666 t14 mb3">Trabajadores asignados</div>
                        <div class="secundary t16 tB mb20"><?= count($thisAsignacionesOK); ?> / <?= count($thisAsignaciones); ?></div>
                    </div>
                    <div class="primary t16 tB mb3"><?= ($thisEmpresa["nombre"]); ?></div>
                    <div class="t14 tB mb20"><?= ($thisEmpresa["descripcion"]); ?></div>
                </div>
            </div>
        </div>


        <!-- <div class="card p30">
            <div class="row align-items-center">
                <div class="col-12 col-md-2">
                    <div class="t40 tB taR"><?= round($resultadoFinal, 2); ?></div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="primary t16 tB mb3">Calificación global</div>
                    <div class="color666 t14">Mínimo requerido: <?= ($thisEvaluacion["nivel_minimo"]); ?></div>
                </div>
                <div class="col-12 col-md-7 taR">
                    <?php
                        foreach($rolesVale AS $rolesVal){
                            echo ' <div class="dIB colorfff t12 p510 rr20" style="background-color:'.($rolesVal["color"]).';">';
                            echo ($rolesVal["nombre"]." - ".round($rolesVal["valorFinal"], 2))."%";
                            echo '</div> ';
                        }
                    ?>
                </div>
            </div>
        </div> -->

        <?php include "reporte_gra3.php";?>

        <pre><?php //print_r($allion); ?></pre>
        <pre><?php //print_r($rolesVale); ?></pre>


<?php
        } else echo "<div class='card taC pAA50 t30'>".$motor."</div>";
    } else echo "<div class='card taC pAA50 t30'>"."ERROR: reporte que busca no existe."."</div>";
?>