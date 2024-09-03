<div class="app-in-<?= $appHabil; ?>">
    <div class="dB bfff bShadow3 rr20" style="overflow:hidden">
        <div class="p20">
            <img src="<?= $dominion; ?>resources/olc/olc-<?= strtolower($appData["app"]); ?>.png" class="h50" alt="" />
        </div>

        <div class="">

            <div class="folder">
                <div class="posR wh120 mAUTO">
                    <?php if($appHabil != "academia"){ ?><div class="posA rr50 wh40 t20 ff4 colorfff <?= ($aplicacion["pendientes"] > 0) ? 'b000': 'baaa'; ?>" style="right:0; top:5px;"><div class="vMM"><?= $aplicacion["pendientes"]; ?></div></div><?php } ?>
                    <img src="<?= $dominion; ?>resources/img/folder-<?= $appHabil; ?>.png" />
                </div>
            </div>

        </div>
        <div class="p1020 color666 t14 taC">


            <?php
                $texto = '';
                $verbo = '';
                if($appHabil == 'tucoach'){

                    if($aplicacion["pendientes"] > 0){
                        $texto = ($aplicacion["pendientes"] == 1) ? '<div class="">Tienes <b>'.$aplicacion["pendientes"].'</b> estudio pendiente</div>' : '<div class="">Tienes <b>'.$aplicacion["pendientes"].'</b> estudios pendientes</div>';
                    } else $texto = 'No tienes estudios asignados por realizar';
                    $verbo = 'Entrar';

                }else if($appHabil == 'leletog'){

                    if($aplicacion["pendientes"] > 0){
                        $texto = ($aplicacion["pendientes"] == 1) ? '<div class="">Hay <b>'.$aplicacion["pendientes"].'</b> actividad pendiente de tu participación</div>' : '<div class="">Hay <b>'.$aplicacion["pendientes"].'</b> actividades pendientes de tu participación</div>';
                    } else $texto = 'No tienes actividades pendientes de tu participación';
                    $verbo = 'Entrar';

                }else if($appHabil == 'okr'){

                    if($aplicacion["pendientes"] > 0){
                        $texto = ($aplicacion["pendientes"] == 1) ? '<div class="">Tienes <b>'.$aplicacion["pendientes"].'</b> proyecto asignado que está vigente</div>' : '<div class="">Tienes <b>'.$aplicacion["pendientes"].'</b> proyectos asignados que están vigentes</div>';
                    } else $texto = 'No tienes proyectos asignados';
                    $verbo = 'Entrar';

                }else if($appHabil == 'valora'){

                    if($aplicacion["pendientes"] > 0){
                        $texto = ($aplicacion["pendientes"] == 1) ? '<div class="">Tienes <b>'.$aplicacion["pendientes"].'</b> valoración pendiente</div>' : '<div class="">Tienes <b>'.$aplicacion["pendientes"].'</b> valoraciones pendientes</div>';
                    } else $texto = 'No tienes valoraciones pendientes';
                    $verbo = 'Entrar';

                }else if($appHabil == 'academia'){

                    $texto = 'Accede a la plataforma de formación continua';
                    $verbo = 'Acceder';

                }

            ?>

            <div class="h50"><?= $texto; ?></div>

            <div class="taC pAA10 w80 mAUTO">
                <a <?php if($appHabil == "academia") echo 'target="_blank"'; ?> href="<?= $appData['url_'.$_ENV["ENV"]]; ?>" class="dB bPrimary colorfff rr20 p10 ff2 t16 bHover" style="overflow:hidden">
                    <?= $verbo; ?>
                </a>
            </div>

        </div>

        <div class="beee bShadow2 p20"></div>

    </div>
</div>


