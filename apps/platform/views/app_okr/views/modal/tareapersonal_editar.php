<!-- Modal -->
<?php $thiss 	= $_ZOOM->get_data("grw_okr_tareasprivadas", " AND id = ".$geton[2]." AND id_trabajador = ".$_SESSION["WORKER"]["id"]." AND inactivo = 0 AND eliminado = 0  ", 0); ?>

<?php if($thiss){ ?>

<div class="max700 pAA40 mAUTO">

	<div class="p20 t20 ff3 ff0 colorfff bMorado">
		<small class="ff1 coloreee">Editando la Tarea Personal</small><br><?= ($thiss["nombre"]); ?>
	</div>
	<div class="p30">
		<form action="kr/tareas-personales-crear" id="formion" name="formion" method="post" class="form-horizontal zoom_form">
			<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id" id="id" value="<?= ($thiss["id"]); ?>">
			<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="tabla5" id="tabla5" value="grw_okr_tareasprivadas">
			<input type="text" class="p1020 w100 bS1 rr5 dB mb10" name="nombre5" id="nombre5" maxlength="250" placeholder="Nombre" value="<?= ($thiss["nombre"]); ?>">
			<textarea type="text" class="p20 w100 bS1 rr5 dB mb10" name="descripcion5" id="descripcion5" maxlength="300" placeholder="Descripción"><?= ($thiss["descripcion"]); ?></textarea>

			<div class="mb3">Estado</div>
			<div class="posR mb10">
				<select class="p1020 w100 bS1 rr5 dB mb10" name="estado" id="estado">
					<option value="0">Pendiente</option>
					<option value="1">En proceso</option>
					<option value="2">Finalizado</option>
				</select>
			</div>

			<div id="rtn-formion" class="taC mb20"></div>
			<button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> Guardar Cambios</button>
		</form>
	</div>

</div>

<?php } ?>