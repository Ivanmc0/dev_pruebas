<?php require_once ('../../../appInit.php');

	function prevalidar($data){
		if(!is_numeric($data)) {
			echo "<div class='danger t12'>Omitido</div>";
			return false;
		} else return true;
	}
	function validarTrabajador($cc, $emp){
		require_once ('../../../appInit.php');
		return $_TUCOACH->get_data("zoom_users", " AND id_empresa = ".$emp." AND identificacion = '".$cc."' ORDER BY id DESC ", 0);
	}
	function validarRol($rol){
		require_once ('../../../appInit.php');
		return $_TUCOACH->get_data("grw_tuc_roles", " AND nombre = '".utf8_decode($rol)."' ORDER BY id DESC ", 0);
	}
	function validarPerfil($perfil){
		require_once ('../../../appInit.php');
		return $_TUCOACH->get_data("grw_perfiles", " AND nombre = '".utf8_decode($perfil)."' ORDER BY id DESC ", 0);
	}
	function validar($t1, $t2, $rol, $perfil, $eval){
		require_once ('../../../appInit.php');
		$existe = $_TUCOACH->get_data("grw_tuc_p2p_asignaciones", " AND id_evaluacion = ".$eval." AND id_evaluador = ".$t1." AND id_evaluado = ".$t2." AND id_rol = ".$rol." AND id_perfil = ".$perfil." ORDER BY id DESC ", 0);
		if($existe) {
			echo '<div class="t12 info">La asignación ya existe con el ID '.$existe["id"].'</div>';
		}else{
			$_POST["fecha"] 			= date("Y-m-d h:i:s");
			$_POST["id_perfil"] 		= $perfil;
			$_POST["id_evaluador"] 		= $t1;
			$_POST["id_evaluado"] 		= $t2;
			$_POST["id_rol"] 			= $rol;
			$_POST["id_evaluacion"] 	= $eval;
			$insert = $_TUCOACH->insert_data_array($_POST, "grw_tuc_p2p_asignaciones");
			if($insert != 0){
				echo '<div class="t12 success">Asignación creada con el ID: '.$insert;
			} else echo("<div class='danger'>Error al crear la Asignación</div>");
		}
	}



	// echo "<pre class='taL'>";
	// print_r($_POST);
	// print_r($_FILES);
	// echo "</pre>";


	if(isset($_FILES['excelion']['name'])){

		$miExcel 	= $_FILES['excelion']['name'];
		$uTemp 		= $_FILES['excelion']['tmp_name'];

		require '../../../resources/plugins/excel/vendor/autoload.php';
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($uTemp);

		require_once ('../../../appInit.php');

		$eval 	= $_TUCOACH->get_data("grw_tuc_p2p_estudios", " AND id = '".$_POST["id_evaluacion"]."' ORDER BY id DESC ", 0);

		// echo "<pre class='taL'>";
		// print_r($eval);
		// echo "</pre>";


		$worksheet = $spreadsheet->getActiveSheet();

		echo '<div class="card"><div class="card-content collapse show"><div class="table-responsive bar"><table class="table table-bordered table-hover mb-0">';
		foreach ($worksheet->getRowIterator() as $row) {
			echo '<tr>';
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(FALSE);
			$cellion 		= 0;
			$obtenFila	= array();
			foreach ($cellIterator as $cell) {
				if($cellion < 5){
					echo '<td class="t12 taL vM">'.$cell->getValue().'</td>';
					$valorion 				= $cell->getValue();
					$obtenFila[$cellion] 	= $valorion;
				}
				$cellion++;
			}
				echo '<td class="taL w40">';
					if(prevalidar($obtenFila[0])){
						if($t1 = validarTrabajador(trim($obtenFila[1]), $eval["id_empresa"])){
							echo "<div class='info t12'>Evaluador encontrado con el id ".$t1["id"]."</div>";
							if($t2 = validarTrabajador(trim($obtenFila[3]), $eval["id_empresa"])){
								echo "<div class='info t12'>Evaluado encontrado con el id ".$t2["id"]."</div>";

								if($rol = validarRol($obtenFila[2])){
									echo "<div class='info t12'>Rol encontrado con el id ".$rol["id"]."</div>";

									if($perfil = validarPerfil($obtenFila[4])){

										echo "<div class='info t12'>Perfil encontrado con el id ".$perfil["id"]."</div>";
										validar($t1["id"], $t2["id"], $rol["id"], $perfil["id"], $eval["id"]);

									}else echo "<div class='danger t12'>No se encontró el Perfil ".$obtenFila[4]."</div>";

								}else echo "<div class='danger t12'>No se encontró el Rol ".$obtenFila[2]."</div>";

							}else echo "<div class='danger t12'>No se encontró al evaluado con CC ".$obtenFila[3]."</div>";
						}else echo "<div class='danger t12'>No se encontró al evaluador con CC ".$obtenFila[1]."</div>";
					}
				echo '</td>';
			echo '</tr>';
		}
		echo '</table></div></div></div>';


	} else echo "<div class='error'>Debe seleccionar el formato en excel</div>";


?>

