<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">

        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th width="50">Orden</th>
                <th>Nombre</th>
                <th>Correcta</th>
                <th width="100">Opciones</th>
            </tr>
        </thead>

        <tbody>
            <?php

            foreach ($listados as $listado) {
                $getModelo      = $_ZOOM->get_data('grw_lel_preguntas', " AND id = " . $listado['id_pregunta'] . " ORDER BY id DESC ", 0);
                $getMod         = $_ZOOM->get_data('grw_lel_dinamicas', " AND id = " . $getModelo['id_dinamica'] . " ORDER BY id DESC ", 0);
                $tipo           = $getMod['id_tipo'];
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
                    <td class="vM"><?= ($listado["nombre"]); ?></td>
                    <td class="vM"><?php
                                    if ($tipo == 1) {
                                        if ($listado["correcta"] == 0) echo '<i class="la la-close danger t18"></i>';
                                        if ($listado["correcta"] == 1) echo '<i class="la la-check success t18"></i>';
                                    } else echo 'Sin respuestas correctas'
                                    ?></td>
                    <td class="vM" style="padding:10px !important;"><?php include $roution . "views/botones_listas.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>