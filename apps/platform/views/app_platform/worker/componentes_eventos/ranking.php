<a href="<?= $evento["url"]; ?>" target="_blank" class="dIB w200x h250 bVerde rr15 bShadow3 posR ofH grover mL10">

    <div class="brillo2"></div>

    <div class="vMM">

        <div class="w100 taL p1020">

            <div class="dIB color666 t12 ff2 p310 rr20 bVerde3 mb20"><?= $evento["categoria"]; ?></div>
            <div class="t24 ff3 colorfff truncate-2 mb30"><?= $evento["nombre"]; ?></div>

            <div class="t14 colorfff mb5">
                <div class="dIB colorGrowi2">Hasta:</div>
                <div class="dIB ff2"><?= dateFront($evento["fecha_fin"]); ?></div>
            </div>
            <div class="t14 ff2 colorfff truncate-1"><?= $_SESSION["COMPANY"]["nombre"]; ?></div>

        </div>

    </div>

    <div class="posA" style="right:10px; bottom:10px; z-index:3">
        <i class="las la-long-arrow-alt-right colorfff t20"></i>
    </div>

</a>