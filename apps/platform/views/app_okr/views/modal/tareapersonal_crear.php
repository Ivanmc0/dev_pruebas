<!-- Modal -->

<div class="modal fade" id="tareapersonal_crear" tabindex="-1" role="dialog" aria-labelledby="tareapersonal_crearLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">


			<div class="p20 t20 ff3 ff0 colorfff bMorado4">
				Crea una Tarea Personal
			</div>
			<div class="p30">
				<form action="kr/tareas-personales-crear" id="formion5" name="formion5" method="post" class="form-horizontal zoom_form">
					<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_trabajador5" id="id_trabajador5" value="<?= $_SESSION["WORKER"]["id"]; ?>">
					<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_empresa5" id="id_empresa5" value="<?= $_SESSION["COMPANY"]["id"]; ?>">
					<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_proyecto5" id="id_proyecto5" value="<?= $_SESSION["thisProject"]; ?>">
					<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="tabla5" id="tabla5" value="grw_okr_tareasprivadas">
					<input type="text" class="p1020 w100 bS1 rr5 dB mb10" name="nombre5" id="nombre5" maxlength="250" placeholder="Nombre">
					<textarea type="text" class="p20 w100 bS1 rr5 dB mb10" rows="10" name="descripcion5" maxlength="300" id="descripcion5" placeholder="Descripción"></textarea>
					<div class="h10"></div>

					<div id="rtn-formion5" class="taC mb20"></div>
					<button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> Crear Tarea Personal</button>
				</form>
			</div>


		</div>
	</div>
</div>