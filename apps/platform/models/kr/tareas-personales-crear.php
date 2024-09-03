<?php require_once ('../../appInit.php');

	if($_POST["nombre5"] != ""){

			if(isset($_POST["id"])) $id = trim($_POST["id"]); else $id = "";

			$insert = 0;
			$update = 0;

			if($id == ""){
				$_POST["fecha"] = date("Y-m-d H:i:s");
				$_POST["nombre"] 			= $_POST["nombre5"];
				$_POST["descripcion"] 		= $_POST["descripcion5"];
				$_POST["id_trabajador"] 	= $_POST["id_trabajador5"];
				$_POST["id_empresa"] 		= $_POST["id_empresa5"];
				$_POST["id_proyecto"] 		= $_POST["id_proyecto5"];
				$_POST["tabla"] 			= $_POST["tabla5"];
				$insert = $_TUCOACH->insert_data_array($_POST, $_POST["tabla"]);
			} else {
				$_POST["nombre"] 			= $_POST["nombre5"];
				$_POST["descripcion"] 		= $_POST["descripcion5"];
				$_POST["id_trabajador"] 	= $_POST["id_trabajador5"];
				$_POST["id_empresa"] 		= $_POST["id_empresa5"];
				$_POST["id_proyecto"] 		= $_POST["id_proyecto5"];
				$_POST["tabla"] 			= $_POST["tabla5"];
				$update = $_TUCOACH->update_data_array($_POST, $_POST["tabla"], "id", $id);
			}

			if($insert != 0) {
				echo "<div class='success'>Registro creado correctamente</div>";
				echo '<script>setTimeout(function(){ location.reload(); }, 500);</script>';
			}
			if($update != 0){
				echo '<div class="success">Los cambios se han guardado correctamente</div>';
				echo '<script>setTimeout(function(){ history.go(-1); }, 1500);</script>';
			}

	} else echo "Debe indicar un nombre para esta parte del proceso";

?>
