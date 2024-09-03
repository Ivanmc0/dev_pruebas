<?php require_once('../../../appInit.php');

	foreach ($_POST as $key => $value) {

		$value["fecha_actualizacion"] = date("Y-m-d H:i:s");
		$update = $_ZOOM->update_data_array($value, "w_soluciones", "id", $key);

	}


		echo '<script>setTimeout(function(){ location.reload(); }, 500);</script>';

?>
