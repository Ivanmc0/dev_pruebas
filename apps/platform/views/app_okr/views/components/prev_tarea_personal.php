<?php $vencido = 0; ?>

<div class="bfff bS1 bCeee rr20 bShadow3 mb20">

    <div class="tab tU bBS1 rr20 estado<?= $tarea["estado"]; ?> colorfff ff3 <?php if($vencido) echo 'vencido'; ?>">
        <div class="tabIn w40x taL">
            <?php if($tarea["estado"] != 0){ ?>
                <div class="wh40 rr50 dIB bHover2 taC cP bfff estadot<?= $tarea["estado"]; ?>" onClick="Ion.moveTaskPer(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'left')" style="padding-top:13px;border-right:1px solid #ccc; margin-bottom:-1px">
                    <i class="fas fa-reply"></i>
                </div>
            <?php } ?>
        </div>
        <div class="tabIn taC" style="padding:13px 0;">
            <div class="dIB pR10 taC t14 colorfff">
                <?php if($tarea["estado"] == 0) echo '<i class="fas fa-minus"></i>' ?>
                <?php if($tarea["estado"] == 1) echo '<i class="fas fa-spinner"></i>' ?>
                <?php if($tarea["estado"] == 2) echo '<i class="fas fa-check"></i>' ?>
            </div>
            <?php if($vencido) echo 'Vencido'; else echo $estado[$tarea["estado"]]; ?>
        </div>
        <div class="tabIn w40x taR">
            <?php if($tarea["estado"] != 2){ ?>
                <div class="wh40 rr50 dIB bHover2 taC cP bfff estadot<?= $tarea["estado"]; ?>" onClick="Ion.moveTaskPer(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'right')" style="padding-top:13px; border-left:1px solid #ccc; margin-bottom:-1px">
                    <i class="fas fa-reply fa-flip-horizontal"></i>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="p20 bBS1 bCeee">
        <div class="ff3 t14 color333 mb5"><?= ($tarea["nombre"]); ?></div>
        <div class="color666 t12 mb10"><?= ($tarea["descripcion"]); ?></div>
    </div>

    <div class="tab">
        <div class="tab50">
            <a href="<?= $tarea["id"]; ?>/editar/" class="dB taC pAA10 estadot<?= $tarea["estado"]; ?> bHover2 cP" title="Editar">
                <i class="fas fa-edit"></i>
            </a>
        </div>
        <div class="tab50">
            <div class="dB taC pAA10 estadot<?= $tarea["estado"]; ?> bHover2 cP" onClick="Ion.deleteTaskPer(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'right')" title="Eliminar">
                <i class="fas fa-trash"></i>
            </div>
        </div>
    </div>

</div>