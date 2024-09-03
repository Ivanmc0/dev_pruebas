<?php require_once ('../../../appInit.php');

	$nivel 		= $_POST["nivel"];
	$rol 		= $_POST["rol"];
	$modulo 	= $_POST["modulo"];

	$models = $_TUCOACH->get_data("zoom_models", " AND id_modulo = $modulo AND inactivo = 0 AND eliminado = 0 ORDER BY orden ASC ", 1);
	if($models){
		foreach($models AS $model){
			$relrol = $_TUCOACH->get_data("zoom__models__roles", " AND id_modulo = ".$model["id"]." AND id_rol = ".$rol." AND eliminado = 0 ORDER BY id DESC ", 0);
			echo '<div class="tab bS1 bCeee" style="margin-bottom:-1px;">';
			echo '<div class="tabIn p10 cP rHover1 nivel-'.$nivel.' mod-'.$model['id'].'" onclick="Zoom.getChildren('.$nivel.','.$model["id"].','.$rol.')">'.($model["modulo"]).'</div>';
			echo '<div class="tabIn bLS1 w40x taC cP rHover2 modicon-'.$model['id'].'" onclick="Zoom.assignModels('.$model["id"].','.$rol.')">';
			if($relrol && $relrol["inactivo"] == 0){
				echo '<i class="la la-check success"></i>';
			}else{
				echo '<i class="la la-close danger"></i>';
			}
			echo '</div></div>';
		}
	} else echo '<div class="danger t12 pAA10"><i class="la la-close t12 danger"></i> Sin datos</div>';

?>