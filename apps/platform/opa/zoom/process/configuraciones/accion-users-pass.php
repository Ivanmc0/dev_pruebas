<?php require_once ('../../../appInit.php');

	// $_POST["clave"] = $_POST["clave"];

	if(isset($_POST["password"]) && $_POST["password"] == ""){
		MsgError("Indique una contraseña");
		die();
	}

	$_POST["password"] = md5($_POST["password"]);

	$update = 0;
	$update = $_TUCOACH->update_data_array($_POST, $_POST["tabla"], "id", $_POST["id"]);

	if($update != 0){
		echo '<div class="success">Los cambios se han guardado correctamente</div>';
		echo '<script>setTimeout(function(){ history.go(-1); }, 1500);</script>';
	}

?>
