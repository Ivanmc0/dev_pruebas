<?php

	$sesion       = $_ZOOM->get_data("grw_rkg_sesiones", " AND uuid = '".$geton[2]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$grupo        = $_ZOOM->get_data("grw_grupos", " AND id = '".$sesion["id_grupo"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$programa     = $_ZOOM->get_data("grw_rkg_programas", " AND id = ".$sesion["id_programa"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$modulo       = $_ZOOM->get_data("grw_rkg_modulos", " AND id = ".$sesion["id_modulo"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$alumnos      = [];
	$trabajadores = $_ZOOM->order_array_by($_ZOOM->get_data("zoom_users", " AND id_empresa = 100100 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1), "id");
	$sess         = $_ZOOM->get_data("grw_rkg_sesiones", " AND id_grupo = '".$sesion["id_grupo"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);

	if($miembros = $_ZOOM->get_data("grw_grupos_miembros", " AND es_lider = 0 AND id_empresa = 100100 AND id_grupo = '".$grupo["id"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1)){

		foreach ($miembros as $miembro) {

			$alumnos[$miembro["id_trabajador"]] = [
				"id"     => $trabajadores[$miembro["id_trabajador"]]["id"],
				"nombre" => $trabajadores[$miembro["id_trabajador"]]["nombre"],
				"lider"  => $miembro["es_lider"],
			];

			$alumnos[$miembro["id_trabajador"]]["solucion"] = $_ZOOM->get_data("grw_rkg_soluciones", " AND id_sesion = '".$sesion["id"]."' AND id_trabajador = '".$miembro["id_trabajador"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
			$alumnos[$miembro["id_trabajador"]]["total"]    = $alumnos[$miembro["id_trabajador"]]["solucion"] ? $alumnos[$miembro["id_trabajador"]]["solucion"]["asistencia"] + $alumnos[$miembro["id_trabajador"]]["solucion"]["evaluacion"] + $alumnos[$miembro["id_trabajador"]]["solucion"]["reto"] + $alumnos[$miembro["id_trabajador"]]["solucion"]["herramienta"] + $alumnos[$miembro["id_trabajador"]]["solucion"]["desafio"] + $alumnos[$miembro["id_trabajador"]]["solucion"]["bonus"] : 0;
		}
	}

	// Debug::Mostrar();
?>

<div class="ionix beee allion-101 p50 p20_oS bFull" style="background-image:url(<?= $dominion; ?>resources/img/background24.jpg); overflow:hidden;">

	<div class="tab h100 colorfff pLR20 p0_oS">
		<div class="tabIn w180x">
			<img src="<?= $dominion; ?>resources/bancow/banco-w-blanco.png" class="">
		</div>
		<div class="tabIn pLR20">
			<div class="colorfff t30 tU ff3 mb5"><?= $programa["nombre"]; ?></div>
			<div class="colorfff t16 ff1">Módulo: <?= $modulo["nombre"]; ?></div>
		</div>
		<div class="tabIn taR w180x">
			<img src="<?= $dominion; ?>resources/img/growi-logo-w.png" class="">
		</div>
	</div>

	<div class="wall3 bfff bShadow mb50" style="overflow:hidden;">
		<div class="tab h100 p20 p10_oS beee">
			<div class="tabIn p1020 p510_oS">
				<div class="color666 t16 ff1 mb5 mb5_oS">Grupo</div>
				<div class="colorGrowi t24 ff4"><?= ($grupo["nom_grupo"]); ?></div>
			</div>
			<div class="tabIn p1020 p510_oS taR">
				<div class="bfff dIB">
					<select onchange="window.location.href=this.value" class="bfff colorMorado2 ff3 p1020 t16 p5_oS m0_oS bShadow3" style="background: transparent;">
						<?php
							foreach ($sess as $key => $ses){
								$sel = ($ses["id"] == $sesion["id"]) ? "selected" : "";
								echo '<option value="'.$dominion."bancow/balance/".$ses["uuid"].'/" '.$sel.' class="">Balance de sesión '.$ses["numero"].'</option>';
							}
						?>
					</select>
				</div>
				<a href="<?= $dominion; ?>bancow/ranking/<?= $grupo['uuid']; ?>/" class="bVerde colorfff bHover ff3 p1020 p5_oS t16 bShadow3 mL10">Ver Ranking</a>
			</div>
		</div>

		<style>
			.tableFixHead          { overflow: auto; }
			.tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
		</style>

			<div class="tableFixHead wall3in table-responsive">
				<table class="table table-hover">
					<thead>
						<tr class="t16">
							<th class="bfff" scope="col" style="vertical-align: middle; padding-left:20px;">Nombre</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Participación</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Evaluación</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Reto</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Herramienta</th>
							<?php if($programa["id"] != 1) { ?><th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Desafío</th><?php } ?>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Bonus Eficacia</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Total</th>
							<th class="bfff" scope="col" style="vertical-align: middle; text-align:center;">Medalla</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($alumnos as $key => $alumno){ ?>
							<tr class="t16">
								<th style="vertical-align: middle; padding-left:20px" scope="row" class="t16 ff1"><?= ($alumno["nombre"]); ?></th>
								<td style="vertical-align: middle; text-align:center"><?php if(($alumno["solucion"])) echo $alumno["solucion"]["asistencia"]; ?></td>
								<td style="vertical-align: middle; text-align:center"><?php if(($alumno["solucion"])) echo $alumno["solucion"]["evaluacion"]; ?></td>
								<td style="vertical-align: middle; text-align:center"><?php if(($alumno["solucion"])) echo $alumno["solucion"]["reto"]; ?></td>
								<td style="vertical-align: middle; text-align:center"><?php if(($alumno["solucion"])) echo $alumno["solucion"]["herramienta"]; ?></td>
								<?php if($programa["id"] != 1) { ?><td style="vertical-align: middle; text-align:center"><?php if(($alumno["solucion"])) echo $alumno["solucion"]["desafio"]; ?></td><?php } ?>
								<td style="vertical-align: middle; text-align:center">
									<?php if(($alumno["solucion"]["bonus"])) echo '<img src="'.$dominion.'resources/bancow/bono.png" class="w30x mL5" style="margin-top:-8px; margin-bottom:-8px;">'; ?>
								</td>

								<td style="vertical-align: middle; text-align:center" class="tB">
									<?= $alumno["total"]; ?>
								</td>
								<td style="vertical-align: middle; text-align:center">
									<?php
										if($alumno["solucion"] && $alumno["solucion"]["medalla"]){
											echo '<img src="'.$dominion.'resources/bancow/medalla-'.$alumno["solucion"]["medalla"].'.png" class="w30x mL5" style="margin-top:-8px; margin-bottom:-8px;">';
										}
									?>
								</td>

							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		<!-- </div> -->


	</div>

	<div class="taC">
		<img src="<?= $dominion; ?>resources/img/growi-logo-white.png" class="">
	</div>

</div>