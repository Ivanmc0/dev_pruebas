<!-- Modal -->

<?php $trabajadores	= $_ZOOM->get_data("zoom_users", " AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1); ?>

<div class="modal fade" id="sprint_crear" tabindex="-1" role="dialog" aria-labelledby="sprint_crearLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">

				<div class="p20 t20 ff3 ff0 colorfff bMorado">
					Crea un nuevo Sprint Mensual
				</div>
				<div class="p30">
					<form action="kr/all" id="formion" name="formion" method="post" class="form-horizontal zoom_form">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_empresa" id="id_empresa" value="<?= $_SESSION["COMPANY"]["id"]; ?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_proyecto" id="id_proyecto" value="<?= $_SESSION["thisProject"]; ?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_accion" id="id_accion" value="<?= $geton[2]; ?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="tabla" id="tabla" value="grw_okr_sprints">
						<input type="text" class="p1020 w100 bS1 rr5 dB mb10" name="nombre" id="nombre" maxlength="250" placeholder="Nombre">
						<textarea type="text" class="p20 w100 bS1 rr5 dB mb10" name="descripcion" id="descripcion" maxlength="300" placeholder="Descripción"></textarea>
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
						<div class="row">
							<div class="col-12 col-lg-6">
								<div class="mb3">Año</div>
								<select class="p1020 w100 bS1 rr5 dB mb10" name="ano" id="ano">
									<?php for($ff=2024; $ff<=2025; $ff++){ ?>
										<option value="<?= $ff; ?>"><?= $ff; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-12 col-lg-6">
								<div class="mb3">Mes</div>
								<select class="p1020 w100 bS1 rr5 dB mb10" name="mes" id="mes">
									<?php for($ff=1; $ff<=12; $ff++){ ?>
										<option value="<?= $ff; ?>"><?= $_ZOOM->verMes($ff); ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div id="rtn-formion" class="taC mb20"></div>
						<button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> Crear Sprint</button>
					</form>
				</div>

		</div>
	</div>
</div>