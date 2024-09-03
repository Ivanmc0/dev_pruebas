<?php require_once('../../../appInit.php');

	if(isset($_POST["id"])) $id = trim($_POST["id"]); else $id = "";

	$insert = 0;
	$update = 0;

	if($id == ""){
		$_POST["fecha"] = date("Y-m-d H:i:s");
        $org = $_ZOOM->get_data('grw_organigramas',' AND id = '.$_POST['id_organigrama'],0);
        if($org) $_POST['id_empresa'] = $org['id_empresa'];
		$insert = $_ZOOM->insert_data_array($_POST, $_POST["tabla"]);
	} else {
		$update = $_ZOOM->update_data_array($_POST, $_POST["tabla"], "id", $id);
	}

	if($insert != 0) {
		echo "<div class='success'>Registro creado correctamente</div>";
		echo '<script>setTimeout(function(){ history.go(-1); }, 1500);</script>';
	}
	if($update != 0){
		echo '<div class="success">Los cambios se han guardado correctamente</div>';
		echo '<script>setTimeout(function(){ history.go(-1); }, 1500);</script>';
	}
