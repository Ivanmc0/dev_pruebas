<?php require_once ('../../appInit.php');

	if($_POST["id_empresa2"] != "" && $_POST["id_nivel"] != "" && $_POST["nivel"] != "" && $_POST["id_proyecto2"] != ""){
		if($_POST["id_corresponsable"] != 0){

			if(isset($_POST["id"])) $id = trim($_POST["id"]); else $id = "";

			$insert = 0;

			if($_POST["id_responsable2"] != $_POST["id_corresponsable"]){

				$noHayCorr 	= 0;
				$corrs 		= $_TUCOACH->get_data("grw_okr_pyt_corresponsables", " AND nivel = ".$_POST["nivel"]." AND id_nivel = ".$_POST["id_nivel"]." AND id_proyecto = ".$_POST["id_proyecto2"]." AND id_empresa = ".$_POST["id_empresa2"]." AND inactivo = 0 AND eliminado = 0 ", 1);
				if($corrs) foreach($corrs AS $corr) if($corr["id_corresponsable"] == $_POST["id_corresponsable"]) $noHayCorr = 1;

				if(!$noHayCorr){
					$_POST["id_proyecto"] = $_POST["id_proyecto2"];
					$_POST["id_empresa"] = $_POST["id_empresa2"];
					$_POST["fecha"] = date("Y-m-d H:i:s");

					$insert = $_TUCOACH->insert_data_array($_POST, $_POST["tabla"]);

					echo "<div class='colorVerde'>Registro creado correctamente</div>";
					echo '<script>setTimeout(function(){ location.reload(); }, 500);</script>';

				} else echo "<div class='colorRojo'>El trabajador seleccionado ya es co-responsable</div>";
			} else echo "<div class='colorRojo'>El trabajador seleccionado ya es el Responsable</div>";


		} else echo "<div class='colorRojo'>Debe seleccionar un responsable</div>";
	} else echo "Error";

?>
