<div class="bShadow3 p10 posR rr15 grover cP" style="background-color: <?= $reconocimiento["color"]; ?>;" onclick="Ion.GrowiModal('reconocimiento', '<?= $reconocimiento['uuid']; ?>')">

    <div class="posA w100 h100_ bfffT rr15" style="left:0; top:0; z-index:1;"></div>
    <div class="posA w100 h100_ bfffT rr15" style="left:0; top:0; z-index:1;"></div>

    <div class="posR" style="z-index:2;">
        <div class="bfff pAA40 rr15 celebration-container">

            <div class="posA getD bGrowi bS5" style="transform:rotate(45deg); top:-100%; width:100%; height:100%;">
                <div class="posA w100 h100_ bfffT3" style="bottom:10%; right:10%;">
                    <div class="posA w100 h100_ bGrowi" style="bottom:5%; right:5%;"></div>
                </div>
            </div>

            <div class="posR w70 max200 mAUTO getWpoli">
                <div class="posA w100 h100_" style="z-index:1;">
                    <div class="vMM posR"><div class="bShadow3 rr50 setWpoli mAUTO rr10" style="background-color:<?= $reconocimiento["color"]; ?>;"></div></div>
                </div>
                <div class="posA w100 h100_" style="z-index:2;">
                    <div class="vMM posR"><div class="rr50 setWpoli2 b000T2 mAUTO rr10"></div></div>
                </div>
                <div class="posA w100 h100_" style="z-index:3;">
                    <div class="vMM posR"><div class="rr50 setWpoli3 bfffT mAUTO rr10" style="background-color: <?= $reconocimiento["color"]; ?>;"></div></div>
                </div>

                <div class="posA w100 h100_" style="z-index:4;">
                    <div class="vMM posR ofH">
                        <div class="posR rr50 setWpoli mAUTO rr10 ofH">
                            <div class="posA w100 h100_ bfffT" style="transform:rotate(45deg); left:-50%; top:-50%; width:120%; height:120%;background: linear-gradient(to bottom, rgba(255,255,255,0.10) 0%,rgba(255,255,255,0.60) 100%);"></div>
                        </div>
                    </div>
                </div>

                <div class="posA w100 h100_" style="z-index:5;">
                    <div class="vMM posR t120 colorfff tShadow2"><i class="<?= $reconocimiento["icono"]; ?>"></i></div>
                </div>

                <div class="posA w100 h100_" style="z-index:6;">
                    <div class="posA wh60 bGrowi colorfff t24 ff3 rr50" style="right:0px; bottom:0px;"><div class="vMM"><?= $reconocimiento["cantidad"]; ?></div></div>
                </div>

            </div>
        </div>
        <div class="p20">
            <div class="t14 ff3 mb10">Te han otorgado el reconocimiento</div>
            <div class="t24 ff4 truncate-1"><?= $reconocimiento["nombre"]; ?></div>
            <div class="h20"></div>
        </div>
    </div>

</div>
