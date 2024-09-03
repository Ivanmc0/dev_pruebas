<?php require_once ('../../appInit.php');

 

	$asignacion = $_POST["id_asignacion"];

	$contador 	= 0;
	$conteo 	= count($_POST["comportamientos"]);

	foreach($_POST["comportamientos"] AS $compy){
		$insert 					= 0;
		$update 					= 0;
		$id_comportamiento 			= $compy["id"];
		$solucion 					= $compy["solucion"];
		$solucion2 					= $compy["solucion2"];
		$_POST["id_comportamiento"] = $id_comportamiento;
		$_POST["solucion"] 			= $solucion;
		$_POST["solucion2"] 		= $solucion2;
		if($solucion2 == '0') $_POST["solucion2"] = "0";

		$existe = $_TUCOACH->get_data("grw_sol_p2b_estudio", " AND id_asignacion = ".$asignacion." AND id_comportamiento = ".$id_comportamiento." ORDER BY id DESC ", 0);

		if($existe){
			$id 	= $existe["id"];
			$update = $_TUCOACH->update_data_array($_POST, "grw_sol_p2b_estudio", "id", $id);
		} else {
			$_POST["fecha"] = date("Y-m-d H:i:s");
			$insert = $_TUCOACH->insert_data_array($_POST, "grw_sol_p2b_estudio");
		}

		if($insert != 0) $contador++;
		if($update != 0) $contador++;
	}

	if($contador >= $conteo){
		unset($_POST);
		$id					= $asignacion;
		$_POST["realizado"] = 1;
		$update = $_TUCOACH->update_data_array($_POST, "grw_tuc_p2b_asignaciones", "id", $id);
		echo '<script>location.href="../../";</script>';
	}

?>
