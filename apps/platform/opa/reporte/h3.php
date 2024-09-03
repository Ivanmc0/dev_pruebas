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
	$rrEmpresaIn2 = '<span style="color:#77428c;">Justificación</span>';
	$pdf->writeHTMLCell(0, 0, 0, 40, $rrEmpresaIn2, '', 0, 0, true, 'R', true);



	$infoIntro		= "

		Evaluaci&oacute;n de competencias es un instrumento que sirve como soporte para su desarrollo profesional y de carrera por cuanto
		identifica elementos claves en los cuales es posible fortalecer el desempe&ntilde;o y determinar c&oacute;mo las expectativas y necesidades
		de la organizaci&oacute;n se encuadran frente al trabajo desarrollado continuamente.
		<br /><br />
		Particularmente este reporte puede aportar elementos en los siguientes aspectos:
		<br />
		<ul>
			<li>Identificar como se percibe usted en cuanto a su actuaci&oacute;n en el trabajo.</li>
			<li>Conocer como es observado(a) por las personas que trabajan con usted diariamente.</li>
			<li>Desarrollar sus fortalezas y orientar sus esfuerzos hacia el crecimiento de aquellas &aacute;reas que puedan presentar opciones de mejora.</li>
		</ul>
		<br />
		El conjunto de competencias contenidas en este informe fueron seleccionadas espec&iacute;ficamente para el proceso de L&iacute;deres con Sentido Integral,
		tratando de reflejar la manera como la organizaci&oacute;n espera se comporte un l&iacute;der en la empresa; es por esto que es importante su total
		compromiso frente a esta valoraci&oacute;n.
		<br /><br />
		Encontrar&aacute; gr&aacute;ficas de an&aacute;lisis de relaciones donde estar&aacute; el puntaje de su evaluaci&oacute;n (autoevaluaci&oacute;n) comparado con los de su
		jefe y dem&aacute;s observadores con el fin de confirmar las fortalezas o hallar las &aacute;reas de mejora para el desarrollo de sus competencias.
		<br /><br />
		Estos son resultados es importante que los pueda revisar con su jefe en un dialogo de crecimiento para validar que esperan de usted
		en el cargo y posibles caminos de desarrollo, adem&aacute;s del soporte que necesita para alcanzar su meta individual.
		<br /><br />
		Sabemos que este proceso es muy importante para usted y queremos ratificar nuestro compromiso de acompa&ntilde;arlo en el camino. Buen d&iacute;a!


	";

	$pdf->SetTopMargin(55);
	$pdf->SetFont('helvetica', '', 11);
	$contenidoIntro	= ($infoIntro);
	$pdf->writeHTML($contenidoIntro, true, false, true, false, '');

?>