<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead>
            <tr>
                <th>Grupo</th>
                <th>Sesión 1</th>
                <th>Sesión 2</th>
                <th>Sesión 3</th>
                <th>Sesión 4</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($listados AS $idgrupo => $listado){
            ?>
                <tr>
                    <td class="vM"><small>Grupo</small><br> <?= $grupos[$idgrupo]["nom_grupo"]; ?></td>

                    <?php foreach ($listado AS $numero => $data) { ?>
                        <td class="vM">
                            <a href="<?= $roution; ?>w/detalle-grupo-24s2_<?= $idgrupo; ?>-<?= $numero; ?>.zoom" class="btn btn-teal btn-sm taL">
                                <?= $modulos[$data["id_modulo"]]["nombre"]; ?>
                            </a>
                        </td>
                    <?php } ?>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>