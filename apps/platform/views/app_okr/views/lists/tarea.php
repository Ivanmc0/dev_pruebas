<?php
    $sem = $_ZOOM->get_data("olc_semanas", " AND id = ".$tarea["id_semana"]." AND inactivo = 0 AND eliminado = 0 ", 0);
    $vencido = 0;
    if($sem["semana"] < $this_week["semana"] && $tarea["estado"] != 2) $vencido = 1;
    $responsable = $_ZOOM->get_data("zoom_users", " AND id = ".$tarea["id_responsable"]." AND inactivo = 0 AND eliminado = 0 ", 0);
?>
<!--
<pre>
<?php print_r($tarea); ?>
</pre> -->

<div class="bfff bS1 bCeee rr5 bShadow3 mb20">

    <div class="tab p5 tU estado<?= $tarea["estado"]; ?> rr5 colorfff ff3 <?php if($vencido) echo 'vencido'; ?>">
        <div class="tabIn w40x taL">
            <?php if($tarea["estado"] != 0 && $_SESSION["WORKER"]["id"] == $responsable["id"] && $sem["id"] == $this_week["id"]){ ?>
                <div class="wh30 dIB bS1 bHover2 rr5 taC cP" onClick="Ion.moveTask(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'left')" style="padding-top:8px;">
                    <i class="fas fa-reply"></i>
                </div>
            <?php } ?>
        </div>
        <div class="tabIn p10 taC">
            <?php if($vencido) echo 'Vencido'; else echo $estado[$tarea["estado"]]; ?>
        </div>
        <div class="tabIn w40x taR">
            <?php if($tarea["estado"] != 2 && $_SESSION["WORKER"]["id"] == $responsable["id"] && $sem["id"] == $this_week["id"]){ ?>
                <div class="wh30 dIB bS1 bHover2 rr5 taC cP" onClick="Ion.moveTask(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'right')" style="padding-top:8px;">
                    <i class="fas fa-reply fa-flip-horizontal"></i>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="p20 bBS1">
        <div class="ff3 t16 color333 mb5"><?= ($tarea["nombre"]); ?></div>
        <div class="color666"><?= ($tarea["descripcion"]); ?></div>
    </div>

    <?php
        if($responsable){
    ?>
        <div class="tab bBS1 p10 color999">
            <div class="tabIn taC w30x"><i class="far fa-user"></i></div>
            <div class="tabIn">
                <div class="dIB ff3 color666"><?= ucwords(strtolower(($responsable["nombre"]))); ?></div> •
                <div class="dIB color999"><?= ucwords(strtolower(($responsable["cargo"]))); ?></div>
            </div>
        </div>
    <?php } ?>



    <div class="tab p10 color999">
        <div class="tabIn taC w30x"><i class="far fa-calendar"></i></div>
        <div class="tabIn">Semana <?php if($sem) echo $sem["semana"]; ?></div>
    </div>

</div>