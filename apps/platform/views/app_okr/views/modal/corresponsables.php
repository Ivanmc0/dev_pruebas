<?php $trabajadores	= $_ZOOM->get_data("zoom_users", " AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 1); ?>

<div class="modal fade" id="co-responsables" tabindex="-1" role="dialog" aria-labelledby="co-responsablesLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">

				<div class="p20 t20 ff3 ff0 colorfff bMorado">
					Co-responsables en este <span id="titleModalCR"></span>
				</div>

				<div id="list-cores" class="p30">
					<div class="mb20">
						<?php
							if(isset($corris)){
								foreach($corris AS $res){
									echo '<div id="liti'.$res["id"].'" class="tab bGray bS1 rr5 mb5">';
									echo '<div class="tabIn color333 r16 ff2 p1020">'.ucwords(strtolower(($res["nombre"]))).'</div>';
									echo '<div class="tabIn color666 t14 ff1 pLR10 taR">'.ucwords(strtolower(($res["cargo"]))).'</div>';
									echo '<div onClick="Ion.deleteCR('.$res["id"].')" class="tabIn color666 t14 ff1 bHover2 w50x taC cP"><i class="fas fa-trash-alt"></i></div>';
									echo '</div>';
								}
							}
						?>
					</div>
					<div id="rtn_list_cr"></div>
					<div class="taC"><button class="btn btn-outline-primary btn-cores"><i class="ft-unlock"></i> Agregar Co-responsable</button></div>
				</div>

				<div id="form-cores" class="p30 dN">
					<form action="kr/co-responsable" id="formion2" name="formion2" method="post" class="form-horizontal zoom_form2">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_nivel" id="id_nivel" value="">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="nivel" id="nivel" value="">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_proyecto2" id="id_proyecto2" value="">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_empresa2" id="id_empresa2" value="">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_responsable2" id="id_responsable2" value="">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="tabla" id="tabla" value="grw_okr_pyt_corresponsables">
						<div class="mb3">Co-responsable</div>
						<div class="posR mb10">
							<select class="bS1 rr5 w100 selectpicker" data-live-search="true" name="id_corresponsable" id="id_corresponsable">
								<option value="0">Seleccione</option>
								<?php if($trabajadores){ foreach($trabajadores AS $trabajador){ ?>
									<option value="<?= ($trabajador["id"]); ?>" data-subtext="<?= ($trabajador["identificacion"]); ?>"><?= ($trabajador["nombre"]); ?></option>
								<?php } } ?>
							</select>
						</div>

						<div id="rtn-formion2" class="taC mb20"></div>
						<button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> Adicionar</button>
					</form>
				</div>

		</div>
	</div>
</div>