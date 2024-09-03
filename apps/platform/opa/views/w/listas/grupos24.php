<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th>Grupo</th>
                <th>Competencias</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($listados AS $listado){
            ?>
                <tr id="tr-<?= $listado["id"]; ?>">
                    <td class="vM taC">
                        <?php
                            if($listado["inactivo"] == 0) echo '<i class="la la-check success t24"></i>';
                            if($listado["inactivo"] == 1) echo '<i class="la la-close danger t24"></i>';
                        ?>
                    </td>
                    <td class="vM"><?= ($listado["id"]); ?></td>
                    <td class="vM">Grupo <?= ($listado["nombre"]); ?></td>
                    <td class="vM" style="padding:10px !important;">
                        <?php
                            foreach($sesiones AS $key => $sesion){
                                echo '
                                    <a href="'.($roution.'w/detalle-grupo24_'.$listado["id"].'-'.$sesion["id"].'-'.$key.'.zoom').'" class="btn btn-outline-teal btn-sm taL">
                                        Sesión: '.($key-10).": ".($sesion["nombre"]).'
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
