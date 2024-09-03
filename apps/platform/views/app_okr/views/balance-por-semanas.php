<div class="bfff p4020 bBS1 bCeee mb20">
    <div class="ff3 tU t24 colorMorado2">Balance tareas por semanas</div>
</div>

<?php
    $weeks = $_TUCOACH->get_data("olc_semanas", " AND id >= ".$proyecto["id_semana_desde"]." AND id <= ".$proyecto["id_semana_hasta"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
    if($weeks){
        $ccc = 1;
        foreach($weeks AS $week){
?>
            <div class="hShadow bS1 bGray rr20 mb20" style="overflow:hidden;">
                <a href="<?= $dominion; ?>proyecto/week/<?= $week["id"]; ?>" class="">

                    <?php
                        $homeworks      =  array(
                            "week"              => 0,
                            "week_pendientes"    => 0,
                            "week_en_proceso"    => 0,
                            "week_realizadas"    => 0,
                        );
                        $get_homeworks  = $_TUCOACH->get_data("grw_okr_tareas", " AND id_semana = ".$week["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id_proyecto = ".$proyecto["id"]." AND inactivo = 0 AND eliminado = 0 ", 1);
                        if($get_homeworks){
                            $ioio = array();
                            foreach($get_homeworks AS $hw){

                                if($hw["id_semana"] == $week["id"]) $homeworks["week"] += 1;
                                if($hw["estado"] == 0 && $hw["id_semana"] == $week["id"]) $homeworks["week_pendientes"] += 1;
                                if($hw["estado"] == 1 && $hw["id_semana"] == $week["id"]) $homeworks["week_en_proceso"] += 1;
                                if($hw["estado"] == 2 && $hw["id_semana"] == $week["id"]) $homeworks["week_realizadas"] += 1;

                            }
                        }
                        $promedio_week 	= 0;
                        if($homeworks["week"] != 0)	        $promedio_week 	= $homeworks["week_realizadas"]/$homeworks["week"]*100;
                    ?>

                    <div class="posR">
                        <div class="tab p20 bMorado2 colorfff">
                            <div class="tabIn ">
                                <div class="ff4 t20">Semana <?php if($week) echo $week["semana"]; ?> del <?=$week["ano"]; ?></div>
                            </div>
                            <div class="tabIn taR">
                                <div class="ff3 colorccc t14 mb5">#<?=$ccc;?></div>
                                <div class="ff1 t16"><?= $_TUCOACH->pulirFecha($week["fecha_desde"],$week["fecha_hasta"]); ?></div>
                            </div>
                        </div>
                        <div class="p1020 bGray bBS1">
                            <div class="row taC align-items-center">
                                <div class="col-12 col-lg-12">
                                    <div class="posR b666 rr40" style="overflow:hidden;">
                                        <div class="bVerde pAA20" style="width:<?= $promedio_week."%"; ?>;"></div>
                                        <div class="posA colorfff t16 ff3" style="left:20px; top:10px; z-index:1">Balance de la semana <?php if($week) echo $week["semana"]; ?></div>
                                        <div class="posA colorfff t18 ff3" style="right:20px; top:9px; z-index:2"><?= round($promedio_week,1)."%"; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="row taC align-items-center">
                            <?php if($week["id"] < $today["id"]){ ?>
                                    <div class="col-12 col-lg-4 pAA30 bRS1">
                                        <div class="ff2 color999 t14 mb3">Tareas</div>
                                        <div class="ff1 colorMorado t16 mb10">Totales</div>
                                        <div class="wh50 t18 ff3 rr50 bMorado colorfff mAUTO vCC"><?= $homeworks["week"]; ?></div>
                                    </div>
                                    <div class="col-12 col-lg-4 pAA30 bRS1">
                                        <div class="ff2 color999 t14 mb3">Tareas</div>
                                        <div class="ff1 vencidot t16 mb10">Vencidas</div>
                                        <div class="wh50 t18 ff3 rr50 vencido colorfff mAUTO vCC"><?= $homeworks["week_pendientes"]+$homeworks["week_en_proceso"]; ?></div>
                                    </div>
                                    <div class="col-12 col-lg-4 pAA30 bRS1">
                                        <div class="ff2 color999 t14 mb3">Tareas</div>
                                        <div class="ff1 estadot2 t16 mb10">Realizadas</div>
                                        <div class="wh50 t18 ff3 rr50 estado2 colorfff mAUTO vCC"><?= $homeworks["week_realizadas"]; ?></div>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-12 col-lg-3 pAA30 bRS1">
                                        <div class="ff2 color999 t14 mb3">Tareas</div>
                                        <div class="ff1 colorMorado t16 mb10">Totales</div>
                                        <div class="wh50 t18 ff3 rr50 bMorado colorfff mAUTO vCC"><?= $homeworks["week"]; ?></div>
                                    </div>
                                    <div class="col-12 col-lg-3 pAA30 bRS1">
                                        <div class="ff2 color999 t14 mb3">Tareas</div>
                                        <div class="ff1 estadot0 t16 mb10">Pendientes</div>
                                        <div class="wh50 t18 ff3 rr50 estado0 colorfff mAUTO vCC"><?= $homeworks["week_pendientes"]; ?></div>
                                    </div>
                                    <div class="col-12 col-lg-3 pAA30 bRS1">
                                        <div class="ff2 color999 t14 mb3">Tareas</div>
                                        <div class="ff1 estadot1 t16 mb10">En proceso</div>
                                        <div class="wh50 t18 ff3 rr50 estado1 colorfff mAUTO vCC"><?= $homeworks["week_en_proceso"]; ?></div>
                                    </div>
                                    <div class="col-12 col-lg-3 pAA30 bRS1">
                                        <div class="ff2 color999 t14 mb3">Tareas</div>
                                        <div class="ff1 estadot2 t16 mb10">Realizadas</div>
                                        <div class="wh50 t18 ff3 rr50 estado2 colorfff mAUTO vCC"><?= $homeworks["week_realizadas"]; ?></div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>

                </a>
            </div>
<?php
            $ccc++;
        }
    }
?>



<div id="delete-taspe"></div>
<div id="rtn_tasks"></div>