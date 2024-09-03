<?php require_once ('../../../appInit.php');

	if(count($_POST["respuestas"]) == $_POST["total"]){

		$id_asignacion 	= $_POST["id_asignacion"];
		$id_trabajador 	= $_POST["id_trabajador"];
		$total 			= $_POST["total"];

		$contador 		= 0;
		$conteo 		= count($_POST["respuestas"]);

		foreach($_POST["respuestas"] AS $respuestas){
			$insert 				= 0;
			$update 				= 0;

			$id_segmento 			= $respuestas["segmento"];
			$solucion 				= $respuestas["opcion"];
			$_POST["id_segmento"] 	= $id_segmento;
			$_POST["solucion"] 		= $solucion;
			if($solucion == '0') $_POST["solucion"] = "0";

			$existe = $_TUCOACH->get_data("grw_tuc_p2b_sol_perfilado", " AND id_asignacion = ".$id_asignacion." AND id_segmento = ".$id_segmento." ORDER BY id DESC ", 0);

			if($existe){
				$id 	= $existe["id"];
				$update = $_TUCOACH->update_data_array($_POST, "grw_tuc_p2b_sol_perfilado", "id", $id);
			} else {
				$_POST["fecha"] = date("Y-m-d H:i:s");
				$insert = $_TUCOACH->insert_data_array($_POST, "grw_tuc_p2b_sol_perfilado");
			}

			if($insert != 0) $contador++;
			if($update != 0) $contador++;
		}

		if($contador >= $conteo){
			unset($_POST);
			$id					= $id_asignacion;
			$_POST["perfil_completo"] = 1;
			$update = $_TUCOACH->update_data_array($_POST, "grw_tuc_p2b_asignaciones", "id", $id);
			echo '<script>location.href="../tucoach/evaluaciones-empresa.html";</script>';
		}

	} else echo '<div class="colorRojo">Debe seleccionar una opción de cada pregunta</div>';

?>
