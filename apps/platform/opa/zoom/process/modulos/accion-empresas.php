<?php require_once ('../../../appInit.php');

	// echo '<pre class="taL">';
	// print_r($_POST);
	// print_r($_FILES);
	// echo '</pre>';
	// die();

	if(isset($_POST["id"])) $id = trim($_POST["id"]); else $id = "";

	$insert = 0;
	$update = 0;

	$imgg 		= "logo";
	$direccion 	= "../../../../static/".$_POST["carpeta"];
	if(isset($_FILES[$imgg]['name'])){
		$nombreImg   = explode('.', $_FILES[$imgg]['name']);
		$nombreFinal = $_POST["subdominio"]."_".time().".".end($nombreImg);
		if (move_uploaded_file($_FILES[$imgg]['tmp_name'], $direccion.$nombreFinal)){
			require_once '../../../../../../class/resize-class.php';
			$oResize = new resize($direccion.$nombreFinal);
			$oResize -> resizeImage(0, 70, 'portrait');
			$oResize -> saveImage($direccion."olc_".$nombreFinal, 95);
			$_POST[$imgg] = "olc_".$nombreFinal;
		}
	} else unset($_POST[$imgg]);

	if($id == ""){

		$_POST["fecha"] = date("Y-m-d H:i:s");

		if($insert = $_TUCOACH->insert_data_array($_POST, $_POST["tabla"])){

			$dataUser = [
				"id_empresa"          => $insert,
				"id_rol"              => 110,
				"nombres"             => $_POST["nombres"],
				"apellidos"           => $_POST["apellidos"],
				"email"               => $_POST["email"],
				"identificacion"      => $_POST["identificacion"],
				"identificacion_tipo" => 'CC',
				"fecha" 			  => date("Y-m-d H:i:s"),
			];

			if($insert2 = $_TUCOACH->insert_data_array($dataUser, "zoom_users")){

				$dataRolAdmin = [
					"id_user" => $insert2,
					"id_rol"  => 120,
					"fecha"   => date("Y-m-d H:i:s"),
				];
				$_TUCOACH->insert_data_array($dataRolAdmin, "zoom__users__roles");

				$Organigrama = [
					"id_empresa" => $insert,
					"nombre"    => "Mi Organigrama",
					"activo"     => 1,
					"fecha"      => date("Y-m-d H:i:s"),
				];
				$_TUCOACH->insert_data_array($Organigrama, "grw_organigramas");

				$Categ = [
					"id_empresa" => $insert,
					"nombre"    => "General",
					"fecha"      => date("Y-m-d H:i:s"),
				];
				$_TUCOACH->insert_data_array($Categ, "grw_lel_categorias");

			}

		}

	} else {

		$update = $_TUCOACH->update_data_array($_POST, $_POST["tabla"], "id", $id);
	}

	if($insert != 0) {
		echo "<div class='success'>Registro creado correctamente</div>";
		echo '<script>setTimeout(function(){ history.go(-1); }, 1500);</script>';
	}
	if($update != 0){
		echo '<div class="success">Los cambios se han guardado correctamente</div>';
		echo '<script>setTimeout(function(){ history.go(-1); }, 1500);</script>';
	}

?>
