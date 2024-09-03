<div class="bGradL">
    <div class="ionix general">

        <div class="tab pAA10">
            <div class="tabIn">
                <a href="<?= $dominion; ?>">
                    <div class="t50 ff4 colorfff">
                        <img src="<?= $dominion; ?>resources/olc/olc-<?= $apps[$app]["app"]; ?>-white.png" class="h80" />
                    </div>
                </a>
            </div>
            <div class="tabIn taR">
                <?php if($geton[0] != ''){ ?>
                    <a href="<?= $dominion; ?>" class="btn-5">
                        <i class="las la-flag left"></i>
                        <span>Ir al inicio</span>
                    </a>
                <?php } ?>
                &nbsp;
                <a href="<?= $_SESSION["COMPANY"]["GROWI"]; ?>tablero/" class="btn-5">
                    <span>Salir de <?= $apps[$app]['name']; ?></span>
                    <i class="las la-sign-out-alt right"></i>
                </a>
            </div>
        </div>

        <?php
            if($geton[0] == '' && $app == 'okr') include $roution."views/general/components/head-$app.php";
            if($geton[0] == '' && $app == 'leletog') include $roution."views/general/components/head-$app.php";
        ?>

    </div>
</div>