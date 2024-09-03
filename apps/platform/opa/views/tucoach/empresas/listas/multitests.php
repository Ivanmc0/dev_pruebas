<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th>Nombre</th>
                <th>Tests</th>
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
                            $tests = $_TUCOACH->get_grupo_tests(" AND multi.id = ".$listado["id"]." ORDER BY id DESC ", 1);
                            if($tests) {
                                foreach($tests AS $test){
                                    echo '
                                        <div class="tab bS1 mb-1" id="tr-'.$test["id_rel"].'">
                                            <div class="tabIn p510">'.($test["id"]).'</div>
                                            <div class="tabIn p510">'.($test["nombre"]).'</div>
                                            <div class="tabIn p510 taR"><a href="#" onClick="Zoom.changeDelete(\'grw_tuc_paquetes_tests\', '.$test["id_rel"].')" class="btn btn-outline-danger btn-sm" title="'.($boton["modulo"]).'"><i class="la la-trash t16"></i></a></div>
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