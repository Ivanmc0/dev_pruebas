<?php

	$home   = $_TUCOACH->get_data("web_contenidos_secciones", " AND id_proyecto = ".$project." AND id_categoria = 7 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
	$equipo = $_TUCOACH->get_data("web_contenidos_secciones", " AND id_proyecto = ".$project." AND id_categoria = 9 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);

?>




<div id="nosotros" class="ionix bGrad1 pAA120 pAA60_oS bShadow" style="z-index:11">
	<div class="generalMin">
		<div class="colorfff t50 ff3 mb50">
			<?= ($home[1]["titulo1"]); ?>
			<span class="colorMorado2"><?= ($home[1]["url1"]); ?></span>
		</div>
		

		<div class="row align-items-center">
			<div class="col-6">
				<div class="pLR60 pLR30 mb30_oS">
					<img src="<?= $dominion; ?>resources/img/olc-group-logo-blanco2.png" alt="">
				</div>
			</div>
			<div class="col-6">
				<div class="colorfff ff2 t18 max400 magion"><?= (htmlspecialchars_decode($home[1]["texto1"])); ?></div>
			</div>
		</div>


	</div>
	<!-- <div class="tab taR posR">
		<div class="tabIn" style="vertical-align:bottom">
			<img src="<?= ($static."secciones/".$home[1]["imagen"]); ?>" class="w50 mT-200" style="margin-top:-200px; margin-right:5%;" alt="">
			<div class="t150 tU ff4 posA w100" style="bottom:0;">
				<marquee scrolldelay="200" scrollamount="12" class="txtBorderColor colorMorado3 mb40"><?= ($home[1]["titulo2"]); ?></marquee>
				<marquee scrolldelay="200" scrollamount="15" direction="right" class="txtBorderColor colorMorado3 taC mb40"><?= ($home[1]["titulo3"]); ?></marquee>
				<marquee scrolldelay="200" scrollamount="8" class="txtBorderColor2 colorMorado3"><?= ($home[1]["titulo4"]); ?></marquee>
			</div>
		</div>
	</div> -->
	<!-- <div id="/* The code you provided is commented out in HTML and PHP. It seems to be a section of
	code related to displaying content about "programas" (programs) on a webpage.
	However, this section is currently commented out, which means it is not active and
	will not be displayed on the webpage. */
	programas" class="h40"></div>
	<div class="h40"></div>
	<div class="generalMin">
		<div class="colorfff t50 ff3 mb50">
			<?= ($home[2]["titulo1"]); ?>
			<span class="colorMorado2"><?= ($home[2]["titulo2"]); ?></span>
		</div>
		<div class="h30"></div>
	</div> -->
</div>





<div class="ionix pAA80 pAA40_oS" style="z-index:40; background:url(resources/img/border.png) center bottom no-repeat; background-size:100% auto;">
	<div class="general">

		<div class="taC mb50">
			<h2 class="max1000 t40 ff5 tU colorMorado mAUTO mb20"><?= ($home[2]["titulo3"]); ?></h2>
			<div class="max700 t18 ff2 color999 mAUTO"><?= ($home[2]["titulo4"]); ?></div>
		</div>

		<div class="row justify-content-center">
			<?php

				$colaboradores = [
					1 => [
						"nombre"   => "John Vinasco",
						"cargo"    => "Gerente general",
						"titulo"   => "Especialista en Desarrollo de negocios",
						"linkedin" => "https://www.linkedin.com/in/john-vinasco-43471971/",
						"foto"     => "john-vinasco.webp"
					],
					2 => [
						"nombre"   => "Marcos Valdés",
						"cargo"    => "Director de Comunicaciones",
						"titulo"   => "Especialista en Comunicación y Contenidos",
						"linkedin" => "https://www.linkedin.com/in/marcos-adri%C3%A1n-vald%C3%A9s-garc%C3%ADa-608768147/",
						"foto"     => "marcos-valdes.webp"
					],
					3 => [
						"nombre"   => "William Aragón",
						"cargo"    => "Director de TI",
						"titulo"   => "Master en Gestión de Proyectos TI",
						"linkedin" => "https://www.linkedin.com/in/williamaragon/",
						"foto"     => "william-aragon.webp"
					],
				];

				foreach ($colaboradores as $key => $colaborador) {
					echo '<div class="col-12 col-sm-6 col-lg-3 mb20_oS">';
					include "web/components/colaborador.php";
					echo '</div>';
				}

			?>
		</div>

		<div class="h50"></div>
	</div>
</div>



