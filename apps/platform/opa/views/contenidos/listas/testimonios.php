<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th class="taC" width="100" style="padding-left:0; padding-right:0;">Imagen</th>
                <th>Testigo</th>
                <th>Cargo / Empresa</th>
                <th>Testimonio</th>
                <th>Prioridad</th>
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
                                echo '<img src="'.$rutaStatic.'testimonios/s/'.($listado["imagen"]).'" class="w100x" />';
                            } else echo '<img src="'.$sinImagen.'" class="w100x" />';
                        ?>
                    </td>
                    <td class="vM"><?= ($listado["nombre"]); ?></td>
                    <td class="vM"><?= ($listado["cargo"]); ?></td>
                    <td class="vM"><?= ($listado["testimonio"]); ?></td>
                    <td class="vM"><?= ($listado["prioridad"]); ?></td>
                    <td class="vM" style="padding:10px !important;"><?php include $roution."views/botones_listas.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
