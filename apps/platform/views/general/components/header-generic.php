<div class="tabAll">

    <div class="tabIn dN_oPC w20x_oS"></div>

    <?php if($mode == 3){ ?>
        <div class="tabIn w40x_oS dN_oPC">
            <div onclick="Ion.openBio2('bioMenu')" class="dIB wh40 bS1 bCMorado2 rr50 colorMorado2 bHover2 cP"><div class="vMM w100 h100_"><i class="fas fa-bars"></i></div></div>
        </div>
    <?php } ?>

    <div class="tabIn bGrowi w100x  dN_oS">
        <img src="<?= $dominion; ?>resources/olc/growi-logo-white.png" alt="Growi by OLC Group">
    </div>

    <div class="tabIn w20x dN_oS"></div>

    <?php $urltem = (isset($geton[0]) && $geton[0] == 'panel-control') ? $dominion.'panel-control/' : $dominion.'tablero/'; ?>
    <a href="<?= $urltem; ?>" class="tabIn w200x">
        <img src="<?= $static; ?>logos/300/<?= $_SESSION['COMPANY']['logo']; ?>" class="h70 h40_oS">
    </a>

    <div class="tabIn dN_oS">
        <div class="t16 color999 let2"><?= $_SESSION['COMPANY']['proposito']; ?></div>
    </div>

    <div class="tabIn"></div>

    <div class="tabIn taR">

        <!-- <div class="dIB">
            <div onclick="Ion.openBio('bioOLC')" class="tab wh40 bHover2 color000 rr20 cP mL5">
                <div class="tabIn"><div class="wh40 rr50 t30"><div class="vMM w100 h100_"><i class="las la-question-circle"></i></div></div></div>
            </div>
        </div> -->

        <div class="dIB">
            <div onclick="Ion.openBio('bioPlatforms')" class="tab wh40 bHover2 color000 rr20 cP mL5">
                <div class="tabIn"><div class="wh40 rr50 t30"><div class="vMM w100 h100_"><i class="las la-icons"></i></div></div></div>
            </div>
        </div>

        <div class="dIB"><div class="bccc h40" style="margin:0 20px 0 10px; width:1px;"></div></div>

        <div class="dIB">
            <div onclick="Ion.openBio('bioWorker')" class="tab bHover2 rr20 cP">
                <div class="tabIn"><div class="wh40 rr50 bMorado colorfff ff3"><div class="vMM w100 h100_"><?= $sigla; ?></div></div></div>
                <div class="tabIn p515 dN_oS"><div class="color000 t18 ff3"><?= $_SESSION['WORKER']['nombre']; ?></div></div>
            </div>
        </div>

    </div>

    <div class="tabIn w30x w20x_oS"></div>

</div>