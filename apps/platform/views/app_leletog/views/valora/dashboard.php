<div class="bfff- p40 p20_oS bBS1 bCeee">
    <div class="ff3 t18 colorVerde mb5">Categorías de actividades</div>
    <div class="color666 let2 t16">Te invitamos a revisar tus actividades pendientes</div>
</div>

<div class="p50 p20_oS">
    <div class="row mb20">

        <?php
            foreach ($categorias as $cat) {
                $cont = 0;
                $actividades = $_ZOOM->get_data('grw_lel_actividades', ' AND id_empresa = '.$trabajador['id_empresa'].' AND id_categoria = ' . $cat["id"] . ' AND inactivo = 0 AND eliminado = 0 ', 1);
                if($actividades){
                    foreach ($actividades as $act) {
                        if($act["tipo"] == 1 || ($act["tipo"] == 2 && $_LELE->busquedaEnLista($act["asignados"], $_SESSION["WORKER"]["id"]))){
                            $cont++;
                        }
                    }
                    if($cont > 0){
        ?>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb30">
                <a href="<?= $dominion."categoria/".$_ZOOM->url_seo($cat['nombre'])."/".$cat['id']; ?>/">
                    <div class="bfff p20 bHover2 rr10 bShadow2">
                        <div class="tab mb20">
                            <div class="tabIn w40x colorVerde t24"><i class="fas fa-chart-line"></i></div>
                            <div class="tabIn"><div class="color666 ff2 t20"><?= ($cat['nombre']); ?></div></div>
                        </div>
                        <div class="h100 pAA10 bGray rr10" style="overflow: auto;">
                            <?php foreach ($actividades as $act) { if($act["tipo"] == 1 || ($act["tipo"] == 2 && $_LELE->busquedaEnLista($act["asignados"], $_SESSION["WORKER"]["id"]))){ ?>
                                <div class="p510">
                                    <?php
                                        $balance = $_ZOOM->validaInteractividad($act['id'], $trabajador["id"]);
                                        if($balance){
                                    ?>
                                            <div class="tab p1020 beee t12 rr10 color666">
                                                <div class="tabIn ff2"><?= ($act['nombre']); ?></div>
                                                <div class="tabIn pLR20 taR"><?= $balance["status_1"]; ?>/<?= $balance["inter"]; ?></div>
                                                <div class="tabIn w100x taC t12 rr10 p5 bfff"><?= $balance["estado"]["text"]; ?></div>
                                            </div>
                                    <?php } ?>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php } } } ?>

    </div>
</div>