<div id="nivel1">
    <?php
        $nivel1 = 1;
        if(isset($mega)){
            foreach($mega AS $objs){
                $objlur = 1;
                if($objs["krs_promedio"] == 100) $objlur   = 2;
                if($objs["krs_promedio"] == 0) $objlur     = 0;
    ?>
        <div id="n1-<?= $objs["id"]; ?>" class="bBS1 bTS1 posR" style="z-index:<?= 100-1; ?>; margin-bottom:-1px;">
            <div class="tab">
                <div class="tabIn p20">
                    <div class="ff3 tU t12 colorMorado2 mb5">Objetivo #<?= $nivel1; ?></div>
                    <div class="ff2 t16 color333"><?= ($objs["nombre"]); ?></div>
                </div>
                <div class="tabIn pLR10 w200x">
                    <div class="rr10 bccc">
                        <div class="p5 estado<?= $objlur; ?> rr10" style="width:<?= $objs["krs_promedio"]; ?>%;"></div>
                    </div>
                </div>
                <div class="tabIn pLR10 w150x">
                    <div class="estadot<?= $objlur; ?> ff2">
                        <div class="wh10 rr50 estado<?= $objlur; ?> dIB"></div> &nbsp;
                        <?= $estado[$objlur]; ?>
                    </div>
                </div>
                <div class="tabIn pLR10 w150x">
                    <div class="color333 ff3"><?= ucwords(strtolower(($objs["responsable"]["nombre"]))); ?></div>
                    <div class="color666 t12"><?= ucwords(strtolower(($objs["responsable"]["cargo"]))); ?></div>
                </div>
                <div class="tabIn pAA10 w120x pR10 taC">
                    <div class="btn-group btn-block" role="group">
                        <a href="kr_objetivo_<?= $_SESSION["thisProject"]; ?>_<?= $objs["id"]; ?>.html" class="btn btn-success w100 bfff bCMorado colorMorado bHover2 btn-sm"><i class="fas fa-long-arrow-alt-right"></i></a>
                        <?php if(isset($objs["krs"])){ ?>
                            <div class="btn btn-success w50--- btn-block bfff bCMorado colorMorado bHover2 btn-sm" data-toggle="collapse" data-target="#nn1-<?= $objs["id"]; ?>" aria-expanded="false" aria-controls="nn1-<?= $objs["id"]; ?>"><i class="fas fa-level-down-alt"></i></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="nn1-<?= $objs["id"]; ?>" class="collapse pL21 posR" aria-labelledby="n1-<?= $objs["id"]; ?>" data-parent="#nivel1" style="z-index:<?= 100-2; ?>; border-left:1px solid #ccc;">
            <?php include "lists/krs.php"; ?>
        </div>
    <?php
                $nivel1++;
            }
        }
    ?>
</div>