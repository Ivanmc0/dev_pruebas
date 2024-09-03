<?php
	$torneo = 3;
	$grupo        	= $_ZOOM->get_data("w_grupos", " AND id_proyecto = $torneo AND code = '".$geton[2]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$sesiones       = $_ZOOM->order_id_array($_ZOOM->get_data("w_sesiones", " AND id_proyecto = $torneo AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1));
	$alumnos        = $_ZOOM->get_data("w_alumnos", " AND id_proyecto = $torneo AND grupo = ".$grupo["nombre"]." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1);
	$promedium		= [];
	if($alumnos){
		foreach ($alumnos as $key => $alumno) {
			$calificaciones = $_ZOOM->get_data("w_soluciones", " AND id_proyecto = $torneo AND id_alumno = '".$alumno["id"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
			if($calificaciones){
				foreach ($calificaciones as $key => $calificacion) {
					$suma = $calificacion["asis"]
							+$calificacion["eval"]
							+$calificacion["reto1"]
							+$calificacion["ah_envio"]
							+$calificacion["ah_bonus"]
							+$calificacion["desafio"];
					if(isset($promedium[$alumno["id"]])){
						$promedium[$alumno["id"]]["asis"] += $calificacion["asis"];
						$promedium[$alumno["id"]]["eval"] += $calificacion["eval"];
						$promedium[$alumno["id"]]["reto1"] += $calificacion["reto1"];
						$promedium[$alumno["id"]]["ah_envio"] += $calificacion["ah_envio"];
						$promedium[$alumno["id"]]["ah_bonus"] += $calificacion["ah_bonus"];
						$promedium[$alumno["id"]]["desafio"] += $calificacion["desafio"];
						$promedium[$alumno["id"]]["total"] += $suma;
						$promedium[$alumno["id"]]["sesiones"] .= ' - '.$calificacion["id_sesion"].": ".$suma;
					}else{
						$promedium[$alumno["id"]] = [
							"info" 		=> $alumno,
							"asis" 		=> $calificacion["asis"],
							"eval" 		=> $calificacion["eval"],
							"reto1" 	=> $calificacion["reto1"],
							"ah_envio" 	=> $calificacion["ah_envio"],
							"ah_bonus" 	=> $calificacion["ah_bonus"],
							"total" 	=> $suma,
							"desafio" 	=> $calificacion["desafio"],
							"sesiones" 	=> $calificacion["id_sesion"].": ".$suma,
						];
					}
					if($calificacion["ah_logro"]){
						if(isset($promedium[$alumno["id"]]["logros"])) $promedium[$alumno["id"]]["logros"] .= ",".$sesiones[$calificacion["id_sesion"]]["icono"];
						else $promedium[$alumno["id"]]["logros"] = $sesiones[$calificacion["id_sesion"]]["icono"];
					}
					if($calificacion["insignia"]){
						if(isset($promedium[$alumno["id"]]["insignia"])) $promedium[$alumno["id"]]["insignia"] .= ",".$calificacion["insignia"];
						else $promedium[$alumno["id"]]["insignia"] = $calificacion["insignia"];
					}
				}
			}
		}
	}
	array_multisort(array_column($promedium, 'total'), SORT_DESC, $promedium);
?>

<div class="ionix beee allion-101 p50 p20_oS bFull" style="background-image:url(<?= $dominion; ?>resources/img/background24.jpg); overflow:hidden;">

	<div class="tab h100 colorfff">
		<div class="tabIn w40_oS pLR30 pLR10_oS">
			<img src="<?= $dominion; ?>resources/olc/olc-leletog-white.png" class="">
			<!-- <span class="pL20 t20 ff0 colorVerde dN_oS">Leletog</span> -->
		</div>
		<div class="tabIn taR">
			<img src="<?= $dominion; ?>resources/img/banco-w-blanco.png" class="w120x_oS bCfff bSR1 b0_oS dIB_oS mb5_oS">
			<span class="pLR20 pLR10_oS t20 ff2 coloreee">RANKING G<?= $grupo["nombre"]; ?></span>
		</div>


	</div>

	<div class="wall3 bfff bShadow" style="overflow:hidden;">
		<div class="tab h100 p1020 p10_oS beee">
			<div class="tabIn w200x taC dN_oS"><img src="<?= $dominion; ?>resources/bancow/copa<?= $grupo["copa"]; ?>.png" alt=""></div>
			<div class="tabIn pL20 p5_oS">
				<div class="color000 t20 tU ff2 mb5 mb5_oS"><?= ($grupo["descripcion"]); ?></div>
				<div class="color333 t16 ff1"><?= ($grupo["descripcion2"]); ?></div>
			</div>
		</div>


		<style>
			.tableFixHead          { overflow: auto; }
			.tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
		</style>
		<!-- <div class="wall3in posR" style="overflow: auto;"> -->

			<div class="tableFixHead wall3in table-responsive">
	<table class="table table-striped-">
	<thead>
		<tr class="t14">
			<th class="bfff" scope="col" style="vertical-align: middle; padding-left:20px">Nombre</th>
			<th class="bfff" scope="col" style="vertical-align: middle; text-align:center">Puntos</th>
			<th class="bfff" scope="col" style="vertical-align: middle; text-align:center">Logros</th>
			<th class="bfff" scope="col" style="vertical-align: middle; text-align:center">Nivel</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($promedium as $key => $prom){ ?>
			<tr class="t14">
				<th style="vertical-align: middle; padding-left:20px" scope="row" class="t14 ff1"><?= ($prom["info"]["nombre"]); ?></th>
				<td style="vertical-align: middle; text-align:center"><?= ($prom["total"]); ?></td>
				<td style="vertical-align: middle; text-align:center">
				<?php
					if(isset($prom["insignia"])){
						foreach (explode(",", $prom["insignia"]) as $key => $insignia) {
							echo '<img src="'.$dominion.'resources/bancow/medalla-'.$insignia.'.png" class="w30x mL5">';
						}
					}
					if(isset($prom["logros"])){
						foreach (explode(",", $prom["logros"]) as $key => $log) {
							echo '<img src="'.$dominion.'resources/bancow/'.$log.'.png" class="w30x mL5" title="'.$log.'">';
						}
					}
				?>
				</td>
				<td style="vertical-align: middle; text-align:center">
					<?php
						if($prom["total"] >= 15) echo '<img src="'.$dominion.'resources/bancow/estrella.png" class="w30x mL5">';
						if($prom["total"] >= 30) echo '<img src="'.$dominion.'resources/bancow/estrella.png" class="w30x mL5">';
						if($prom["total"] >= 45) echo '<img src="'.$dominion.'resources/bancow/estrella.png" class="w30x mL5">';
						if($prom["total"] >= 60) echo '<img src="'.$dominion.'resources/bancow/estrella.png" class="w30x mL5">';
						if($prom["total"] >= 75) echo '<img src="'.$dominion.'resources/bancow/estrella.png" class="w30x mL5">';
					?>
				</td>
			</tr>
		<?php } ?>

	</tbody>
	</table>
</div>


	</div>
</div>