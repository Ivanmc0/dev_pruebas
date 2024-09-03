<?php require_once ('../../appInit.php');

	if($_POST["id_empresa"] != "" && $_POST["id_kr"] != "" && $_POST["id_proyecto"] != "" && $_POST["id"] != ""){

		$exist = $_TUCOACH->get_data("grw_okr_estrategias", " AND id = ".$_POST["id"]." AND id_kr = ".$_POST["id_kr"]." AND id_proyecto = ".$_POST["id_proyecto"]." AND id_empresa = ".$_POST["id_empresa"]." AND inactivo = 0 AND eliminado = 0 ", 0);

		if($exist){
			$delete = $_TUCOACH->delete_on("grw_okr_estrategias", "id", $exist["id"]);
			if($delete){
				//echo "<div class='success'>Registro creado correctamente</div>";
				echo '<script>$("#prop'.$exist["id"].'").slideUp();</script>';
				echo '<script>$("#propp'.$exist["id"].'").slideUp();</script>';
			} //else echo "<div class='danger'>Error</div>";
		}

	} else echo "Error";

?>
