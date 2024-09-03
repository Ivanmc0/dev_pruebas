<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th>Nombre</th>
                <th width="150">Competencia 1</th>
                <th width="150">Competencia 2</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($listados AS $listado){
                    $logros     = explode(",", $listado["logros"]);
                    $logros2    = explode(",", $listado["logros2"]);

            ?>
                <tr id="tr-<?= $listado["id"]; ?>">
                    <td class="vM taC">
                        <?php
                            if($listado["inactivo"] == 0) echo '<i class="la la-check success t24"></i>';
                            if($listado["inactivo"] == 1) echo '<i class="la la-close danger t24"></i>';
                        ?>
                    </td>
                    <td class="vM"><?= ($listado["id"]); ?></td>
                    <td class="vM"><?= ($listado["nombre"]); ?></td>
                    <td class="vM taC" style="padding:10px !important;">
                        <?php
                            foreach($logros AS $key => $logro){
                                echo '
                                    <a href="'.($roution.'w/detalle-grupo_'.$listado["id"].'-'.$logro.'-'.$key.'.zoom').'" class="btn btn-outline-teal btn-sm taL btn-block">
                                        S'.($key+1).": ".($sesiones[$logro]["nombre"]).'
                                    </a>
                                ';
                            }
                        ?>
                    </td>
                    <td class="vM taC" style="padding:10px !important;">
                        <?php
                            foreach($logros2 AS $key => $logro){
                                echo '
                                    <a href="'.($roution.'w/detalle-grupo_'.$listado["id"].'-'.$logro.'-'.$key.'.zoom').'" class="btn btn-outline-teal btn-sm taL btn-block">
                                        S'.($key+1).": ".($sesiones[$logro]["nombre"]).'
                                    </a>
                                ';
                            }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
