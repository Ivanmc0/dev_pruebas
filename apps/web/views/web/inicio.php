<?php

	$home   = $_TUCOACH->get_data("web_contenidos_secciones", " AND id_proyecto = ".$project." AND id_categoria = 7 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
	$equipo = $_TUCOACH->get_data("web_contenidos_secciones", " AND id_proyecto = ".$project." AND id_categoria = 9 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);

?>

<div id="inicio" class="beee" style="z-index:1">
	<div class="h500 bFull posR" style="background-image:url(<?= ($dominion."resources/img/background-2024.webp"); ?>); overflow:hidden;">
		<div class="tabAll posR" style="z-index:10">
			<div class="tabIn pLR30">
				<div class="h50"></div>
				<div class="ff5 t50 colorfff tU taC tShadow mb10">ORGANIZATIONAL<br>LEARNING FOR THE CHANGE</div>
				<div class="ff2 t20 colorfff tU taC tShadow" style="letter-spacing:0.25em;"><?= ($home[0]["titulo2"]); ?></div>
			</div>
		</div>
	</div>
</div>


<div class="ionix" style="z-index:40;">
	<div class="general">

		<div class="row mb50" style="margin-top:-50px; z-index:4;">
			<?php
				$prg = 1;
				$noticias = $_TUCOACH->get_data("web_contenidos_articulos", " AND id_proyecto = ".$project." AND id_categoria = 7 AND visible = 1 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC LIMIT 6 ", 1);
				if($noticias){
					$ff=1;
					foreach($noticias AS $noticia){
						echo '<div class="col-6 col-sm-4 col-xl-2 mb30">';
						include $roution."views/web/components/programa.php";
						echo '</div>';
						$prg++;
					}
				}
			?>
		</div>


		<h2 class="ff4 t30 colorMorado mb10">Nuestros clientes</h2>
		<h2 class="ff2 t18 color666 mb30">Construyendo relaciones duraderas que transforme la cultura para vivir mejor.</h2>

		<div class="bfff">
			<?php $galerias = $_TUCOACH->get_data("web_contenidos_galerias_imagenes", " AND id_galeria = 9 AND inactivo = 0 AND eliminado = 0 ORDER BY id ", 1); ?>
			<div class="row m0 p0">
				<?php
					if($galerias){
						shuffle($galerias);
						foreach($galerias AS $galeria){
				?>
						<div class="col-12 col-sm-4 col-lg-2 p0 m0"><img src="<?= ($static."galerias/m/".$galeria["imagen"]); ?>" class="rrssBW-" /></div>
				<?php
						}
					}
				?>
			</div>
		</div>

		<div class="h50"></div>


	</div>
</div>


<!-- <div class="ionix pAA150" style="background:#440b74 url(<?= $dominion; ?>resources/img/back-in2024.jpg) center top no-repeat; background-size:100% auto;"> -->

<div class="ionix pAA150" style="background:#440b74 url(<?= ($static."secciones/".$home[3]["imagen"]); ?>) center top no-repeat; background-size:100% auto;">
	<div class="general">

		<div class="h50"></div>

		<div class="ffX t80 colorfff tU taC mb20"><?= ($home[3]["titulo1"]); ?></div>
		<div class="ff2 t20 colorfff tU taC mb50" style="letter-spacing:0.25em;"><?= ($home[3]["titulo2"]); ?></div>

		<div class="row m0 p0 bS1 mb50">
			<div class="col-12 col-sm-4 col-lg-4 mb20_oS p0 m0">
				<div class="bS1 bfff h400 posR enfoque">
					<div class="p40 color666 t14 tU ff0"><?= ($home[4]["url1"]); ?></div>
					<div class="p40 posA" style="bottom:0">
						<div class="t50 tU ffX w80 colorMorado4 mb10"><?= ($home[4]["titulo1"]); ?></div>
						<div class="t20 ff1 w70 colorfff dN"><?= (htmlspecialchars_decode($home[4]["texto1"])); ?></div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-4 col-lg-4 mb20_oS p0 m0">
				<div class="bS1 bfff h400 posR enfoque">
					<div class="p40 color666 t14 tU ff0"><?= ($home[4]["url2"]); ?></div>
					<div class="p40 posA" style="bottom:0">
						<div class="t50 tU ffX w80 colorMorado4 mb10"><?= ($home[4]["titulo2"]); ?></div>
						<div class="t20 ff1 w70 colorfff dN"><?= (htmlspecialchars_decode($home[4]["texto2"])); ?></div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-4 col-lg-4 mb20_oS p0 m0">
				<div class="bS1 bfff h400 posR enfoque">
					<div class="p40 color666 t14 tU ff0"><?= ($home[4]["url3"]); ?></div>
					<div class="p40 posA" style="bottom:0">
						<div class="t50 tU ffX w80 colorMorado4 mb10"><?= ($home[4]["titulo3"]); ?></div>
						<div class="t20 ff1 w70 colorfff dN"><?= (htmlspecialchars_decode($home[4]["texto3"])); ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="generalMin">

		<div class="max1000 mAUTO mb30">
			<div class="t50 ff3 colorMorado2 mb20"><span class="colorfff"><?= ($home[3]["titulo3"]); ?></span> <?= ($home[3]["titulo4"]); ?></div>
			<div class="t21 ff1 colorfff"><?= (htmlspecialchars_decode($home[3]["texto1"])); ?></div>
		</div>

	</div>
</div>

<div class="ionix">
	<div class="general">

		<div class="b000 p50100 pLR50_oS mb40 mT-200 textion5 opa posR" style="margin-top:-100px;">
			<div class="testimonios">
				<?php
					$testimonios = $_TUCOACH->get_data("web_contenidos_testimonios", " AND id_grupo = 7 AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
					shuffle($testimonios);
					if($testimonios){
						foreach($testimonios AS $testimonio){
							include $roution."views/web/components/testimonio.php";
						}
					}
				?>
			</div>
		</div>


		<div id="blog" class="h40"></div>
		<div class="h40"></div>
		<div class="colorMorado t80 ffX tU pLR20 mb20">Blog</div>

		<div class="row mb50">
			<?php
				$noticias = $_TUCOACH->get_data("web_contenidos_articulos", " AND id_proyecto = ".$project." AND id_categoria = 6 AND visible = 1 AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC LIMIT 3 ", 1);
				if($noticias){
					$ff=1;
					foreach($noticias AS $noticia){
						echo '<div class="col-12 col-sm-4 textion5News'.$ff.' opa">';
						include $roution."views/web/components/articulo.php";
						echo '</div>';
						$ff++;
					}
				}
			?>
		</div>


		<div class="h50"></div>

	</div>
</div>