<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">

        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">Icono</th>
                <th>Nombre</th>
                <th>Código</th>
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
                        <small><?= $listado["id"]; ?></small>
                    </td>
                    <td class="vM taC" style="padding:3px; color:FireBrick;"><i class="<?= ($listado["icono"]); ?> t30"></i></td>
                    <td class="vM"><?= ($listado["nombre"]); ?></td>
                    <td class="vM"><?= ($listado["icono"]); ?></td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>