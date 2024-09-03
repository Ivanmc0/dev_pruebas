<div class="ionix pAA150 beee">
<div class="generalMax">

<a href="<?= $dominion; ?>reportes/disc" class="t16 ff5 color333 cP">Regresar</a>


<?php if($dato = $_TUCOACH->get_data("grw_val_listasexternas_registros", " AND uuid = '".$geton[2]."' AND eliminado = 0 ORDER BY id DESC ", 0)){ ?>

		<h1 class="taC t24 ff3 color333 tU mb50">Reporte de registro individual</h1>
		<div class="bfff bShadow3 rr20 p30 p20_oS mb50">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th class="tB">ID</th>
							<th class="tB">Nombre</th>
							<th class="tB">Empresa</th>
							<th class="tB">Cargo</th>
							<th class="tB">Email</th>
							<th class="tB">Celular</th>
							<th class="tB">Fecha</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="vertical-align: middle;" class="taL"><?= ($dato["id"]); ?></td>
							<td style="vertical-align: middle;" class="taL"><?= ($dato["nombre"]); ?></td>
							<td style="vertical-align: middle;" class="taL"><?= ($dato["empresa"]); ?></td>
							<td style="vertical-align: middle;" class="taL"><?= ($dato["cargo"]); ?></td>
							<td style="vertical-align: middle;" class="taL"><?= ($dato["email"]); ?></td>
							<td style="vertical-align: middle;" class="taL"><?= ($dato["celular"]); ?></td>
							<td style="vertical-align: middle;" class="taL"><?= ($dato["fecha"]); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>


		<?php

			$consul = [
				1 => [
					1 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					2 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					3 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]]
				],
				2 => [
					1 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					2 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					3 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]]
				],
				3 => [
					1 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					2 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					3 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]]
				],
				4 => [
					1 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					2 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					3 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]]
				],
				5 => [
					1 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					2 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					3 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]]
				],
				6 => [
					1 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					2 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					3 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]]
				],
				7 => [
					1 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					2 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					3 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]]
				],
				8 => [
					1 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					2 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],
					3 => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]]
				],
				'suma' => ['mas' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0], 'menos' => ['1' => 0, '2' => 0, '3' => 0, '4' => 0]],

			];


			if($respuestas = $_TUCOACH->get_data("grw_sol_val_listaexterna", " AND id_listaexterna_registro = '".$dato['id']."' AND id_encuesta = 4 AND eliminado = 0 ORDER BY id DESC ", 1)){
				$arrRespuestas = [];
				foreach($respuestas AS $respuesta){
					$arrRespuestas[$respuesta["id_pregunta"]] = [
						'mas'   => $respuesta["id_respuesta_mas"],
						'menos' => $respuesta["id_respuesta_menos"]
					];
				}
			 

		?>

			<h1 class="taC t24 ff3 color333 tU mb50">Respuestas DISC</h1>
			<div class="bfff bShadow3 rr20 p30 p20_oS mb50">

				<div class="row">
					<?php
						$conteo = 0;
						$faq    = 1;
						$bloque = 1;
						if($encPregs = $_TUCOACH->get_data("grw_val_preguntas", " AND id_encuesta = 4 AND eliminado = 0 ORDER BY id ASC ", 1)){
						 
							foreach($encPregs AS $encPreg){
								$conteo++;


					?>
							<div class="col-md-3 mb30">

								<h2 class="t16 ff3 color333 mb10"><?= $encPreg["nombre"].' '.$faq.' | Grupo '.$bloque.', preg '.$conteo; ?></h2>

								<?php
									if($encResps = $_TUCOACH->get_data("grw_val_respuestas", " AND id_pregunta = '".$encPreg['id']."' AND eliminado = 0 ORDER BY prioridad ASC ", 1)){
										$rrr = 1;
								?>

									<div class="table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th class="tB">Respuesta</th>
													<th class="tB taC">Más</th>
													<th class="tB taC">Menos</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($encResps AS $encResp){
												?>
													<tr>
														<td style="vertical-align: middle;" class="taL"><?= $rrr.' '.($encResp["nombre"]); ?></td>
														<td style="vertical-align: middle;" class="taC">
															<?php
																if(($encResp["id"] == $arrRespuestas[$encPreg['id']]['mas'])){
																	echo '<i class="las la-plus-circle t24 colorVerde"></i>';
																	$consul[$bloque][$conteo]['mas'][$rrr] += 1;
																}
															?>
														</td>
														<td style="vertical-align: middle;" class="taC">
															<?php
																if(($encResp["id"] == $arrRespuestas[$encPreg['id']]['menos'])){
																	echo '<i class="las la-minus-circle t24 colorRojo"></i>';
																	$consul[$bloque][$conteo]['menos'][$rrr] += 1;
																}
															?>
														</td>
													</tr>
												<?php
														$rrr++;
													}
												?>
											</tbody>
										</table>
									</div>

								<?php
									}
								?>

							</div>



<?php 

// echo $conteo;
if($conteo >= 3){

?>

<div class="col-md-3 mb30 bMorado5">

	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="tB taC" colspan="4">Más</th>
					<th class="beee"></th>
					<th class="tB taC" colspan="4">Menos</th>
				</tr>
			</thead>
			<tbody>
					<tr>
						<td style="vertical-align: middle;" class="taC">D</td>
						<td style="vertical-align: middle;" class="taC">I</td>
						<td style="vertical-align: middle;" class="taC">S</td>
						<td style="vertical-align: middle;" class="taC">C</td>
						<td class="beee"></td>
						<td style="vertical-align: middle;" class="taC">D</td>
						<td style="vertical-align: middle;" class="taC">I</td>
						<td style="vertical-align: middle;" class="taC">S</td>
						<td style="vertical-align: middle;" class="taC">C</td>
					</tr>
					<?php for ($i=1; $i < 4; $i++) { ?>
						<tr>
							<td style="vertical-align: middle;" class="taC"><?= $consul[$bloque][$i]['mas'][1]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $consul[$bloque][$i]['mas'][2]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $consul[$bloque][$i]['mas'][3]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $consul[$bloque][$i]['mas'][4]; ?></td>
							<td class="beee"></td>
							<td style="vertical-align: middle;" class="taC"><?= $consul[$bloque][$i]['menos'][1]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $consul[$bloque][$i]['menos'][2]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $consul[$bloque][$i]['menos'][3]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $consul[$bloque][$i]['menos'][4]; ?></td>
						</tr>
					<?php } ?>
			</tbody>
		</table>
	</div>


</div>



<?php


$conteo = 0;
$bloque++;

}


													$faq++;

								// }
								// $conteo++;
							}
						}


					?>










				</div>

			</div>


			<div>

			<?php

				for ($i = 1; $i <= 8; $i++) {
					for ($j = 1; $j <= 3; $j++) {
						for ($k = 1; $k <= 4; $k++) {

							$consul['suma']['mas'][$k] += $consul[$i][$j]['mas'][$k];
							$consul['suma']['menos'][$k] += $consul[$i][$j]['menos'][$k];

						}
					}

				}


?>

<div class="generalMin">

<h1 class="taC t24 ff3 color333 tU mb50">Resultado final DISC</h1>
		<div class="bfff bShadow3 rr20 p30 p20_oS mb50">

<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="tB taC">Letra</th>
					<th class="tB taC">Más</th>
					<th class="tB taC">Equivalente</th>
					<th class="tB taC">Menos</th>
					<th class="tB taC">Equivalente</th>
					<th class="tB taC">Combinado</th>
					<th class="tB taC">Equivalente</th>

				</tr>
			</thead>
			<tbody>
					<?php

$mas = [
	1 => [
		'17' => 100,
		'16' => 100,
		'15' => 99,
		'14' => 97,
		'13' => 96,
		'12' => 95,
		'11' => 94,
		'10' => 91,
		'9' => 89,
		'8' => 82,
		'7' => 75,
		'6' => 70,
		'5' => 66,
		'4' => 58,
		'3' => 45,
		'2' => 35,
		'1' => 22,
		'0' => 10,
	],
	2 => [
		'17' => 99,
		'16' => 98,
		'15' => 97,
		'14' => 96,
		'13' => 95,
		'12' => 94,
		'11' => 91,
		'10' => 87,
		'9' => 82,
		'8' => 75,
		'7' => 67,
		'6' => 65,
		'5' => 62,
		'4' => 55,
		'3' => 45,
		'2' => 35,
		'1' => 20,
		'0' => 7,

	],
	3 => [
		'17' => 99,
		'16' => 96,
		'15' => 94,
		'14' => 89,
		'13' => 82,
		'12' => 77,
		'11' => 72,
		'10' => 67,
		'9' => 58,
		'8' => 52,
		'7' => 48,
		'6' => 38,
		'5' => 35,
		'4' => 28,
		'3' => 20,
		'2' => 15,
		'1' => 8,
		'0' => 4,
	],
	4 => [
		'17' => 98,
		'16' => 98,
		'15' => 98,
		'14' => 98,
		'13' => 97,
		'12' => 93,
		'11' => 92,
		'10' => 86,
		'9' => 82,
		'8' => 72,
		'7' => 67,
		'6' => 58,
		'5' => 45,
		'4' => 38,
		'3' => 25,
		'2' => 16,
		'1' => 8,
		'0' => 2,
	],
];

$menos = [
	1 => [
		'0' => 99,
		'1' => 97,
		'2' => 94,
		'3' => 88,
		'4' => 83,
		'5' => 75,
		'6' => 70,
		'7' => 65,
		'8' => 59,
		'9' => 52,
		'10' => 48,
		'11' => 40,
		'12' => 35,
		'13' => 28,
		'14' => 22,
		'15' => 16,
		'16' => 10,
		'17' => 6,
		'18' => 4,
		'19' => 1,
	],
	2 => [
		'0' => 99,
		'1' => 95,
		'2' => 86,
		'3' => 75,
		'4' => 68,
		'5' => 55,
		'6' => 45,
		'7' => 34,
		'8' => 25,
		'9' => 22,
		'10' => 12,
		'11' => 9,
		'12' => 6,
		'13' => 4,
		'14' => 3,
		'15' => 2,
		'16' => 1,
		'17' => 1,
		'18' => 1,
		'19' => 1,

	],
	3 => [
		'0' => 99,
		'1' => 80,
		'2' => 70,
		'3' => 55,
		'4' => 46,
		'5' => 35,
		'6' => 32,
		'7' => 22,
		'8' => 14,
		'9' => 9,
		'10' => 7,
		'11' => 6,
		'12' => 3,
		'13' => 2,
		'14' => 1,
		'15' => 1,
		'16' => 1,
		'17' => 1,
		'18' => 1,
		'19' => 1,
	],
	4 => [
		'0' => 99,
		'1' => 94,
		'2' => 80,
		'3' => 70,
		'4' => 65,
		'5' => 55,
		'6' => 45,
		'7' => 40,
		'8' => 36,
		'9' => 33,
		'10' => 22,
		'11' => 12,
		'12' => 8,
		'13' => 6,
		'14' => 4,
		'15' => 2,
		'16' => 1,
		'17' => 1,
		'18' => 1,
		'19' => 1,
	],
];

$balance = [
	1 => [
		'17' => 100,
		'16' => 100,
		'15' => 100,
		'14' => 99,
		'13' => 98,
		'12' => 96,
		'11' => 95,
		'10' => 94,
		'9' => 93,
		'8' => 92,
		'7' => 90,
		'6' => 89,
		'5' => 86,
		'4' => 82,
		'3' => 80,
		'2' => 79,
		'1' => 77,
		'0' => 70,
		'-1' => 67,
		'-2' => 65,
		'-3' => 63,
		'-4' => 60,
		'-5' => 55,
		'-6' => 48,
		'-7' => 43,
		'-8' => 40,
		'-9' => 35,
		'-10' => 33,
		'-11' => 30,
		'-12' => 25,
		'-13' => 21,
		'-14' => 18,
		'-15' => 14,
		'-16' => 7,
	],
	2 => [
		'17' => 99,
		'16' => 98,
		'15' => 97,
		'14' => 96,
		'13' => 96,
		'12' => 96,
		'11' => 95,
		'10' => 94,
		'9' => 93,
		'8' => 79,
		'7' => 86,
		'6' => 80,
		'5' => 78,
		'4' => 75,
		'3' => 70,
		'2' => 65,
		'1' => 63,
		'0' => 61,
		'-1' => 55,
		'-2' => 50,
		'-3' => 45,
		'-4' => 37,
		'-5' => 33,
		'-6' => 28,
		'-7' => 20,
		'-8' => 15,
		'-9' => 8,
		'-10' => 7,
		'-11' => 6,
		'-12' => 5,
		'-13' => 4,
		'-14' => 3,
		'-15' => 2,
		'-16' => 1,

	],
	3 => [
		'17' => 99,
		'16' => 97,
		'15' => 95,
		'14' => 94,
		'13' => 88,
		'12' => 82,
		'11' => 80,
		'10' => 78,
		'9' => 75,
		'8' => 70,
		'7' => 64,
		'6' => 60,
		'5' => 55,
		'4' => 52,
		'3' => 48,
		'2' => 42,
		'1' => 40,
		'0' => 35,
		'-1' => 30,
		'-2' => 25,
		'-3' => 23,
		'-4' => 20,
		'-5' => 16,
		'-6' => 13,
		'-7' => 9,
		'-8' => 8,
		'-9' => 6,
		'-10' => 4,
		'-11' => 3,
		'-12' => 2,
		'-13' => 1,
		'-14' => 1,
		'-15' => 1,
		'-16' => 1,

	],
	4 => [
		'17' => 99,
		'16' => 99,
		'15' => 99,
		'14' => 99,
		'13' => 99,
		'12' => 98,
		'11' => 96,
		'10' => 94,
		'9' => 90,
		'8' => 86,
		'7' => 82,
		'6' => 78,
		'5' => 75,
		'4' => 70,
		'3' => 65,
		'2' => 63,
		'1' => 55,
		'0' => 48,
		'-1' => 38,
		'-2' => 37,
		'-3' => 36,
		'-4' => 33,
		'-5' => 30,
		'-6' => 25,
		'-7' => 22,
		'-8' => 16,
		'-9' => 11,
		'-10' => 9,
		'-11' => 7,
		'-12' => 5,
		'-13' => 4,
		'-14' => 2,
		'-15' => 1,
		'-16' => 1,
	],
];

$disc = ['', 'D', 'I', 'S', 'C'];

						for ($i=1; $i <= 4; $i++) {

					?>
						<tr>
							<td style="vertical-align: middle;" class="taC"><?= $disc[$i]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $consul['suma']['mas'][$i]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $mas[$i][$consul['suma']['mas'][$i]]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $consul['suma']['menos'][$i]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $menos[$i][$consul['suma']['menos'][$i]]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $consul['suma']['mas'][$i] - $consul['suma']['menos'][$i]; ?></td>
							<td style="vertical-align: middle;" class="taC"><?= $balance[$i][$consul['suma']['mas'][$i] - $consul['suma']['menos'][$i]]; ?></td>
							<td style="vertical-align: middle;" class="taC"></td>
						</tr>
					<?php } ?>
			</tbody>
		</table>
	</div>

	</div>

	</div>



			</div>



		<?php } else { ?>

			<div class="taC">
				<h1 class="t24 ff3 color333 tU mb10">No se encontraron respuestas</h1>
			</div>

		<?php } ?>

<?php } ?>

</div>
</div>
