
<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th>Evaluado</th>
                <th>Asignaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($reportes AS $reporte){
                    $thisEvaluado = $_TUCOACH->get_data("zoom_users", " AND id = ".$reporte["id_trabajador"]." AND eliminado = 0 ", 0);
            ?>
                <tr>
                    <td class="vM"><?php if($thisEvaluado) echo ($thisEvaluado["nombre"]); ?></td>
                    <td class="vM"><?php echo ($reporte["id_evaluacion"]); ?></td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>