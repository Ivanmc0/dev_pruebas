<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th width="50">OK</th>
                <th width="50">ID</th>
                <th width="100">Logo</th>
                <th>Nombre</th>
                <th>Subdominio</th>
                <th>Login</th>
                <th width="100">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $listados =SetPositionArray($listados, 'id' );
                $subdominio = $listados[1]['subdominio'];
                foreach($listados AS $listado){
            ?>
                <tr id="tr-<?= $listado["id"]; ?>">
                    <td class="vM taC">
                        <?php
                            if($listado["inactivo"] == 0) echo '<i class="la la-check success t24"></i>';
                            if($listado["inactivo"] == 1) echo '<i class="la la-close danger t24"></i>';
                        ?>
                    </td>
                    <td class="vM"><?= ($listado["id"]); ?></td>
                    <td class="vM taC" style="padding:0 !important;">
                        <?php
                            if($listado["logo"] != ""){
                                echo '<img src="../../static/logos/300/'.($listado["logo"]).'" class="w70x" />';
                            } else echo '<img src="'.$sinImagen.'" class="w70x" />';
                        ?>
                    </td>
                    <td class="vM">
                        <?php
                            echo $listado["nombre"];
                            echo '<br><small>'.$listado["proposito"].'</small>';
                        ?>
                    </td>
                    <td class="vM">
                        <?php
                            echo $listado["subdominio"];
                            echo '<br><small><a href="'.$_ENV['PROTOCOL'].$listado["subdominio"].'.'.$_ENV['DOMAIN'].'/" target="_blank">'.$_ENV['PROTOCOL'].$listado["subdominio"].'.'.$_ENV['DOMAIN'].'</a></small>';
                        ?>
                    </td>

                    <td class="vM taC">
                        <a class="btn btn-warning btn-sm" href="<?= $_ENV['PROTOCOL'].$subdominio .'.' .$_ENV['DOMAIN'] .'/s/' .$listado["uuid"].'/' ?>" target="_blank">
                            Acceso SuperAdmin
                        </a>
                    </td>

                    <td class="vM" style="padding:10px !important;">
                        <?php include $roution."views/botones_listas.php"; ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
