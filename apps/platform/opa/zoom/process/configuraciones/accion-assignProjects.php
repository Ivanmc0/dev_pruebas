<?php require_once ('../../../appInit.php');

	$rol 		= $_POST["rol"];
	$proyecto 	= $_POST["proyecto"];

	$relrol = $_TUCOACH->get_data("zoom__project__roles", " AND id_proyecto = ".$proyecto." AND id_rol = ".$rol." AND eliminado = 0 ORDER BY id DESC ", 0);
	if($relrol){
		if($relrol["inactivo"] == 0) $_POST["inactivo"] = 1; else  $_POST["inactivo"] = '0';
		$id = $relrol["id"];
		$update = $_TUCOACH->update_data_array($_POST, "zoom__project__roles", "id", $id);
		if($update){
			if($_POST["inactivo"] == 0) echo '<i class="la la-check success"></i>';
			if($_POST["inactivo"] == 1) echo '<i class="la la-close danger"></i>';
		} else echo 'Err';
	}else{
		$_POST["id_rol"] 		= $rol;
		$_POST["id_proyecto"] 	= $proyecto;
		$_POST["fecha"] 		= date("Y-m-d H:i:s");
		$insert = $_TUCOACH->insert_data_array($_POST, "zoom__project__roles");
		if($insert) echo '<i class="la la-check success"></i>';
		else echo 'Err';
	}

?>
