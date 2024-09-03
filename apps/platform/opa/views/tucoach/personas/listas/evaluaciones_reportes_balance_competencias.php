<style>

    .wXXX { width:100px; }

</style>

<div class="table-responsive mb10">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr class="vM">
                <th class="vM tU wXXX0 t10" style="padding:10px;"><div class="wXXX" style="white-space:break-spaces;">Trabajadores</div></th>
                <?php
                    foreach($competencias AS $competencia){
                        echo '<th class="vM tU wXXX0 t10" style="padding:10px;"><div class="wXXX" style="white-space:break-spaces;">'.($competencia["nombre"]).'</div></th>';
                    }
                ?>
                <th class="vM tU wXXX0 t10" style="padding:10px;"><div class="wXXX" style="white-space:break-spaces;">General</div></th>

            </tr>
        </thead>
        <tbody>




                <!-- <td class="vM" style="padding:10px;"><div class="wXXX t12" style="white-space:break-spaces;">Empleado</div></td> -->

                <?php
                    $cont[$perfil["id"]]    = 0;
                    foreach($reportes AS $reporte){
                        $blc_sumatoria          = 0;
                        $blc_contador           = 0;
                        $blc_promedio           = 0;
                        $asignacion = $_TUCOACH->get_data("grw_tuc_p2p_asignaciones", " AND id_evaluacion = ".$id." AND id_perfil = ".$perfil["id"]." AND id_evaluado = ".$reporte["id_trabajador"]." AND inactivo = 0 AND eliminado = 0  ORDER BY id DESC ", 1);
                        if($asignacion){
                            $cont[$perfil["id"]]++;
                            $baly = false;
                            include "/var/www/apps/platform/opa/views/tucoach/personas/reporte_motor.php";
                            

                ?>
                            <tr>
                                <td class="vM" style="padding:10px;">
                                    <div class="wXXX t12">
                                        <?php //echo __DIR__ ?>
                                        <!-- <?= $reporte["id_trabajador"]; ?> -->
                                        <?= ($thisEvaluado["nombre"]); ?>
                                    </div>
                                </td>
                                <?php
                                    if($baly){
                                        foreach($competencias AS $competencia){
                                            $blc_sumatoria += $allion[$competencia["id_categoria"]]["competencias"][$competencia["id"]]["resultado"];
                                            $blc_contador  += 1;

                                            echo '<td class="vM tB" style="padding:10px;"><div class="wXXX t12" style="white-space:break-spaces;">'.round($allion[$competencia["id_categoria"]]["competencias"][$competencia["id"]]["resultado"], 2).'</div></td>';
                                        }
                                        $blc_promedio = $blc_sumatoria/$blc_contador;
                                    }
                                ?>
                                <td class="vM tB" style="padding:10px;">
                                    <div class="wXXX t12">
                                        <?php //if($baly) echo round($resultadoFinal, 2); ?>
                                        <?php //if($baly) echo round($blc_sumatoria, 2); ?>
                                        <?php //if($baly) echo round($blc_contador, 2); ?>
                                        <?php if($baly) echo round($blc_promedio, 2); ?>
                                        <?php
                                            // echo '<pre>';
                                            // print_r($reporte);
                                            // echo '</pre>';
                                        ?>
                                    </div>
                                </td>
                            </tr>
                <?php
                        }
                    }
                    //
                    //
                    //
                    if($cont[$perfil["id"]] > 0) $lector.= '<script> $( document ).ready(function() {  $("#perfilion'.$perfil["id"].'").slideDown(); }); </script>';
                ?>

                <!-- <td class="vM" style="padding:10px;"><div class="wXXX t12" style="white-space:break-spaces;">-</div></td> -->



        </tbody>
    </table>
</div>