<div id="nivel6-<?= $semanal["id"]; ?>">
    <?php
		$nivel6 = 1;
        if(isset($semanal["tareas"])) {
            foreach($semanal["tareas"] AS $tarea){
    ?>
        <div id="n6-<?= $tarea["id"]; ?>" class="bBS1 bTS1 posR" style="z-index:<?= 100-6; ?>; margin-bottom:-1px;">
            <div class="tab">
                <div class="tabIn p20 posR">
                    <div class="posA w20x h100_" style="top:0; left:-20px; border-left:1px solid #ccc;"><div class="posA w20x bBS1 bfff" style="top:0; left:0; height:50%;"><div class="triangulo posA" style="bottom:-5px; right:-2px;"></div></div></div>
                    <div class="ff3 tU t12 colorMorado2 mb5">Tarea #<?= $nivel6; ?></div>
                    <div class="ff2 t16 color333"><?= ($tarea["nombre"]); ?></div>

                </div>
                <div class="tabIn pLR10 w200x taC t20 estadot<?= $tarea["estado"]; ?> <?php if($tarea["vencido"]) echo 'vencidot'; ?>">
                    <?php if($tarea["estado"] == 0) echo '<i class="fas fa-minus"></i>' ?>
                    <?php if($tarea["estado"] == 1) echo '<i class="fas fa-spinner"></i>' ?>
                    <?php if($tarea["estado"] == 2) echo '<i class="fas fa-check"></i>' ?>
                </div>
                <div class="tabIn pLR10 w150x">
                    <div class="estadot<?= $tarea["estado"]; ?> <?php if($tarea["vencido"]) echo 'vencidot'; ?> ff2">
                        <div class="wh10 rr50 estado<?= $tarea["estado"]; ?> <?php if($tarea["vencido"]) echo 'vencido'; ?> dIB"></div> &nbsp;
                        <?php if($tarea["vencido"]) echo 'Vencido'; else echo $estado[$tarea["estado"]]; ?>
                    </div>
                </div>
                <div class="tabIn pLR10 w150x">
                    <div class="color333 ff3"><?= ucwords(strtolower(($tarea["responsable"]["nombre"]))); ?></div>
                    <div class="color666 t12"><?= ucwords(strtolower(($tarea["responsable"]["cargo"]))); ?></div>
                </div>
                <div class="tabIn pAA10 w120x pR10 taC">
                    <div class="btn-group btn-block" role="group">
                        <a href="kr_tarea_<?= $getVal[2]; ?>_<?= $tarea["id"]; ?>.html" class="btn btn-success w100 bfff bCMorado colorMorado bHover2 btn-sm"><i class="fas fa-search"></i></a>
                        <?php if($tarea["id_responsable_mes"] == $_SESSION["WORKER"]["id"] && $tarea["estado"] != 2){ ?>
                            <a href="kr_tareaeditar_<?= $getVal[2]; ?>_<?= $tarea["id"]; ?>.html" class="btn btn-success w100 bfff bCMorado colorMorado bHover2 btn-sm"><i class="fas fa-edit"></i></a>
                            <a onClick="Ion.task_on(<?= $tarea["id"]; ?>)" class="btn btn-danger w100 colorfff btn-sm"><i class="fas fa-trash-alt colorfff"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    <?php
                $nivel6++;
            }
        }
    ?>
</div>