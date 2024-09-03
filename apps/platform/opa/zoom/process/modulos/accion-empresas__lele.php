<?php require_once('../../../appInit.php');

	if(isset($_POST["id"])) $id = trim($_POST["id"]); else $id = "";

	$insert = 0;
	$update = 0;

	if($id == ""){
		$_POST["fecha"] = date("Y-m-d H:i:s");
		$insert = $_ZOOM->insert_data_array($_POST, $_POST["tabla"]);
	} else {
		$imgg 		= "logo";
		$direccion 	= "../../../../static/".$_POST["carpeta"];
		if(isset($_FILES[$imgg]['name'])){
			$nombreImg   = explode('.', $_FILES[$imgg]['name']);
			$nombreFinal = "tucoach_".$_POST["seo"]."_".time().".".end($nombreImg);
			if (move_uploaded_file($_FILES[$imgg]['tmp_name'], $direccion.$nombreFinal)){
				$_POST[$imgg] = $nombreFinal;
			}
		}
		$update = $_ZOOM->update_data_array($_POST, $_POST["tabla"], "id", $id);
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
