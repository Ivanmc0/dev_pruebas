<div class="modal fade" id="estrategias" tabindex="-1" role="dialog" aria-labelledby="estrategiasLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">

				<div class="p20 t20 ff3 ff0 colorfff bMorado">
					Estrategias en este KR
				</div>

				<div id="list-trates" class="p30">
					<div class="mb20">
						<?php
							if(isset($tratos)){
								foreach($tratos AS $res){
									echo '<div id="prop'.$res["id"].'" class="tab bGray bS1 rr5 mb5">';
									echo '<div class="tabIn color333 r16 ff2 p1020">'.((($res["nombre"]))).'</div>';
									echo '<div onClick="Ion.deleteTratos('.$res["id"].')" class="tabIn color666 t14 ff1 bHover2 w50x taC cP"><i class="fas fa-trash-alt"></i></div>';
									echo '</div>';
								}
							} else echo '<div class="taC p30 t24 tU ff0">No hay estrategias</div>';
						?>
					</div>
					<?php if($krs["id_responsable"] == $_SESSION["WORKER"]["id"]){ ?>
						<div id="rtn_list_trates"></div>
						<div class="taC"><button class="btn btn-outline-primary btn-trates"><i class="ft-unlock"></i> Nueva estrategia</button></div>
					<?php }?>
				</div>

				<div id="form-trates" class="p30 dN">
					<form action="kr/estrategias" id="formion3" name="formion3" method="post" class="form-horizontal zoom_form">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_proyecto3" id="id_proyecto3" value="<?= $_SESSION["thisProject"]?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_empresa3" id="id_empresa3" value="<?= $_SESSION["COMPANY"]["id"]?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="id_kr3" id="id_kr3" value="<?= $krs["id"]?>">
						<input type="hidden" class="p1020 w100 bS1 rr5 dB mb10" name="tabla3" id="tabla3" value="grw_okr_estrategias">
						<div class="t10 color999 mb3">Máximo 500 caracteres</div>
						<textarea maxlength="500" class="p20 w100 bS1 rr5 dB mb10" rows="8" name="nombre" id="nombre" placeholder="Detalle la estrategia"></textarea>

						<div id="rtn-formion3" class="taC mb20"></div>
						<button type="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> Adicionar</button>
					</form>
				</div>

		</div>
	</div>
</div>