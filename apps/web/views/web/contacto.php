<?php $home = $_TUCOACH->get_data("web_contenidos_secciones", " AND id_proyecto = ".$project." AND id_categoria = 7 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1); ?>

<div class="ionix">
	<div class="general">

		<div id="contacto" class="h40"></div>
		<div class="h30"></div>
		<div class="h30"></div>

		<div class="row">

			<div class="col-12 col-sm-8">
				<div class="p50 t16">
					<div class="colorMorado t40 ff3 pL10 mb30">Escríbenos</div>

					<form action="events/contact" id="formion" name="formion" method="post" class="form-horizontal zoom_form">

						<input class="dB w100 bfff p20 bShadow3 bS1 bCeee rr10 mb10" type="text" name="nombre" placeholder="Nombre" />
						<input class="dB w100 bfff p20 bShadow3 bS1 bCeee rr10 mb10" type="text" name="empresa" placeholder="Empresa" />
						<input class="dB w100 bfff p20 bShadow3 bS1 bCeee rr10 mb10" type="text" name="email" placeholder="Email" />
						<input class="dB w100 bfff p20 bShadow3 bS1 bCeee rr10 mb20" type="text" name="celular" placeholder="Celular" />

						<div class="colorMorado2 t16 ff2 pL10 mb10">Cuéntenos, ¿cómo podemos ayudarle?</div>

						<input class="dB w100 bfff p20 bShadow3 bS1 bCeee rr10 mb10" type="text" name="asunto" placeholder="Asunto" />
						<textarea class="dB w100 bfff p20 bShadow3 bS1 bCeee rr10 mb20" type="text" name="mensaje" placeholder="Mensaje (opcional)"></textarea>

						<div id="rtn-formion" class="taC pAA10 mb20"></div>

						<div id="btn-formion" class="taC">
							<button class="bMorado2 colorfff bHover p20 rr10 ff3 t18 w70 dIB taC cP" type="submit">Enviar mensaje</button>
						</div>

					</form>

				</div>
			</div>

			<div class="col-12 col-sm-4 bGrad1">
				<div class="p50">
					<div class="colorfff t40 ff3 mb40"><?= ($home[5]["titulo1"]); ?></div>
					<div class="colorfff t20 ff1 mb20"><?= ($home[5]["titulo2"]); ?></div>
					<div class="tab colorfff taC mb20">
						<div class="tabIn w50x t24"><i class="fas fa-mobile-alt"></i></div>
						<div class="tabIn taL t18"><?= ($home[5]["titulo3"]); ?></div>
					</div>
					<div class="tab colorfff taC">
						<div class="tabIn w50x t24"><i class="fas fa-envelope"></i></div>
						<div class="tabIn taL t18"><?= ($home[5]["titulo4"]); ?></div>
					</div>
				</div>
			</div>

		</div>

		<div class="h30"></div>
		<div class="h30"></div>
		<div class="h30"></div>

	</div>
</div>