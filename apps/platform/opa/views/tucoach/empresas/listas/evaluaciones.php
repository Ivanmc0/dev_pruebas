<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th>Nombre</th>
                <th>Empresa</th>
                <th>Grupo Test</th>
                <th>Grupo Segmentación</th>
                <th width="100">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listados AS $listado){ ?>
                <tr id="tr-<?= $listado["id"]; ?>">
                    <td class="vM taC">
                        <?php
                            if($listado["inactivo"] == 0) echo '<i class="la la-check success t24"></i>';
                            if($listado["inactivo"] == 1) echo '<i class="la la-close danger t24"></i>';
                        ?>
                    </td>
                    <td class="vM"><?= ($listado["id"]); ?></td>
                    <td class="vM">
                        <?= ($listado["nombre"]); ?><br>
                        <small><?= ($listado["descripcion"]); ?></small>
                    </td>
                    <td class="vM">
                        <?php
                            $empresa = $_TUCOACH->get_data("olc_empresas", " AND id = ".$listado["id_empresa"]." AND eliminado = 0 ORDER BY id DESC ", 0);
                            if($empresa) echo ($empresa["nombre"]);
                        ?>
                    </td>
                    <td class="vM">
                        <?php
                            $test = $_TUCOACH->get_data("grw_tuc_paquetests", " AND id = ".$listado["id_grupotests"]." AND eliminado = 0 ORDER BY id DESC ", 0);
                            if($test) echo ($test["nombre"]);
                        ?>
                    </td>
                    <td class="vM">
                        <?php
                            $gruporoles = $_TUCOACH->get_data("grw_tuc_segmentaciones_grupo", " AND id = ".$listado["id_segmentos"]." AND eliminado = 0 ORDER BY id DESC ", 0);
                            if($gruporoles) echo ($gruporoles["nombre"]);
                        ?>
                    </td>
                    <td class="vM" style="padding:10px !important;"><?php include $roution."views/botones_listas.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>