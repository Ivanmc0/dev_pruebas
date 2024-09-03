<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th>Nombre</th>
                <th>Color</th>
                <th>Autoevaluación</th>
                <th>Valor</th>
                <th width="100">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $valion = 0; foreach($listados AS $listado){ ?>
                <tr id="tr-<?= $listado["id"]; ?>">
                    <td class="vM taC">
                        <?php
                            if($listado["inactivo"] == 0) echo '<i class="la la-check success t24"></i>';
                            if($listado["inactivo"] == 1) echo '<i class="la la-close danger t24"></i>';
                        ?>
                    </td>
                    <td class="vM"><?= ($listado["id"]); ?></td>
                    <td class="vM"><?= ($listado["nombre"]); ?></td>
                    <td class="vM"><div class="rr50 wh30 mAUTO" style="background-color:<?= ($listado["color"]); ?>"></div></td>
                    <td class="vM taC">
                        <?php
                            if($listado["auto"] == 1) echo 'Si';
                            if($listado["auto"] == 0) echo 'No';
                        ?>
                    </td>
                    <td class="vM"><?= ($listado["valor"]); ?></td>
                    <td class="vM" style="padding:10px !important;"><?php include $roution."views/botones_listas.php"; ?></td>
                </tr>
            <?php $valion += $listado["valor"]; } ?>
        </tbody>
    </table>
</div>

<div class="p20 taC t20">
    <strong>Valor total:</strong>
    <?= $valion; ?>
    <?php
        if(trim($valion) == 100)    echo '<i class="la la-check success"></i>';
        else                        echo '<i class="la la-close danger"></i>';
    ?>
</div>