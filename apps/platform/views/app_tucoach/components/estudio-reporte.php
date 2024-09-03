<div class="cloud bHover2 cP mb20">

    <div class="row align-items-center mb20">
        <div class="col-12 col-lg-4"><div class="dIB p1030 rr40 bP2P colorfff t18 ff3"> <?= $Estudio['asignacion']['tipo'] ?> </div></div>
        <div class="col-12 col-lg-4">
            <div class="tab">
                <div class="tabIn t24 w40x colorMorado2"><i class="las la-flag"></i></div>
                <div class="tabIn"><div class="colorGrowi t14 ff2">Finaliza: <?= $Estudio['alcance']['hasta'] ?></div></div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="tab">
                <div class="tabIn t24 w40x colorMorado2"><i class="las la-stopwatch"></i></div>
                <div class="tabIn"><div class="colorGrowi t14 ff2">Tiempo estimado: <?= $Estudio['duracion'] ?> mins</div></div>
            </div>
        </div>
    </div>

    <div class="tab mb20">
        <div class="tabIn bP2P w10x"></div>
        <div class="tabIn bP2P2 p1020">
            <div class="tab">
                <div class="tab33">
                    <div class="t14 ff2 color666 mb3">Estudio</div>
                    <div class="t16 ff4 colorGrowi"><?= $Estudio['nombre'] ?></div>
                </div>
                <div class="tab33">
                    <div class="t14 ff2 color666 mb3">Evalúas a</div>
                    <div class="t16 ff4 colorGrowi">  <?= $Estudio['evaluado']['nom_completo'] ?> </div>
                </div>
                <div class="tab33">
                    <div class="t14 ff2 color666 mb3">Perfil aplicado</div>
                    <div class="t16 ff4 colorGrowi"><?= $Estudio['evaluado']['perfil']['nombre'] ?> </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab">
        <div class="tab50">
            <div class="t14 colorGrowi ff3 mb5">Progreso (70%)</div>
            <div class="beee rr5 ovH">
                <div class="w70 rr5 p5 bVerde"></div>
            </div>
        </div>
        <div class="tab50 taR">
            <div class="btn-1 btn-zm">
                <i class="las la-play left"></i>
                <span class="t14 ff3 colorfff">Continuar estudio</span>
            </div>

        </div>
    </div>

</div>