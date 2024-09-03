<?php

	$grupo        = $_ZOOM->get_data("grw_grupos", " AND uuid = '".$geton[2]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$sess         = $_ZOOM->get_data("grw_rkg_sesiones", " AND id_grupo = '".$grupo["id"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
	$programa     = $_ZOOM->get_data("grw_rkg_programas", " AND id = ".$sess[0]["id_programa"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$alumnos      = [];
	$trabajadores = $_ZOOM->order_array_by($_ZOOM->get_data("zoom_users", " AND id_empresa = 100100 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1), "id");
	$modulos      = $_ZOOM->order_array_by($_ZOOM->get_data("grw_rkg_modulos", " AND id_empresa = 100100 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1), "id");
	$sesiones     = $_ZOOM->order_array_by($sess, "id");

	if($miembros = $_ZOOM->get_data("grw_grupos_miembros", " AND es_lider = 0 AND id_empresa = 100100 AND id_grupo = '".$grupo["id"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1)){

		foreach ($miembros as $miembro) {

			$alumnos[$miembro["id_trabajador"]] = [
				"id"     => $trabajadores[$miembro["id_trabajador"]]["id"],
				"nombre" => $trabajadores[$miembro["id_trabajador"]]["nombre"],
				"lider"  => $miembro["es_lider"],
			];

			$alumnos[$miembro["id_trabajador"]]["solucion"]  = [];
			$alumnos[$miembro["id_trabajador"]]["medallas"]  = [];
			$alumnos[$miembro["id_trabajador"]]["insignias"] = [];
			$alumnos[$miembro["id_trabajador"]]["bonos"] = [];
			$alumnos[$miembro["id_trabajador"]]["total"]     = 0;

			foreach ($sess as $key => $ses) {
				if($sol = $_ZOOM->get_data("grw_rkg_soluciones", " AND id_sesion = '".$ses["id"]."' AND id_trabajador = '".$miembro["id_trabajador"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0)){

					   $sumatoria                                                                   = $sol["asistencia"] + $sol["evaluacion"] + $sol["reto"] + $sol["herramienta"] + $sol["desafio"] + $sol["bonus"];
					if($sol["herramienta"] >= 3) $alumnos[$miembro["id_trabajador"]]["insignias"][] = $modulos[$ses["id_modulo"]]["imagen"];
					if($sol["medalla"]) $alumnos[$miembro["id_trabajador"]]["medallas"][]           = $sol["medalla"];
					if($sol["bonus"]) $alumnos[$miembro["id_trabajador"]]["bonos"][]           		= $sol["bonus"];

				}else{

					$sumatoria = 0;

				}

				$alumnos[$miembro["id_trabajador"]]["solucion"][] = $sumatoria;
				$alumnos[$miembro["id_trabajador"]]["total"] += $sumatoria;

			}
		}
	}

	array_multisort(array_column($alumnos, 'total'), SORT_DESC, $alumnos);

	// Debug::Mostrar($alumnos);

?>

<div class="ionix beee allion-101 p50 p20_oS bFull" style="background-image:url(<?= $dominion; ?>resources/img/background24.jpg); overflow:hidden;">

	<div class="tab h100 colorfff pLR20 p0_oS">
		<div class="tabIn w180x">
			<img src="<?= $dominion; ?>resources/bancow/banco-w-blanco.png" class="">
		</div>
		<div class="tabIn pLR20">
			<div class="colorfff t30 tU ff3"><?= $programa["nombre"]; ?></div>
		</div>
		<div class="tabIn taR w180x">
			<img src="<?= $dominion; ?>resources/img/growi-logo-w.png" class="">
		</div>
	</div>

	<div class="wall3 bfff bShadow mb50" style="overflow:hidden;">

		<div class="tab h100 p20 p10_oS beee">
			<div class="tabIn p1020 p510_oS">
				<div class="color666 t16 ff1 mb5 mb5_oS">Ranking del Grupo</div>
				<div class="colorGrowi t24 ff4"><?= ($grupo["nom_grupo"]); ?></div>
			</div>
			<div class="tabIn p1020 p510_oS taR">
				<div class="color666 t16 ff1 mb5 mb5_oS">Clic para ver detalle</div>
				<div class="bfff dIB">

					<select onchange="window.location.href=this.value" class="bfff colorMorado2 ff3 p1020 t16 p5_oS m0_oS bShadow3" style="background: transparent;">
						<option class="">Seleccione una sesión</option>
						<?php
							foreach ($sess as $key => $ses){
								$sel = ($ses["id"] == $sesion["id"]) ? "selected" : "";
								echo '<option value="'.$dominion."bancow/balance/".$ses["uuid"].'/" '.$sel.' class="">Balance de sesión '.$ses["numero"].'</option>';
							}
						?>
					</select>
				</div>
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
				<tr class="t16">
					<th class="bfff" scope="col" style="vertical-align: middle; padding-left:20px">Nombre</th>
					<th class="bfff" scope="col" style="vertical-align: middle; text-align:center">Puntos</th>
					<th class="bfff" scope="col" style="vertical-align: middle; text-align:center">Logros</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($alumnos as $key => $alumno){ ?>
					<tr class="t16">
						<th style="vertical-align: middle; padding-left:20px" scope="row" class="t16 ff1"><?= ($alumno["nombre"]); ?></th>
						<td style="vertical-align: middle; text-align:center"><?= ($alumno["total"]); ?></td>
						<td style="vertical-align: middle; text-align:center">
						<?php
							if($alumno["medallas"]){
								foreach ($alumno["medallas"] as $med) {
									echo '<img src="'.$dominion.'resources/bancow/medalla-'.$med.'.png" class="w30x mL5" style="margin-top:-7px; margin-bottom:-7px;">';
								}
							}
							if(isset($alumno["insignias"])){
								foreach ($alumno["insignias"] as $insignia) {
									echo '<img src="'.$dominion.'resources/bancow/'.$insignia.'" class="w30x mL5" title="'.$med.'" style="margin-top:-7px; margin-bottom:-7px;">';
								}
							}
							if(isset($alumno["bonos"])){
								foreach ($alumno["bonos"] as $bonos) {
									echo '<img src="'.$dominion.'resources/bancow/bono.png" class="w30x mL5" style="margin-top:-7px; margin-bottom:-7px;">';
								}
							}
						?>
						</td>
					</tr>
				<?php } ?>

			</tbody>
			</table>
		</div>


	</div>

	<div class="taC">
		<img src="<?= $dominion; ?>resources/img/growi-logo-white.png" class="">
	</div>

</div>