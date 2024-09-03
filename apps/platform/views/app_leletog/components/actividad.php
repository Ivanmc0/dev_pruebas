<a href="<?= $dominion; ?>detalle-actividad/<?= $asignacion['uuid']; ?>/" class="dB bfff bShadow3 rr15 ofH color000 grover">

    <div class="tab p30 bBS1 bCeee <?php if($asignacion["totales"]["pendientes"]>0) echo "bRojo5"; ?>">
        <div class="tabIn ">
            <div class="tab h50 mb10">
                <div class="tabIn">
                    <div class="t24 colorGrowi ff4 truncate-2"><?= $asignacion['nombre']; ?></div>
                </div>
            </div>
            <div class="dIB b000T3 color333 ff2 t14 p510 rr10"><?= $asignacion['categoria']['nombre']; ?></div>
        </div>
    </div>

    <div class="p1030 bBS1 bCeee">
        <div class="t14 colorGrowi mb5">
            <div class="tab mb10">
                <div class="tabIn">
                    <div class="bRojo2 rr20 ovH">
                        <div class="bVerde rr20" style="height:15px; width: <?= $asignacion['totales']['avance']; ?>%;"></div>
                    </div>
                </div>
                <div class="tabIn w60x taR t20 ff3"><?= $asignacion['totales']['avance']; ?>%</div>
            </div>
            <div class="tab">
                <div class="tabIn t24 w30x color666"><i class="las la-list-alt"></i></div>
                <div class="tabIn t16 color666 ff2 w80x">Dinámicas:</div>
                <div class="tabIn t16 colorGrowi ff3 w100x taR pR10">Realizadas</div>
                <div class="tabIn w30x">
                    <div class="wh25 rr50 bVerde ofH t14 colorfff ff2"><div class="vMM"><?= $asignacion['totales']['realizadas']; ?></div></div>
                </div>
                <div class="tabIn t16 colorGrowi ff3 w100x taR pR10">Pendientes</div>
                <div class="tabIn w30x">
                    <div class="wh25 rr50 <?php if($asignacion["totales"]["pendientes"]>0) echo "bRojo"; else echo "bccc"; ?> ofH t14 colorfff ff2"><div class="vMM"><?= $asignacion['totales']['pendientes']; ?></div></div>
                </div>
                <div class="tabIn"></div>
            </div>
        </div>

    </div>

    <div class="p1030">
        <div class="tab">
            <div class="tabIn">
                <div class="tab">
                    <div class="tabIn t24 w30x color666"><i class="las la-flag"></i></div>
                    <div class="tabIn t16 color666 ff2">Finaliza:</div>
                </div>
                <div class="tab">
                    <div class="tabIn w30x"></div>
                    <div class="tabIn t16 colorGrowi ff3"><?= $asignacion['periodo']['hasta']; ?></div>
                </div>
            </div>
            <div class="tabIn taR">
                <div class="btn-process btn-zs">
                    <span class="t14 ff3 colorfff">Realizar</span>
                    <i class="las la-arrow-alt-circle-right right"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="h10"></div>

</a>

 