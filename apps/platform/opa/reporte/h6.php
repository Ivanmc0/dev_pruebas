<?php
	$pdf->AddPage();

	$bMargin = $pdf->getBreakMargin();
	$auto_page_break = $pdf->getAutoPageBreak();
	$pdf->SetAutoPageBreak(false, 0);
	$img_file = K_PATH_IMAGES.'image_demo2.jpg';
	$pdf->Image($img_file, 0, 0, 216, 279, '', '', '', false, 300, '', false, false, 0);
	$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
	$pdf->setPageMark();

	$pdf->SetFont('helvetica', 'B', 11);
	$rrEvaluadoIn = ($evaluado["nombre"]);
	$pdf->writeHTMLCell(0, 0, 0, 10, $rrEvaluadoIn, '', 0, 0, true, 'R', true);

	$pdf->SetFont('helvetica', '', 10);
	$rrEmpresaIn = "Confidencial: ".($thisEmpresa["nombre"]);
	$pdf->writeHTMLCell(0, 0, 0, 15, $rrEmpresaIn, '', 0, 0, true, 'R', true);

	$pdf->SetFont('helvetica', 'BI', 24);
	$rrEmpresaIn2 = '<span style="color:#77428c;">MAPA DE FORTALEZAS Y<br />ÁREAS DE MEJORA</span>';
	$pdf->writeHTMLCell(0, 0, 0, 40, $rrEmpresaIn2, '', 0, 0, true, 'R', true);

	$pdf->SetTopMargin(55);
	$pdf->SetFont('helvetica', '', 11);
	$contenidoMapa	= '';
	$contenidoMapa	.= '<br /><br /><br />En esta sección usted encontrará un resumen escrito de las diferentes competencias que se han reconocido como fortalezas o como áreas de mejora, de acuerdo con los análisis realizados a lo largo del informe.<br><br><br /><br />';

	$forty1 	= "";
	$forty2 	= "";
	$forty3 	= "";
	$forty4 	= "";
	$rolYo 		= 0;
	$rolNo 		= 0;
	$finalYo 	= 0;
	$finalNo 	= 0;

	foreach($rolesVale AS $rolesVal){
		if($rolesVal["auto"] == 1)	$rolYo+=1;
		else						$rolNo+=1;
	}

	if(count($allion) > 0){
        foreach($allion AS $categoria){
            if($categoria){
                $contenidoN2	.=  '<br><br><br>';
                $contenidoN2	.=  '<table style="font-size:20px; font-style:italic; font-weight:bold;"><tr>';
                $contenidoN2	.=  '<td style="">'.($categoria["nombre"]).'</td>';
				$contenidoN2	.=  '</tr></table>';
                foreach($categoria["competencias"] AS $competencia){
					$sumaYo 	= 0;
					$sumaNo 	= 0;
					foreach($competencia["roles"] AS $rol){
						if($rol["auto"] == 1){
							$sumaYo += $rol["resultado"];
						}
						else{
							$sumaNo += $rol["resultado"];
						}
					}
					$finalYo = $sumaYo/$rolYo;
					$finalNo = $sumaNo/$rolNo;
					//$contenidoMapa	.= ("Sumayo: ".$finalYo." - SumaNo: ".$finalNo."<br>");
					if($finalYo >= $thisEvaluacion["nivel_minimo"] && $finalNo >= $thisEvaluacion["nivel_minimo"]) 	$forty1 .= "&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp; ".$competencia["nombre"]."<br>";
					if($finalYo < $thisEvaluacion["nivel_minimo"] && $finalNo < $thisEvaluacion["nivel_minimo"]) 	$forty2 .= "&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp; ".$competencia["nombre"]."<br>";
					if($finalYo < $thisEvaluacion["nivel_minimo"] && $finalNo >= $thisEvaluacion["nivel_minimo"]) 	$forty3 .= "&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp; ".$competencia["nombre"]."<br>";
					if($finalYo >= $thisEvaluacion["nivel_minimo"] && $finalNo < $thisEvaluacion["nivel_minimo"]) 	$forty4 .= "&nbsp;&nbsp;&nbsp;&#8226;&nbsp;&nbsp; ".$competencia["nombre"]."<br>";
                }
            }
        }
    }

	$contenidoMapa	.= '<table style="width:100%" border="0" cellspacing="10"><tr>';
	$contenidoMapa	.= '<td style="width:48%;">';
	$contenidoMapa	.= '<table bgcolor="#663399" style="width:100%; color:#fff; text-align:center" cellpadding="10"><tr><td>Fortalezas Confirmadas</td></tr></table>';

	$contenidoMapa	.= '<p style="padding:20px;">'.($forty1).'</p>';
	$contenidoMapa	.= '</td><td style="width:4%"></td><td style="width:48%">';
	$contenidoMapa	.= '<table bgcolor="#663399" style="width:100%; color:#fff; text-align:center" cellpadding="10"><tr><td>Áreas de mejora Confirmadas</td></tr></table>';

	$contenidoMapa	.= '<p style="padding:20px;">'.($forty2).'</p>';
	$contenidoMapa	.= '</td>';
	$contenidoMapa	.= '</tr></table>';


	$contenidoMapa	.= '<table style="width:100%" border="0" cellspacing="10"><tr>';
	$contenidoMapa	.= '<td style="width:48%;">';
	$contenidoMapa	.= '<table bgcolor="#663399" style="width:100%; color:#fff; text-align:center" cellpadding="10"><tr><td>Fortalezas Desconocidas</td></tr></table>';

	$contenidoMapa	.= '<p style="padding:20px;">'.($forty3).'</p>';
	$contenidoMapa	.= '</td><td style="width:4%"></td><td style="width:48%">';
	$contenidoMapa	.= '<table bgcolor="#663399" style="width:100%; color:#fff; text-align:center" cellpadding="10"><tr><td>Áreas de mejora Desconocidas</td></tr></table>';

	$contenidoMapa	.= '<p style="padding:20px;">'.($forty4).'</p>';
	$contenidoMapa	.= '</td>';
	$contenidoMapa	.= '</tr></table>';




$pdf->writeHTML($contenidoMapa, true, false, true, false, '');;

?>