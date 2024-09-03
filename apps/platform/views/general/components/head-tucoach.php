<div class="p30">

    <div class="h20"></div>

    <div class="t30 colorGrowi ff3 mb5">
        <span class="ff0">Hola,</span>
        <?= $_SESSION['WORKER']['nombre']; ?>
    </div>
    <div class="t20 colorGrowi ff1 mb20"><?= $apps[$app]['name']; ?> te da la bienvenida.</div>

    <div class="t14 color666 ff1 mb5">Tu crecimiento es nuestra meta y juntos diseñaremos un plan para alcanzar tu máximo potencial.</div>
    <div class="t16 color666 ff3 mb20">¡Por eso, cada segundo cuenta!</div>

    <div class="bS1 bCeee bGray p1020 rr5 mb10">
        <div class="tab">
            <div class="tabIn w60x colorMorado2 t40"><i class="las la-clipboard-list"></i></div>
            <div class="tabIn">
            <div class="t14 color666 ff1 mb5">Participación en estudios P2P</div>
            <div class="t30 ff4 colorGrowi"><?= $asignaciones["participaciones"]['p2p']; ?></div>
            </div>
        </div>
    </div>

    <div class="bS1 bCeee bGray p1020 rr5">
        <div class="tab">
            <div class="tabIn w60x colorMorado2 t40"><i class="las la-clipboard"></i></div>
            <div class="tabIn">
                <div class="t14 color666 ff1 mb5">Participación en estudios P2B</div>
                <div class="t30 ff4 colorGrowi"><?= $asignaciones["participaciones"]['p2b']; ?></div>
            </div>
        </div>
    </div>

</div>

<div class="taC"><img src="<?= $dominion; ?>resources/img/growi-illus-tucoach.png" alt=""></div>