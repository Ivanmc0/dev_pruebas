<?php
	$noticia = $_TUCOACH->get_data("web_contenidos_articulos", " AND seo = '".$geton[1]."' AND inactivo = 0 AND eliminado = 0 ", 0);
	if($noticia){
?>
<div class="ionix bfff taC">
	<div class="">
		<img src="<?= ($static."articulos/l/".$noticia["imagen"]); ?>" class="w100">
	</div>
</div>

<div class="ionix" style="z-index:5;">
	<div class="generalMin bFull">

		<div class="mT-200 w90 mAUTO bGray p50 p30_oS mb50">

			<div class="colorAzul ff3 p20 p0_oS t50 mb20"><?= ($noticia["nombre"]); ?></div>

			<div class="colorAzul2 ff1 t30 pL40 w80 w100_oS magion mb50 mb20_oS"><?= ($noticia["resumen"]); ?></div>

			<?php if($noticia["video"] != ""){ ?>
				<div class="videoWrapper mb50 mb20_oS">
					<?= (htmlspecialchars_decode($noticia["video"])); ?>
				</div>
			<?php } ?>

			<?php
				$url_face = "http://www.facebook.com/sharer.php?u=".$urlion;
				$url_twit = "https://twitter.com/intent/tweet?text=".$urlion;
				$url_link = "https://www.linkedin.com/shareArticle?mini=true&url=".$urlion."&source=LinkedIn";
			?>


			<div class="tab">
				<div class="tabIn w200x tab100_oS" style="vertical-align:top;">
					<div class="pAA30 p20_oS w150x wAUTO_oS taC fL bRS1 mEsp5 fN_oS b0_oS">
						<div class="ff2 t12 tU mb30 mb10_oS">Comparte este artículo por</div>
						<a href="<?= $url_face; ?>" target="_blank" class="w40x dIB"><img src="<?= $roution; ?>resources/img/icons/facebook.png" alt=""></a>
						<div class="dN_oS"><br></div>
						<a href="<?= $url_twit; ?>" target="_blank" class="w40x dIB"><img src="<?= $roution; ?>resources/img/icons/twitter.png" alt=""></a>
						<div class="dN_oS"><br></div>
						<a href="<?= $url_link; ?>" target="_blank" class="w40x dIB"><img src="<?= $roution; ?>resources/img/icons/linkedin.png" alt=""></a>
					</div>
				</div>
				<div class="tabIn tab100_oS">
					<div class="color666 dIB ff1 t20 magion w90 w100_oS">
						<?= (htmlspecialchars_decode($noticia["contenido"])); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if($noticia["id_galeria"] != 0){ ?>
<div class="ionix bAzul4">

	<div class="h80 h40_oS"></div>

	<?php
		$galeria2 = $_TUCOACH->get_data("web_contenidos_galerias", " AND id = ".$noticia["id_galeria"]." AND inactivo = 0 AND eliminado = 0 ", 0);
		$galerias2 = $_TUCOACH->get_data("web_contenidos_galerias_imagenes", " AND id_galeria = ".$galeria2["id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ", 1);
		shuffle($galerias2);
	?>

	<div class="taC t40 ff3 colorfff mb30"><span class="colorAzul">#</span><?= ($galeria2["nombre"]); ?></div>
	<div style="overflow:hidden;">
		<div class="galerion">
			<?php
				if($galerias2){
					foreach($galerias2 AS $galeria){
			?>
					<a href="<?= ($station."galerias/l/".$galeria["imagen"]); ?>" data-fancybox="galeria" class="dB bFull h250 h150_oS" style="background-image:url(<?= ($station."galerias/m/".$galeria["imagen"]); ?>);"></a>
			<?php
					}
				}
			?>
		</div>
	</div>


</div>

<?php } ?>

<div class="ionix bfff pAA80 pAA40_oS">
	<div class="general">
		<div class="color000 ffZ2 t40 mb20">Otros artículos</div>
		<div class="row m0 p0 mb40">
			<?php
				$noticias = $_TUCOACH->get_data("web_contenidos_articulos", " AND id != ".$noticia["id"]." AND id_proyecto = ".$project." AND id_categoria = 6 AND visible = 1 AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC LIMIT 3 ", 1);
				if($noticias){
					foreach($noticias AS $noticia){
						echo '<div class="col-12 col-sm-4 m0 p10">';
						include $roution."default/prev_articulo.php";
						echo '</div>';
					}
				}
			?>
		</div>
	</div>
</div>



<?php
	}
?>