
<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th>Evaluado</th>
                <th>Asignaciones</th>
                <th width="150">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($evaluados AS $evaluado){
                    $thisEvaluado = $_TUCOACH->get_data("zoom_users", " AND id = ".$evaluado["id_evaluado"]." AND eliminado = 0 ", 0);
            ?>
                <tr>
                    <td class="vM"><?php if($thisEvaluado) echo ($thisEvaluado["nombre"]); ?></td>
                    <td class="vM" style="padding:10px !important;">
                        <?php
                            $complemento = " AND id_evaluado = ".$evaluado["id_evaluado"]." ";
                            $listados = $_TUCOACH->get_data($access_model["tabla"], $complemento." AND eliminado = 0 ORDER BY id DESC ", 1);
                            if($listados) include "evaluaciones_reportes_in.php";
                            else echo '<div class="card-title t30 taC p50">No hay registros</div>';
                        ?>
                    </td>
                    <td class="vM taC" style="padding:10px !important;">
                        <div class="btn-group" role="group">
                            <?php
                                $thisReporte = $_TUCOACH->get_data("grw_tuc_p2p_reportes", " AND id_evaluacion = ".$id." AND id_trabajador = ".$thisEvaluado["id"]." AND eliminado = 0 ", 0);
                                if($thisReporte){ if($_TUCOACH->permission($rol, 165)){
                            ?>
                                <a href="reporte_<?= $thisReporte["id"]; ?>.zoom" class="btn btn-outline-info btn-sm" title="Ver reporte">
                                    <i class="la la-bar-chart t12"></i>
                                    Ver reporte
                                </a>
                            <?php }}else{ if($_TUCOACH->permission($rol, 164)){ ?>
                                <button onclick="Zoom.createReport(<?= $id; ?>, <?= $thisEvaluado['id']; ?>)" class="btn btn-outline-success btn-sm" title="Iniciar reporte">
                                    <i class="la la-external-link-square t12"></i>
                                    Crear reporte
                                </button>
                            <?php }} ?>
                        </div>
                        <div id="rtn_report_<?= $id; ?>_<?= $thisEvaluado['id']; ?>"></div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>