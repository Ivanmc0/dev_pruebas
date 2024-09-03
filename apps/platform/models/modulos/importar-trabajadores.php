<?php require_once ('../../appInit.php');

	function validarFila($empresa, $thisFila){

		if(is_numeric($thisFila[0])){
			if($trabajador = validarSiExiste($empresa, $thisFila)){
				echo '<div class="t12 info">El trabajador con cédula '.$thisFila[0].'<br>Existe con el ID '.$trabajador["id"].'</div>';
				actualizarTrabajador($thisFila, $trabajador);
			}else{
				crearTrabajador($empresa, $thisFila);
			}
		} else echo '<div class="t12 colorRojo">Omitido</div>';
	}

	function validarSiExiste($empresa, $thisFila){
		require_once ('../../appInit.php');
		$sql 	= " AND id_empresa = ".$empresa." AND identificacion = '".$thisFila[0]."' ORDER BY id DESC ";
		return $_TUCOACH->get_data("zoom_users", $sql, 0);
	}

	function crearTrabajador($empresa, $thisFila){
		require_once ('../../appInit.php');
		$newy 	= array();
		$newy["fecha"] 			= date("Y-m-d h:i:s");
		$newy["id_empresa"] 		= $empresa;
		$newy["identificacion"] 			= $thisFila[0];
		$newy["nombre"] 			= $thisFila[1];
		$newy["cargo"] 				= $thisFila[2];
		$newy["mail"] 				= $thisFila[3];
		$newy["detalle1"] 			= $thisFila[4];
		$newy["detalle2"] 			= $thisFila[5];
		$newy["detalle3"] 			= $thisFila[6];
		$insert = $_TUCOACH->insert_data_array($newy, "zoom_users");
		if($insert != 0){
			echo '<div class="t12 success">Trabajador creado con el ID: '.$insert;
		} else echo("<div class='danger'>Error al crear al trabajador</div>");
	}

	function actualizarTrabajador($thisFila, $trabajador){

		// echo '<pre class="taL">';
		// print_r($trabajador);
		// print_r($thisFila);
		// echo '</pre>';

		require_once ('../../appInit.php');
		$upty = array();
		$rr = 0;
		if($thisFila[1] != $trabajador["nombre"]){ 	$upty["nombre"] = $thisFila[1]; $rr++; }
		if($thisFila[2] != $trabajador["cargo"]){ 	$upty["cargo"] = $thisFila[2]; $rr++; }
		if($thisFila[3] != $trabajador["mail"]){ 	$upty["mail"] = $thisFila[3]; $rr++; }
		if($thisFila[4] != $trabajador["detalle1"]){ 	$upty["detalle1"] = $thisFila[4]; $rr++; }
		if($thisFila[5] != $trabajador["detalle2"]){ 	$upty["detalle2"] = $thisFila[5]; $rr++; }
		if($thisFila[6] != $trabajador["detalle3"]){ 	$upty["detalle3"] = $thisFila[6]; $rr++; }
		if($rr > 0){
			// echo '<pre class="taL">';
			// print_r($trabajador);
			// print_r($upty);
			// echo '</pre>';
			$update = 0;
			echo $update = $_TUCOACH->update_data_array($upty, "zoom_users", "id", $trabajador["id"]);
			if($update != 0){
				echo '<div class="t12 success">Trabajador actualizado';
			} else echo("<div class='t12 danger'>Error al actualizar al trabajador</div>");
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
				if($cellion < 7){
					echo '<td class="t12 taL vM">'.$cell->getValue().'</td>';
					$valorion 				= $cell->getValue();
					$obtenFila[$cellion] 	= $valorion;
				}
				$cellion++;
			}
				echo '<td class="taL">';
					validarFila($_POST["id_empresa"], $obtenFila);
				echo '</td>';
			echo '</tr>';
		}
		echo '</table></div></div></div>';


	} else echo "<div class='error'>Debe seleccionar el formato en excel</div>";


?>

