<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th>Nombre</th>
                <th>Grupo preguntas</th>
                <th>Perfiles</th>
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
                            $grupopreguntas = $_TUCOACH->get_data("grw_paquete_respuestas", " AND id = ".$listado["id_grupopregunta"]." AND eliminado = 0 ORDER BY id DESC ", 0);
                            if($grupopreguntas) echo ($grupopreguntas["nombre"]);
                        ?>
                    </td>
                    <td class="vM" style="padding:10px !important;">
                        <?php
                            $perfiles = $_TUCOACH->get_data("grw_perfiles", " AND id_test = ".$listado["id"]." AND eliminado = 0 ORDER BY id DESC ", 1);
                            if($perfiles) {
                                foreach($perfiles AS $perfil){
                                    echo '
                                        <div class="tab bS1 mb-1">
                                            <div class="tabIn p510">'.($perfil["nombre"]).'</div>
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