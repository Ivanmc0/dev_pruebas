<?php require_once ('../../../appInit.php');

	if($_POST["modulo"] != ""){

		if(isset($_POST["id"])) $id = trim($_POST["id"]); else $id = "";

		$insert = 0; $update = 0;

		if($id == ""){
			$_POST["fecha"] = date("Y-m-d H:i:s");
			$insert = $_TUCOACH->insert_data_array($_POST, "zoom_models");
		} else {
			$update = $_TUCOACH->update_data_array($_POST, "zoom_models", "id", $id);
		}

		if($insert != 0) {
			echo "<div class='success'>Registro creado correctamente</div>";
			echo '<script>setTimeout(function(){ history.go(-1); }, 1500);</script>';
		}
		if($update != 0){
			echo '<div class="success">Los cambios se han guardado correctamente</div>';
			echo '<script>setTimeout(function(){ history.go(-1); }, 1500);</script>';
		}

	} else echo '<span class="danger">No puede crear una función sin nombre</span>';

?>
