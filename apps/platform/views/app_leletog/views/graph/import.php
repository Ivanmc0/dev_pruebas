
<div class="ionix beee allion bFull" style="background-image:url(<?= $dominion; ?>resources/bancow/background.jpg); overflow:hidden-;">

	<div class="p50 mAUTO">

		<div class="bShadow beee mAUTO" style="height:calc(100% - 100px);">

			<div class="tab h100 bfff colorfff">
				<div class="tabIn pLR20 pLR10_oS">
					<img src="<?= $dominion; ?>resources/bancow/olc.jpg" class="w100x_oS">
				</div>
				<div class="tabIn taR pLR30 pLR10_oS colorRojo ff4 tU t30">
					Graficador
				</div>
			</div>

			<div class="wall2 beee" style="overflow:auto;">

				<div class="p20">
					<div class="p30 bfff mAUTO bShadow2- rr5 mb20">
						<form action="graph/importar-excel-data" id="formion" name="formion" method="post" class="form-horizontal zoom_form">
							<div class="row align-items-center">
								<div class="col">
									<div class="t24 ff3 colorAzul2">Importador de datos desde Excel</div>
								</div>
								<div class="col">
									<div class="">
										<div class="">
											<input type="file" class=""  name="excelion">
										</div>
									</div>
								</div>
								<div class="col">
									<div class="text-center">
										<button class="bAzul2 colorfff rr5 p1030 ff3 bHover cP" type="submit"><i class="la la-save t14"></i> &nbsp; Cargar documento</button>
									</div>
								</div>
							</div>
						</form>
					</div>

					<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


					<div id="rtn-formion" class=""></div>

				</div>
			</div>

		</div>

	</div>
</div>