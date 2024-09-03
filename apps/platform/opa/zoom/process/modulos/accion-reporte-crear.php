<?php require_once ('../../../appInit.php');

	$evaluacion = $_POST["id_evaluacion"];
	$trabajador = $_POST["id_trabajador"];

	$existe = $_TUCOACH->get_data("grw_tuc_p2p_reportes", " AND id_evaluacion = ".$evaluacion." AND id_trabajador = ".$trabajador." ORDER BY id DESC ", 0);
	if($existe){
		echo '<script>location.reload();</script>';
	}else{
		$_POST["fecha"] = date("Y-m-d H:i:s");
		$insert = $_TUCOACH->insert_data_array($_POST, "grw_tuc_p2p_reportes");
		echo '<script>location.reload();</script>';
	}

?>
