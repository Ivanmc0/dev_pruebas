<?php
	$promedio 		= 0;
	$promedio_hoy 	= 0;
	if($bbb["hw_total"] != 0) 		$promedio		= $bbb["hw_total_realizadas"]/$bbb["hw_total"]*100;
	if($bbb["hw_total_hoy"] != 0)	$promedio_hoy 	= $bbb["hw_total_realizadas"]/$bbb["hw_total_hoy"]*100;
?>

<div class="bS1 rr10 mb30" style="overflow:hidden;">
	<div class="p20 bGray">
		<div class="row taC align-items-center">
			<div class="col-12 col-lg-6">
				<div class="posR b666 rr40" style="overflow:hidden;">
					<div class="bMorado2 pAA20" style="width:<?= $promedio."%"; ?>;"></div>
					<div class="posA colorfff t18 ff3" style="left:20px; top:10px; z-index:1">Balance total</div>
					<div class="posA colorfff t20 ff3" style="right:20px; top:9px; z-index:2"><?= round($promedio,1)."%"; ?></div>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="posR b666 rr40" style="overflow:hidden;">
					<div class="bMorado pAA20" style="width:<?= $promedio_hoy."%"; ?>;"></div>
					<div class="posA colorfff t18 ff3" style="left:20px; top:10px; z-index:1">Balance hasta semana <?php if($this_week) echo $this_week["semana"]; ?></div>
					<div class="posA colorfff t20 ff3" style="right:20px; top:9px; z-index:2"><?= round($promedio_hoy,1)."%"; ?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="bBS1 bCeee"></div>

	<div class="">
		<div class="row taC align-items-center">
			<div class="col-12 col-lg-2 pAA30 bRS1 bCeee">
				<div class="ff2 color999 mb3">Tareas</div>
				<div class="ff1 colorMorado t16 mb10">Totales</div>
				<div class="wh50 t18 ff3 rr50 bMorado colorfff mAUTO vCC"><?=$bbb["hw_total"];?></div>
			</div>
			<div class="col-12 col-lg-2 pAA30 bRS1 bCeee">
				<div class="ff2 color999 mb3">Tareas</div>
				<div class="ff1 estadot0 t16 mb10">Hasta sem <?php if($this_week) echo $this_week["semana"]; ?></div>
				<div class="wh50 t18 ff3 rr50 estado0 colorfff mAUTO vCC"><?=$bbb["hw_total_hoy"];?></div>
			</div>
			<div class="col-12 col-lg-2 pAA30 bRS1 bCeee">
				<div class="ff2 color999 mb3">Tareas</div>
				<div class="ff1 estadot1 t16 mb10">En proceso</div>
				<div class="wh50 t18 ff3 rr50 estado1 colorfff mAUTO vCC"><?=$bbb["hw_total"]-($bbb["hw_total"]-$bbb["hw_total_hoy"])-$bbb["hw_total_realizadas"]-$bbb["hw_total_vencidas"];?></div>
			</div>
			<div class="col-12 col-lg-2 pAA30 bRS1 bCeee">
				<div class="ff2 color999 mb3">Tareas</div>
				<div class="ff1 estadot2 t16 mb10">Realizadas</div>
				<div class="wh50 t18 ff3 rr50 estado2 colorfff mAUTO vCC"><?=$bbb["hw_total_realizadas"];?></div>
			</div>
			<div class="col-12 col-lg-2 pAA30 bRS1 bCeee">
				<div class="ff2 color999 mb3">Tareas</div>
				<div class="ff1 vencidot t16 mb10">Vencidas</div>
				<div class="wh50 t18 ff3 rr50 vencido colorfff mAUTO vCC"><?=$bbb["hw_total_vencidas"];?></div>
			</div>
			<div class="col-12 col-lg-2 pAA30">
				<div class="ff2 color999 mb3">Tareas</div>
				<div class="ff1 colorMorado2 t16 mb10">Siguientes</div>
				<div class="wh50 t18 ff3 rr50 bMorado2 colorfff mAUTO vCC"><?=$bbb["hw_total"]-$bbb["hw_total_hoy"];?></div>
			</div>
		</div>
	</div>



</div>