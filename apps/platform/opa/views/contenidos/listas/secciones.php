<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th class="taC" width="100" style="padding-left:0; padding-right:0;">Imagen</th>
                <th>Título 1</th>
                <th>Título 2</th>
                <th>Título 3</th>
                <th>Título 4</th>
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
                                echo '<img src="'.$rutaStatic.'secciones/'.($listado["imagen"]).'" class="w100x" />';
                            } else echo '<img src="'.$sinImagen.'" class="w100x" />';
                        ?>
                    </td>
                    <td class="vM">
                        <?= ($listado["titulo1"]); ?><br>
                        <small><?= ($listado["url1"]); ?></small>
                    </td>
                    <td class="vM">
                        <?= ($listado["titulo2"]); ?><br>
                        <small><?= ($listado["url2"]); ?></small>
                    </td>
                    <td class="vM">
                        <?= ($listado["titulo3"]); ?><br>
                        <small><?= ($listado["url3"]); ?></small>
                    </td>
                    <td class="vM">
                        <?= ($listado["titulo4"]); ?><br>
                        <small><?= ($listado["url4"]); ?></small>
                    </td>
                    <td class="vM" style="padding:10px !important;"><?php include $roution."views/botones_listas.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
