<?php require_once ('../../appInit.php');

	$asignacion = $_POST["id_asignacion"];

	$contador 	= 0;
	$conteo 	= count($_POST["id_comportamiento"]);

	foreach($_POST["id_comportamiento"] AS $compy){
		$insert 					= 0;
		$update 					= 0;
		$id_comportamiento 			= $compy;
		$solucion 					= $_POST["valor_comportamiento_".$compy];
		$_POST["id_comportamiento"] = $id_comportamiento;
		$_POST["solucion"] 			= $solucion;
		if($solucion == '0') $_POST["solucion"] = "0";

		$existe = $_TUCOACH->get_data("grw_sol_p2p_estudio", " AND id_asignacion = ".$asignacion." AND id_comportamiento = ".$id_comportamiento." ORDER BY id DESC ", 0);

		if($existe){
			$id 	= $existe["id"];
			$update = $_TUCOACH->update_data_array($_POST, "grw_sol_p2p_estudio", "id", $id);
		} else {
			$_POST["fecha"] = date("Y-m-d H:i:s");
			$insert = $_TUCOACH->insert_data_array($_POST, "grw_sol_p2p_estudio");
		}

		if($insert != 0) $contador++;
		if($update != 0) $contador++;
	}

	if($contador >= $conteo){
		unset($_POST);
		$id					= $asignacion;
		$_POST["realizado"] = 1;
		$update = $_TUCOACH->update_data_array($_POST, "grw_tuc_p2p_asignaciones", "id", $id);
		echo '<script>location.href="../../";</script>';
	}

?>
