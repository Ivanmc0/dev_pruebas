<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">

        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th>Nombre</th>
                <th>Nivel (requierido)</th>
                <th>Dependencia</th>
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
                    <td class="vM"><?= ($listado["nombre"]); ?></td>
                    <td class="vM"><?= ($listado["nivel"]); ?></td>
                    <td class="vM">
                        <?php
                            if($listado["id_cargo"] == -1) echo "Superior | Sin jefe";
                            else{
                                $getEmpresa = $_ZOOM->get_data("grw_cargos", " AND id = ".$listado["id_cargo"]." AND inactivo = 0 AND eliminado = 0 ", 0);
                                if($getEmpresa) echo ($getEmpresa["nombre"]);
                            }
                        ?>
                    </td>
                    <td class="vM" style="padding:10px !important;"><?php include $roution."views/botones_listas.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>