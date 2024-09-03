<?php
	$torneo = 1;

	$grupo        	= $_ZOOM->get_data("w_grupos", " AND id_proyecto = $torneo AND code = '".$geton[2]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$sesion        	= $_ZOOM->get_data("w_sesiones", " AND id_proyecto = $torneo AND code = '".$geton[3]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$sesiones     	= $_ZOOM->order_id_array($_ZOOM->get_data("w_sesiones", " AND id_proyecto = $torneo AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1));
	$calificaciones = $_ZOOM->get_data("w_soluciones", " AND id_proyecto = $torneo AND id_grupo = ".$grupo["id"]." AND id_sesion = ".$sesion["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
	$alumnos        = $_ZOOM->order_id_array($_ZOOM->get_data("w_alumnos", " AND id_proyecto = $torneo AND grupo = ".$grupo["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1));
	// echo '<pre>';
	// print_r($grupo);
	// print_r($sesion);
	// echo '</pre>';
?>

<div class="ionix beee allion bFull" style="background-image:url(<?= $dominion; ?>resources/bancow/background.jpg); padding-top:30px;">
	<!-- <div class="tabAll">
		<div class="tabIn"> -->
			<div class="w90 mAUTO">

				<div class="bShadow bfff mAUTO">

					<div class="tab h100 bfff colorfff taC-">
						<div class="tabIn pLR20 pLR10_oS">
							<img src="<?= $dominion; ?>resources/bancow/olc.jpg" class="w100x_oS">
							<img src="<?= $dominion; ?>resources/bancow/banco-w.jpg" class="w100x_oS">
						</div>
						<div class="tabIn taR pLR20 pLR10_oS">

							<a href="<?= $dominion; ?>bancow-bk/ranking/<?= $geton[2]; ?>/" target="_blank" class="bVerde colorfff bHover ff3 p1020">Ver Ranking</a>

							<select onchange="window.location.href=this.value" class="bS1 rr3 p510">
								<?php
								    $logros = isset($geton[4]) ? explode(",", $grupo["logros2"]) : explode(",", $grupo["logros"]);
								    $comple = isset($geton[4]) ? "2/" : "";
									foreach ($logros as $key => $logro){
										$sel = ($logro == $sesion["id"]) ? "selected" : "";
										if($logro == $sesion["id"]) $ses = ($key+1);
										echo '<option value="'.$dominion."bancow-bk/balance/".$grupo['code']."/".$sesiones[$logro]["code"].'/'.$comple.'" '.$sel.'>Sesión '.($key+1).'</option>';
									}
								?>
							</select>
						</div>
					</div>

					<div class="wall2 bGray" style="overflow:auto;">
						<div class="p2040 p20_oS">


<div class="tab mb20">
	<div class="tabIn w50x tac"><img src="<?= $dominion; ?>resources/bancow/copa<?= $grupo["copa"]; ?>.png" alt=""></div>
	<div class="tabIn pL20">
		<div class="color333 t20 tU ff3 mb10 mb5_oS"><?= ($grupo["descripcion"]); ?></div>
		<div class="color666 t16 ff1 mb10 mb5_oS"><?= ($grupo["descripcion2"]); ?> <span class="pLR10 pLR5_oS">|</span> Sesión #<?= $ses; ?> <span class="pLR10 pLR5_oS">|</span> G<?= $grupo["id"]; ?></div>
		<div class="color999 t12 ff2">Última actualización: <?= ($calificaciones[0]["fecha_actualizacion"]); ?></div>
	</div>
</div>



<div class="table-responsive">
<table class="table table-striped-">
  <thead>
    <tr class="t14">
      <th scope="col" style="vertical-align: middle;">Nombre</th>
      <th scope="col" style="vertical-align: middle; text-align:center">Asis.</th>
      <th scope="col" style="vertical-align: middle; text-align:center">Eval.</th>
      <th scope="col" style="vertical-align: middle; text-align:center">Reto 1</th>
      <th scope="col" style="vertical-align: middle; text-align:center">Reto 2</th>
      <th scope="col" style="vertical-align: middle; text-align:center">Apl. Herr. Envío</th>
      <th scope="col" style="vertical-align: middle; text-align:center">Apl. Herr. Bonus</th>
      <th scope="col" style="vertical-align: middle; text-align:center">Desafío</th>
      <th scope="col" style="vertical-align: middle; text-align:center">Total</th>
      <th scope="col" style="vertical-align: middle; text-align:center">Insignia</th>


    </tr>
  </thead>
  <tbody>
	<?php foreach ($calificaciones as $key => $calificacion){
			if(isset($alumnos[$calificacion["id_alumno"]])){
	?>
		<tr class="t14">
			<th scope="row"><?= ($alumnos[$calificacion["id_alumno"]]["nombre"]); ?></th>
			<td style="vertical-align: middle; text-align:center"><?= ($calificacion["asis"]); ?></td>
			<td style="vertical-align: middle; text-align:center"><?= ($calificacion["eval"]); ?></td>
			<td style="vertical-align: middle; text-align:center"><?= ($calificacion["reto1"]); ?></td>
			<td style="vertical-align: middle; text-align:center"><?= ($calificacion["reto2"]); ?></td>
			<td style="vertical-align: middle; text-align:center"><?= ($calificacion["ah_envio"]); ?></td>
			<td style="vertical-align: middle; text-align:center"><?= ($calificacion["ah_bonus"]); ?></td>
			<td style="vertical-align: middle; text-align:center"><?= ($calificacion["desafio"]); ?></td>
			<td style="vertical-align: middle; text-align:center" class="tB">
				<?php
					echo $calificacion["asis"]
						+ $calificacion["eval"]
						+ $calificacion["reto1"]
						+ $calificacion["reto2"]
						+ $calificacion["ah_envio"]
						+ $calificacion["ah_bonus"]
						+ $calificacion["desafio"];
				?>
			</td>
			<td style="vertical-align: middle; text-align:center">
				<?php
					if($calificacion["insignia"]){
						echo '<img src="'.$dominion.'resources/bancow/medalla-'.$calificacion["insignia"].'.png" class="w30x mL5">';
					}
				?>
			</td>

		</tr>
	<?php } } ?>

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