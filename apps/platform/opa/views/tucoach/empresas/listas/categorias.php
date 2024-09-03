<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th>Nombre</th>
                <th>Competencias</th>
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
                    <td class="vM" style="padding:10px !important;">
                        <?php
                            $competencias = $_TUCOACH->get_data("grw_tuc_p2b_competencias", " AND id_categoria = ".$listado["id"]." AND eliminado = 0 ORDER BY id DESC ", 1);
                            if($competencias) {
                                foreach($competencias AS $competencia){
                                    echo '
                                        <div class="tab bS1 mb-1">
                                            <div class="tabIn p510">'.($competencia["nombre"]).'</div>
                                        </div>
                                    ';
                                }
                            } else echo "Sin datos";
                        ?>
                    </td>
                    <td class="vM" style="padding:10px !important;"><?php include $roution."views/botones_listas.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>