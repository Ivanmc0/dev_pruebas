<div class="app-in-<?= $appHabil; ?>">
    <div class="dB beee bShadow3 rr20" style="overflow:hidden">

        <div class="p20">
            <img src="<?= $dominion; ?>resources/olc/olc-<?= strtolower($appData["app"]); ?>.png" class="h50" alt="" />
        </div>

        <div style="height:18px"></div>

        <div class="">
            <div class="folder">
                <div class="posR wh120 mAUTO">
                    <img src="<?= $dominion; ?>resources/img/folder-<?= $appHabil; ?>.png" />
                </div>
            </div>
        </div>

        <div style="height:18px"></div>

        <div class="p1020 color666 t14 taC">

            <?php
                $texto = 'Esta aplicación no está habilitada en su organización';
                $verbo = 'Más información';
            ?>

            <div class="h50 tInc"><?= $texto; ?></div>
            <div class="h20"></div>

            <!-- <div class="taC pAA10 w80 mAUTO">
                <a target="_blank" href="https://olcgroup.co" class="dB bccc color666 rr20 p10 ff2 t16 bHover" style="overflow:hidden">
                    <?= $verbo; ?>
                </a>
            </div> -->

        </div>

        <div class="beee bShadow2 p20"></div>

    </div>
</div>