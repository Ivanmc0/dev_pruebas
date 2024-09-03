<?php

	$aa1  = $_TUCOACH->get_data("grw_okr_sprints", " AND id = ".$hw["id_sprint"]." AND inactivo = 0 AND eliminado = 0 ", 0);
	if($aa1){
		$aa2  = $_TUCOACH->get_data("grw_okr_acciones", " AND id = ".$aa1["id_accion"]." AND inactivo = 0 AND eliminado = 0 ", 0);
		if($aa2){
			$ioio["id_accion"] = $aa2["id"];
			$aa3  = $_TUCOACH->get_data("grw_okr_krs", " AND id = ".$aa2["id_kr"]." AND inactivo = 0 AND eliminado = 0 ", 0);
			if($aa3){
				$ioio["id_kr"] = $aa3["id"];
				$aa4  = $_TUCOACH->get_data("grw_okr_objetivos", " AND id = ".$aa3["id_objetivo"]." AND inactivo = 0 AND eliminado = 0 ", 0);
				if($aa4){
					$ioio["id_objetivo"] = $aa4["id"];
				}
			}
		}
	}
	$update = $_TUCOACH->update_data_array($ioio, "grw_okr_tareas", "id", $hw["id"]);

?>
