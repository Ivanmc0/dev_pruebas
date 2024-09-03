<?php require_once ('../../../appInit.php');


	if($_POST["id"] != "" && $_POST["trb"] != "" && $_POST["emp"] != ""){

		$exist = $_TUCOACH->get_data("grw_okr_tareasprivadas", " AND id = ".$_POST["id"]." AND id_trabajador = ".$_POST["trb"]." AND id_empresa = ".$_POST["emp"]." AND inactivo = 0 AND eliminado = 0 ", 0);

		if($exist){
			$delete = $_TUCOACH->delete_on("grw_okr_tareasprivadas", "id", $exist["id"]);
			if($delete){
				echo '<script>setTimeout(function(){ location.reload(); }, 500);</script>';
			}
		}

	} else echo "Error";

?>
