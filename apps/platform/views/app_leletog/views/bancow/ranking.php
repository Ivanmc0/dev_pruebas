<?php
	$torneo = 1;

	$grupo        	= $_ZOOM->get_data("w_grupos", " AND id_proyecto = $torneo AND code = '".$geton[2]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$sesiones       = $_ZOOM->order_id_array($_ZOOM->get_data("w_sesiones", " AND id_proyecto = $torneo AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1));
	$alumnos        = $_ZOOM->order_id_array($_ZOOM->get_data("w_alumnos", " AND id_proyecto = $torneo AND grupo = ".$grupo["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1));
	$logros 		= explode(",", $grupo["logros"]);
	$promedium		= [];

	if($logros){
		foreach ($logros as $key => $logro) {
			$calificaciones = $_ZOOM->get_data("w_soluciones", " AND id_proyecto = $torneo AND id_grupo = ".$grupo["id"]." AND id_sesion = ".$logro." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
			if($calificaciones){
				foreach ($calificaciones as $key => $calificacion) {

					if(isset($alumnos[$calificacion["id_alumno"]])){

						$suma = $calificacion["asis"]
								+$calificacion["eval"]
								+$calificacion["reto1"]
								+$calificacion["reto2"]
								+$calificacion["ah_envio"]
								+$calificacion["ah_bonus"]
								+$calificacion["desafio"];

						if(isset($promedium[$calificacion["id_alumno"]])){

							$promedium[$calificacion["id_alumno"]]["asis"] += $calificacion["asis"];
							$promedium[$calificacion["id_alumno"]]["eval"] += $calificacion["eval"];
							$promedium[$calificacion["id_alumno"]]["reto1"] += $calificacion["reto1"];
							$promedium[$calificacion["id_alumno"]]["reto2"] += $calificacion["reto2"];
							$promedium[$calificacion["id_alumno"]]["ah_envio"] += $calificacion["ah_envio"];
							$promedium[$calificacion["id_alumno"]]["ah_bonus"] += $calificacion["ah_bonus"];
							$promedium[$calificacion["id_alumno"]]["desafio"] += $calificacion["desafio"];
							$promedium[$calificacion["id_alumno"]]["total"] += $suma;
							$promedium[$calificacion["id_alumno"]]["sesiones"] .= ' - '.$logro.": ".$suma;

						}else{

							$promedium[$calificacion["id_alumno"]] = [
								"info" 		=> $alumnos[$calificacion["id_alumno"]],
								"asis" 		=> $calificacion["asis"],
								"eval" 		=> $calificacion["eval"],
								"reto1" 	=> $calificacion["reto1"],
								"reto2" 	=> $calificacion["reto2"],
								"ah_envio" 	=> $calificacion["ah_envio"],
								"ah_bonus" 	=> $calificacion["ah_bonus"],
								"total" 	=> $suma,
								"desafio" 	=> $calificacion["desafio"],
								"sesiones" 	=> $logro.": ".$suma,
							];

						}

						if($calificacion["ah_logro"]){
							if(isset($promedium[$calificacion["id_alumno"]]["logros"])) $promedium[$calificacion["id_alumno"]]["logros"] .= ",".$sesiones[$logro]["icono"];
							else $promedium[$calificacion["id_alumno"]]["logros"] = $sesiones[$logro]["icono"];
						}

						if($calificacion["insignia"]){
							if(isset($promedium[$calificacion["id_alumno"]]["insignia"])) $promedium[$calificacion["id_alumno"]]["insignia"] .= ",".$calificacion["insignia"];
							else $promedium[$calificacion["id_alumno"]]["insignia"] = $calificacion["insignia"];
						}

					}

				}
			}
		}
		array_multisort(array_column($promedium, 'total'), SORT_DESC, $promedium);
	}

?>

<div class="ionix beee allion bFull" style="background-image:url(<?= $dominion; ?>resources/bancow/background.jpg); padding-top:30px;">
	<!-- <div class="tabAll">
		<div class="tabIn"> -->
			<div class="w90 mAUTO">

				<div class="bShadow bfff mAUTO">

					<div class="tab h100 bfff colorfff">
						<div class="tabIn pLR20 pLR10_oS">
							<img src="<?= $dominion; ?>resources/bancow/olc.jpg" class="w100x_oS">
							<img src="<?= $dominion; ?>resources/bancow/banco-w.jpg" class="w100x_oS">
						</div>
						<div class="tabIn taR pLR30 pLR10_oS colorVerde ff4 t24">
							RANKING G<?= $grupo["id"]; ?>
						</div>
					</div>

					<div class="wall2 bGray" style="overflow:auto;">
						<div class="p2040 p20_oS">


<div class="tab mb20">
	<div class="tabIn pL20">
		<div class="color333 t20 tU ff3 mb10 mb5_oS"><?= ($grupo["descripcion"]); ?></div>
		<div class="color666 t16 ff1"><?= ($grupo["descripcion2"]); ?></div>
	</div>
</div>



<div class="table-responsive">
<table class="table table-striped-">
  <thead>
    <tr class="t14">
      <th scope="col" style="vertical-align: middle;">Nombre</th>
      <!-- <th scope="col" style="vertical-align: middle; text-align:center">Sesiones</th> -->
      <th scope="col" style="vertical-align: middle; text-align:center">Puntos</th>
      <th scope="col" style="vertical-align: middle; text-align:center">Logros</th>
      <th scope="col" style="vertical-align: middle; text-align:center">Nivel</th>
    </tr>
  </thead>
  <tbody>
	<?php foreach ($promedium as $key => $prom){ ?>
		<tr class="t14">
			<th scope="row"><?= ($prom["info"]["nombre"]); ?></th>
			<!-- <td style="vertical-align: middle; text-align:center"><?= ($prom["sesiones"]); ?></td> -->
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

				</div>

			</div>
		<!-- </div>
	</div> -->
</div>