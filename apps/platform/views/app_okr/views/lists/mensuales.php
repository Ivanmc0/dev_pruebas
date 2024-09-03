<div id="nivel4-<?= $accion["id"]; ?>">
    <?php
		$nivel4 = 1;
        if(isset($accion["mensuales"])) {
            foreach($accion["mensuales"] AS $mensual){
                $mensulur = 1;
                if($mensual["semanas_promedio"] == 100) $mensulur   = 2;
                if($mensual["semanas_promedio"] == 0) $mensulur     = 0;
    ?>
        <div id="n4-<?= $mensual["id"]; ?>" class="bBS1 bTS1 posR" style="z-index:<?= 100-4; ?>; margin-bottom:-1px;">
            <div class="tab">
                <div class="tabIn p20 posR">
                    <div class="posA w20x h100_" style="top:0; left:-20px; border-left:1px solid #ccc;"><div class="posA w20x bBS1 bfff" style="top:0; left:0; height:50%;"><div class="triangulo posA" style="bottom:-5px; right:-2px;"></div></div></div>
                    <div class="ff3 tU t12 colorMorado2 mb5">Sprint Mensual #<?= $nivel4; ?></div>
                    <div class="ff2 t14 color666 mb5"><?= $_ZOOM->verMes($mensual["mes"])." / ".($mensual["ano"]); ?></div>
                    <div class="ff2 t16 color333"><?= ($mensual["nombre"]); ?></div>
                </div>
                <div class="tabIn pLR10 w200x">
                    <div class="rr10 bccc">
                        <div class="p5 estado<?= $mensulur; ?> rr10" style="width:<?= $mensual["semanas_promedio"]; ?>%;"></div>
                    </div>
                </div>
                <div class="tabIn pLR10 w150x">
                    <div class="estadot<?= $mensulur; ?> ff2">
                        <div class="wh10 rr50 estado<?= $mensulur; ?> dIB"></div> &nbsp;
                        <?= $estado[$mensulur]; ?>
                    </div>
                </div>
                <div class="tabIn pLR10 w150x">
                    <div class="color333 ff3"><?= ucwords(strtolower(($mensual["responsable"]["nombre"]))); ?></div>
                    <div class="color666 t12"><?= ucwords(strtolower(($mensual["responsable"]["cargo"]))); ?></div>
                </div>
                <div class="tabIn pAA10 w120x pR10 taC">
                    <div class="btn-group btn-block" role="group">
                        <a href="kr_sprint_<?= $_SESSION["thisProject"]; ?>_<?= $mensual["id"]; ?>.html" class="btn btn-success w100 bfff bCMorado colorMorado bHover2 btn-sm"><i class="fas fa-long-arrow-alt-right"></i></a>
                        <?php if(isset($mensual["semanas"])){ ?>
                            <div class="btn btn-success w100 bfff bCMorado colorMorado bHover2 btn-sm" data-toggle="collapse" data-target="#nn4-<?= $mensual["id"]; ?>" aria-expanded="false" aria-controls="nn4-<?= $mensual["id"]; ?>"><i class="fas fa-level-down-alt"></i></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="nn4-<?= $mensual["id"]; ?>" class="collapse pL21 posR" aria-labelledby="n4-<?= $mensual["id"]; ?>" data-parent="#nivel4-<?= $accion["id"]; ?>" style="z-index:<?= 100-5; ?>; border-left:1px solid #ccc;">
            <?php include "lists/semanales.php"; ?>
        </div>

    <?php
                $nivel4++;
            }
        }
    ?>
</div>