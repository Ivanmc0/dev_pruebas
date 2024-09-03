<?php if($asignacion["completado"]) { ?>

    <div class="cloud bValora3 mb20">

        <div class="t14 ff1 color666 mb10">Encuesta</div>
        <div class="t24 ff4 colorGrowi mb20 truncate-1"><?= $asignacion["nombre_encuesta"]; ?></div>

        <div class="tab mb5">
            <div class="tabIn t20 w30x colorValora"><i class="las la-stopwatch"></i></div>
            <div class="tabIn"><div class="colorGrowi t14 ff2">Tiempo estimado: 15 mins</div></div>
        </div>
        <div class="tab">
            <div class="tabIn t20 w30x colorValora"><i class="las la-hourglass-half"></i></div>
            <div class="tabIn"><div class="colorGrowi t14 ff2">Completado</div></div>
        </div>

    </div>

<?php }else{ ?>

    <a href="encuesta/<?= $asignacion["uuid"]; ?>/">
        <div class="cloud bValora2 bHover2 cP mb20">

            <div class="t14 ff1 color666 mb10">Encuesta</div>
            <div class="t24 ff4 colorGrowi mb20 truncate-2 h50"><?= $asignacion["nombre_encuesta"]; ?></div>

            <div class="tab mb5">
                <div class="tabIn t20 w30x colorValora"><i class="las la-stopwatch"></i></div>
                <div class="tabIn"><div class="colorGrowi t14 ff2">Tiempo estimado: 15 mins</div></div>
            </div>
            <div class="tab mb20">
                <div class="tabIn t20 w30x colorValora"><i class="las la-hourglass-half"></i></div>
                <div class="tabIn"><div class="colorGrowi t14 ff2">Disponible hasta: <?= dateFront('2025-01-15'); ?></div></div>
            </div>

            <div class="tab">
                <div class="tabIn taC">
                    <div class="btn-1 btn-zs">
                        <i class="las la-play left"></i>
                        <span class="t14 ff3 colorfff">Iniciar</span>
                    </div>

                </div>
            </div>

        </div>
    </a>

<?php } ?>