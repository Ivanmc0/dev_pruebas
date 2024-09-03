<div class="cloud" style="margin-top:-200px">

    <div class="tab mb20">
        <div class="tabIn w200x">
            <div class="bS1 taC pAA50">
                <img src="<?= $static; ?>logos/300/<?= ($_SESSION["COMPANY"]["logo"]); ?>" alt="Logo <?= $_SESSION["COMPANY"]["nombre"]; ?>">
            </div>
        </div>
        <div class="tabIn p20"  style="padding-right:0">

            <div class="mb30">
                <div class="dIB t16 colorGrowi ff4">Reporte de <?= $this_proceso['nombre']; ?></div>
                <div class="dIB t12 color666"></div>
                <div class="dIB t16 color666 ff1">
                    generado el
                    <span class="ff3 color666 pLR5"><?= date('Y-m-d'); ?></span>
                    a las
                    <span class="ff3 color666 pLR5"><?= date('H:i'); ?></span>
                    por
                    <span class="ff3 color666 pLR5"><?= $_SESSION["WORKER"]["nombres"].' '.$_SESSION["WORKER"]["apellidos"]; ?></span>
                </div>
            </div>

            <div class="colorGrowi truncate-1 t40 ff4 mb20"><?= $report["nombre"]; ?></div>

            <div class="tab beee rr10 p10">

                <div class="tabIn w150x">
                    <div class="bAzul4 ff3 taC p10 rr20"><?= $report["categoria"]["nombre"]; ?></div>
                </div>

                <div class="tabIn pLR20">

                    <div class="dIB pLR10">
                        <div class="tab">
                            <div class="tabIn t24 w30x color666"><i class="las la-flag"></i></div>
                            <div class="tabIn t16 color666 ff2">Finaliza:</div>
                            <div class="tabIn t16 colorGrowi ff3 pLR10"><?= 'Ene 01 de 2024';//$report['periodo']['hasta']; ?></div>
                        </div>
                    </div>

                    <div class="dIB pLR10">
                        <div class="tab">
                            <div class="tabIn t24 w30x color666"><i class="las la-flag"></i></div>
                            <div class="tabIn t16 color666 ff2">Nivel de asignación:</div>
                            <div class="tabIn t16 colorGrowi ff3 pLR10">Toda la empresa</div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <div class="row">

        <div class="col-md-8">

            <?php include 'header-'.$geton[1].'.php'; ?>

        </div>
        <div class="col-md-4">
            <div class="tab h200 bGrowi p1020 rr15">
                <div class="tabIn taC">
                    <div class="w70 mAUTO taL colorfff magion">
                        Reporte construido por
                        <span class="ff3">OLC Group</span>
                        a través de
                        <span class="ff3">Growi</span>.
                    </div>
                    <div class=""><img src="<?= $dominion; ?>resources/olc/growi-logo-w.png" alt=""></div>
                </div>
                <div class="tab30 taC">
                    <div class=""><img src="<?= $dominion; ?>resources/img/reporte.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>

</div>