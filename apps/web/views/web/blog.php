<?php

	$home   = $_TUCOACH->get_data("web_contenidos_secciones", " AND id_proyecto = ".$project." AND id_categoria = 7 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
	$equipo = $_TUCOACH->get_data("web_contenidos_secciones", " AND id_proyecto = ".$project." AND id_categoria = 9 AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);

?>


<div class="ionix pAA80">
	<div class="general">

		<div class="colorMorado t80 ffX tU pLR20 mb10">Blog</div>
		<div class="colorMorado2 t24 ff2 pLR20 mb50">Encuentra las últimas noticias y artículos de interés</div>

		<div class="row mb50">
			<?php
				$noticias = $_TUCOACH->get_data("web_contenidos_articulos", " AND id_proyecto = ".$project." AND id_categoria = 6 AND visible = 1 AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
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