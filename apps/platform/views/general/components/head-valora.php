<div class="p30">

    <div class="h20"></div>

    <div class="t30 colorGrowi ff3 mb5">
        <span class="ff0">Hola,</span>
        <?= $_SESSION['WORKER']['nombre']; ?>
    </div>
    <div class="t20 colorGrowi ff1 mb20"><?= $apps[$app]['name']; ?> te da la bienvenida.</div>

    <div class="t14 color666 ff1 w80 mb20">Tu voz importa. Ayúdanos a mejorar, comparte tu experiencia y juntos alcanzaremos la excelencia.</div>

    <div class="bS1 bCeee bGray p1020 rr5 mb10">
        <div class="tab">
            <div class="tabIn w60x colorValora t40"><i class="las la-user-clock"></i></div>
            <div class="tabIn">
                <div class="t14 color666 ff1 mb5">Encuestas en curso</div>
                <div class="t30 ff4 colorGrowi"><?php if($asignaciones) echo $asignaciones["pendientes"]; ?></div>
            </div>
        </div>
    </div>

    <div class="bS1 bCeee bGray p1020 rr5">
        <div class="tab">
            <div class="tabIn w60x colorValora t40"><i class="las la-clipboard-check"></i></div>
            <div class="tabIn">
                <div class="t14 color666 ff1 mb5">Encuestas finalizadas</div>
                <div class="t30 ff4 colorGrowi"><?php if($asignaciones) echo $asignaciones["realizadas"]; ?></div>
            </div>
        </div>
    </div>

</div>

<div class="taC"><img src="<?= $dominion; ?>resources/img/growi-illus-valora.png" alt=""></div>