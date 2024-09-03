<?php require_once ('../../../appInit.php');

	if($_POST["id_empresa3"] != "" && $_POST["id_kr3"] != "" && $_POST["id_proyecto3"] != ""){
		if($_POST["nombre"] != ""){


			if(isset($_POST["id"])) $id = trim($_POST["id"]); else $id = "";

			$insert = 0;




			$_POST["id_proyecto"] 	= $_POST["id_proyecto3"];
			$_POST["id_empresa"] 	= $_POST["id_empresa3"];
			$_POST["id_kr"] 		= $_POST["id_kr3"];
			$_POST["fecha"] 		= date("Y-m-d H:i:s");

			$insert = $_TUCOACH->insert_data_array($_POST, $_POST["tabla3"]);

			if($insert != 0){
				echo "<div class='colorVerde'>Registro creado correctamente</div>";
				echo '<script>setTimeout(function(){ location.reload(); }, 500);</script>';
			} else echo "Error";


		} else echo "<div class='colorRojo'>Debe ingresar una estrategia</div>";
	} else echo "Error";

?>
