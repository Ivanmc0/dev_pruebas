<?php require_once ('../../../appInit.php');

	$exist = $_TUCOACH->get_data("grw_okr_tareasprivadas", " AND id = ".$_POST["id"]." AND id_trabajador = ".$_POST["trb"]." AND id_empresa = ".$_POST["emp"]." ", 0);

	if($exist){
		$id = $_POST["id"];
		if($_POST["dir"] == "left") 	$_POST["estado"] = '0';
		if($_POST["dir"] == "right") 	$_POST["estado"] = $exist["estado"] + 1;
		if($_POST["estado"] > 1) 		$_POST["estado"] = 2;
		$update = $_TUCOACH->update_data_array($_POST, "grw_okr_tareasprivadas", "id", $id);
		echo '<script>setTimeout(function(){ location.reload(); }, 500);</script>';
	}


?>
