<?php

require_once 'OLC.php';
require_once 'OLC-Company.php';
require_once 'OLC-Leletog.php';
require_once 'OLC-Platform.php';

class Growi {

	private $ZOOM;
	private $COMPANY;
	private $LELE;
	private $VALORA;
	private $Platform;

	public function __construct(){
		$this->ZOOM     = new Zoom();
		$this->COMPANY  = new Company();
		$this->LELE     = new lele();
		$this->VALORA   = new Valora();
		$this->Platform = new Platform();
	}

	public function GET($Class, $Function, $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false){

		try {

			if(isset($ParametersToQuery['empresa'])) $AddToQuery = " AND " . $ParametersToQuery['empresa'] . " = " . $_SESSION['COMPANY']['id'] . " " . $AddToQuery;
			return $this->$Class->$Function($AddToQuery, $ParametersToQuery, $ReturnRecord);

		} catch (PDOException $e) {

			print "¡Error TryCatch!: " . $e->getMessage();

		}

	}

	public function GetCampos($Tabla, $Campos, $Condicion = '', $ReturnRecord  = false){

		if (!$Tabla || !$Campos) return 0;

		$Tabla  = " " . trim($Tabla);
		$Campos = " " . trim($Campos);

		if (($Condicion)) $Condicion = " WHERE " . trim($Condicion) . " AND eliminado = 0 ";
		else $Condicion = " WHERE eliminado = 0 ";

		$TextSQL  = "SELECT $Campos FROM $Tabla $Condicion ";

		return  $this->ZOOM->RUN_SQL($TextSQL, $ReturnRecord);

	}

}