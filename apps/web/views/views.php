<?php

if($geton[0] == "reportes"){

	if($geton[1] == "graficador-personas-empresa"){

		include $roution."views/general/header-cobo.php";
		include $roution."views/reports/graficador-persona-empresa.php";
		include $roution."views/general/footer-cobo.php";

	} else if($geton[1] == "disc"){

		include $roution."views/general/header.php";

		if(!isset($geton[2])) 	include $roution."views/reports/disc.php";
		else 					include $roution."views/reports/disc-report.php";

		include $roution."views/general/footer.php";

	} else echo '<script>location.href="'.$dominion.'";</script>';


}else if($geton[0] == "landing"){
	if($geton[1] == "camp-informe-disc"){
		if(isset($geton[2]) && $geton[2] == "gracias") 		include $roution."views/landings/disc-2024-gracias.php";
		else 												include $roution."views/landings/disc-2024.php";
	}
	else if($geton[1] == "prueba-gratis-para-lideres")    	include $roution."views/landings/prueba-gratis-para-lideres.php";
	else echo '<script>location.href="'.$dominion.'";</script>';


}else if($geton[0] == "bancow"){

	if($geton[1] == "ranking")		include $roution."views/bancow/ranking.php";
	else if($geton[1] == "balance")	include $roution."views/bancow/balance.php";
	else if($geton[1] == "experiencia")	include $roution."views/bancow/experiencia.php";
	else echo '<script>location.href="'.$dominion.'";</script>';

} else {


	include $roution."views/general/header-web.php";

	if($geton[0] == "")						include $roution."views/web/inicio.php";
	else if($geton[0] == "nosotros")		include $roution."views/web/nosotros.php";
	else if($geton[0] == "directorio")		include $roution."views/web/directorio.php";
	else if($geton[0] == "contacto")		include $roution."views/web/contacto.php";
	else if($geton[0] == "blog")			include $roution."views/web/blog.php";
	else if($geton[0] == "servicios")		include $roution."views/web/servicios.php";
	else if($geton[0] == "plataforma")		include $roution."views/web/plataforma.php";
	else if($geton[0] == "articulo")		include $roution."views/web/articulo.php";


	else echo '<script>location.href="'.$dominion.'";</script>';

	include $roution."views/general/footer-web.php";

}