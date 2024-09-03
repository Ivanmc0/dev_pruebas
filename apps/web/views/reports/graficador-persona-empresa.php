<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<?php

	$testSelect = 111;
	$id = $geton[2];

	if($thisEvaluacion = $_TUCOACH->get_data("grw_tuc_p2b_estudios", " AND hash = '".$id."' AND eliminado = 0 ORDER BY id DESC ", 0)){
		$duo = 1;
?>

<div class="ionix pAA150 bfff">
	<div class="p50 p30_oS">

		<form action="models/reportes/graficar-personas-empresa-filtros" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

			<div class="">

				<h1 class="taC t24 ff2 color333 tU mb50">Comparador de resultados por segmentación</h1>

				<h4 class="ff2 t18 color333 mb30">Selecciones los criterios deseados para generar su gráfica</h4>
				<input type="hidden" id="id" name="id" value="<?= $thisEvaluacion["id"]; ?>" />
				<input type="hidden" id="duo" name="duo" value="0" />

				<div class="row mb20">
					<div class="col-md-4 mb20_oS">
						<label class="control-label">Criterio base</label>
						<select class="dB w100 bC000 p1020 bfff bS1 bCeee color666" id="id_categoria" name="id_categoria">
							<option value="">Evaluación General</option>
							<option value="0">Las Categorías</option>
							<?php
								$datos = $_TUCOACH->get_data("grw_tuc_p2b_categorias", " AND id_test = $testSelect AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
								if($datos){
									foreach($datos AS $dato){
							?>
										<option value="<?= ($dato["id"]); ?>">Categoría: <?= ($dato["nombre"]); ?></option>
							<?php
									}
								}
							?>
						</select>
					</div>
					<div class="col-md-4 mb20_oS">
						<label class="control-label">Competencias</label>
						<select class="dB w100 bC000 p1020 bfff bS1 bCeee color666" id="id_competencia" name="id_competencia">
							<option value="0">Todas</option>
						</select>
					</div>
					<div class="col-md-4">
						<label class="control-label">Comportamientos</label>
						<select class="dB w100 bC000 p1020 bfff bS1 bCeee color666" id="id_comportamiento" name="id_comportamiento">
							<option value="0">Todos</option>
						</select>
					</div>
				</div>

				<?php
					$colors = [
						0 => ["color" => "rgb(154, 102, 254)", "linea" => "rgb(154, 102, 254)"],
						1 => ["color" => "rgb(252, 206, 87)", "linea" => "rgb(252, 206, 87)"],
						2 => ["color" => "rgb(29, 196, 255)", "linea" => "rgb(29, 196, 255)"],
						3 => ["color" => "rgb(255, 100, 132)", "linea" => "rgb(255, 100, 132)"],
						4 => ["color" => "rgb(76, 192, 191)", "linea" => "rgb(76, 192, 191)"],
						5 => ["color" => "rgb(255, 159, 64)", "linea" => "rgb(255, 159, 64)"],
						6 => ["color" => "rgb(146, 208, 80)", "linea" => "rgb(146, 208, 80)"],
						7 => ["color" => "rgb(185, 123, 61)", "linea" => "rgb(185, 123, 61)"],
						8 => ["color" => "rgb(71, 71, 255)", "linea" => "rgb(71, 71, 255)"],
						9 => ["color" => "rgb(242, 0, 179)", "linea" => "rgb(242, 0, 179)"]
					];

					foreach ($colors as $i => $color) {
				?>

					<div id="btn-resultado-<?= $i; ?>" class="taC mb30 <?php if($i != 3) echo "dN"; ?> "><div class="dB colorMorado2 t16 cP aS" onclick="Ion.otro_resultado(<?= $i; ?>);"><i class="fas fa-plus t14"></i>&nbsp; Agregar resultado</div></div>

					<div class="<?php if($i>2) echo "dN"; ?>" id="resultado-<?= $i; ?>">
						<div class="row align-items-center p20 bShadow3 m0 mb20">
							<div class="col-6 col-md-3 mb10_oS m0 p0">
								<div class="mb5">Resultado <?= $i+1; ?></div>
								<div class="w50 p3" style="background-color:<?= $color["color"]; ?>"></div>
							</div>
							<?php for ($j=0; $j < 3; $j++) { ?>

								<div class="col-6 col-md-3 mb10_oS m0 pLR10">
									<select class="dB w100 bC000 p1020 bfff bS1 bCeee color666" name="segmentos[<?= $i; ?>][<?= $j; ?>]">
										<option value="0">Segmento <?= $j+1; ?></option>
										<?php
											if($datos = $_TUCOACH->get_data("grw_tuc_segmentaciones", " AND id_gruposegmento = '".$thisEvaluacion["id_segmentos"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1)){
												foreach($datos AS $dato){
													if($datos2 = $_TUCOACH->get_data("grw_tuc_segmentaciones_opciones", " AND id_segmento = '".$dato["id"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1)){
														foreach($datos2 AS $dato2){
										?>
													<option value="<?= ($dato2["id"]); ?>"><?= ($dato["nombre"]); ?>: <?= ($dato2["nombre"]); ?></option>
										<?php
														}
													}
												}
											}
										?>
									</select>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>


				<div class="text-center mb20 apuntador-" destino="grapion-">
					<button class="b333 p2040 dIB colorfff colorfff cP bHover" type="submit">
						<div class="t18 tU ff0 mb5" style="letter-spacing:0.2em;">Generar gráfico</div>
						<div class="t14 coloraaa ff1">Comprarar resultados gráficamente</div>
					</button>
				</div>

			</div>

			<div id="grapion" class="b333- ">
				<div class="h50 h30_oS"></div>
				<div id="rtn-formion" class="b333-"></div>
			</div>

		</form>

	</div>

</div>

<?php } ?>