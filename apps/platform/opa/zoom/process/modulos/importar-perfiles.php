<?php require_once ('../../../appInit.php');

	function validarFila($test, $thisFila){

		if($thisFila[0] != "" && $thisFila[0] != "PERFIL"){

			$perfil = validarPerfil($test, $thisFila[0]);
			echo "<hr>";
			if($perfil && $thisFila[1] != "") $categoria = validarCategoria($perfil, $thisFila[1]); else echo '<div class="t12 danger">Omitido</div>';
			echo "<hr>";
			if($categoria && $thisFila[2] != "") $competencia = validarCompetencia($categoria, $thisFila[2], $thisFila[3]); else echo '<div class="t12 danger">Omitido</div>';
			echo "<hr>";
			if($competencia && $thisFila[4] != "") validarComportamiento($competencia, $thisFila[4]); else echo '<div class="t12 danger">Omitido</div>';

		} else echo '<div class="t12 danger">Omitido</div>';

	}

	function validarPerfil($id, $dato){
		require_once ('../../../appInit.php');
		$existe = $_TUCOACH->get_data("grw_perfiles", " AND id_test = ".$id." AND nombre = '".utf8_decode($dato)."' ORDER BY id DESC ", 0);
		if($existe) {
			echo '<div class="t12 info">El perfil <strong>'.$dato.'</strong> existe con el ID '.$existe["id"].'</div>';
			return $existe["id"];
		}else{
			$_POST["fecha"] 			= date("Y-m-d h:i:s");
			$_POST["id_test"] 			= $id;
			$_POST["nombre"] 			= $dato;
			$insert = $_TUCOACH->insert_data_array($_POST, "grw_perfiles");
			if($insert != 0){
				echo '<div class="t12 success">Perfil creado con el ID: '.$insert;
				return $insert;
			} else echo("<div class='danger'>Error al crear el perfil</div>");
		}
	}
	function validarCategoria($id, $dato){
		require_once ('../../../appInit.php');
		$existe = $_TUCOACH->get_data("grw_tuc_p2p_categorias", " AND id_perfil = ".$id." AND nombre = '".utf8_decode($dato)."' ORDER BY id DESC ", 0);
		if($existe) {
			echo '<div class="t12 info">La categoría <strong>'.$dato.'</strong> existe con el ID '.$existe["id"].'</div>';
			return $existe["id"];
		}else{
			$_POST["fecha"] 			= date("Y-m-d h:i:s");
			$_POST["id_perfil"] 		= $id;
			$_POST["nombre"] 			= $dato;
			$insert = $_TUCOACH->insert_data_array($_POST, "grw_tuc_p2p_categorias");
			if($insert != 0){
				echo '<div class="t12 success">Categoría creada con el ID: '.$insert;
				return $insert;
			} else echo("<div class='danger'>Error al crear la categoría</div>");
		}
	}
	function validarCompetencia($id, $dato, $dato2){
		require_once ('../../../appInit.php');
		$existe = $_TUCOACH->get_data("grw_tuc_p2p_competencias", " AND id_categoria = ".$id." AND nombre = '".utf8_decode($dato)."' ORDER BY id DESC ", 0);
		if($existe) {
			echo '<div class="t12 info"> competencia <strong>'.$dato.'</strong> existe con el ID '.$existe["id"].'</div>';
			return $existe["id"];
		}else{
			$_POST["fecha"] 			= date("Y-m-d h:i:s");
			$_POST["id_categoria"] 		= $id;
			$_POST["valor"] 			= $dato2;
			$_POST["nombre"] 			= $dato;
			$insert = $_TUCOACH->insert_data_array($_POST, "grw_tuc_p2p_competencias");
			if($insert != 0){
				echo '<div class="t12 success">Competencia creada con el ID: '.$insert;
				return $insert;
			} else echo("<div class='danger'>Error al crear la competencia</div>");
		}
	}
	function validarComportamiento($id, $dato){
		require_once ('../../../appInit.php');
		$existe = $_TUCOACH->get_data("grw_tuc_p2p_comportamientos", " AND id_competencia = ".$id." AND nombre = '".utf8_decode($dato)."' ORDER BY id DESC ", 0);
		if($existe) {
			echo '<div class="t12 info">El comportamiento <strong></strong> existe con el ID '.$existe["id"].'</div>';
			return $existe["id"];
		}else{
			$_POST["fecha"] 			= date("Y-m-d h:i:s");
			$_POST["id_competencia"] 	= $id;
			$_POST["nombre"] 			= $dato;
			$insert = $_TUCOACH->insert_data_array($_POST, "grw_tuc_p2p_comportamientos");
			if($insert != 0){
				echo '<div class="t12 success">Comportamiento creado con el ID: '.$insert;
			} else echo("<div class='danger'>Error al crear el comportamiento</div>");
		}
	}




	// echo "<pre>";
	// print_r($_POST);
	// print_r($_FILES);
	// echo "</pre>";


	if(isset($_FILES['excelion']['name'])){

		$miExcel 	= $_FILES['excelion']['name'];
		$uTemp 		= $_FILES['excelion']['tmp_name'];

		require '../../../resources/plugins/excel/vendor/autoload.php';
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($uTemp);

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
					validarFila($_POST["id_test"], $obtenFila);
				echo '</td>';
			echo '</tr>';
		}
		echo '</table></div></div></div>';


	} else echo "<div class='error'>Debe seleccionar el formato en excel</div>";


?>

