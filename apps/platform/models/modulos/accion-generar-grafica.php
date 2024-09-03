<?php require_once ('../../appInit.php');

	$allion = json_decode($_POST["allion_json"]);

	$dataPoints = array(
		array("y" => 3373.64, "label" => "Germany" ),
		array("y" => 2435.94, "label" => "France" ),
		array("y" => 1842.55, "label" => "China" ),
		array("y" => 1828.55, "label" => "Russia" ),
		array("y" => 1039.99, "label" => "Switzerland" ),
		array("y" => 765.215, "label" => "Japan" ),
		array("y" => 612.453, "label" => "Netherlands" )
	);

	echo '<div id="chartionIn" style="height:400px; width:100%;"></div>';

	echo '
		<script>
			$( document ).ready(function(){
				var chart = new CanvasJS.Chart("chartionIn", {
					animationEnabled: true,
					theme: "light2",
					title:{
						text: "'.$nombre.'"
					},
					axisY: {
						title: "Promedio"
					},
					data: [{
						type: "column",
						yValueFormatString: "#,##0.## tonnes",
						dataPoints: '.json_encode($dataPoints, JSON_NUMERIC_CHECK).'
					}]
				});
				chart.render();
			});
		</script>
	';

?>


