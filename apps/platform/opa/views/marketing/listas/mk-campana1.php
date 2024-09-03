
<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Celular</th>
                <th>Ciudad</th>
                <th>fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($listados AS $listado){
            ?>
                <tr>
                    <td class="vM"><?= ($listado["nombres"]); ?></td>
                    <td class="vM"><?= ($listado["apellidos"]); ?></td>
                    <td class="vM"><?= ($listado["email"]); ?></td>
                    <td class="vM"><?= ($listado["celular"]); ?></td>
                    <td class="vM"><?= ($listado["ciudad"]); ?></td>
                    <td class="vM"><?= ($listado["fecha"]); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>