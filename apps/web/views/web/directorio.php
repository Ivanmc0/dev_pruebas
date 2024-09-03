<div class="ionix beee">
	<div class="generalMax">

		<div class="h80 h30_oS"></div>
		<div class="pAA40 pAA20_oS taC">
			<h1 class="t40 ff5 tU colorMorado">Directorio de aplicaciones</h1>
			<h4 class="t30 ff0 color000">OLC Group</h4>
		</div>



		<div class="row p0 m0 dN_oS align-items-center">
			<div class="col-12 col-lg-3 p1020 m0">
				<div class="t14 ff2 colorMorado mb5">Más información</div>
				<div class="dIB bAzul colorfff t12 p515 rr40 bHover cP btn-migas btn-migas-1" migas="1">Mostrar</div>
			</div>
			<div class="col-12 col-lg-3 p1020 m0" style="background-color:rgba(0,0,0,0.3)">
				<div class="t20 ff2 tU taC pAA20 colorfff">Ambiente de Desarrollo</div>
			</div>
			<div class="col-12 col-lg-3 p1020 m0" style="background-color:rgba(0,0,0,0.5)">
				<div class="t20 ff2 tU taC pAA20 colorfff">Ambiente de Pruebas</div>
			</div>
			<div class="col-12 col-lg-3 p1020 m0" style="background-color:rgba(0,0,0,0.7)">
				<div class="t20 ff2 tU taC pAA20 colorfff">Ambiente de Producción</div>
			</div>
		</div>

	</div>
</div>



<?php
	foreach ($apps as $key => $app){
?>

	<div class="ionix bGray pAA20_oS" style="background-color:<?= $app["color"]; ?>">
		<div class="generalMax">
			<div class="row p0 m0 align-items-center">
				<div class="col-12 col-lg-3 p1020 m0 colorfff t18 ff0 taC_oS p10_oS mb10_oS">
					<div class=""><img src="<?= $dominion; ?>resources/olc/<?= $app["code"]; ?>-white.png" alt="<?= $app["name"]; ?>"></div>
				</div>
				<div class="col-12 col-lg-3 p1020 m0 mb20_oS" style="background-color:rgba(0,0,0,0.3)">
					<div class="t20 ff0 tU taC colorfff mb10 dN_oPC">Ambiente de Desarrollo</div>
					<div class="h20 dN_oS"></div>
					<?php
						$ambiente = "dev";
						include "components/sitio.php";
					?>
				</div>
				<div class="col-12 col-lg-3 p1020 m0 mb20_oS" style="background-color:rgba(0,0,0,0.5)">
					<div class="t20 ff0 tU taC colorfff mb10 dN_oPC">Ambiente de Pruebas / Test</div>
					<div class="h20 dN_oS"></div>
					<?php
						$ambiente = "test";
						include "components/sitio.php";
					?>
				</div>
				<div class="col-12 col-lg-3 p1020 m0" style="background-color:rgba(0,0,0,0.7)">
					<div class="t20 ff0 tU taC colorfff mb10 dN_oPC">Ambiente de Producción</div>
					<div class="h20 dN_oS"></div>
					<?php
						$ambiente = "prod";
						include "components/sitio.php";
					?>
				</div>
			</div>
		</div>
	</div>

<?php } ?>