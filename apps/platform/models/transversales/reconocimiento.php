<?php require_once ('../../appInit.php');

    $reconocimiento = $_WORKERS->MiReconocimiento($_SESSION['WORKER']['id'], "'".$_POST['value']."'");
 

?>

<div class="p30-">

    <div class="bShadow3 p10 posR" style="background-color: <?= $reconocimiento["color"]; ?>;">

        <div class="posA w100 h100_ bfffT" style="left:0; top:0; z-index:1;"></div>
        <div class="posA w100 h100_ bfffT" style="left:0; top:0; z-index:1;"></div>

        <div class="tab posR" style="z-index:2;">
            <div class="tabIn w150x">
                <div class="posR">
                    <div class="bfff wh150 bS1 bCfff rr15 posR celebration-container">

                        <div class="posA wh120 bGrowi bS5" style="transform:rotate(45deg); top:-90px; left:15px">
                            <div class="posA w100 h100_ bfffT3" style="bottom:10%; right:10%;">
                                <div class="posA w100 h100_ bGrowi" style="bottom:5%; right:5%;"></div>
                            </div>
                        </div>

                        <div class="posR wh120 mAUTO">

                            <div class="posA bShadow3 rr50 wh120 taC" style="z-index:1; top:15px; background-color:<?= $reconocimiento["color"]; ?>;">
                                <div class="posA w100 h100_ rr50 mAUTO ofH" style="z-index: 10;">
                                    <div class="posA w100 h100_ bfffT" style="transform:rotate(45deg); left:-50%; top:-50%; width:120%; height:120%; background: linear-gradient(to bottom, rgba(255,255,255,0.10) 0%,rgba(255,255,255,0.60) 100%);"></div>
                                </div>
                                <div class="vMM">
                                    <div class="posR w90 h90_ mAUTO b000T2 rr50 rr10 taC" style="z-index:2;">
                                        <div class="vMM">
                                            <div class="posR w90 h90_ mAUTO bfffT rr50 rr10 taC" style="z-index:3; background-color:<?= $reconocimiento["color"]; ?>;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="posA wh120" style="z-index:5; top:15px;">
                                <div class="vMM posR t80 colorfff tShadow2"><i class="<?= $reconocimiento["icono"]; ?>"></i></div>
                            </div>

                            <div class="posA w100 h100_" style="z-index:6;">
                                <div class="posA wh40 bGrowi colorfff t18 ff3 rr50" style="right:-10px; bottom:-10px;"><div class="vMM"><?= count($reconocimiento["soluciones"]); ?></div></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tabIn pLR30">
                <div class="t14 ff3 mb10">Reconocimiento por</div>
                <div class="t30 ff4 truncate-1"><?= $reconocimiento["nombre"]; ?></div>
            </div>
        </div>

    </div>

</div>

<div class="p2040">

    <div class="tab pAA10">
        <div class="tabIn w40x taC"><div class="wh30 rr3 beee t20"><div class="vMM"><i class="las la-user"></i></div></div></div>
        <div class="tabIn color333 t16 ff2">(<?= count($reconocimiento["soluciones"]); ?>) personas te han dado el reconocimiento.</div>
    </div>
    <?php foreach ($reconocimiento["soluciones"] as $solucion) { ?>
        <div class="bS1 bGray rr3 mb20">
            <div class="tab bBS1">
                <div class="tabIn w100x pAA10">
                    <div class="wh60 bGrowi t24 ff4 colorfff rr50 mAUTO"><div class="vMM"><?= $solucion["sigla"]; ?></div></div>
                </div>
                <div class="tabIn pR20">
                    <div class="t18 ff3 mb5"><?= $solucion["reconocedor"]; ?></div>
                    <div class="color666"><?= $solucion["comentario"]; ?></div>
                </div>
            </div>
            <div class="tab">
                <div class="tabIn w100x"></div>
                <div class="tabIn pAA10">
                    <div class="dIB t20"><i class="las la-calendar-check"></i></div>
                    <div class="dIB t14 color666"><?= $solucion["fecha"]; ?></div>
                    <div class="dIB w20x"></div>
                    <div class="dIB t20"><i class="las la-clipboard-check"></i></div>
                    <div class="dIB t14 ff3 color666"><?= $reconocimiento["actividad"]; ?></div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>