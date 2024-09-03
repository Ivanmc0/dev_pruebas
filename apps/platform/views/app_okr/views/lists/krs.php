<div id="nivel2-<?= $objs["id"]; ?>">
    <?php
		$nivel2 = 1;
        if(isset($objs["krs"])) {
            foreach($objs["krs"] AS $krs){
                $krlur = 1;
                if($krs["accion_promedio"] == 100) $krlur   = 2;
                if($krs["accion_promedio"] == 0) $krlur     = 0;
    ?>
        <div id="n2-<?= $krs["id"]; ?>" class="bBS1 bTS1 posR" style="z-index:<?= 100-2; ?>; margin-bottom:-1px;">
            <div class="tab">
                <div class="tabIn p20 posR">
                    <div class="posA w20x h100_" style="top:0; left:-20px; border-left:1px solid #ccc;"><div class="posA w20x bBS1 bfff" style="top:0; left:0; height:50%;"><div class="triangulo posA" style="bottom:-5px; right:-2px;"></div></div></div>
                    <div class="ff3 tU t12 colorMorado2 mb5">KR #<?= $nivel2; ?></div>
                    <div class="ff2 t16 color333"><?= ($krs["nombre"]); ?></div>
                </div>
                <div class="tabIn pLR10 w200x">
                    <div class="rr10 bccc">
                        <div class="p5 estado<?= $krlur; ?> rr10" style="width:<?= $krs["accion_promedio"]; ?>%;"></div>
                    </div>
                </div>
                <div class="tabIn pLR10 w150x">
                    <div class="estadot<?= $krlur; ?> ff2">
                        <div class="wh10 rr50 estado<?= $krlur; ?> dIB"></div> &nbsp;
                        <?= $estado[$krlur]; ?>
                    </div>
                </div>
                <div class="tabIn pLR10 w150x">
                    <div class="color333 ff3"><?= ucwords(strtolower(($krs["responsable"]["nombre"]))); ?></div>
                    <div class="color666 t12"><?= ucwords(strtolower(($krs["responsable"]["cargo"]))); ?></div>
                </div>
                <div class="tabIn pAA10 w120x pR10 taC">
                    <div class="btn-group btn-block" role="group">
                        <a href="kr_kr_<?= $_SESSION["thisProject"]; ?>_<?= $krs["id"]; ?>.html" class="btn btn-success w100 bfff bCMorado colorMorado bHover2 btn-sm"><i class="fas fa-long-arrow-alt-right"></i></a>
                        <?php if(isset($krs["acciones"])){ ?>
                            <div class="btn btn-success w100 bfff bCMorado colorMorado bHover2 btn-sm" data-toggle="collapse" data-target="#nn2-<?= $krs["id"]; ?>" aria-expanded="false" aria-controls="nn2-<?= $krs["id"]; ?>"><i class="fas fa-level-down-alt"></i></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="nn2-<?= $krs["id"]; ?>" class="collapse pL21 posR" aria-labelledby="n2-<?= $krs["id"]; ?>" data-parent="#nivel2-<?= $objs["id"]; ?>" style="z-index:<?= 100-3; ?>; border-left:1px solid #ccc;">
            <?php include "lists/acciones.php"; ?>
        </div>

    <?php
                $nivel2++;
            }
        }
    ?>
</div>