<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th>Nombre</th>
                <th>Opciones</th>
                <th width="100">Acciones</th>
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
                    <td class="vM"><?= ($listado["nombre"]); ?></td>
                    <td class="vM" style="padding:10px !important;">
                        <?php
                            $contenidos = $_ZOOM->get_data("grw_segmentos", " AND id_parametro = ".$listado["id"]." AND eliminado = 0  ORDER BY id_empresa ASC, nombre ", 1);
                            if($contenidos) {
                                foreach($contenidos AS $contenido){
                                    echo '
                                        <div class="tab bS1 mb-1">
                                            <div class="tabIn p510">'.($contenido["nombre"]).'</div>
                                        </div>
                                    ';
                                }
                            } else echo "Sin datos";
                        ?>
                    </td>
                    <td class="vM" style="padding:10px !important;"><?php include $roution."views/botones_listas_genericos.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>