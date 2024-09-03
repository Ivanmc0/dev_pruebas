<?php

	$url = "";
	if($sitio["env"][$ambiente]["status"]) $url = '<a href="'.$sitio["env"][$ambiente]["url"].'" class="d-flex w50x p10 dB w100 t14 ff3 colorfff taC beee aHover2" target="_blank" style="background-color:'.$app["color"].';"><div class="w100 taC"><i class="fas fa-external-link-alt"></i></div></a>';
	$status = $sitio["env"][$ambiente]["status"] ? '<div class="fR dIB bVerde rr5 t10 ff0 mL10 colorfff" style="padding:2px 4px;">Online</div>' : '<div class="fR dIB bRojo rr5 t10 ff0 mL10 colorfff" style="padding:2px 4px;">Offline</div>';
	echo '
		<div class="bfff mb10">
			<div class="d-flex w100 p510 align-items-end">
				<div class="d-flex flex-column w100 pR10">
					<div class="w100 t12 ff3 mb3" style="color:'.$app["color"].';">'.$sitio["name"].''.$status.'</div>
					<input class="dB w100 t12 color666 p5 bS1" readOnly value="'.$sitio["env"][$ambiente]["url"].'" />
				</div>
				'.$url.'
			</div>';
		echo '</div>
	';