<?php

	include $roution."views/general/header.php";

	### VIEWS ###
	// if($geton[0] == "")                     	include $roution."views/home.php";
	if($geton[0] == "")                     	echo '<script>location.href="'.$dominion.''.'";</script>';
	else if($geton[0] == "contact")             include $roution."views/contact.php";
	else if($geton[0] == "user")             	include $roution."views/user/index.php";

	### BANCO W ###
	else if($geton[0] == "bancow-bk"){

		if(isset($geton[1]) && $geton[1] == "balance") 	include $roution."views/bancow/balance.php";
		if(isset($geton[1]) && $geton[1] == "ranking") 	include $roution."views/bancow/ranking.php";

	}

	else if($geton[0] == "bancow-2024"){

		if(isset($geton[1]) && $geton[1] == "balance") 	include $roution."views/bancow24/balance.php";
		if(isset($geton[1]) && $geton[1] == "ranking") 	include $roution."views/bancow24/ranking.php";

	}

	### GRAPHICS ###
	else if($geton[0] == "graph"){

		if(isset($geton[1]) && $geton[1] == "ion") 	include $roution."views/graph/index.php";
		if(isset($geton[1]) && $geton[1] == "import") 	include $roution."views/graph/import.php";

	}

	### APP ###
	else if($geton[0] == "app"){
		if(isset($_SESSION["WORKER"]["id"]) && isset($_SESSION["WORKER"]["identificacion"]) && isset($_SESSION["lele_nombre"]) && isset($_SESSION["lele_cargo"]) && isset($_SESSION["COMPANY"]["id"]) ){
			if(isset($geton[1])){

				$mi_perfil = $_LELE->validation_perfil($_SESSION["WORKER"]["id"], $_SESSION["COMPANY"]["id"]);
				$mi_cargo = $_LELE->validation_cargo($_SESSION["WORKER"]["id"]);

				$empresa 		= $_ZOOM->get_data("olc_empresas", " AND id = ".$_SESSION["COMPANY"]["id"]." AND eliminado = 0 ORDER BY id DESC ", 0);
				$trabajador 	= $_ZOOM->get_data("zoom_users", " AND identificacion = '".$_SESSION["WORKER"]["identificacion"]."' AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND eliminado = 0 ORDER BY id DESC ", 0);
				$actividades 	= $_ZOOM->get_data("grw_lel_actividades", " AND id_empresa = ".$empresa["id"]." AND eliminado = 0 ORDER BY id DESC ", 1);
				$categorias 	= $_ZOOM->get_data("grw_lel_categorias", "  AND eliminado = 0 ORDER BY id DESC ", 1);
				$perfil 		= $_ZOOM->get_data("grw_sol_seg_perfilado", " AND id_trabajador = ".$trabajador["id"]." AND id_empresa = ".$_SESSION["COMPANY"]["id"]." AND eliminado = 0 ORDER BY id DESC ", 1);

				include $roution."views/fix/app_header.php";

				if($mi_perfil && $mi_cargo && isset($mi_cargo["jefe"]) && isset($mi_cargo["cargo"])){

					if($geton[1] == "mi-tablero") 					include $roution."views/mi-tablero.php";
					if($geton[1] == "detalle-categoria") 			include $roution."views/categoria-detalle.php";
					if($geton[1] == "detalle-actividad") 			include $roution."views/actividad-detalle.php";


					// if($geton[1] == "dashboard") 	include $roution."views/dashboard.php";
					// if($geton[1] == "categoria")	include $roution."views/categoria.php";
					// if($geton[1] == "actividad")	include $roution."views/actividad.php";
					// if($geton[1] == "detalle")		include $roution."views/actividad-detalle2.php";
					// if($geton[1] == "detalle3")		include $roution."views/actividad-detalle3.php";
					if($geton[1] == "lider")		include $roution."views/actividad-lider2.php";
					if($geton[1] == "organizacion")	include $roution."views/organizacion.php";
					if($geton[1] == "reconocimientos")	include $roution."views/reconocimientos.php";
					if($geton[1] == "reconocimiento")	include $roution."views/reconocimiento.php";

					if($geton[1] == "mi-perfil-empresarial")	include $roution."views/mi-perfil-empresarial.php";
					if($geton[1] == "completar-perfil")	include $roution."views/completar-perfil.php";
					if($geton[1] == "completar-jefe")	include $roution."views/completar-jefe.php";

				} else {

					if($geton[1] == "completar-perfil")	include $roution."views/completar-perfil.php";
					else if($geton[1] == "completar-jefe")	include $roution."views/completar-jefe.php";
					else include $roution."views/mi-perfil-empresarial.php";

				}

				include $roution."views/fix/app_footer.php";

			} else include $roution."views/ingreso.php";
		} else {
			if(isset($geton[1])) echo '<script>location.href="'.$dominion.''.'";</script>';
			else include $roution."views/ingreso.php";

		}

	}

	else echo '<script>location.href=$roution."'.$dominion.'";</script>';

	include $roution."views/general/footer.php";

?>