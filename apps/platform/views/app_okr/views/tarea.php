<?php

	$levelN 	= 5;

	$level 		= "Tarea";
	$next 		= "";
	$zona 		= $_TUCOACH->get_data("grw_okr_tareas", " AND id = ".$geton[2]." AND inactivo = 0 AND inactivo = 0 ", 0);
	$tabla_p	= "grw_okr_tareas";
	$tabla_h	= "";
	$condition 	= " id = 0 ";

	$superior   = $_TUCOACH->get_data("grw_okr_sprints", " AND id = ".$zona["id_sprint"]." AND inactivo = 0 AND eliminado = 0 ", 0);


	include "components/balance.php";

	$tarea = $zona;

	$vencido = 0;
	if($tarea["id_semana"] < $today["id"] && $tarea["estado"] != 2) $vencido = 1;

	$sem = $_TUCOACH->get_data("olc_semanas", " AND id = ".$tarea["id_semana"]." AND inactivo = 0 AND eliminado = 0 ", 0);

?>

<div class="rr20 mb40 bShadow3" style="overflow:hidden;">

	<div class="tab p5 tU estado<?= $tarea["estado"]; ?> rr20 colorfff ff3 <?php if($vencido) echo 'vencido'; ?>">
		<div class="tabIn w40x taL">
			<?php if($tarea["estado"] != 0 && $_SESSION["WORKER"]["id"] == $tarea["id_responsable"] && $tarea["id_semana"] == $today["id"]){ ?>
				<div class="wh30 dIB bfff bHover2 rr50 taC cP" onClick="Ion.moveTask2(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'left')" style="padding-top:8px;">
					<i class="fas fa-reply estadot<?= $tarea["estado"]; ?> <?php if($vencido) echo 'vencidot'; ?>"></i>
				</div>
			<?php } ?>
		</div>
		<div class="tabIn p10 taC">
			<?php if($vencido) echo 'Vencido'; else echo $estado[$tarea["estado"]]; ?>
		</div>
		<div class="tabIn w40x taR">
			<?php if($tarea["estado"] != 2 && $_SESSION["WORKER"]["id"] == $tarea["id_responsable"] && $tarea["id_semana"] == $today["id"]){ ?>
				<div class="wh30 dIB bfff bHover2 rr50 taC cP" onClick="Ion.moveTask2(<?= $tarea["id"]; ?>, <?= $_SESSION["WORKER"]["id"]; ?>, <?= $_SESSION["COMPANY"]["id"]; ?>, 'right')" style="padding-top:8px;">
					<i class="fas fa-reply fa-flip-horizontal estadot<?= $tarea["estado"]; ?> <?php if($vencido) echo 'vencidot'; ?>"></i>
				</div>
			<?php } ?>
		</div>
	</div>

	<div class="tab color666 p20">
		<div class="tabIn t20 ff0 taC">
			<div class="ff3 t16 tInc colorNaranja mb5">Asignada a</div>
			<i class="far fa-calendar t16"></i> &nbsp;&nbsp;
			Semana <?php if($sem) echo $sem["semana"]; ?> de <?php if($sem) echo $sem["ano"]; ?><br>
			<div class="ff2 dIB color999 t14"><?= $_TUCOACH->pulirFecha($sem["fecha_desde"],$sem["fecha_hasta"]); ?></div>
		</div>
	</div>
</div>


