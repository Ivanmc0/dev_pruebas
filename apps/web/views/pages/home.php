<?php

	$home   = $_TUCOACH->get_data("web_contenidos_secciones", " AND id_proyecto = ".$project." AND id_categoria = 7 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
	$equipo = $_TUCOACH->get_data("web_contenidos_secciones", " AND id_proyecto = ".$project." AND id_categoria = 9 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);

?>


<div id="inicio" class="ionix beee" style="z-index:1">
	<div class="allion bFull posR" style="background-image:url(<?= ($dominion."resources/img/background-2024.webp"); ?>); overflow:hidden;">

		<?php
			$galerin = $_TUCOACH->get_data("web_contenidos_galerias_imagenes", " AND id_galeria = 8 AND inactivo = 0 AND eliminado = 0 ORDER BY prioridad ASC  ", 1);
		?>
<!--
		<div class="bMorado rr50 posA bShadow2 bFull alt1" style="width:15%; bottom:-1%; left:-1%; z-index:6; background-image:url(<?= ($static."galerias/l/".$galerin[0]["imagen"]); ?>)"></div>
		<div class="bMorado rr50 posA bShadow2 bFull alt2" style="width:18%; bottom:2%; left:14%; z-index:5; background-image:url(<?= ($static."galerias/l/".$galerin[1]["imagen"]); ?>)"></div>
		<div class="bMorado rr50 posA bShadow2 bFull alt3" style="width:25%; bottom:-7%; left:33%; z-index:6; background-image:url(<?= ($static."galerias/l/".$galerin[2]["imagen"]); ?>)"></div>
		<div class="bMorado rr50 posA bShadow2 bFull alt4" style="width:20%; bottom:2%; right:23%; z-index:5; background-image:url(<?= ($static."galerias/l/".$galerin[3]["imagen"]); ?>)"></div>
		<div class="bMorado rr50 posA bShadow2 bFull alt5" style="width:30%; bottom:-10%; right:-5%; z-index:6; background-image:url(<?= ($static."galerias/l/".$galerin[4]["imagen"]); ?>)"></div>
-->

		<div class="tabAll posR" style="z-index:10">
			<div class="tabIn pLR30">
				<div class="ff5 t80 colorfff tU taC tShadow mb5" style="line-height:1em">ORGANIZATIONAL</div>
				<div class="ff5 t80 colorfff tU taC tShadow mb5" style="line-height:1em">LEARNING FOR</div>
				<div class="ff5 t80 colorfff tU taC tShadow mb20" style="line-height:1em">THE CHANGE</div>
				<div class="ff2 t20 colorfff tU taC tShadow" style="letter-spacing:0.25em;"><?= ($home[0]["titulo2"]); ?></div>
			</div>
		</div>
	</div>
</div>

<div id="nosotros" class="ionix bGrad1 pAA120 pAA60_oS bShadow" style="z-index:11">
	<div class="generalMin">
		<div class="colorfff t50 ff3 mb50">
			<?= ($home[1]["titulo1"]); ?>
			<span class="colorMorado2"><?= ($home[1]["url1"]); ?></span>
		</div>
		<div class="colorfff ff2 t18 max400 magion"><?= (htmlspecialchars_decode($home[1]["texto1"])); ?></div>
	</div>
	<div class="tab taR posR">
		<div class="tabIn" style="vertical-align:bottom">
			<img src="<?= ($static."secciones/".$home[1]["imagen"]); ?>" class="w50 mT-200" style="margin-top:-200px; margin-right:5%;" alt="">
			<div class="t150 tU ff4 posA w100" style="bottom:0;">
				<marquee scrolldelay="200" scrollamount="12" class="txtBorderColor colorMorado3 mb40"><?= ($home[1]["titulo2"]); ?></marquee>
				<marquee scrolldelay="200" scrollamount="15" direction="right" class="txtBorderColor colorMorado3 taC mb40"><?= ($home[1]["titulo3"]); ?></marquee>
				<marquee scrolldelay="200" scrollamount="8" class="txtBorderColor2 colorMorado3"><?= ($home[1]["titulo4"]); ?></marquee>
			</div>
		</div>
	</div>
	<div id="programas" class="h40"></div>
	<div class="h40"></div>
	<div class="generalMin">
		<div class="colorfff t50 ff3 mb50">
			<?= ($home[2]["titulo1"]); ?>
			<span class="colorMorado2"><?= ($home[2]["titulo2"]); ?></span>
		</div>
		<div class="h30"></div>
	</div>
</div>


<div class="ionix" style="z-index:40; background:url(resources/img/border.png) center bottom no-repeat; background-size:100% auto;">
	<div class="general">

		<div class="row" style="margin-top:-100px; z-index:4;">
			<?php
				$prg = 1;
				$noticias = $_TUCOACH->get_data("web_contenidos_articulos", " AND id_proyecto = ".$project." AND id_categoria = 7 AND visible = 1 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC LIMIT 6 ", 1);
				if($noticias){
					$ff=1;
					foreach($noticias AS $noticia){
						echo '<div class="col-12 col-sm-6 col-lg-4 mb30">';
						include $roution."views/components/programa.php";
						echo '</div>';
						$prg++;
					}
				}
			?>
		</div>

		<div id="equipo" class="h40"></div>
		<div class="h40"></div>

		<div class="taC max700 t50 ff3 colorMorado mAUTO mb20"><?= ($home[2]["titulo3"]); ?></div>
		<div class="taC max700 t24 ff3 color999 mAUTO mb40"><?= ($home[2]["titulo4"]); ?></div>

		<div class="row justify-content-center align-items-center">
			<div class="col-12 col-sm-6 col-lg-3 mb30">
				<div class="equipo">
					<div class="posR taC mb20">
						<img src="resources/img/john-vinasco.png" alt="">
						<div class="wh40 posA" style="left:30px; bottom:30px;">
							<div class="bVerde tabAll posR rr50" style="z-index:5">
								<div class="tabIn taC t18 colorfff"><i class="fas fa-plus"></i></div>
							</div>
							<div class="posA w180x h40 bGray bShadow rr60 rrss taR colorMorado2" style="left:0; top:0; z-index:4; padding:6px 5px 0 0;">
								<a href="<?= ($equipo[0]["url1"]); ?>" target="_blank" class="t30 coloraaa aS2">I</a>
								<a href="<?= ($equipo[0]["url2"]); ?>" target="_blank" class="t30 coloraaa aS2">L</a>
								<a href="<?= ($equipo[0]["url3"]); ?>" target="_blank" class="t30 coloraaa aS2">F</a>
							</div>
						</div>
					</div>
					<div class="tU colorfff ffX t24 taC mb10"><?= ($equipo[0]["titulo1"]); ?></div>
					<div class="colorccc ff2 t18 taC w180x mAUTO"><?= ($equipo[0]["titulo2"]); ?></div>
				</div>
			</div>
		</div>

		<div class="h30"></div>
		<div class="h30"></div>

	</div>
</div>


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

		<div class="b000 p50100 pLR50_oS mb40 mT-200 textion5 opa" style="margin-top:-100px;">
			<div class="testimonios">
				<?php
					$testimonios = $_TUCOACH->get_data("web_contenidos_testimonios", " AND id_grupo = 7 AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
					shuffle($testimonios);
					if($testimonios){
						foreach($testimonios AS $testimonio){
							include $roution."views/components/testimonio.php";
						}
					}
				?>
			</div>
		</div>

		<div class="bfff">
			<?php $galerias = $_TUCOACH->get_data("web_contenidos_galerias_imagenes", " AND id_galeria = 9 AND inactivo = 0 AND eliminado = 0 ORDER BY id ", 1); ?>
			<div class="row m0 p0">
				<?php
					if($galerias){
						shuffle($galerias);
						foreach($galerias AS $galeria){
				?>
						<div class="col-12 col-sm-4 col-lg-2 p0 m0"><img src="<?= ($static."galerias/m/".$galeria["imagen"]); ?>" class="rrssBW" /></div>
				<?php
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
						include $roution."views/components/articulo.php";
						echo '</div>';
						$ff++;
					}
				}
			?>
		</div>


		<div id="contacto" class="h40"></div>
		<div class="h40"></div>

		<div class="row ">
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
			<div class="col-12 col-sm-8">
				<div class="p50 t16">
					<div class="color666 pL10 mb10">Nombre completo</div>
					<input type="text" class="dB w100 bGray p1530 bS1 rr10 mb15">
					<div class="color666 pL10 mb10">Correo electrónico</div>
					<input type="text" class="dB w100 bGray p1530 bS1 rr10 mb15">
					<div class="color666 pL10 mb10">Teléfono</div>
					<input type="text" class="dB w100 bGray p1530 bS1 rr10 mb15">
					<div class="color666 pL10 mb10">Asunto</div>
					<input type="text" class="dB w100 bGray p1530 bS1 rr10 mb15">
					<div class="color666 pL10 mb10">Mensaje</div>
					<textarea type="text" class="dB w100 bGray p1530 bS1 rr10 mb15"></textarea>
					<div id="ref" class="pLR40 mb20"></div>
					<div class="dIB bVerde p2040 t18 rr40 tU ff3 colorfff">Enviar mensaje</div>
				</div>
			</div>
		</div>

		<div class="h30"></div>

	</div>
</div>