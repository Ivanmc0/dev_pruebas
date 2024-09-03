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
	$rrEmpresaIn2 = '<span style="color:#77428c;">RESUMEN GENERAL</span>';
	$pdf->writeHTMLCell(0, 0, 0, 40, $rrEmpresaIn2, '', 0, 0, true, 'R', true);

	$pdf->SetTopMargin(55);
	$pdf->SetFont('helvetica', '', 11);
	$contenidoN1	= '';
	$contenidoN1	.= 'En esta sección usted encontrará de manera simplificada las calificaciones obtenidas por cada uno de los tipos de evaluadores, en las diferentes categorías de competencias que se tuvieron en cuenta.<br><br /><br /><br>';

	//----------------------------------------------------------------------------
	$contenidoN1	.=  $rrssEval2;
	$contenidoN1	.=  '<br><br>';
	$contenidoN1	.=  '<table cellpadding="5"><tr>';
	$contenidoN1	.=  '<td style="font-style:italic; font-weight:bold; text-align:left; color:#000; background-color:#ccc; width:'.($thisEvaluacion["nivel_minimo"]*$equivalente/2).'%;">Puntaje mínimo requerido</td>';
	$contenidoN1	.=  '<td style="font-style:italic; font-weight:bold; text-align:right; color:#000; background-color:#ccc; width:'.($thisEvaluacion["nivel_minimo"]*$equivalente/2).'%;">'.$thisEvaluacion["nivel_minimo"].'</td>';
	$contenidoN1	.=  '</tr></table>';


	if(count($allion) > 0){
        foreach($allion AS $categoria){
            if($categoria){
                $contenidoN1	.=  '<br><br><br>';
                $contenidoN1	.=  '<table style="font-size:20px; font-style:italic; font-weight:bold;"><tr>';
                $contenidoN1	.=  '<td style="">'.($categoria["nombre"]).'</td>';
                $contenidoN1	.=  '<td style="text-align:right">'.round($categoria["resultado"], 2).'</td>';
                $contenidoN1	.=  '</tr></table><br><br>';
                //$contenidoN1	.=  '<div style="background:#000; position:absolute; width:1px; height:100%; left:'.($thisEvaluacion["nivel_minimo"]*$equivalente).'%; z-index:5"></div>';
                foreach($categoria["roles"] AS $rol){
					$contenidoN1	.=  '<table cellspacing="3" cellpadding="5"><tr>';
                    $contenidoN1	.=  '<td style="font-style:italic; font-weight:bold; text-align:right; color:#fff; background-color:'.$rol["color"].'; width:'.$rol["resultado"]*$equivalente.'%;">'.round($rol["resultado"],2).'</td>';
					$contenidoN1	.=  '</tr></table>';
                }
            }
        }
	}

	$pdf->writeHTML($contenidoN1, true, false, true, false, '');

?>