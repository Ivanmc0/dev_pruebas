<div class="ionix beee allion bFull" style="background-image:url(../zoom/resources/img/bg.jpg)">
	<div class="tabAll">
		<div class="tabIn">
			<div class="general">

				<div class="bShadow bfff max500 mAUTO">
					<div class="pAA60 bVerde colorfff taC">
						<img src="<?= $roution; ?>resources/img/leletog-logo-blanco.png" alt="">
						<br>
						<br>
						<div class="taC colorfff t12 tU ff0 let">Let's learning together</div>

					</div>
					<div class="p30">

						<div class="color666 t16 tU ff3 taC mb10">Restaurar mi contraseña</div>
						<div class="color666 t14 ff1 mb30">Indique su número de cédula y su email para solicitar el cambio de contraseña, luego revise su email para continuar con el proceso.</div>

						<form action="general/pass-restaurar-app" id="formion" name="formion" method="post" class="form-horizontal zoom_form">
							<fieldset class="form-group position-relative has-icon-left">
								<input type="text" class="form-control" name="user-id" id="user-id" placeholder="Número de Cédula" required>
								<div class="form-control-position">
									<i class="ft-user"></i>
								</div>
							</fieldset>
							<fieldset class="form-group position-relative has-icon-left">
								<input type="text" class="form-control" name="user-email" id="user-email" placeholder="Email" required>
								<div class="form-control-position">
									<i class="la la-key"></i>
								</div>
							</fieldset>
							<div id="rtn-formion" class="taC mb20"></div>
							<button type="submit" class="btn btn-outline-success btn-block"><i class="ft-unlock"></i> Solicitar cambio</button>
						</form>
					</div>

					<div class="taC p10 t12 beee">Leletog es un producto de <a href="<?= $roution; ?>" class="">OLC Group</a></div>
				</div>

			</div>
		</div>
	</div>
</div>