<!-- Modal -->

<?php

	$trabajadores	= $_ZOOM->get_data("zoom_users", " AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1);
	$weekions		= $_ZOOM->get_data("olc_semanas", " AND mes = ".$zona["mes"]." AND ano = ".$zona["ano"]." AND inactivo = 0 AND eliminado = 0 ORDER BY ano ASC, mes ASC, semana ASC ", 1); 

	$ggSprint 	= $_ZOOM->get_data("grw_okr_sprints", " AND id = ".$geton[2]."  ", 0);
	$ggAccion 	= $_ZOOM->get_data("grw_okr_acciones", " AND id = ".$ggSprint['id_accion']."  ", 0);
	$ggKR 		= $_ZOOM->get_data("grw_okr_krs", " AND id = ".$ggAccion['id_kr']."  ", 0);
	$ggObj 		= $_ZOOM->get_data("grw_okr_objetivos", " AND id = ".$ggKR['id_objetivo']."  ", 0);
?>


<div class="modal fade" id="tarea_crear" tabindex="-1" role="dialog" aria-labelledby="tarea_crearLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">

				<div class="p20 t20 ff3 ff0 colorfff bMorado">
					Crea una nueva Tarea
				</div>
				<div class="p30">

					<form action="kr/all" id="formion" name="formion" method="post" class="form-horizontal zoom_form">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_empresa" id="id_empresa" value="<?= $_SESSION["COMPANY"]["id"]; ?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_proyecto" id="id_proyecto" value="<?= $_SESSION["thisProject"]; ?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_sprint" id="id_sprint" value="<?= $geton[2]; ?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_accion" value="<?= $ggAccion['id']; ?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_kr" value="<?= $ggKR['id']; ?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_objetivo" value="<?= $ggObj['id']; ?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="tabla" id="tabla" value="grw_okr_tareas">
						<input type="text" class="p1020 w100 bS1 rr5 dB mb10" name="nombre" id="nombre" maxlength="250" placeholder="Nombre">
						<textarea type="text" class="p20 w100 bS1 rr5 dB mb10" rows="10" name="descripcion" maxlength="300" id="descripcion" placeholder="Descripción"></textarea>
						<div class="mb3">Semana de ejecución</div>
						<div class="posR mb10">
							<select class="p1020 w100 bS1 rr5 dB mb10" name="id_semana" id="id_semana">
								<option value="0">Seleccione</option>
								<?php if($weekions){ foreach($weekions AS $weekion){ ?>
									<option value="<?= ($weekion["id"]); ?>"><?= "Año: ".($weekion["ano"]." / Mes: ".$weekion["mes"]." / Semana: ".$weekion["semana"]); ?></option>
								<?php }} ?>
							</select>
						</div>
						<div class="mb3">Responsable</div>
						<div class="posR">
							<select class="bS1 rr5 w100 selectpicker" data-live-search="true" name="id_responsable" id="id_responsable">
								<option value="0">Seleccione</option>
								<?php if($trabajadores){ foreach($trabajadores AS $trabajador){ ?>
									<option value="<?= ($trabajador["id"]); ?>" data-subtext="<?= ($trabajador["identificacion"]); ?>"><?= ($trabajador["nombre"]); ?></option>
								<?php } } ?>
							</select>
						</div>
						<div class="h10"></div>

						<div id="rtn-formion" class="taC mb20"></div>
						<button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> Crear Tarea</button>
					</form>
				</div>

		</div>
	</div>
</div>