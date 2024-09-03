<?php

    if(isset($_SESSION["thisWeek"]) && $_SESSION["thisWeek"] != "" && $_SESSION["thisWeek"] != 0){

        $week = $_TUCOACH->get_data("olc_semanas", " AND id = ".$_SESSION["thisWeek"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);

    }elseif(isset($geton[2]) && $geton[1] == "week") {

        $_SESSION["thisWeek"] = $geton[2];

		$week = $_TUCOACH->get_data("olc_semanas", " AND id = ".$geton[2]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);

	}else {

        $_SESSION["thisWeek"] = $today['id'];
        $week = $_TUCOACH->get_data("olc_semanas", " AND id = ".$today['id']." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);

    }

?>

<div class="tab bBS1 bCeee pAA10 ff3">

    <div class="tabIn p10">
        <div class="t12 ff1 color999 mb3">Estás viendo hasta la</div>
        <div class="ff4 cPrimary tU t16">Semana <?php if($week) echo $week["semana"]; ?> de <?php if($week) echo $week["ano"]; ?></div>
    </div>
    <div class="tabIn p10 taR">
        <div class="dIB bS1 rr5 w250x">
            <select id="changeWeek" name="week" class="selectpicker" onchange="Ion.changeWeek(this.value)">
                <?php foreach($listWeeks AS $listsWeek){ ?>
                    <option value="<?= $listsWeek["id"]; ?>" <?php if($listsWeek["id"] == $week["id"]) echo "selected"; ?> data-subtext="<?= $_TUCOACH->verMes($listsWeek["mes"])." - ".$listsWeek["ano"]; ?>">
                        <?= "Semana ".$listsWeek["semana"]." (".$_TUCOACH->pulirFecha($listsWeek["fecha_desde"],$listsWeek["fecha_hasta"]).")" ; ?>
                    </option>
                <?php } ?>
            </select>
            <div id="rtn-changeWeek" class=""></div>

        </div>
    </div>

    <?php if($today["semana"] != $week["semana"]){ ?>
        <div class="tabIn p10 w60x pL10">
            <div onclick="Ion.changeWeek(<?= $today['id']; ?>)" class="dIB btn btn-danger">
                <i class="fas fa-flag"></i> &nbsp;
                Volver a la semana actual
            </div>
        </div>
    <?php } ?>

</div>