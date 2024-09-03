<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th>Nombre</th>
                <th>Identificación</th>
                <th>E-mail</th>
                <th>Celular</th>
                <th>Acceder</th>
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
                        <?= $listado["nombre"];
                        ?>
                    </td>
                    <td class="vM">
                        <div>CC. <?= ($listado["identificacion"]); ?></div>
                        <small>
                            Pass:
                            <?php echo ($listado["password"]) ? '**********' : '<span class="red">Sin contraseña</span>'; ?>
                        </small>
                    </td>
                    <td class="vM"><?= ($listado["email"]); ?></td>
                    <td class="vM"><?= ($listado["celular"]); ?></td>
                    <td class="vM" style="padding:10px !important;"><?php include $roution."views/botones_listas.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
