<div class="ionix allion-landing bFull land1" style="overflow:auto;">

	<div class="posA w100" style="bottom:0; left:0; z-index:10;">
		<div class="tab">
			<div class="tabIn tab100_oS taR taC_oS p1020 p10_oS">
				<div class="ff2 tU t12 coloreee dIB">© <?= date('Y'); ?> | OLC GROUP.</div> &nbsp;
				<div class="ff1 t12 colorccc dIB">Todos los derechos reservados.</div>
			</div>
		</div>
	</div>

	<div class="tabAll">
		<div class="tabIn">


			<div class="ionix pAA30 pAA30_oS">
				<div class="general pLR20">

					<div class="row align-items-center">

						<div class="col-12 col-lg-2 p0 m0">
						</div>
						<div class="col-12 col-lg-6">

							<div class="max400 wAUTO_oS mAUTO">

								<?php
									if($thisQr = $_ZOOM->get_data("grw_val_asignaciones", " AND uuid = '".$geton[3]."' ", 0)){
										if($valora = $_ZOOM->get_data("olc_apps", " AND app = 'valora' ", 0)){
											$url = $valora['url_'.$_ENV['ENV']]."disc/".$thisQr['uuid']."/";
								?>

											<div class="taC mb50">
												<div class="wh100 rr50 bfff mAUTO mb20">
													<div class="vMM"><div class="p5"><img src="<?= $dominion; ?>resources/olc/olc-web.png" alt=""></div></div>
												</div>
												<h1 class="bMorado p1020 dIB t18 rr40 ff4 colorfff mb20">Gracias por tu registro</h1>
												<h3 class="t16 ff1 colorfff magion mb50">Te invitamos a disponer de 15 minutos para realizar la prueba diagnóstica.</h3>

												<a href="<?= $url; ?>" class="dB bMorado2 colorfff bHover p15 rr40 ff3 t16 taC cP">Iniciar prueba DISC</a>

											</div>

								<?php
										}
									}
								?>

							</div>

						</div>

					</div>

					<div class="h50 dN_oPC"></div>

				</div>
			</div>
			<!-- <div class="dN_oPC taC"><img src="<?= $dominion; ?>resources/img/empresaria2.jpg" alt=""></div> -->

		</div>
	</div>
</div>