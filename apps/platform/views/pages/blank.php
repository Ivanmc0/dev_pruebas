<div class="max1000 mAUTO p50 p30_oS taC">

    <div class="mb30"><img src="<?= $dominion; ?>resources/olc/olc-<?= $thisApp["app"]; ?>-white.png" alt=""></div>
    <h1 class="ff0 t16 tInc colorfff mb50">Transformamos culturas para vivir mejor.</h1>
    <div class="h30 mb50"></div>
    <div class="taC app-in-platform">

        <?php if($app != "leletog"){ ?>
                <a href="<?= $apps["platform"]["url_".$_ENV["ENV"]]; ?>tablero/" class="bPrimary colorfff ff4 t16 p1030 bHover">Regresar a <b>OLC Platform</b></a>
        <?php
            }else{
             for ($i=1; $i < 11; $i++) {
        ?>
                <a href="https://g<?= $i; ?>.olcgroup.co" class="dIB bPrimary colorfff ff4 t16 p1030 bHover">G<?= $i; ?></a>
        <?php
                }
            }
        ?>

    </div>

</div>