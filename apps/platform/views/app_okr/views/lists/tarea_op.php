<?php
    // echo "<pre>";
    // print_r($tarea);
    // echo "</pre>";
?>

<div class="bfff bS1 bCeee rr5 bShadow3 mb20">

    <div class="tab tU estado<?= $tarea["estado"]; ?> rr5 colorfff ff3 <?php if($tarea["vencido"]) echo 'vencido'; ?>">
        <div class="tabIn w40x taL">
            <?php if($tarea["estado"] != 0 && $_SESSION["WORKER"]["id"] == $tarea["id_responsable"] && $tarea["id_semana"] == $this_week["id"]){ ?>
                <div class="wh40 dIB bHover2 taC cP" onClick="Ion.moveTask(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'left')" style="padding-top:13px;border-right:1px solid #ccc">
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
            <?php if($tarea["vencido"]) echo 'Vencido'; else echo $estado[$tarea["estado"]]; ?>
        </div>
        <div class="tabIn w40x taR">
            <?php if($tarea["estado"] != 2 && $_SESSION["WORKER"]["id"] == $tarea["id_responsable"] && $tarea["id_semana"] == $this_week["id"]){ ?>
                <div class="wh40 dIB bHover2 taC cP" onClick="Ion.moveTask(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'right')" style="padding-top:13px; border-left:1px solid #ccc">
                    <i class="fas fa-reply fa-flip-horizontal"></i>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="p20">
        <div class="ff3 t16 color333 mb5"><?= ($tarea["nombre"]); ?></div>
        <div class="color666"><?= ($tarea["descripcion"]); ?></div>
    </div>

    <div class="pLR20 mb10">
        <div class="tab bGray rr5 bS1 p10 color999">
            <div class="tabIn w30x"><i class="far fa-user"></i></div>
            <div class="tabIn ff2 color666"><?= ucwords(strtolower(($tarea["responsable"]["nombre"]))); ?></div>
            <div class="tabIn color999 t12 taR">Responsable</div>
        </div>
    </div>
<!--
    <div class="p10 bBS1 bCeee">
        <div class="bS1 bCeee bHover2 rr5">
            <div class="tab bGray rr5 bS1 p10 color999">
                <div class="tabIn w30x"><i class="far fa-user"></i></div>
                <div class="tabIn ff2 color666"><?= ucwords(strtolower(($tarea["responsable"]["nombre"]))); ?></div>
                <div class="tabIn color999 t12 taR">Responsable</div>
            </div>
            <?php if(isset($tarea["corresponsables"])){ ?>
                <div class="tab p10 color999">
                    <div class="tabIn w30x"><i class="fas fa-users"></i></div>
                    <div class="tabIn ff2 color666">
                        <?php foreach($tarea["corresponsables"] AS $cuur){ ?>
                            <div class="p3"><div class="dIB pR5 color999">•</div><?= ucwords(strtolower(($cuur["nombre"]))); ?></div>
                        <?php } ?>
                    </div>
                    <div class="tabIn color999 t12 taR">Co-Responsables</div>
                </div>
            <?php } ?>
        </div>
    </div> -->

    <div class="tab p1020 bBS1 bCeee color999">
        <div class="tabIn w30x pL5"><i class="far fa-calendar"></i></div>
        <div class="tabIn">Semana <?=$tarea["semana"]; ?></div>
        <div class="tabIn taR">
            <div class="ff2 t12 dIB"><?= $_ZOOM->pulirFecha($selWeek["fecha_desde"],$selWeek["fecha_hasta"]); ?></div>
        </div>
    </div>
    <a class="tab w100 p15 bHover2" href="kr_tarea_<?=$_SESSION["thisProject"]?>_<?=$tarea["id"]?>.html">
        <?php if($tarea["id_responsable"] == $_SESSION["WORKER"]["id"] || $coo){ ?>
            <div class="tabIn"><div class="dIB bMorado<?php if($coo) echo "2"; ?> colorfff t10 tU p510 rr3">SOY <?php if($coo) echo "Co-"; ?>Responsable</div></div>
        <?php } ?>
        <div class="tabIn taR colorMorado<?php if($coo) echo "2"; ?> tU ff2 t12">Ver detalles &nbsp; <i class="fas fa-search t10"></i></div>
    </a>

</div>