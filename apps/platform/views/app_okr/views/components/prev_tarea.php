<?php
    // echo "<pre>";
    // print_r($tarea);
    // echo "</pre>";

    $vencido = 0;
    if($tarea["id_semana"] < $today["id"] && $tarea["estado"] != 2) $vencido = 1;

    $responsable = $_TUCOACH->get_data("zoom_users", " AND id = ".$tarea["id_responsable"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ", 0);

?>

<div class="bfff bS1 bCeee rr20 bShadow3 mb20" style="overflow:hidden;">

    <div class="tab tU bBS1 rr20 estado<?= $tarea["estado"]; ?> colorfff ff3 <?php if($vencido) echo 'vencido'; ?>">
        <div class="tabIn w40x taL">
            <?php if($tarea["estado"] != 0 && $_SESSION["WORKER"]["id"] == $tarea["id_responsable"] && $tarea["id_semana"] == $today["id"]){ ?>
                <div class="wh40 rr50 dIB bHover2 taC cP bfff estadot<?= $tarea["estado"]; ?>" onClick="Ion.moveTask3(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'left')" style="padding-top:13px;border-right:1px solid #ccc; margin-bottom:-1px">
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
            <?php if($tarea["estado"] != 2 && $_SESSION["WORKER"]["id"] == $tarea["id_responsable"] && $tarea["id_semana"] == $today["id"]){ ?>
                <div class="wh40 rr50 dIB bHover2 taC cP bfff estadot<?= $tarea["estado"]; ?>" onClick="Ion.moveTask3(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'right')" style="padding-top:13px; border-left:1px solid #ccc; margin-bottom:-1px">
                    <i class="fas fa-reply fa-flip-horizontal"></i>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="p20">
        <div class="ff3 t14 color333 mb5"><?= ($tarea["nombre"]); ?></div>
        <div class="color666 t12"><?= ($tarea["descripcion"]); ?></div>
    </div>

    <div class="tab p1020 bS1 bCeee bGray color999">
        <div class="tabIn w30x"><i class="far fa-user"></i></div>
        <div class="tabIn ff2 color666"><?= ucwords(strtolower(($responsable["nombre"]))); ?></div>
    </div>

    <div class="tab p1020 bBS1 bCeee color999">
        <div class="tabIn w30x"><i class="far fa-calendar"></i></div>
        <div class="tabIn">Semana <?= $week["semana"]; ?></div>
        <div class="tabIn taR">
            <div class="ff2 t12 dIB"><?= $_TUCOACH->pulirFecha($week["fecha_desde"],$week["fecha_hasta"]); ?></div>
        </div>
    </div>
<?php

    if($star = $_OKR->get_task(" AND TASK.id = ".$tarea["id"]." AND PROY.id = ".$proyecto["id"]." AND EMP.id = ".$_SESSION["COMPANY"]["id"]."  ")){

    $star = $star[0];

    echo '
        <div class="tab p1020 color999">
            <div class="tabIn w30x"><i class="fas fa-list-ol"></i></div>
            <div class="tabIn">Pertenece a</div>
            <div class="tabIn taR"><div class="dIB t12 ff2 b999 colorfff rr3 p310 cP bHover btn-migas btn-migas-'.$tarea["id"].'" migas="'.$tarea["id"].'">Mostrar</div></div>
        </div>
        <div class="bfff p10 dN dMigas dMigas-'.$tarea["id"].'" style="padding-left:50px; margin-top:-15px;">
            <a class="dB p10 bN5 color999 bHover" href="'.$dominion.'proyecto/sprint/'.$star["id_sprint"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_sprint"]).'">
                <div class="tU t10 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right"></i> &nbsp; Sprint</div>
                <div class="t12 ff3 color000 oEllipsis">'.ucfirst(strtolower(($star["nombre_sprint"]))).'</div>
            </a>
            <a class="dB p10 bN4 color999 bHover" href="'.$dominion.'proyecto/accizen/'.$star["id_accion"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_accion"]).'">
                <div class="tU t10 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right"></i> &nbsp; Acción</div>
                <div class="t12 ff3 color000 oEllipsis">'.ucfirst(strtolower(($star["nombre_accion"]))).'</div>
            </a>
            <a class="dB p10 bN3 color999 bHover" href="'.$dominion.'proyecto/kr/'.$star["id_kr"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_kr"]).'">
                <div class="tU t10 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right"></i> &nbsp; KR</div>
                <div class="t12 ff3 color000 oEllipsis">'.ucfirst(strtolower(($star["nombre_kr"]))).'</div>
            </a>
            <a class="dB p10 bN2 color999 bHover" href="'.$dominion.'proyecto/objetivo/'.$star["id_objetivo"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_objetivo"]).'">
                <div class="tU t10 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right"></i> &nbsp; Objetivo</div>
                <div class="t12 ff3 color000 oEllipsis">'.ucfirst(strtolower(($star["nombre_objetivo"]))).'</div>
            </a>
            <a class="dB p10 bN1 color999 bHover" href="'.$dominion.'proyecto/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_proyecto"]).'">
                <div class="tU t10 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right"></i> &nbsp; Proyecto</div>
                <div class="t12 ff3 color000 oEllipsis">'.ucfirst(strtolower(($star["nombre_proyecto"]))).'</div>
            </a>
        </div>
    ';
    }
?>

    <a class="tab w100 p15 beee bHover" href="<?= $dominion; ?>proyecto/tarea/<?= $tarea["id"]; ?>/">
        <?php if($tarea["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
            <div class="tabIn"><div class="dIB bMorado colorfff t10 tU p510 rr3">Soy Responsable</div></div>
        <?php } ?>
        <div class="tabIn taR colorMorado tU ff2 t12">Detalle de tarea &nbsp; <i class="fas fa-arrow-right"></i></div>
    </a>

</div>