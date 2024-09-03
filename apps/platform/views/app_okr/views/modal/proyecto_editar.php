<!-- Modal -->

<?php $trabajadores	= $_ZOOM->get_data("zoom_users", " AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1); ?>
<?php $weekions 	= $_ZOOM->get_data("olc_semanas", " AND inactivo = 0 AND eliminado = 0 ORDER BY ano ASC, mes ASC, semana ASC ", 1); ?>
<?php $thiss 		= $_ZOOM->get_data("grw_okr_proyectos", " AND id = ".$_SESSION["thisProject"]." AND inactivo = 0 AND eliminado = 0 ", 0); ?>
<?php if($thiss){ ?>

<div class="max700 pAA40 mAUTO">

	<div class="p20 t20 ff3 ff0 colorfff bMorado">
		<small class="ff1 coloreee">Editando el proyecto</small><br><?= ($thiss["nombre"]); ?>
	</div>
	<div class="p30">
		<form action="kr/all" id="formion" name="formion" method="post" class="form-horizontal zoom_form">
			<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id" id="id" value="<?= ($thiss["id"]); ?>">
			<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_empresa" id="id_empresa" value="<?= $_SESSION["COMPANY"]["id"]; ?>">
			<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="tabla" id="tabla" value="grw_okr_proyectos">
			<input type="text" class="p1020 w100 bS1 rr5 dB mb10" name="nombre" id="nombre" maxlength="250" placeholder="Nombre" value="<?= ($thiss["nombre"]); ?>">
			<textarea type="text" class="p20 w100 bS1 rr5 dB mb10" name="descripcion" id="descripcion" maxlength="300" placeholder="Descripción"><?= ($thiss["descripcion"]); ?></textarea>
			<div class="mb3">Responsable</div>
			<div class="posR">
				<select class="bS1 rr5 w100 selectpicker" data-live-search="true" name="id_responsable" id="id_responsable">
					<option value="0">Seleccione</option>
					<?php if($trabajadores){ foreach($trabajadores AS $trabajador){ ?>
						<option <?php if($thiss["id_responsable"] == $trabajador["id"]) echo "selected"; ?> value="<?= ($trabajador["id"]); ?>" data-subtext="<?= ($trabajador["identificacion"]); ?>"><?= ($trabajador["nombre"]); ?></option>
					<?php } } ?>
				</select>
			</div>
			<div class="h10"></div>
			<div class="row">
				<div class="col-12 col-lg-6">
					<div class="mb3">Desde</div>
					<select class="p1020 w100 bS1 rr5 dB mb10" name="id_semana_desde" id="id_semana_desde">
						<option value="0">Seleccione</option>
						<?php if($weekions){ foreach($weekions AS $weekion){ ?>
							<option <?php if($thiss["id_semana_desde"] == $weekion["id"]) echo "selected"; ?> value="<?= ($weekion["id"]); ?>"><?= "Año: ".($weekion["ano"]." / Mes: ".$weekion["mes"]." / Semana: ".$weekion["semana"]); ?></option>
						<?php } } ?>
					</select>
				</div>
				<div class="col-12 col-lg-6">
					<div class="mb3">Hasta</div>
					<select class="p1020 w100 bS1 rr5 dB mb10" name="id_semana_hasta" id="id_semana_hasta">
						<option value="0">Seleccione</option>
						<?php if($weekions){ foreach($weekions AS $weekion){ ?>
							<option <?php if($thiss["id_semana_hasta"] == $weekion["id"]) echo "selected"; ?> value="<?= ($weekion["id"]); ?>"><?= "Año: ".($weekion["ano"]." / Mes: ".$weekion["mes"]." / Semana: ".$weekion["semana"]); ?></option>
						<?php } } ?>
					</select>
				</div>
			</div>
			<div class="mb3">Tipo</div>
			<select class="p1020 w100 bS1 rr5 dB mb10" name="tipo" id="tipo">
				<option value="0" <?php if($thiss["tipo"] == 0) echo "selected"; ?>>Público</option>
				<option value="1" <?php if($thiss["tipo"] == 1) echo "selected"; ?>>Privado</option>
			</select>

			<div id="rtn-formion" class="taC mb20"></div>
			<button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> Guardar Cambios</button>
		</form>
	</div>

</div>

<?php } ?>