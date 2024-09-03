<!-- Modal -->

<?php $trabajadores	= $_ZOOM->get_data("zoom_users", " AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1); ?>
<?php $thiss 		= $_ZOOM->get_data("grw_okr_tareas", " AND id = ".$geton[2]." AND inactivo = 0 AND eliminado = 0 ", 0); ?>
<?php $sprint 		= $_ZOOM->get_data("grw_okr_sprints", " AND id = ".$thiss["id_sprint"]." AND inactivo = 0 AND eliminado = 0 ", 0); ?>
<?php $weekions 	= $_ZOOM->get_data("olc_semanas", " AND mes = ".$sprint["mes"]." AND ano = ".$sprint["ano"]." AND inactivo = 0 AND eliminado = 0 ORDER BY ano ASC, mes ASC, semana ASC ", 1); ?>

<?php if($thiss){ ?>

<div class="max700 pAA40 mAUTO">

	<div class="p20 t20 ff3 ff0 colorfff bMorado">
		<small class="ff1 coloreee">Editando la Tarea</small><br><?= ($thiss["nombre"]); ?>
	</div>
	<div class="p30">
		<form action="kr/all" id="formion" name="formion" method="post" class="form-horizontal zoom_form">
			<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id" id="id" value="<?= ($thiss["id"]); ?>">
			<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="tabla" id="tabla" value="grw_okr_tareas">
			<input type="text" class="p1020 w100 bS1 rr5 dB mb10" name="nombre" id="nombre" maxlength="250" placeholder="Nombre" value="<?= ($thiss["nombre"]); ?>">
			<textarea type="text" class="p20 w100 bS1 rr5 dB mb10" name="descripcion" id="descripcion" maxlength="300" placeholder="Descripción"><?= ($thiss["descripcion"]); ?></textarea>
			<div class="mb3">Responsable</div>
			<div class="posR mb10">
				<select class="bS1 rr5 w100 selectpicker" data-live-search="true" name="id_responsable" id="id_responsable">
					<option value="0">Seleccione</option>
					<?php if($trabajadores){ foreach($trabajadores AS $trabajador){ ?>
						<option <?php if($thiss["id_responsable"] == $trabajador["id"]) echo "selected"; ?> value="<?= ($trabajador["id"]); ?>" data-subtext="<?= ($trabajador["identificacion"]); ?>"><?= ($trabajador["nombre"]); ?></option>
					<?php } } ?>
				</select>
			</div>
			<div class="mb3">Semana de ejecución</div>
			<div class="posR mb10">
				<select class="p1020 w100 bS1 rr5 dB mb10" name="id_semana" id="id_semana">
					<option value="0">Seleccione</option>
					<?php if($weekions){ foreach($weekions AS $weekion){ ?>
						<option <?php if($thiss["id_semana"] == $weekion["id"]) echo "selected"; ?> value="<?= ($weekion["id"]); ?>"><?= "Año: ".($weekion["ano"]." / Mes: ".$weekion["mes"]." / Semana: ".$weekion["semana"]); ?></option>
					<?php } } ?>
				</select>
			</div>

			<div id="rtn-formion" class="taC mb20"></div>
			<button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> Guardar Cambios</button>
		</form>
	</div>

</div>

<?php } ?>