<div class="tab">
    <div class="tabIn" style="vertical-align:bottom;">
        <div class="mb30">
            <div class="dIB t30 colorfff ff0"><?= $apps[$app]['name']; ?> te da la bienvenida,</div>
            <div class="dIB t30 colorfff ff3 pL10"><?= $_SESSION['WORKER']['nombre']; ?></div>
        </div>
        <div class="dIB t16 colorfff ff2 mb10">Tus tareas de esta semana en los proyectos activos</div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="tab bfff rr5 p1020 bBS3 bCestado0">
                    <div class="tabIn">
                        <div class="t14 colorGrowi ff3 tU">Pendientes</div>
                    </div>
                    <div class="tabIn taR pLR10"><div class="dIB t12 bS2 bCaaa rr10 ff4 colorGrowi p310">-</div></div>
                    <div class="tabIn w40x taR t34"><i class="las la-list-ul"></i></div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="tab bfff rr5 p1020 bBS3 bCestado1">
                    <div class="tabIn">
                        <div class="t14 colorGrowi ff3 tU">En progreso</div>
                    </div>
                    <div class="tabIn taR pLR10"><div class="dIB t12 bS2 bCaaa rr10 ff4 colorGrowi p310">-</div></div>
                    <div class="tabIn w40x taR t34"><i class="las la-hourglass-half"></i></div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="tab bfff rr5 p1020 bBS3 bCestado2">
                    <div class="tabIn">
                        <div class="t14 colorGrowi ff3 tU">Completadas</div>
                    </div>
                    <div class="tabIn taR pLR10"><div class="dIB t12 bS2 bCaaa rr10 ff4 colorGrowi p310">-</div></div>
                    <div class="tabIn w40x taR t34"><i class="las la-list-alt"></i></div>
                </div>
            </div>
        </div>
        <div class="h20"></div>
    </div>
    <div class="tabIn taR w40" style="vertical-align:bottom;"><img src="<?= $dominion; ?>resources/img/growi-illus-okr.png" alt=""></div>
</div>