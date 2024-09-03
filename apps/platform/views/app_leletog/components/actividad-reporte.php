<a href="<?= $_SESSION['COMPANY']['GROWI']; ?>reporte/ACT/<?= $reporte['uuid']; ?>/" class="dB bfff bShadow3 rr15 ofH color000 grover">

    <div class="tab p30 bBS1 bCeee bGrowi2">
        <div class="tabIn">
            <div class="t24 colorGrowi truncate-1 ff4 mb5"><?= $reporte['nombre']; ?></div>
            <div class="dIB b000T3 color333 ff2 t14 p510 rr10"><?= $reporte['categoria']['nombre']; ?></div>
        </div>
    </div>

    <div class="p1030 bBS1 bCeee">
        <div class="t14 colorGrowi mb5">
            <div class="tab mb10">
                <div class="tabIn t24 w30x color666"><i class="las la-list-alt"></i></div>
                <div class="tabIn t16 color666 ff2">Dinámicas:</div>
                <div class="tabIn t16 colorGrowi ff3 taR pR10">
                    <div class="dIB wh25 rr50 bVerde ofH t14 colorfff ff2"><div class="vMM"><?= $reporte['totales']['dinamicas']; ?></div></div>
                </div>
            </div>
            <div class="tab mb10">
                <div class="tabIn t24 w30x color666"><i class="las la-users"></i></div>
                <div class="tabIn t16 color666 ff2">Colaboradores asignados:</div>
                <div class="tabIn t16 colorGrowi ff3 taR pR10">
                    <div class="dIB wh25 rr50 bVerde ofH t14 colorfff ff2"><div class="vMM">-</div></div>
                </div>
            </div>
            <div class="tab mb10">
                <div class="tabIn t24 w30x color666"><i class="las la-flag"></i></div>
                <div class="tabIn t16 color666 ff2">Inicia:</div>
                <div class="tabIn t16 colorGrowi ff3 taR pR10"><?= $reporte['periodo']['desde']; ?></div>
            </div>
            <div class="tab mb10">
                <div class="tabIn t24 w30x color666"><i class="las la-flag"></i></div>
                <div class="tabIn t16 color666 ff2">Finaliza:</div>
                <div class="tabIn t16 colorGrowi ff3 taR pR10"><?= $reporte['periodo']['hasta']; ?></div>
            </div>
        </div>
    </div>
    <div class="p1030">
        <div class="tab">
            <div class="tabIn taC">
                <div class="btn-growi btn-zl">
                    <span class="t14 ff3 colorfff">Ver Reporte</span>
                    <i class="las la-arrow-alt-circle-right right"></i>
                </div>
            </div>
        </div>
    </div>

</a>

 