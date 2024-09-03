<?php

	$rrssEval 	= "";
	$rrssEval2 	= "";
	$totalParti = 0;
	if($thisRolesAsig){
		foreach($thisRolesAsig AS $rolid){
			$c1  = 0;
			$c2  = 0;
			$rol = $_TUCOACH->get_data("grw_tuc_roles", " AND id = ".$rolid["id_rol"]." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
			if($rol){
				foreach($thisAsignaciones AS $thisAsignacion){
					if($thisAsignacion["id_rol"] == $rol["id"]){
						$c1++;
						if($thisAsignacion["realizado"]){
							$c2++;
							$totalParti++;
						}
					}
				}
			}
			$rrssEval .= '<span style="color:'.($rol["color"]).';">'.($rol["nombre"]).'</span> ';
			$rrssEval .= ' <span style="color:#fff; background-color:'.($rol["color"]).';"> '.$c2.' </span><br>';
			$rrssEval2 .= '<span style="color:#fff; background-color:'.($rol["color"]).';">&nbsp;&nbsp;&nbsp;&nbsp;</span> ';
			$rrssEval2 .= ' <span style="color:'.($rol["color"]).';">'.($rol["nombre"]).'</span> ';
			$rrssEval2 .= ' <span>&nbsp;&nbsp;&nbsp;&nbsp;</span> ';

		}
	}


	$pdf->AddPage();

	$rrLogoEmpresa	= '../../static/logos/300/'.$thisEmpresa["logo"];
	$pdf->Image($rrLogoEmpresa, 10, 123, 0, 0, 'JPG', '', '', true, 300, '', false, false, 0, false, false, false);

	$pdf->SetFont('helvetica', 'B', 16);
	$rrEvaluado = ($thisEvaluado["nombre"]);
	$pdf->writeHTMLCell(190, 0, 10, 190, $rrEvaluado, '', 0, 0, true, 'R', true);

	$pdf->SetFont('helvetica', '', 12);
	$rrDetallesEvaluado = '<span style="color:#666">';
	$rrDetallesEvaluado .= ($thisEvaluado["cargo"]);
	$rrDetallesEvaluado .= "";
	$rrDetallesEvaluado .= "<br />".($thisEvaluacion["nombre"]);
	$rrDetallesEvaluado .= "<br />".date("Y / m / d");;
	$rrDetallesEvaluado .= '</span>';
	$pdf->writeHTMLCell(190, 0, 10, 198, $rrDetallesEvaluado, '', 0, 0, true, 'R', true);


	$pdf->SetFont('helvetica', 'B', 12);
	$rrEvaluadoresRoles = 'TOTAL PARTICIPANTES: '.$totalParti;
	$pdf->writeHTMLCell(190, 0, 10, 224, $rrEvaluadoresRoles, '', 0, 0, true, 'R', true);




	$pdf->SetFont('helvetica', 'BI', 10);
	$pdf->writeHTMLCell(190, 0, 10, 230, $rrssEval, '', 0, 0, true, 'R', true);

?>