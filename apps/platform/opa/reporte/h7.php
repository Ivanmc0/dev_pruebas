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
	$rrEvaluadoIn = ($thisEvaluado["nombre"]);
	$pdf->writeHTMLCell(0, 0, 0, 10, $rrEvaluadoIn, '', 0, 0, true, 'R', true);

	$pdf->SetFont('helvetica', '', 10);
	$rrEmpresaIn = "Confidencial: ".($thisEmpresa["nombre"]);
	$pdf->writeHTMLCell(0, 0, 0, 15, $rrEmpresaIn, '', 0, 0, true, 'R', true);

	$pdf->SetFont('helvetica', 'BI', 24);
	$rrEmpresaIn2 = '<span style="color:#77428c;">COMPORTAMIENTOS</span>';
	$pdf->writeHTMLCell(0, 0, 0, 40, $rrEmpresaIn2, '', 0, 0, true, 'R', true);

	$pdf->SetTopMargin(55);
	$pdf->SetFont('helvetica', '', 11);
	$contenidoN3	= '';
	$contenidoN3	.= 'Esta sección contiene las respuestas seleccionadas por cada evaluador en las diferentes preguntas del
						instrumento. Frente de cada pregunta se presentan las convenciones (jefe, observador) cuando existe una
						diferencia mayor a 2 entre el puntaje de la auto-evaluación y el otorgado por el jefe y/o el promedio de los
						observadores. Cada opción de respuesta se representa con un número del UNO al CINCO como se muestra a
						continuación. Cuando se ha contestado la opción NO APLICA, esa pregunta no es tenida en cuenta para la
						calicación de la competencia, por lo tanto no se encuentra representada en esta gráfica.<br><br><br>';

	// ---------------------------------------------------------------------------------------- //

	$contenidoN3	.=  $rrssEval2;
	$contenidoN3	.=  '<br><br>';
	$contenidoN3	.=  '<table cellpadding="5"><tr>';
	$contenidoN3	.=  '<td style="font-style:italic; font-weight:bold; text-align:left; color:#000; background-color:#ccc; width:'.($thisEvaluacion["nivel_minimo"]*$equivalente/2).'%;">Puntaje mínimo requerido</td>';
	$contenidoN3	.=  '<td style="font-style:italic; font-weight:bold; text-align:right; color:#000; background-color:#ccc; width:'.($thisEvaluacion["nivel_minimo"]*$equivalente/2).'%;">'.$thisEvaluacion["nivel_minimo"].'</td>';
	$contenidoN3	.=  '</tr></table>';


	if(count($allion) > 0){
        foreach($allion AS $categoria){
            if($categoria){
                $contenidoN3	.=  '<br><br><br>';
                $contenidoN3	.=  '<table style="font-size:20px; font-style:italic; font-weight:bold;"><tr>';
                $contenidoN3	.=  '<td style="">'.($categoria["nombre"]).'</td>';
                $contenidoN3	.=  '</tr></table>';
                foreach($categoria["competencias"] AS $competencia){
                    $contenidoN3	.=  '<br><br>';
					$contenidoN3	.=  '<table style="font-size:16px; color:#333; font-style:italic;"><tr>';
					$contenidoN3	.=  '<td style="">'.($competencia["nombre"]).'</td>';
					$contenidoN3	.=  '</tr></table>';
                    foreach($competencia["comportamientos"] AS $comportamiento){
						$contenidoN3	.=  '<br><br>';
						$contenidoN3	.=  '<table style="font-size:14px; color:#666;"><tr>';
						$contenidoN3	.=  '<td style="width:80%">'.($comportamiento["nombre"]).'</td>';
						$contenidoN3	.=  '<td style="text-align:right">'.round($comportamiento["resultado"], 2).'</td>';
						$contenidoN3	.=  '</tr></table><br><br>';
						foreach($comportamiento["roles"] AS $rol){
							$contenidoN3	.=  '<table cellspacing="3" cellpadding="5"><tr>';
							$contenidoN3	.=  '<td style="font-style:italic; font-weight:bold; text-align:right; color:#fff; background-color:'.$rol["color"].'; width:'.$rol["resultado"]*$equivalente.'%;">'.round($rol["resultado"],2).'</td>';
							$contenidoN3	.=  '</tr></table>';
						}
                    }
                }
            }
        }
	}

	$pdf->writeHTML($contenidoN3, true, false, true, false, '');

?>