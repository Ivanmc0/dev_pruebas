<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    ini_set('max_execution_time', '0');
?>



<div class="content-body">

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-header">
                <div id="rtn_list" class="fR taR"></div>
                <h4 class="card-title">
                    <?= ($access_model["modulo"]); ?>
                    por Competencias:
                    <strong>
                        <?php
                            $eval = $_TUCOACH->get_data("grw_tuc_p2p_estudios", " AND id = ".$id." AND eliminado = 0 ORDER BY id DESC ", 0);
                            if($eval) echo ($eval["nombre"]);
                        ?>
                    </strong>
                </h4>
            </div>

            <?php
                if($id != 0) $complemento = " AND id_evaluacion = $id "; else $complemento = "";
                $reportes = $_TUCOACH->get_data($access_model["tabla"], $complemento." AND eliminado = 0  ORDER BY id DESC ", 1);

                if($eval){
                    $perfiles = $_TUCOACH->get_data("grw_perfiles", " AND id_test = ".$eval["id_test"]." AND eliminado = 0  ORDER BY id DESC ", 1);
                    if($perfiles) include "listas/evaluaciones_reportes_balance_perfiles.php";
                    else echo '<div class="card-title t30 taC p50">No hay registros</div>';
                }
            ?>
        </div>
    </div>


</div>