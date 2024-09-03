<?php require_once ('../../../appInit.php');

	if($_POST["id"] != ""){

		$delete = $_TUCOACH->delete_on("grw_okr_tareas", "id", $_POST["id"]);
		if($delete){
			echo 'asdf<script>$("#n6-'.$_POST["id"].'").slideUp();</script>';
		} else echo '<script>$("#n6-'.$_POST["id"].'").slideUp();</script>';

	}

?>
