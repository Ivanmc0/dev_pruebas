<?php require_once ('../../../appInit.php');

	if(isset($_POST["id"])) $id = trim($_POST["id"]); else $id = "";

	$insert = 0;
	$update = 0;

	$imgg 		= "imagen";
	$direccion 	= "../../../../static/".$_POST["carpeta"];
	if(isset($_FILES[$imgg]['name'])){
		$nombreImg   = explode('.', $_FILES[$imgg]['name']);
		$nombreFinal = "john-vinasco_seccion_".time().".".end($nombreImg);
		if (move_uploaded_file($_FILES[$imgg]['tmp_name'], $direccion.$nombreFinal)){
			$size = getimagesize($direccion.$nombreFinal);
			require_once '../../class/resize-class.php';
			$oResize = new resize($direccion.$nombreFinal);
			$oResize -> resizeImage(200, 0, 'landscape');
			$oResize -> saveImage($direccion."/s/".$nombreFinal, 60);
			$oResize -> resizeImage(575, 0, 'landscape');
			$oResize -> saveImage($direccion."/m/".$nombreFinal, 100);
			if($size[0] >= $size[1]){
				$oResize -> resizeImage(1400, 0, 'landscape');
				$oResize -> saveImage($direccion."/l/".$nombreFinal, 100);
			}else{
				$oResize -> resizeImage(0, 900, 'portrait');
				$oResize -> saveImage($direccion."/l/".$nombreFinal, 100);
			}
			$_POST[$imgg] = $nombreFinal;
		}
	}

	$update = $_TUCOACH->update_data_array($_POST, $_POST["tabla"], "id", $id);

	echo '<div class="success">Los cambios se han guardado correctamente</div>';
	echo '<script>setTimeout(function(){ history.go(-1); }, 1500);</script>';


?>
