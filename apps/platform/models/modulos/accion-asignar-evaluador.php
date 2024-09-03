<?php require_once ('../../appInit.php');

	$type 		= $_POST["type"];
	$evaluador	= $_POST["evaluador"];
	$evaluacion	= $_POST["evaluacion"];

	$eval = $_TUCOACH->get_data("grw_tuc_p2b_asignaciones", " AND id_evaluador = ".$evaluador." AND id_evaluacion = $evaluacion AND eliminado = 0 ", 0);
	if($eval){
		if($eval["inactivo"] == 0) $_POST["inactivo"] = 1; else  $_POST["inactivo"] = '0';
		$id = $eval["id"];
		$update = $_TUCOACH->update_data_array($_POST, "grw_tuc_p2b_asignaciones", "id", $id);
		if($update){
			if($_POST["inactivo"] == 0) echo '<button class="btn btn-outline-success btn-sm">Asignado <i class="la la-check t14"></i></button>';
			if($_POST["inactivo"] == 1) echo '<button class="btn btn-outline-info btn-sm">Asignado <i class="la la-la la-angle-double-right t14"></i></button>';
		} else echo 'Err';
	}else{
		$_POST["id_evaluador"] 	= $evaluador;
		$_POST["id_evaluacion"] = $evaluacion;
		$_POST["fecha"] 		= date("Y-m-d H:i:s");
		$insert = $_TUCOACH->insert_data_array($_POST, "grw_tuc_p2b_asignaciones");
		if($insert) echo '<button class="btn btn-outline-success btn-sm">Asignado <i class="la la-check t14"></i></button>';
		else echo 'Err';
	}

?>
