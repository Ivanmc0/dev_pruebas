<?php

    $actividad  = $_ZOOM->get_data('grw_lel_actividades', ' AND uuid = "' . $geton[1] . '" AND inactivo = 0 AND eliminado = 0', 0);
    if($actividad) {
        $categoria  = $_ZOOM->get_data('grw_lel_categorias', ' AND id = ' . $actividad["id_categoria"] . ' AND inactivo = 0 AND eliminado = 0', 0);

        if ($interactividades = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id_actividad = ' . $actividad["id"] . ' AND inactivo = 0 AND eliminado = 0', 1)) {
            // echo '<pre>';
            // print_r($interactividades);
            // echo '</pre>';
?>

        <div class="bfff p40 p20_oS bBS1 mb20">

            <?php //if($jefe = $_ZOOM->get_data('___olc_trabajadores_carg0', ' AND id_jefe = ' . $_SESSION["WORKER"]["id"] . ' AND inactivo = 0 AND eliminado = 0', 1)){ ?>

            <?php if($jefe = $_WORKERS->getCargo(' AND id_jefe = ' . $_SESSION["WORKER"]["id"] . ' AND inactivo = 0 AND eliminado = 0', 1)){ ?>
                <a href="<?= $dominion."lider/".$geton[1]."/".$geton[1]."/"; ?>" class="dIB fR bVerde taC colorfff rr5 cP bHover bS1 bCVerde">
                    <div class="t20 tU ff2 bfff colorVerde p10 rr5 mb3">Líder</div>
                    <div class="t12 ff1 p515">Ver efectividad</div>
                </a>
            <?php } ?>

            <div class="ff3 t18 colorVerde mb5">Actividad</div>
            <div class="color666 let2 t16">Categoría: <?= ($categoria["nombre"]); ?></div>
        </div>

        <div class="general pAA30">

            <div class="mb30">
                <div class="ff3 t24 colorVerde let2 mb10"><?= ($actividad["nombre"]); ?></div>
                <div class="ff2 t18 magion color333 w80 mb5"><?= ($actividad["descripcion"]); ?></div>
                <div class="ff1 t16 magion color999 w90"><?= ($actividad["resumen"]); ?></div>
            </div>

            <div id="rtn_actividad_detalle"></div>

            <script>
                $( document ).ready(function() {
                    lele.get_interactividades(<?= $actividad["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>);
                });
            </script>

        </div>


<?php
        } else echo '<div class="general pAA30"><div class="color666 let2 t16">La actividad que busca no existe</div></div>';
    }
?>
