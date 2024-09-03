<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th class="vM" style="padding:10px;">Perfil</th>
                <th class="vM" style="padding:10px;">Balance</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $cionl = 0;
                foreach($perfiles AS $key => $perfil){
                    //if($cionl < 8){
            ?>
                <tr id="perfilion<?= $perfil["id"]; ?>" style="display:none !important">
                    <td class="vM t12" style="padding:10px;"><?= ($perfil["nombre"]); ?></td>
                    <td class="vM" style="padding:2px;">

                        <?php
                            $categorias = $_TUCOACH->get_data("grw_tuc_p2p_categorias", " AND id_perfil = ".$perfil["id"]." AND eliminado = 0  ORDER BY id DESC ", 1);
                            if($categorias){
                                foreach($categorias AS $categoria){
                                    $competencias = $_TUCOACH->get_data("grw_tuc_p2p_competencias", " AND id_categoria = ".$categoria["id"]." AND eliminado = 0  ORDER BY id DESC ", 1);
                                    if($competencias) include "evaluaciones_reportes_balance_competencias.php";
                                }
                            }
                        ?>

                    </td>
                </tr>
            <?php }//$cionl++;} ?>
        </tbody>
    </table>
</div>