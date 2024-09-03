<?php require_once ('../../../appInit.php');

	$exist = $_TUCOACH->get_data("grw_okr_tareas", " AND id = ".$_POST["tarea"]." AND id_responsable = ".$_POST["trabajador"]." AND id_empresa = ".$_POST["empresa"]." ", 0);

	if($exist){
		$id = $_POST["tarea"];
		if($_POST["arrow"] == "left") 	$_POST["estado"] = '0';
		if($_POST["arrow"] == "right") 	$_POST["estado"] = $exist["estado"] + 1;
		if($_POST["estado"] > 1) 		$_POST["estado"] = 2;
		$update = $_TUCOACH->update_data_array($_POST, "grw_okr_tareas", "id", $id);
		echo '<script>setTimeout(function(){ location.reload(); }, 500);</script>';
	}


?>
