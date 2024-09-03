<?php require_once('../../../appInit.php');

	foreach ($_POST as $idtrabajador => $sol) {

		$data = [
			"id_empresa"    => 100100,
			"id_trabajador" => $idtrabajador,
			"id_sesion"     => $sol["id_sesion"],
			"asistencia"    => $sol["asistencia"],
			"evaluacion"    => $sol["evaluacion"],
			"reto"          => $sol["reto"],
			"herramienta"   => $sol["herramienta"],
			"desafio"       => $sol["desafio"],
			"bonus"         => $sol["bonus"],
			"medalla"       => $sol["medalla"],
		];

		if(isset($sol["id_solucion"])){

			$data["fecha_actualizacion"] = date("Y-m-d H:i:s");
			$_ZOOM->update_data_array($data, "grw_rkg_soluciones", "id", $sol["id_solucion"]);


		}else{

			$data["fecha"]               = date("Y-m-d H:i:s");
			$data["fecha_actualizacion"] = date("Y-m-d H:i:s");
			$_ZOOM->insert_data_array($data, "grw_rkg_soluciones");

		}

	}

	// echo '<script>setTimeout(function(){ location.reload(); }, 500);</script>';
	echo '<script>setTimeout(function(){ history.go(-1); }, 500);</script>';


?>
