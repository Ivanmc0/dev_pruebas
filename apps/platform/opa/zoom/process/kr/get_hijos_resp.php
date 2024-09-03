<?php require_once ('../../../appInit.php');

	if($_POST["id"] != "" && $_POST["nivel"] != "" && $_POST["proyecto"] != "" && $_POST["week"] != "" && $_POST["today"] != "" && $_POST["quien"] != ""){

		$id 		= $_POST["id"];
		$quien 		= $_POST["quien"];
		$nivel 		= $_POST["nivel"];
		$proyecto 	= $_POST["proyecto"];
		$estado 	= array("Pendiente", "En proceso", "Finalizado");

		$vv = "";

		$tabla = array(
			1 => array(
				"tabla" 		=> "grw_okr_objetivos",
				"valor" 		=> "id_proyecto",
				"nombre" 		=> "Objetivo",
			),
			2 => array(
				"tabla" 		=> "grw_okr_krs",
				"valor" 		=> "id_objetivo",
				"nombre" 		=> "KR",
			),
			3 => array(
				"tabla" 		=> "grw_okr_acciones",
				"valor" 		=> "id_kr",
				"nombre" 		=> "Acción",
			),
			4 => array(
				"tabla" 		=> "grw_okr_sprints",
				"valor" 		=> "id_accion",
				"nombre" 		=> "Sprint",
			),
			5 => array(
				"tabla" 		=> "grw_okr_tareas",
				"valor" 		=> "id_sprint",
				"nombre" 		=> "Tarea",
			),
		);

		$ccodi = " ORDER BY id ASC ";
		if($nivel ==  5) $ccodi = " ORDER BY id_semana ASC, id ASC ";

		$week  = $_TUCOACH->get_data("olc_semanas", " AND id = ".$_POST["week"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
		$today = $_TUCOACH->get_data("olc_semanas", " AND id = ".$_POST["today"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
		$datos = $_TUCOACH->get_data($tabla[$nivel]["tabla"], "AND id_responsable = $quien AND inactivo = 0 AND eliminado = 0 ".$ccodi, 1);
		$ccc = 1;
		if($datos){

			echo '<div class="h20"></div>';
			foreach($datos AS $dato){

				$responsable	= $_TUCOACH->get_data("zoom_users", " AND id = ".$dato["id_responsable"]." AND id_empresa = ".$_SESSION["tc_empresa_id"]." AND inactivo = 0 AND eliminado = 0 ", 0);


				$homeworks = array(
					"totales"           	=> 0,
					"totales_hoy"       	=> 0,
					"pendientes"        	=> 0,
					"en_proceso"        	=> 0,
					"realizadas"        	=> 0,
					"realizadas_hoy"    	=> 0,
					"vencidas"          	=> 0,
					"siguientes"        	=> 0,
					"week"              	=> 0,
					"week_pendientes"    	=> 0,
					"week_en_proceso"    	=> 0,
					"week_realizadas"    	=> 0,
				);

				$get_homeworks = 0;
				if($nivel < 5) $get_homeworks  = $_TUCOACH->get_data("grw_okr_tareas", " AND ".$tabla[$nivel+1]["valor"]." = ".$dato["id"]." AND id_empresa = ".$_SESSION["tc_empresa_id"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id_semana ASC, id ASC ", 1);

				// echo '<pre>';
				// print_r($get_homeworks);
				// echo '</pre>';

				if($get_homeworks){
					$ioio = array();
					foreach($get_homeworks AS $hw){

						$homeworks["totales"] += 1;
						if($hw["id_semana"] <= $week["id"]) $homeworks["totales_hoy"] += 1;
						if($hw["estado"] == 0 && $hw["id_semana"] >= $week["id"]) $homeworks["pendientes"] += 1;
						if($hw["estado"] == 1 && $hw["id_semana"] >= $week["id"]) $homeworks["en_proceso"] += 1;
						if($hw["estado"] == 2) $homeworks["realizadas"] += 1;
						if($hw["estado"] == 2 && $hw["id_semana"] <= $week["id"]) $homeworks["realizadas_hoy"] += 1;
						if($hw["estado"] != 2 && $hw["id_semana"] < $week["id"]) $homeworks["vencidas"] += 1;
						if($hw["id_semana"] > $week["id"]) $homeworks["siguientes"] += 1;

						if($hw["id_semana"] == $week["id"]) $homeworks["week"] += 1;
						if($hw["estado"] == 0 && $hw["id_semana"] == $week["id"]) $homeworks["week_pendientes"] += 1;
						if($hw["estado"] == 1 && $hw["id_semana"] == $week["id"]) $homeworks["week_en_proceso"] += 1;
						if($hw["estado"] == 2 && $hw["id_semana"] == $week["id"]) $homeworks["week_realizadas"] += 1;

					}
				}

				echo '<div class="bfff bShadow3" style="overflow:hidden; border-radius:0 0 0 20px; margin-right:-1px">';
				echo '<div class="posR o_wrapper">';

				if($nivel == 5){
					if($star = $_OKR->get_task(" AND TASK.id = ".$dato["id"]." AND PROY.id = ".$dato["id_proyecto"]." AND EMP.id = ".$_SESSION["tc_empresa_id"]."  ")){
						$star = $star[0];
						echo '
							<div class="">
								<div class="tab">
									<a class="tab20 p510 bN1 color999 bHover" href="'.$_SESSION["olc"]["dominion"].'tucoach/proyecto/'.$star["id_proyecto"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_proyecto"]).'">
										<div class="tU t8 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right dN_oS"></i> &nbsp; Proyecto</div>
										<div class="t10 ff3 color000 oEllipsis dN_oS">'.ucfirst(strtolower(($star["nombre_proyecto"]))).'</div>
									</a>
									<a class="tab20 p510 bN2 color999 bHover" href="'.$_SESSION["olc"]["dominion"].'tucoach/proyecto/'.$star["id_proyecto"].'/objetivo/'.$star["id_objetivo"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_objetivo"]).'">
										<div class="tU t8 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right dN_oS"></i> &nbsp; Objetivo</div>
										<div class="t10 ff3 color000 oEllipsis dN_oS">'.ucfirst(strtolower(($star["nombre_objetivo"]))).'</div>
									</a>
									<a class="tab20 p510 bN3 color999 bHover" href="'.$_SESSION["olc"]["dominion"].'tucoach/proyecto/'.$star["id_proyecto"].'/kr/'.$star["id_kr"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_kr"]).'">
										<div class="tU t8 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right dN_oS"></i> &nbsp; KR</div>
										<div class="t10 ff3 color000 oEllipsis dN_oS">'.ucfirst(strtolower(($star["nombre_kr"]))).'</div>
									</a>
									<a class="tab20 p510 bN4 color999 bHover" href="'.$_SESSION["olc"]["dominion"].'tucoach/proyecto/'.$star["id_proyecto"].'/accin/'.$star["id_accion"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_accion"]).'">
										<div class="tU t8 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right dN_oS"></i> &nbsp; Acción</div>
										<div class="t10 ff3 color000 oEllipsis dN_oS">'.ucfirst(strtolower(($star["nombre_accion"]))).'</div>
									</a>
									<a class="tab20 p510 bN5 color999 bHover" href="'.$_SESSION["olc"]["dominion"].'tucoach/proyecto/'.$star["id_proyecto"].'/sprint/'.$star["id_sprint"].'/" data-toggle="tooltip" data-placement="top" title="'.($star["nombre_sprint"]).'">
										<div class="tU t8 ff2 colorRojo3 mb3"><i class="fas fa-angle-double-right dN_oS"></i> &nbsp; Sprint</div>
										<div class="t10 ff3 color000 oEllipsis dN_oS">'.ucfirst(strtolower(($star["nombre_sprint"]))).'</div>
									</a>
								</div>
							</div>
						';
					}
				}

				echo '
						<div class="tab">
							<a href="https://olcgroup.co/tucoach/proyecto/'.$proyecto.'/'. $_TUCOACH->url_seo(utf8_decode(strtolower($tabla[$nivel]["nombre"]))).'/'.($dato["id"]).'/" class="tabIn bHover2">
								<div class="tab">
									<div class="tabIn p20">
				';

				if($nivel == 4){
					echo '<div class="fR ff2 p3 rr tU t10 colorfff b999 rr20 w100x taC" style="margin-top:-10px">'.$_TUCOACH->verMes($dato["mes"])." ".$dato["ano"].'</div>';
				}
				if($nivel == 5){
					$tWeek  = $_TUCOACH->get_data("olc_semanas", " AND id = ".$dato["id_semana"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 0);
					echo '<div class="fR ff2 p3 rr tU t10 colorfff b999 rr20 w100x taC" style="margin-top:-10px">Semana '.$tWeek["semana"].'</div>';
				}

				echo '
										<div class="ff4 tU t12 colorMorado2 mb5">'.($tabla[$nivel]["nombre"]).' #'.$ccc.'</div>
										<div class="ff2 t14 color333">'.($dato["nombre"]).'</div>
									</div>
				';

				if($nivel < 5){
					echo '
									<div class="tabIn pLR10 w150x taC" style="border-left:1px solid #eee;">
										<div class="estadot'.(1).' ff2 taC">
											<div class="color666 t12 mb5">Hasta la semana '.$week["semana"].'</div>
											<div class="dIB"><div class="wh30 t12 ff2 rr50 estado0 colorfff mAUTO vCC">'.$homeworks["totales_hoy"].'</div></div>&nbsp;&nbsp;
											<div class="dIB"><div class="wh30 t12 ff2 rr50 estado2 colorfff mAUTO vCC">'.$homeworks["realizadas"].'</div></div>
										</div>
									</div>
				';
				}

				if($nivel < 5){
					echo '
									<div class="tabIn pLR10 w200x taC" style="border-left:1px solid #eee;">
										<div class="estadot'.(1).' ff2 taC">
											<div class="color666 t12 mb5">En la semana '.$week["semana"].' - '.$week["ano"].'</div>
											<div class="dIB"><div class="wh20 t12 ff2 rr50 bMorado colorfff mAUTO vCC">'.$homeworks["week"].'</div></div>&nbsp;&nbsp;
				';

				if($week["id"] < $today["id"]){
					echo '
											<div class="dIB"><div class="wh20 t12 ff2 rr50 vencido colorfff mAUTO vCC">'.($homeworks["week"]-$homeworks["week_realizadas"]).'</div></div>&nbsp;&nbsp;
					';
				}
				echo '
											<div class="dIB"><div class="wh20 t12 ff2 rr50 estado0 colorfff mAUTO vCC">'.$homeworks["week_pendientes"].'</div></div>&nbsp;&nbsp;
											<div class="dIB"><div class="wh20 t12 ff2 rr50 estado1 colorfff mAUTO vCC">'.$homeworks["week_en_proceso"].'</div></div>&nbsp;&nbsp;
											<div class="dIB"><div class="wh20 t12 ff2 rr50 estado2 colorfff mAUTO vCC">'.$homeworks["week_realizadas"].'</div></div>
										</div>
									</div>
				';
				}
				if($nivel < 5) $va = "180px"; else $va = "240px";
				if($nivel == 5){
					if($dato["id_semana"] < $today["id"] && $dato["estado"] != 2){
					echo '
									<div class="tabIn pLR10 w200x taC" style="border-left:1px solid #eee;">
										<div class="dIB wh10 rr50 vencido"></div>&nbsp;&nbsp;
										<div class="dIB vencidot ff3 mb3">Vencido</div>
									</div>
					';
					}else{
						echo '
									<div class="tabIn pLR10 w200x taC" style="border-left:1px solid #eee;">
										<div class="dIB wh10 rr50 estado'.$dato["estado"].'"></div>&nbsp;&nbsp;
										<div class="dIB estadot'.$dato["estado"].' ff3 mb3">'.$estado[$dato["estado"]].'</div>
									</div>
						';
					}
				}
				echo '
									<div class="tabIn pLR10" style="border-left:1px solid #eee; width:'.$va.';">
										<div class="color333 ff3 mb3">'.ucwords(strtolower(($responsable["nombre"]))).'</div>
										<div class="color666 t12">'.($responsable["cargo"]).'</div>
									</div>
				';
				echo '
								</div>
							</a>
						</div>
					</div>
				';

				//echo '<div class="nivel-'.($nivel+1).' pL20 bGray" id="nivel-'.($nivel+1).'-'.$dato["id"].'"></div>';
				echo '</div>';
				echo '<div class="h20"></div>';


				$ccc++;
			}
		} else echo '<div class="p30 ff1 t16 tU colorMorado2 taC">Sin contenido</div>';

	}


?>