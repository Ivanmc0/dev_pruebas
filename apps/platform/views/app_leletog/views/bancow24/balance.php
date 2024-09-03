<?php
	$torneo         = 3;
	$grupo          = $_ZOOM->get_data("w_grupos", " AND id_proyecto = $torneo AND code = '".$geton[2]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$sesion         = $_ZOOM->get_data("w_sesiones", " AND id_proyecto = $torneo AND code = '".$geton[3]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$sesiones       = $_ZOOM->order_id_array($_ZOOM->get_data("w_sesiones", " AND id_proyecto = $torneo AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1));
	$alumnos        = $_ZOOM->get_data("w_alumnos", " AND id_proyecto = $torneo AND grupo = '".$grupo["nombre"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1);
	$calificaciones = $_ZOOM->order_array_by($_ZOOM->get_data("w_soluciones", " AND id_proyecto = $torneo AND id_sesion = ".$sesion["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1), "id_alumno");

?>

<div class="ionix beee allion-101 p50 p20_oS bFull" style="background-image:url(<?= $dominion; ?>resources/img/background24.jpg); overflow:hidden;">

	<div class="tab h100 colorfff">
		<div class="tabIn w40_oS pLR30 pLR10_oS">
		<img src="<?= $dominion; ?>resources/olc/olc-leletog-white.png" class="">
			<!-- <span class="pL20 t20 ff0 colorVerde dN_oS">Leletog</span> -->
		</div>
		<div class="tabIn taR">
			<img src="<?= $dominion; ?>resources/img/banco-w-blanco.png" class="w120x_oS bCfff bSR1 b0_oS dIB_oS mb5_oS">
			<select onchange="window.location.href=this.value" class="colorfff ff2 tU p1020 t14 mL10 bS1 bCfff p5_oS m0_oS rr40" style="background: transparent;">
				<?php
					foreach ($sesiones as $key => $ses){
						$sel = ($ses["id"] == $sesion["id"]) ? "selected" : "";
						echo '<option value="'.$dominion."bancow-2024/balance/".$grupo['code']."/".$ses["code"].'/" '.$sel.' class="color333">Sesión '.($key-10).'</option>';
					}
				?>
			</select>

			<a href="<?= $dominion; ?>bancow-2024/ranking/<?= $geton[2]; ?>/" target="_blank" class="bVerde colorfff bHover ff2 tU p1020 rr40 p5_oS t14 bS2 bCVerde mL10 m0_oS">Ranking</a>

		</div>


	</div>

	<div class="wall3 bfff bShadow" style="overflow:hidden;">
		<div class="tab h100 p1020 p10_oS beee">
			<div class="tabIn w200x taC dN_oS"><img src="<?= $dominion; ?>resources/bancow/copa<?= $grupo["copa"]; ?>.png" alt=""></div>
			<div class="tabIn pL20 p5_oS">
				<div class="color000 t20 tU ff2 mb5 mb5_oS"><?= ($grupo["descripcion"]); ?></div>
				<div class="color333 t16 ff1 mb10 mb5_oS"><?= ($grupo["descripcion2"]); ?> <span class="pLR10 pLR5_oS dN_oS">|</span><div class="dN_oPC"></div> Sesión #<?= $sesion["id"]-10; ?> - <?= $sesion["nombre"]; ?> <span class="pLR10 pLR5_oS">|</span> G<?= $grupo["nombre"]; ?></div>
				<div class="color999 t12 ff2">Última actualización: <?= ($calificaciones[$alumnos[0]["id"]]["fecha_actualizacion"]); ?></div>
			</div>
		</div>

		<style>
			.tableFixHead          { overflow: auto; }
			.tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
		</style>
		<!-- <div class="wall3in posR" style="overflow: auto;"> -->

			<div class="tableFixHead wall3in table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="t14">
							<th class="bfff" scope="col" style="vertical-align: middle; padding-left:20px;">Nombre</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Part.</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Eval.</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Reto 1</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Apl. Herr. Envío</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Desafío</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Bonus Eficacia</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Total</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Medalla</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($alumnos as $key => $alumno){
								if(isset($calificaciones[$alumno["id"]])){
						?>
							<tr class="t14">
								<th style="vertical-align: middle; padding-left:20px" scope="row" class="t14 ff1"><?= ($alumno["nombre"]); ?></th>
								<td style="vertical-align: middle; text-align:center"><?= ($calificaciones[$alumno["id"]]["asis"]); ?></td>
								<td style="vertical-align: middle; text-align:center"><?= ($calificaciones[$alumno["id"]]["eval"]); ?></td>
								<td style="vertical-align: middle; text-align:center"><?= ($calificaciones[$alumno["id"]]["reto1"]); ?></td>
								<td style="vertical-align: middle; text-align:center"><?= ($calificaciones[$alumno["id"]]["ah_envio"]); ?></td>
								<td style="vertical-align: middle; text-align:center"><?= ($calificaciones[$alumno["id"]]["desafio"]); ?></td>
								<td style="vertical-align: middle; text-align:center"><?= ($calificaciones[$alumno["id"]]["ah_bonus"]); ?></td>

								<td style="vertical-align: middle; text-align:center" class="tB">
									<?php
										echo $calificaciones[$alumno["id"]]["asis"]
											+ $calificaciones[$alumno["id"]]["eval"]
											+ $calificaciones[$alumno["id"]]["reto1"]
											+ $calificaciones[$alumno["id"]]["ah_envio"]
											+ $calificaciones[$alumno["id"]]["ah_bonus"]
											+ $calificaciones[$alumno["id"]]["desafio"];
									?>
								</td>
								<td style="vertical-align: middle; text-align:center">
									<?php
										if($calificaciones[$alumno["id"]]["insignia"]){
											echo '<img src="'.$dominion.'resources/bancow/medalla-'.$calificaciones[$alumno["id"]]["insignia"].'.png" class="w30x mL5">';
										}
									?>
								</td>

							</tr>
						<?php } } ?>
					</tbody>
				</table>
			</div>
		<!-- </div> -->


	</div>
</div>