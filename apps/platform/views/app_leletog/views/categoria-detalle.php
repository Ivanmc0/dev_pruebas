<?php
    if(isset($geton[2])) {
        $categoria      = $_ZOOM->get_data('grw_lel_categorias', ' AND id = ' . $geton[2] . ' AND inactivo = 0 AND eliminado = 0', 0);
        $actividades    = $_ZOOM->get_data('grw_lel_actividades', ' AND id_categoria = ' . $geton[2] . ' AND id_empresa = '.$_SESSION["COMPANY"]["id"].' AND inactivo = 0 AND eliminado = 0', 1);
        if($actividades){
?>

            <div class="bfff p40 p20_oS bBS1 mb20">
                <div class="ff3 t18 colorVerde mb5">Actividades de la categoría: <?= ($categoria["nombre"]); ?></div>
                <div class="color666 let2 t16">Te invitamos a revisar tus actividades pendientes</div>
            </div>

            <div class="general pAA30">

                <?php
                    foreach ($actividades as $act) {
                        if($act["tipo"] == 1 || ($act["tipo"] == 2 && $_LELE->busquedaEnLista($act["asignados"], $_SESSION["WORKER"]["id"]))){
                            $balance = $_ZOOM->validaInteractividad($act['id'], $trabajador["id"]);
                            if($balance){

                ?>
                    <a href="<?= $dominion; ?>detalle-actividad/<?= $_ZOOM->url_seo($act['nombre']).'/'.$act['id']; ?>/">
                        <div class="tab p10">
                            <div class="tabIn p10">
                                <div class="rr20 colorVerde t16 ff2 bS1 bCVerde p20 bHover2">
                                    <div class="colorVerde t18 ff2 mb5"><?= ($act['nombre']); ?></div>
                                    <div class="color666 t14 ff1 w80"><?= ($act['descripcion']); ?></div>
                                    <hr>
                                    <div class="">
                                        <div class="tab p1020 beee t12 rr10 color666">
                                            <div class="tabIn ff2">Balance de actividad</div>
                                            <div class="tabIn pLR20 taR"><?= $balance["status_1"]; ?>/<?= $balance["inter"]; ?></div>
                                            <div class="tabIn w100x taC t12 rr10 p5 bfff"><?= $balance["estado"]["text"]; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tabIn w30x"><div class="vMM bVerde colorfff wh30 rr50 t12"><i class="fas fa-arrow-right"></i></div></div>
                        </div>
                    </a>
                <?php
                            }
                        }
                    }
                ?>

            </div>

<?php
        } else echo '<div class="general pAA30"><div class="color666 let2 t16">No tiene actividades en esta categoría</div></div>';
    }
?>