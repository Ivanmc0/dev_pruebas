<?php require_once ('../../appInit.php');

	if($_POST["tabla"] != "" && $_POST["id"] != ""){

		$_POST["eliminado"] = 1;

		$update = $_TUCOACH->update_data_array($_POST, $_POST["tabla"], "id", $_POST["id"]);
		if($update != 0){
			echo '<script>$( document ).ready(function() { $("#tr-"+'.$_POST["id"].').slideUp(800); });</script>';
		}

	} else echo '<span class="danger">No puede crear una función sin nombre</span>';

?>
