<?php require_once ('../../../appInit.php');

	$rol 		= $_POST["rol"];
	$modulo 	= $_POST["modulo"];

	$relrol = $_TUCOACH->get_data("zoom__models__roles", " AND id_modulo = ".$modulo." AND id_rol = ".$rol." AND eliminado = 0 ORDER BY id DESC ", 0);
	if($relrol){
		if($relrol["inactivo"] == 0) $_POST["inactivo"] = 1; else  $_POST["inactivo"] = '0';
		$id = $relrol["id"];
		$update = $_TUCOACH->update_data_array($_POST, "zoom__models__roles", "id", $id);
		if($update){
			if($_POST["inactivo"] == 0) echo '<i class="la la-check success"></i>';
			if($_POST["inactivo"] == 1) echo '<i class="la la-close danger"></i>';
		} else echo 'Err';
	}else{
		$_POST["id_rol"] 		= $rol;
		$_POST["id_modulo"] 	= $modulo;
		$_POST["fecha"] 		= date("Y-m-d H:i:s");
		$insert = $_TUCOACH->insert_data_array($_POST, "zoom__models__roles");
		if($insert) echo '<i class="la la-check success"></i>';
		else echo 'Err';
	}

?>
