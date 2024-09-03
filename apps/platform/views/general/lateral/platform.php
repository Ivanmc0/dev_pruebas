<div class="p30">
    <div class="ff3 cPrimary t18 tU mb10">Mis Herramientas</div>
    <div class="ff1 color333 t14 mb30">Con OLC Platform cuentas con herramientas especializadas para atender las necesidades de tu organización.</div>

    <?php
        $addon = "";
        if($_SESSION["COMPANY"]["apps"]){
        foreach ($_SESSION["COMPANY"]["apps"] as $herr => $ok) {
            if($herr == "platform") $addon = "tablero/";
    ?>

        <div class="app-in-<?= $apps[$herr]["app"]; ?>">
            <a href="<?= $apps[$herr]["url_".$_ENV["ENV"]].$addon; ?>" class="">
                <div class="p20 mb20 bPrimary bHover rr10">
                    <div class="t16 ff3 color333"><img src="<?= $dominion; ?>resources/olc/olc-<?= $apps[$herr]["app"]; ?>-white.png" class="h70" /></div>
                </div>
            </a>
        </div>

    <?php }} ?>

    <div class="ff2 t14 color666 taC mb5">© OLC Group - <?= date('Y'); ?></div>
    <div class="ff0 t12 color999 taC">Todos los derechos reservados</div>
</div>