<?php require_once ('../../appInit.php');

	if($_POST["id_empresa2"] != "" && $_POST["id_nivel"] != "" && $_POST["nivel"] != "" && $_POST["id_proyecto2"] != "" && $_POST["id_cr"] != ""){

		$exist = $_TUCOACH->get_data("grw_okr_pyt_corresponsables", " AND id_corresponsable = ".$_POST["id_cr"]." AND nivel = ".$_POST["nivel"]." AND id_nivel = ".$_POST["id_nivel"]." AND id_proyecto = ".$_POST["id_proyecto2"]." AND id_empresa = ".$_POST["id_empresa2"]." AND inactivo = 0 AND eliminado = 0 ", 0);

		if($exist){
			$delete = $_TUCOACH->delete_on("grw_okr_pyt_corresponsables", "id", $exist["id"]);
			if($delete){
				echo '<script>$("#liti'.$_POST["id_cr"].'").slideUp();</script>';
				echo '<script>$("#litii'.$_POST["id_cr"].'").slideUp();</script>';
			}
		}else echo "no hay";

	} else echo "Error";

?>
