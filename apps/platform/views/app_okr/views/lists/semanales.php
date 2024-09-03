<div id="nivel5-<?= $mensual["id"]; ?>">
    <?php
		$nivel5 = 1;
        if(isset($mensual["semanas"])) {
            foreach($mensual["semanas"] AS $semanal){
                $culur = 1;
                if($semanal["tareas_promedio"] == 100) $culur   = 2;
                if($semanal["tareas_promedio"] == 0) $culur     = 0;

    ?>
        <div id="n5-<?= $semanal["id"]; ?>" class="bBS1 bTS1 posR" style="z-index:<?= 100-5; ?>; margin-bottom:-1px;">
            <div class="tab">
                <div class="tabIn p20 posR">
                    <div class="posA w20x h100_" style="top:0; left:-20px; border-left:1px solid #ccc;"><div class="posA w20x bBS1 bfff" style="top:0; left:0; height:50%;"><div class="triangulo posA" style="bottom:-5px; right:-2px;"></div></div></div>
                    <div class="ff2 dIB t14 p310 rr5 <?php if(isset($semanal["tareas"])) echo "bMorado2 colorfff"; else echo "beee color999"; ?>">
                        Semana <?= ($semanal["semana"])." <small>(".$_ZOOM->pulirFecha($semanal["fecha_desde"],$semanal["fecha_hasta"]).")</small>"; ?>
                    </div>
                </div>
                <div class="tabIn pLR10 w200x">
                    <?php if(isset($semanal["tareas"])){ ?>
                        <div class="rr10 bccc">
                            <div class="p5 estado<?= $culur; ?> <?php if($semanal["incumplido"] > 0) echo "vencido"; ?> rr10" style="width:<?= $semanal["tareas_promedio"]; ?>%;"></div>
                        </div>
                    <?php } ?>
                </div>
                <div class="tabIn pLR10 w150x">
                    <?php if(isset($semanal["tareas"])){ ?>
                        <div class="estadot<?= $culur; ?> <?php if($semanal["incumplido"] > 0) echo "vencidot"; ?> ff2">
                            <div class="wh10 rr50 estado<?= $culur; ?> <?php if($semanal["incumplido"] > 0) echo "vencido"; ?> dIB"></div> &nbsp;
                            <?php if($semanal["incumplido"] > 0) echo "Incompleto"; else echo $estado[$culur]; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="tabIn pLR10 w150x"></div>
                <div class="tabIn pAA10 w120x pR10 taC">
                    <div class="btn-group btn-block" role="group">
                        <a href="kr_semana_<?= $getVal[2]; ?>_<?= $mensual["id"];?>_<?= $semanal["id"]; ?>.html" class="btn btn-success w100 bfff bCMorado colorMorado bHover2 btn-sm"><i class="fas fa-long-arrow-alt-right"></i></a>
                        <?php if(isset($semanal["tareas"])){ ?>
                            <div class="btn btn-success w100 bfff bCMorado colorMorado bHover2 btn-sm" data-toggle="collapse" data-target="#nn5-<?= $semanal["id"]; ?>" aria-expanded="false" aria-controls="nn5-<?= $semanal["id"]; ?>"><i class="fas fa-level-down-alt"></i></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="nn5-<?= $semanal["id"]; ?>" class="collapse pL21 posR" aria-labelledby="n5-<?= $semanal["id"]; ?>" data-parent="#nivel5-<?= $mensual["id"]; ?>" style="z-index:<?= 100-6; ?>; border-left:1px solid #ccc;">
            <?php include "lists/tareas.php"; ?>
        </div>

    <?php
                $nivel5++;
            }
        }
    ?>
</div>