<?php
if (isset($geton[3])) {
    $actividades = $_ZOOM->get_data('grw_lel_actividades', ' AND id_categoria = ' . $geton[3] . ' AND inactivo = 0 AND eliminado = 0', 1);
    if ($actividades) {


?>

        <div class="bfff p40 p20_oS bBS1 mb20">
            <div class="ff3 t18 colorVerde mb5">Mis Actividades</div>
            <div class="color666 let2 t16">Te invitamos a revisar tus actividades pendientes</div>
        </div>

        <div class="general pAA30">
            <div class="row justify-content-center mb20">

                <?php foreach ($actividades as $act) { ?>
                    <div class="col-12 col-md-6 mb30">
                        <a href="interactiviades/<?= $act['id'] ?>">
                            <div class="bVerde colorDorado3 p50 taC ffX t30"><?= $act['nombre']; ?></div>
                        </a>
                    </div>
                <?php } ?>

            </div>
        </div>

<?php    } else echo '<div class="general pAA30"><div class="color666 let2 t16">No tiene actividades</div></div>';
} ?>