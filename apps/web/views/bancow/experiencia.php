<?php

	$miembro        = $_ZOOM->get_data("grw_val_listasexternas_registros", " AND uuid = '".$geton[2]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
	$asignaciones   = $_ZOOM->get_data("grw_val_asignaciones", " AND id_listaexterna_registro = '".$miembro["id"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);

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
				<div class="color666 t16 ff1 mb5 mb5_oS">Le damos la bienvenida</div>
				<div class="colorGrowi t24 ff4"><?= ($miembro["nombre"]); ?></div>
			</div>
			<div class="tabIn p1020 p510_oS taR">
				<div class="color666 t16 ff1 mb5 mb5_oS">Desafío: Experiencia del empleado</div>
				<div class="colorGrowi t24 ff4">El impacto del líder</div>
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
					<th class="bfff" scope="col" style="vertical-align: middle; padding-left:30px">Encuestas</th>
					<th class="bfff" scope="col" style="vertical-align: middle; padding-right:30px; text-align:right">Acceso</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$hoy = date('Y-m-d H:i:s');
					foreach ($asignaciones as $key => $asignacion){
						if($investigacion = $_ZOOM->get_data("grw_val_investigaciones", " AND id = '".$asignacion["id_investigacion"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0)){

				?>
					<tr class="t16">
						<td style="vertical-align: middle; text-align:left; padding-left:30px;"><?= ($investigacion["nombre"]); ?></td>
						<td style="vertical-align: middle; text-align:right; padding-right:30px;">

							<?php
								if ($hoy >= $investigacion['fecha_inicio'] && $hoy <= $investigacion['fecha_fin']) {
									echo '
										<a class="p1030 bVerde bHover t12 ff3 colorfff" target="_blank" href="https://valora.olcgroup.co/e/'.$asignacion["uuid"].'/">Realizar encuesta<a>
									';
								} else {
							?>
									<div class="t12 ff1 mb5">Estará disponible</div>
									<?= dateFront($investigacion["fecha_inicio"]); ?>
							<?php
								}
							?>
						</td>
					</tr>
				<?php }} ?>

			</tbody>
			</table>
		</div>


	</div>

	<div class="taC">
		<img src="<?= $dominion; ?>resources/img/growi-logo-white.png" class="">
	</div>

</div>