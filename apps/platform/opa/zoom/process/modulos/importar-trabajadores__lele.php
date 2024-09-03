<?php require_once('../../../appInit.php');

ini_set('max_execution_time', 0);

	function validarFila($empresa, $thisFila){

		if($thisFila[0]){
			if($trabajador = validarSiExiste($empresa, $thisFila)){
				echo '<div class="t12 info">El trabajador con cédula '.$thisFila[0].'<br>Existe con el ID '.$trabajador["id"].'</div>';
				actualizarTrabajador($thisFila, $trabajador);
			}else{
				crearTrabajador($empresa, $thisFila);
			}
		} else echo '<div class="t12 colorRojo">Omitido</div>';
	}

	function validarSiExiste($empresa, $thisFila){
		$sql 	= " AND id_empresa = ".$empresa." AND identificacion = '".$thisFila[0]."' ORDER BY id DESC ";
		return $_ZOOM->get_data("zoom_users", $sql, 0);
	}

	function crearTrabajador($empresa, $thisFila){
		$_POST["fecha"] 			= date("Y-m-d h:i:s");
		$_POST["id_empresa"] 		= $empresa;
		$_POST["identificacion"] 			= $thisFila[0];
		$_POST["nombre"] 			= $thisFila[1];
		$_POST["cargo"] 			= $thisFila[2];
		$_POST["mail"] 				= $thisFila[3];
		$_POST["aux1"] 				= $thisFila[4];
		$_POST["aux2"] 				= $thisFila[5];
		$_POST["aux3"] 				= $thisFila[6];
		$insert = $_ZOOM->insert_data_array($_POST, "zoom_users");
		if($insert != 0){
			echo '<div class="t12 success">Trabajador creado con el ID: '.$insert;
		} else echo("<div class='danger'>Error al crear al trabajador</div>");
	}

	function actualizarTrabajador($thisFila, $trabajador){
		$rr = 0;
		if($thisFila[1] != $trabajador["nombre"]){ 	$_POST["nombre"] = $thisFila[1]; $rr++; }
		if($thisFila[2] != $trabajador["cargo"]){ 	$_POST["cargo"] = $thisFila[2]; $rr++; }
		if($thisFila[3] != $trabajador["mail"]){ 	$_POST["mail"] = $thisFila[3]; $rr++; }
		if($thisFila[4] != $trabajador["aux1"]){ 	$_POST["aux1"] = $thisFila[4]; $rr++; }
		if($thisFila[5] != $trabajador["aux2"]){ 	$_POST["aux2"] = $thisFila[5]; $rr++; }
		if($thisFila[6] != $trabajador["aux3"]){ 	$_POST["aux3"] = $thisFila[6]; $rr++; }
		if($rr > 0){
			$update = $_ZOOM->update_data_array($_POST, "zoom_users", "id", $trabajador["id"]);
			if($update != 0){
				echo '<div class="t12 success">Trabajador actualizado';
			} else echo("<div class='danger'>Error al actualizar al trabajador</div>");
		}
	}


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
