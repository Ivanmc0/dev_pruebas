<?php
	$url = "";
	if($app["env"][$ambiente]["status"]) $url = '<a href="'.$app["env"][$ambiente]["url"].'" class="d-flex align-items-center justify-content-center w50x t14 ff3 colorfff taC beee aHover2" target="_blank" style="background-color:'.$app["color"].';"><i class="fas fa-external-link-alt"></i></a>';
	$status = $app["env"][$ambiente]["status"] ? '<div class="fR bVerde p310 rr5 t12 colorfff">Online</div>' : '<div class="fR bRojo p310 rr5 t12 colorfff">Offline</div>';
	echo '
		<div class="bS1 beee pLR10 mb20" style="border-color:'.$app["color"].';">
			<div class="d-flex pAA10">
				<div class="d-flex w80x bS1 bFull" style="background-image:url('.$dominion."resources/img/".$app["image"].')"></div>
				<div class="d-flex flex-column w100 p510">
					<div>
						'.$status.'
						<div class="t10 color999 mb10 dN dMigas dMigas-1">Code. '.$app["code"].'</div>
						<div class="t14 tU ff4 mb10" style="color:'.$app["color"].';">
							<img src="'.$dominion."resources/".$app["favicon"].'">
							'.$app["name"].'
						</div>
						<div class="t14 color333 mb10 dN dMigas dMigas-1">Descripción: '.$app["description"].'</div>
						<div class="t12 color666 mb10 dN dMigas dMigas-1">Keywords: '.$app["keywords"].'</div>
						<input class="dB bGray w100 t14 color666 p5 bS1" readOnly value="'.$app["env"][$ambiente]["url"].'" />
					</div>
				</div>
				'.$url.'
			</div>';

			if (isset($app["sites"])){
				echo '<div class="pLR10"><div class="ff2 t12 mb10">Otras utilidades</div>';
				foreach ($app["sites"] as $key => $sitio) include "sitio_utilidad.php";
				echo '</div>';
			}

		echo '</div>
	';