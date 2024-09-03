<?php
    // echo "<pre>";
    // print_r($mis_tp);
    // echo "</pre>";
?>


<div id="lolo<?= $mis_tp["id"]; ?>" class="bMorado5 bS1 bCeee rr5 bShadow3 mb10" style="overflow:hidden">

    <div class="tab tU estado<?= $mis_tp["estado"]; ?> rr5 colorfff ff3 <?php if($mis_tp["vencido"]) echo 'vencido'; ?>">

        <div class="tabIn" style="padding:13px 0 13px 10px;">
            <div class="dIB pR10 taC t14 colorfff">
                <?php if($mis_tp["estado"] == 0) echo '<i class="fas fa-minus"></i>' ?>
                <?php if($mis_tp["estado"] == 1) echo '<i class="fas fa-spinner"></i>' ?>
                <?php if($mis_tp["estado"] == 2) echo '<i class="fas fa-check"></i>' ?>
            </div>
            <?php if($mis_tp["vencido"]) echo 'Vencido'; else echo $estado[$mis_tp["estado"]]; ?>
        </div>

        <?php if($_SESSION["WORKER"]["id"] == $trabajador["id"] && $mis_tp["estado"] > 0){ ?>
            <div class="tabIn w40x taR">
                <div class="wh40 dIB bHover2 taC cP" onClick="Ion.moveTaskPer(<?= $mis_tp["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'left')" style="padding-top:13px; border-left:1px solid #ccc" title="Mover a estado anterior">
                    <i class="fas fa-reply"></i>
                </div>
            </div>
        <?php } if($_SESSION["WORKER"]["id"] == $trabajador["id"] && $mis_tp["estado"] < 2){ ?>
            <div class="tabIn w40x taR">
                <div class="wh40 dIB bHover2 taC cP" onClick="Ion.moveTaskPer(<?= $mis_tp["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'right')" style="padding-top:13px; border-left:1px solid #ccc" title="Mover a estado siguiente">
                    <i class="fas fa-reply fa-flip-horizontal"></i>
                </div>
            </div>
        <?php } ?>
        <div class="tabIn w40x taR">
            <a href="kr_tareapersonaleditar_<?= $mis_tp["id"]; ?>.html" class="wh40 dIB bHover2 taC colorfff cP" style="padding-top:13px; border-left:1px solid #ccc" title="Editar">
                <i class="fas fa-edit"></i>
            </a>
        </div>
        <div class="tabIn w40x taR">
            <div class="wh40 dIB bHover2 taC cP" onClick="Ion.deleteTaskPer(<?= $mis_tp["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'right')" style="padding-top:13px; border-left:1px solid #ccc" title="Eliminar">
                <i class="fas fa-trash"></i>
            </div>
        </div>
    </div>

    <div class="p10">
        <div class="ff3 t16 colorMorado mb5"><?= ($mis_tp["nombre"]); ?></div>
        <div class="ff0 color666"><?= ($mis_tp["descripcion"]); ?></div>
    </div>

</div>