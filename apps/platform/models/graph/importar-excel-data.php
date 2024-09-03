<?php session_start();

	ini_set('max_execution_time', 0);

	if(isset($_FILES['excelion']['name'])){

		$miExcel 	= $_FILES['excelion']['name'];
		$uTemp 		= $_FILES['excelion']['tmp_name'];

		require '../../resources/plugins/excel/vendor/autoload.php';
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$spreadsheet = $reader->load($uTemp);

		$worksheet = $spreadsheet->getActiveSheet();

		$myData 	= [];
		$tabla 		= 0;
		$tabla_tit 	= 1;

		foreach ($worksheet->getRowIterator() AS $key => $row) {

			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(FALSE);

			foreach ($cellIterator AS $key2 => $cell) {
				if($cell->getValue() == 'FINTABLA'){
					$tabla++;
					$tabla_tit = $key+1;
					break;
				}else{

					if(!empty($cell->getValue())){

						if($key == $tabla_tit){


							if($key2 == 'A'){
								$myData[$tabla]["graph"] = $cell->getValue();
							}else{
								$myData[$tabla]["labels"][] = $cell->getValue();
							}




						}else{

							if($key2 == 'A'){
								$myData[$tabla]["datasety"][$key]["label"] = $cell->getValue();
							}else{
								$myData[$tabla]["datasety"][$key]["data"][] = $cell->getValue();
							}




						}


					}

				}


				// echo '<pre>';
				// echo $cell->getValue();
				// echo '</pre>';
			}


		}

		// echo '<pre>';
		// print_r($myData);
		// echo '</pre>';

		if ($myData) {
			foreach ($myData as $key => $graph) {

				$graph = json_encode($graph);
				// $graph = json_encode(("", $graph));
				echo'
					<div class="p50 bfff rr5 mb20">
						<div class="">Tabla Graphion-'.$key.'</div>
						<div class="chart-container p30" style="position: relative; height:70%; width:100%">
							<canvas id="graphion-'.$key.'"></canvas>
						</div>
					</div>

					<script>
						// bar, line, radar
						Graphion.ggg("graphion-'.$key.'", '.$graph.');
					</script>
				';

			}
		}

	} else echo "<div class='error'>Debe seleccionar el formato en excel</div>";

?>