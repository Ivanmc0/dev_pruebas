<!--
    // P2P <a href="evaluacion-p2p/'.$asignacion["id"].'/" class="btn btn-sm btn-primary ff3">
    // P2B echo '<a href="reporte-evaluacion-p2b/'. $asignacion["id"].'/" class="btn btn-sm btn-success ff3">Visualizar</a>';
-->
<?php
 
    if($asignacion['asignacion']['tipo'] == 'P2P'){
        $b1  = 'bP2P';
        $b2  = 'bP2P2';
        $url = 'href="evaluacion-p2p/'.$asignacion['asignacion']['id'].'/"';
    }else {
        $b1  = 'bP2B';
        $b2  = 'bP2B2';
        $url = 'href="evaluacion-p2b/'.$asignacion['asignacion']['id'].'/"';
    }
?>

<a <?= $url; ?> class="dB cloud bHover2 cP mb20">

    <div class="row align-items-center mb20">
        <div class="col-12 col-lg-4"><div class="dIB p1030 rr40 <?= $b1; ?> colorfff t18 ff3">Estudio <?= $asignacion['asignacion']['tipo'] ?> </div></div>
        <div class="col-12 col-lg-4">
            <div class="tab">
                <div class="tabIn t24 w40x colorMorado2"><i class="las la-flag"></i></div>
                <div class="tabIn"><div class="colorGrowi t14 ff2">Finaliza: <?= $asignacion['alcance']['hasta'] ?></div></div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="tab">
                <div class="tabIn t24 w40x colorMorado2"><i class="las la-stopwatch"></i></div>
                <div class="tabIn"><div class="colorGrowi t14 ff2">Tiempo estimado: <?= $asignacion['duracion'] ?> mins</div></div>
            </div>
        </div>
    </div>

    <div class="tab mb20">
        <div class="tabIn <?= $b1; ?> w10x"></div>
        <div class="tabIn <?= $b2; ?> p1020">
            <div class="tab">
                <div class="tab33">
                    <div class="t14 ff2 color666 mb3">Estudio</div>
                    <div class="t16 ff4 colorGrowi"><?= $asignacion['nombre'] ?></div>
                </div>
                <div class="tab33">
                    <div class="t14 ff2 color666 mb3">Evalúas a</div>
                    <div class="t16 ff4 colorGrowi">
                        <?php
                            echo $asignacion['asignacion']['tipo'] == 'P2P' ? $asignacion['evaluado']['nom_completo'] : $_SESSION['COMPANY']['nombre'];
                        ?>
                    </div>
                </div>
                <?php if($asignacion['asignacion']['tipo'] == 'P2P'){ ?>
                <div class="tab33">
                    <div class="t14 ff2 color666 mb3">Perfil aplicado</div>
                    <div class="t16 ff4 colorGrowi"><?= $asignacion['evaluado']['perfil']['nombre'] ?> </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="tab">
        <div class="tab50">
            <div class="t14 colorGrowi ff3 mb5">Progreso (0%)</div>
            <div class="bccc rr5 ovH">
                <div class="w5 rr5 p5 bVerde"></div>
            </div>
        </div>
        <div class="tab50 taR">
            <div class="btn-1 btn-zm">
                <i class="las la-play left"></i>
                <span class="t14 ff3 colorfff">Iniciar estudio</span>
            </div>

        </div>
    </div>

</a>