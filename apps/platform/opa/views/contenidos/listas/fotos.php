<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th class="taC" width="100" style="padding-left:0; padding-right:0;">Imagen</th>
                <th>Prioridad</th>
                <th width="100">Visualizar</th>
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
                    <td class="vM taC" style="padding:0 !important;">
                        <?php
                            if($listado["imagen"] != ""){
                                $imgggL = $rutaStatic.'galerias/l/'.($listado["imagen"]);
                                $imggg = $rutaStatic.'galerias/s/'.($listado["imagen"]);
                            } else $imggg  = $sinImagen;
                        ?>
                        <img src="<?= $imggg; ?>" class="w100x" />
                    </td>
                    <td class="vM"><?= ($listado["prioridad"]); ?></td>
                    <td class="vM taC"><a href="<?= $imgggL; ?>" target="_blank" class="btn btn-primary btn-sm">Visualizar</a></td>
                    <td class="vM" style="padding:10px !important;"><?php include $roution."views/botones_listas.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
