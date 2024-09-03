<?php

	if($_TOKENS->CookiesExists()){

		$mode       = 2;
		$trabajador = $_SESSION['WORKER'];
		$empresa    = $_SESSION['COMPANY'];

		if($geton[0] == ""){

			include $roution."views/general/header-mode-".$mode.".php";
			include $roution."views/app_tucoach/views/dashboard.php";
			include $roution."views/general/footer-mode-".$mode.".php";

		} elseif($geton[0] == "reporte-evaluacion-p2p"){

			include $roution."views/general/header-mode-".$mode.".php";
			include $roution."views/app_tucoach/views/reporte-evaluacion-p2p.php";
			include $roution."views/general/footer-mode-".$mode.".php";

		} elseif($geton[0] == "reporte-evaluacion-p2b"){

			include $roution."views/general/header-mode-".$mode.".php";
			include $roution."views/app_tucoach/views/reporte-evaluacion-p2b.php";
			include $roution."views/general/footer-mode-".$mode.".php";

		} elseif($geton[0] == "evaluacion-p2p"){

			include $roution."views/general/header-mode-".$mode.".php";
			include $roution."views/app_tucoach/views/evaluacion-p2p.php";
			include $roution."views/general/footer-mode-".$mode.".php";

		} elseif($geton[0] == "evaluacion-p2b"){

			include $roution."views/general/header-mode-".$mode.".php";
			include $roution."views/app_tucoach/views/evaluacion-p2b.php";
			include $roution."views/general/footer-mode-".$mode.".php";

		} elseif($geton[0] == "completar-perfil"){

			include $roution."views/general/header-mode-".$mode.".php";
			include $roution."views/app_tucoach/views/completar-perfil.php";
			include $roution."views/general/footer-mode-".$mode.".php";

		}

		else echo '<script>location.href="'.$dominion.'";</script>';

	} else {

		include $roution."views/general/header-mode-1.php";
		include $roution."views/pages/blank.php";
		include $roution."views/general/footer-mode-1.php";

	}
