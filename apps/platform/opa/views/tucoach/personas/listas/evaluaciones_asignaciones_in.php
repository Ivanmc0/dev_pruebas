<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr class="t12">
                <th style="padding:10px !important;" width="30">ID</th>
                <th style="padding:10px !important;">con el Rol</th>
                <th style="padding:10px !important;">evalua a</th>
                <th style="padding:10px !important;">con el Perfil</th>
                <th style="padding:10px !important;">OK</th>
                <th style="padding:10px !important;" width="50">Opciones</th>
            </tr>
        </thead>
        <tbody class="t12">
            <?php foreach($listados AS $listado){ ?>
                <tr id="tr-<?= $listado["id"]; ?>">
                    <td class="vM" style="padding:10px !important;"><?= $listado["id"]; ?></td>
                    <td class="vM" width="25%" style="padding:10px !important;">
                        <?php
                            $thisRol = $_TUCOACH->get_data("grw_tuc_roles", " AND id = ".$listado["id_rol"]." AND eliminado = 0 ", 0);
                            if($thisRol) echo ($thisRol["nombre"]);
                        ?>
                    </td>
                    <td class="vM" width="25%" style="padding:10px !important;">
                        <?php
                            $thisEvaluado = $_TUCOACH->get_data("zoom_users", " AND id = ".$listado["id_evaluado"]." AND eliminado = 0 ", 0);
                            if($thisEvaluado) echo ($thisEvaluado["nombre"]);
                        ?>
                    </td>
                    <td class="vM" width="25%" style="padding:10px !important;">
                        <?php
                            $thisPerfil = $_TUCOACH->get_data("grw_perfiles", " AND id = ".$listado["id_perfil"]." AND eliminado = 0 ", 0);
                            if($thisPerfil) echo ($thisPerfil["nombre"]);
                        ?>
                    </td>
                    <td class="vM taC" style="padding:10px !important;">
                        <?php
                            if($listado["realizado"] == 1) echo '<i class="la la-check success t24"></i>';
                            if($listado["realizado"] == 0) echo '<i class="la la-close danger t24"></i>';
                        ?>
                    </td>
                    <td class="vM" style="padding:3px !important;"><?php include $roution."views/botones_listas.php"; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>