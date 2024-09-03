<?php require_once ('../../../appInit.php');

	if($_POST["nombre"] != "" AND $_POST["id_categoria"] != 0){

		if(isset($_POST["id"])) $id = trim($_POST["id"]); else $id = "";

		$insert = 0;
		$update = 0;

		$imgg 		= "imagen";
		$direccion 	= "../../../../static/".$_POST["carpeta"];
		if(isset($_FILES[$imgg]['name'])){
			$nombreImg   = explode('.', $_FILES[$imgg]['name']);
			$nombreFinal = "john-vinasco_".$_POST["seo"]."_".time().".".end($nombreImg);
			if (move_uploaded_file($_FILES[$imgg]['tmp_name'], $direccion.$nombreFinal)){
				require_once '../../class/resize-class.php';
				$oResize = new resize($direccion.$nombreFinal);
				$oResize -> resizeImage(200, 0, 'landscape');
				$oResize -> saveImage($direccion."/s/".$nombreFinal, 60);
				$oResize -> resizeImage(575, 0, 'landscape');
				$oResize -> saveImage($direccion."/m/".$nombreFinal, 100);
				$oResize -> resizeImage(1920, 0, 'landscape');
				$oResize -> saveImage($direccion."/l/".$nombreFinal, 100);
				$_POST[$imgg] = $nombreFinal;
			}
		}

		if($id == 0){
			$_POST["fecha"] = date("Y-m-d H:i:s");
			$insert = $_TUCOACH->insert_data_array($_POST, $_POST["tabla"]);
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

	} else echo '<div class="danger">Debe ingresar el nombre del artículo y su categoría</div>';

?>
