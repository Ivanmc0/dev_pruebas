<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">

        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th width="50">Orden</th>
                <th>Nombre</th>
                <th>Respuestas</th>
                <th width="100">Opciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($listados as $listado) {
                $getMod         = $_ZOOM->get_data('grw_lel_dinamicas', " AND id = " . $listado["id_dinamica"] . " ORDER BY id DESC ", 0);
            ?>
                <tr id="tr-<?= $listado["id"]; ?>">
                    <td class="vM taC">
                        <?php
                        if ($listado["inactivo"] == 0) echo '<i class="la la-check success t24"></i>';
                        if ($listado["inactivo"] == 1) echo '<i class="la la-close danger t24"></i>';
                        ?>
                    </td>
                    <td class="vM"><?= ($listado["id"]); ?></td>
                    <td class="vM"><?= ($listado["prioridad"]); ?></td>
                    <td class="vM">
                        <?= ($listado["nombre"]); ?>
                        <?php $getModo = $_ZOOM->get_data("olc_preguntas_tipos",  " AND id = " . $listado["id_modo"] . " AND inactivo = 0 AND eliminado = 0 ", 0);
                        if ($getModo) echo '<br><small><b>Modo:</b> ' . ($getModo["nombre"]) . '</small>'; ?>
                    </td>
                    <td class="vM">
                        <ul>
                            <?php
                            if ($listado["id_modo"] != 5) {
                                $getRespuestas = $_ZOOM->get_data("grw_lel_respuestas", " AND id_pregunta = " . $listado["id"] . " AND inactivo = 0 AND eliminado = 0 ", 1);
                                if ($getRespuestas) {
                                    foreach ($getRespuestas as $resp) {

                                        echo '<li>' . $resp['nombre'];
                                        if ($getMod["id_tipo"] == 1) {
                                            if ($resp["correcta"] == 0) echo '<i class="la la-close danger t18"></i>';
                                            if ($resp["correcta"] == 1) echo '<i class="la la-check success t18"></i>';
                                        }
                                        echo '</li>';
                                    }
                                }
                            } else {
                                echo 'Respuesta abierta';
                            }
                            ?>
                        </ul>
                    </td>
                    <td class="vM" style="padding:10px !important;"><?php include $roution . "views/botones_preguntas.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>