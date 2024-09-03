<div id="nivel3-<?= $krs["id"]; ?>">
    <?php
		$nivel3 = 1;
        if(isset($krs["acciones"])) {
            foreach($krs["acciones"] AS $accion){
                $acclur = 1;
                if($accion["mes_promedio"] == 100) $acclur   = 2;
                if($accion["mes_promedio"] == 0) $acclur     = 0;
    ?>
        <div id="n3-<?= $accion["id"]; ?>" class="bBS1 bTS1 posR" style="z-index:<?= 100-3; ?>; margin-bottom:-1px;">
            <div class="tab">
                <div class="tabIn p20 posR">
                    <div class="posA w20x h100_" style="top:0; left:-20px; border-left:1px solid #ccc;"><div class="posA w20x bBS1 bfff" style="top:0; left:0; height:50%;"><div class="triangulo posA" style="bottom:-5px; right:-2px;"></div></div></div>
                    <div class="ff3 tU t12 colorMorado2 mb5">Acción #<?= $nivel3; ?></div>
                    <div class="ff2 t16 color333"><?= ($accion["nombre"]); ?></div>
                </div>
                <div class="tabIn pLR10 w200x">
                    <div class="rr10 bccc">
                        <div class="p5 estado<?= $acclur; ?> rr10" style="width:<?= $accion["mes_promedio"]; ?>%;"></div>
                    </div>
                </div>
                <div class="tabIn pLR10 w150x">
                    <div class="estadot<?= $acclur; ?> ff2">
                        <div class="wh10 rr50 estado<?= $acclur; ?> dIB"></div> &nbsp;
                        <?= $estado[$acclur]; ?>
                    </div>
                </div>
                <div class="tabIn pLR10 w150x">
                    <div class="color333 ff3"><?= ucwords(strtolower(($accion["responsable"]["nombre"]))); ?></div>
                    <div class="color666 t12"><?= ucwords(strtolower(($accion["responsable"]["cargo"]))); ?></div>
                </div>
                <div class="tabIn pAA10 w120x pR10 taC">

                    <div class="btn-group btn-block" role="group">
                        <a href="kr_accion_<?= $_SESSION["thisProject"]; ?>_<?= $accion["id"]; ?>.html" class="btn btn-success w100 bfff bCMorado colorMorado bHover2 btn-sm"><i class="fas fa-long-arrow-alt-right"></i></a>
                        <?php if(isset($accion["mensuales"])){ ?>
                            <div class="btn btn-success w100 bfff bCMorado colorMorado bHover2 btn-sm" data-toggle="collapse" data-target="#nn3-<?= $accion["id"]; ?>" aria-expanded="false" aria-controls="nn3-<?= $accion["id"]; ?>"><i class="fas fa-level-down-alt"></i></div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
        <div id="nn3-<?= $accion["id"]; ?>" class="collapse pL21 posR" aria-labelledby="n3-<?= $accion["id"]; ?>" data-parent="#nivel3-<?= $krs["id"]; ?>" style="z-index:<?= 100-4; ?>; border-left:1px solid #ccc;">
            <?php include "lists/mensuales.php"; ?>
        </div>

    <?php
                $nivel3++;
            }
        }
    ?>
</div>