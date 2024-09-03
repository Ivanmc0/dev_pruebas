<a href="<?= $evento["url"]; ?>" target="_blank" class="dIB w300x h250 bAzul6 rr15 bShadow3 posR ofH grover mL10">

    <div class="brillo2"></div>

    <div class="vMM">

        <div class="w100 taL p1030">

            <div class="dIB colorfff t12 ff2 p310 rr20 bAzul5 mb20"><?= $evento["categoria"]; ?></div>
            <div class="t24 ff3 colorfff truncate-2 mb30"><?= $evento["nombre"]; ?></div>

            <div class="t14 colorfff mb10">
                <div class="dIB colorGrowi2"><i class="las la-flag-checkered t16"></i> Estado:</div>
                <div class="dIB ff2">Disponible</div>
            </div>
            <div class="t14 ff2 colorfff truncate-1"><?= $_SESSION["COMPANY"]["nombre"]; ?></div>

        </div>

    </div>

    <div class="posA" style="right:10px; bottom:10px; z-index:3">
        <i class="las la-long-arrow-alt-right colorfff t20"></i>
    </div>

</a>