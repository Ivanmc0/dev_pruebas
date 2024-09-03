<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

	set_time_limit(0);

	require_once('../zoom/class/classZoom.php');
    $_TUCOACH = new Zoom();

	$id = "";
	if(isset($_GET["ion"])) $id = $_GET["ion"];

	$reporte = $_TUCOACH->get_data("grw_tuc_p2p_reportes", " AND id = $id AND eliminado = 0 ORDER BY id DESC ", 0);
    if($reporte){

		// echo '<pre>';
		// print_r($reporte);
		// echo '</pre>';

		require_once('../views/tucoach/personas/reporte_motor.php');

		//ob_end_clean();
		//ob_start();
		require_once('../resources/plugins/tcpdf/tcpdf_include.php');

		class MYPDF extends TCPDF {
			public function Header() {
				$bMargin = $this->getBreakMargin();
				$auto_page_break = $this->AutoPageBreak;
				$this->SetAutoPageBreak(false, 0);

				$img_file = K_PATH_IMAGES.'image_demo.jpg';
				$this->Image($img_file, 0, 0, 216, 279, '', '', '', false, 300, '', false, false, 0);
				$this->SetAutoPageBreak($auto_page_break, $bMargin);
				$this->setPageMark();
			}
		}

		$sizzu 		= array(216, 279);
		$pdf 		= new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $sizzu, true, 'UTF-8', false);

		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('TU COACH - OLC Group');
		$pdf->SetTitle('Reporte');
		$pdf->SetSubject('Generación de Reporte');
		$pdf->SetKeywords('smile, pdf, tucoach, olc');

		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(0);
		$pdf->setPrintFooter(false);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}


		// ---------------------------------------------------------


		include "h1.php";
		// remove run header
		$pdf->setPrintHeader(false);
		include "h2.php";
		// include "h3.php";
		include "h4.php";
		include "h5.php";
		include "h6.php";
		include "h7.php";

		$ruu	= "C:/xampp/htdocs/tucoach/master/evaluacion/ripurt/tcpdf/examples/";
		$pdf->Output("Reporte Tu Coach - ".($thisEvaluado["nombre"]).'.pdf', 'I');

	} else echo "ooasdf";

?>
