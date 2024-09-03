<?php

	$homeworks      =  array(
        "totales"           => 0,
        "totales_hoy"       => 0,
        "pendientes"        => 0,
        "en_proceso"        => 0,
        "realizadas"        => 0,
        "realizadas_hoy"    => 0,
        "vencidas"          => 0,
        "siguientes"        => 0,
        "week"              => 0,
        "week_pendientes"    => 0,
        "week_en_proceso"    => 0,
        "week_realizadas"    => 0,
    );

    $get_homeworks  = $_TUCOACH->get_data("grw_okr_tareas", " AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND $condition AND inactivo = 0 AND eliminado = 0 ", 1);

    if($get_homeworks){
        $ioio = array();
        foreach($get_homeworks AS $hw){

            $homeworks["totales"] += 1;
            if($hw["id_semana"] <= $week["id"]) $homeworks["totales_hoy"] += 1;
            if($hw["estado"] == 0 && $hw["id_semana"] >= $week["id"]) $homeworks["pendientes"] += 1;
            if($hw["estado"] == 1 && $hw["id_semana"] >= $week["id"]) $homeworks["en_proceso"] += 1;
            if($hw["estado"] == 2) $homeworks["realizadas"] += 1;
            if($hw["estado"] == 2 && $hw["id_semana"] <= $week["id"]) $homeworks["realizadas_hoy"] += 1;
            if($hw["estado"] != 2 && $hw["id_semana"] < $week["id"]) $homeworks["vencidas"] += 1;
            if($hw["id_semana"] > $week["id"]) $homeworks["siguientes"] += 1;

            if($hw["id_semana"] == $week["id"]) $homeworks["week"] += 1;
            if($hw["estado"] == 0 && $hw["id_semana"] == $week["id"]) $homeworks["week_pendientes"] += 1;
            if($hw["estado"] == 1 && $hw["id_semana"] == $week["id"]) $homeworks["week_en_proceso"] += 1;
			if($hw["estado"] == 2 && $hw["id_semana"] == $week["id"]) $homeworks["week_realizadas"] += 1;

		}
	}

	$promedio 		= 0;
	$promedio_hoy 	= 0;
	$promedio_week 	= 0;
	if($homeworks["totales"] != 0) 		$promedio		= $homeworks["realizadas"]/$homeworks["totales"]*100;
	if($homeworks["totales_hoy"] != 0)	$promedio_hoy 	= $homeworks["realizadas_hoy"]/$homeworks["totales_hoy"]*100;
	if($homeworks["week"] != 0)	        $promedio_week 	= $homeworks["week_realizadas"]/$homeworks["week"]*100;

?>

<?php if($levelN >= 1) { echo '<div class="bBS1 bCeee o_wrapper">'; include "migas.php"; echo "</div>"; } ?>

<div class="bfff p4020 bBS1 bCeee mb20">
    <div class="ff3 tU t24 colorMorado2">Detalle de <?= $level; ?></div>
</div>

<div class="rr20 p20 mb40 bShadow3" style="overflow:hidden;">
	<div class="tab">
		<div class="tabIn">
			<div class="ff3 tU t16 colorMorado mb20"><?= ($zona["nombre"]); ?></div>
			<div class="ff1 t14 color999 mb5" style="margin-top:-15px;"><?= ($zona["descripcion"]); ?></div>
			<div class="taC">

				<div class="h10 bBS1 bCeee mb20"></div>
				<div class="colorMorado taC">
					<?php
						// $coco = $_ZOOM->get_data("grw_okr_pyt_corresponsables", " AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id_proyecto = ".$_SESSION["thisProject"]." AND nivel = $levelN AND id_nivel = ".$zona["id"]." AND id_corresponsable = ".$_SESSION["WORKER"]["id"]."  ", 1);
						if($superior["id_responsable"] == $_SESSION["WORKER"]["id"]){
						?>
						<a href="editar" class="dIB bS1 bCMorado2 colorMorado2 p310 bHover2 aS2 rr20 cP">
							<i class="fas fa-edit t12"></i>&nbsp;
							Editar <?= $level; ?>
						</a>
					<?php } ?>
					<?php if($levelN != 5){ ?>
						<?php
							$coco = $_ZOOM->get_data("grw_okr_pyt_corresponsables", " AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND id_proyecto = ".$_SESSION["thisProject"]." AND nivel = $levelN AND id_nivel = ".$zona["id"]." AND id_corresponsable = ".$_SESSION["WORKER"]["id"]."  ", 1);
							if($zona["id_responsable"] == $_SESSION["WORKER"]["id"] || $coco){
						?>
							&nbsp;&nbsp;
							<a data-toggle="modal" data-target="#<?= $_TUCOACH->url_seo((strtolower($next))); ?>_crear" class="dIB bS1 bCMorado2 colorMorado2 p310 bHover2 aS2 rr20 cP">
								<i class="fas fa-plus t12"></i>&nbsp;
								Crear <?= $next; ?>
							</a>
						<?php } ?>
					<?php } ?>
				</div>

			</div>

		</div>
		<div class="tabIn w50 pL20" style="border-left:1px solid #eee;">
			<?php include "responsables.php"; ?>
		</div>
	</div>
</div>


<?php if($levelN != 5){ ?>
<div class="rr20 mb40 bShadow3" style="overflow:hidden;">

	<div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">Balace General de tareas</div>
	<div class="p1020 bGray">
		<div class="row taC align-items-center">
			<div class="col-12 col-lg-6">
				<div class="posR b666 rr40" style="overflow:hidden;">
					<div class="bVerde h30" style="width:<?= $promedio."%"; ?>;"></div>
					<div class="posA colorfff t16 ff3" style="left:20px; top:6px; z-index:1">Balance Total</div>
					<div class="posA colorfff t16 ff3" style="right:20px; top:6px; z-index:2"><?= round($promedio,1)."%"; ?></div>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="posR b666 rr40" style="overflow:hidden;">
					<div class="bVerde h30" style="width:<?= $promedio_hoy."%"; ?>;"></div>
					<div class="posA colorfff t16 ff3" style="left:20px; top:6px; z-index:1">Balance hasta la semana <?php if($week) echo $week["semana"]; ?></div>
					<div class="posA colorfff t16 ff3" style="right:20px; top:6px; z-index:2"><?= round($promedio_hoy,1)."%"; ?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="bBS1 bCeee"></div>

	<div class="">
		<div class="row taC align-items-center">
			<div class="col-12 col-lg-3 pAA30 bRS1 bCeee">
				<div class="ff2 color999 mb3">Tareas</div>
				<div class="ff1 colorMorado t16 mb10">Totales</div>
				<div class="wh50 t18 ff3 rr50 bMorado colorfff mAUTO vCC"><?= $homeworks["totales"]; ?></div>
			</div>
			<div class="col-12 col-lg-2 pAA30 bRS1 bCeee">
				<div class="ff2 color999 mb3">Tareas</div>
				<div class="ff1 estadot0 t16 mb10">Hasta sem <?php if($week) echo $week["semana"]; ?></div>
				<div class="wh50 t18 ff3 rr50 estado0 colorfff mAUTO vCC"><?= $homeworks["totales_hoy"]; ?></div>
			</div>
			<div class="col-12 col-lg-2 pAA30 bRS1 bCeee">
				<div class="ff2 color999 mb3">Tareas</div>
				<div class="ff1 estadot2 t16 mb10">Realizadas</div>
				<div class="wh50 t18 ff3 rr50 estado2 colorfff mAUTO vCC"><?= $homeworks["realizadas"]; ?></div>
			</div>
			<div class="col-12 col-lg-2 pAA30 bRS1 bCeee">
				<div class="ff2 color999 mb3">Tareas</div>
				<div class="ff1 vencidot t16 mb10">Vencidas</div>
				<div class="wh50 t18 ff3 rr50 vencido colorfff mAUTO vCC"><?= $homeworks["vencidas"]; ?></div>
			</div>
			<div class="col-12 col-lg-3 pAA30">
				<div class="ff2 color999 mb3">Tareas</div>
				<div class="ff1 colorMorado2 t16 mb10">Próximas semanas</div>
				<div class="wh50 t18 ff3 rr50 bMorado2 colorfff mAUTO vCC"><?= $homeworks["siguientes"]; ?></div>
			</div>
		</div>
	</div>
</div>



<div class="rr20 mb40 bShadow3" style="overflow:hidden;">

    <div class="bBS1 bCeee pAA10 taC colorfff bMorado2 tU t18 ff3">
        Balance de tareas en la semana <?php if($week) echo $week["semana"]." de ".$week["ano"]; ?>
        <span class="t12 ff0"><?= ($homeworks["week"]-$homeworks["week_realizadas"]); ?> No realizadas</span>
    </div>
	<div class="p1020 bGray">
		<div class="row taC align-items-center">
			<div class="col-12 col-lg-12">
				<div class="posR b666 rr40" style="overflow:hidden;">
					<div class="bVerde h30" style="width:<?= $promedio_week."%"; ?>;"></div>
					<div class="posA colorfff t16 ff3" style="left:20px; top:6px; z-index:1">Balance de la semana <?php if($week) echo $week["semana"]; ?></div>
					<div class="posA colorfff t16 ff3" style="right:20px; top:6px; z-index:2"><?= round($promedio_week,1)."%"; ?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="bBS1 bCeee"></div>

	<div class="">
		<div class="row taC align-items-center">
			<div class="col-12 col-lg-3 pAA30 bRS1 bCeee">
				<div class="ff1 colorMorado t16 mb10">Totales</div>
				<div class="wh50 t18 ff3 rr50 bMorado colorfff mAUTO vCC"><?= $homeworks["week"]; ?></div>
			</div>
			<div class="col-12 col-lg-3 pAA30 bRS1 bCeee">
				<div class="ff1 estadot0 t16 mb10">Pendientes</div>
				<div class="wh50 t18 ff3 rr50 estado0 colorfff mAUTO vCC"><?= $homeworks["week_pendientes"]; ?></div>
			</div>
			<div class="col-12 col-lg-3 pAA30 bRS1 bCeee">
				<div class="ff1 estadot1 t16 mb10">En proceso</div>
				<div class="wh50 t18 ff3 rr50 estado1 colorfff mAUTO vCC"><?= $homeworks["week_en_proceso"]; ?></div>
			</div>
			<div class="col-12 col-lg-3 pAA30 bRS1 bCeee">
				<div class="ff1 estadot2 t16 mb10">Realizadas</div>
				<div class="wh50 t18 ff3 rr50 estado2 colorfff mAUTO vCC"><?= $homeworks["week_realizadas"]; ?></div>
			</div>
		</div>
	</div>

</div>
<?php } ?>