<?php require_once ('../../appInit.php');

	$segmentions = json_decode($_POST["segmentions_json"]);

	$id 	= $_POST["id"];
	$nombre = $_POST["nombre"];

	echo '<div class="tabAll">';
	echo '<div class="tabIn taC">';
	echo '<div class="tB t20 primary taC mb10">'.$nombre.'</div>';

	echo '<div class="row m0 p0 pLR40 mb30">';
		echo '<div class="col-3 p3">';
			echo '<select id="seliiion1" class="w100 p1020 bfff bS1 rr5">';
			echo '<option>Seleccione</option>';
			$segmentions = (array) $segmentions;
			foreach ($segmentions as $segmention) {
				$segmention = (array) $segmention;
				echo '<option disabled>'.$segmention["nombre"].'</option>';
				$opts = (array) $segmention["seg_opciones"];
				foreach ($opts as $opt) {
					$opt = (array) $opt;
					echo '<option value="'.$opt["id"].'">'.$opt["nombre"].'</option>';
				}
			}
			echo '</select>';
		echo '</div><div class="col-3 p3">';
			echo '<select id="seliiion2" class="w100 p1020 bfff bS1 rr5">';
			echo '<option>Seleccione</option>';
			$segmentions = (array) $segmentions;
			foreach ($segmentions as $segmention) {
				$segmention = (array) $segmention;
				echo '<option disabled>'.$segmention["nombre"].'</option>';
				$opts = (array) $segmention["seg_opciones"];
				foreach ($opts as $opt) {
					$opt = (array) $opt;
					echo '<option value="'.$opt["id"].'">'.$opt["nombre"].'</option>';
				}
			}
			echo '</select>';
		echo '</div><div class="col-3 p3">';
			echo '<select id="seliiion3" class="w100 p1020 bfff bS1 rr5">';
			echo '<option>Seleccione</option>';
			$segmentions = (array) $segmentions;
			foreach ($segmentions as $segmention) {
				$segmention = (array) $segmention;
				echo '<option disabled>'.$segmention["nombre"].'</option>';
				$opts = (array) $segmention["seg_opciones"];
				foreach ($opts as $opt) {
					$opt = (array) $opt;
					echo '<option value="'.$opt["id"].'">'.$opt["nombre"].'</option>';
				}
			}
			echo '</select>';
		echo '</div><div class="col-3 p3">';
			echo '<button onclick="Zoom.crearGraph(111,3333)" class="btn btn-primary btn-block">Graficar <i class="la la-angle-double-right"></i></button>';
		echo '</div>';
	echo '</div>';

	echo '<div id="chartion"></div>';
	echo '</div>';
	echo '</div>';









?>


