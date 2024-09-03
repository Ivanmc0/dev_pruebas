<?php require_once ('../../../appInit.php');

	if(isset($_POST["id"])){

		$id	= $_POST["id"];
		$existe = $_TUCOACH->get_data("zoom_users", " AND id = ".$id." ", 0);

		if($existe){

			if($existe["kr"] == 1) $_POST["kr"] = '0';
			if($existe["kr"] == 0) $_POST["kr"] = '1';

			$update = $_TUCOACH->update_data_array($_POST, "zoom_users", "id", $id);
			echo '<i class="la la-check t14"></i>';
			echo '<script>setTimeout(function(){ location.reload(); }, 500);</script>';

		}

	} else echo '<div class="colorRojo">ERROR</div>';

?>
