<?php require_once ('../../../appInit.php');

	$i    		= 0;
	$input 		= "imagenes";
	$direccion 	= "../../../../static/".$_POST["carpeta"];

	if(isset($_FILES)){
		foreach($_FILES[$input]["name"] as $file){
			$nombreImg = explode('.', $_FILES[$input]['name'][$i]);
			$nombreFinal = "john-vinasco_foto_".$i."-".time().".".end($nombreImg);
			if (move_uploaded_file($_FILES[$input]['tmp_name'][$i], $direccion.$nombreFinal)){
				$size = getimagesize($direccion.$nombreFinal);
				$ancho 	= $size[0];
				$alto 	= $size[1];
				require_once '../../class/resize-class.php';
				$oResize = new resize($direccion.$nombreFinal);
				$oResize -> resizeImage(200, 0, 'landscape');
				$oResize -> saveImage($direccion."/s/".$nombreFinal, 60);
				$oResize -> resizeImage(575, 0, 'landscape');
				$oResize -> saveImage($direccion."/m/".$nombreFinal, 100);
				if($ancho >= $alto){
					$oResize -> resizeImage(1400, 0, 'landscape');
					$oResize -> saveImage($direccion."/l/".$nombreFinal, 100);
				}else{
					$oResize -> resizeImage(0, 900, 'portrait');
					$oResize -> saveImage($direccion."/l/".$nombreFinal, 100);
				}
				$_POST["imagen"] 	= $nombreFinal;
				$_POST["prioridad"] = 9999;
				$_POST["fecha"] 	= date("Y-m-d H:i:s");
				$insert = $_TUCOACH->insert_data_array($_POST, $_POST["tabla"]);
			}
			$i++;
		}
		echo '<div class="success">Las fotos fueron subidas correctamente</div>';
		echo '<script>setTimeout(function(){ location.reload(); }, 1500);</script>';
	} else echo '<div class="danger">Debe seleccionar alguna imagen</div>';

?>
