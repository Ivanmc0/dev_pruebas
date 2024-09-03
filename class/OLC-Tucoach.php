<?php

require_once 'connect/conexion.php';
require_once 'class.inputfilter.php';

class Tucoach {

	public static $instancia;
	public $dbh;
	public $iFilter;

	public function __construct(){
		$this->dbh     = Conexion::singleton_conexion();
		$this->iFilter = new InputFilterion();
	}

	public function pp() {
		return 'ppp';
	}

	public function getOpcionesPorRol($rol, $appName='platform', $condicion = ''){

		try {
			$query = $this->dbh->prepare("
							SELECT model.id AS id, model.uuid AS uuid, model.id_modulo AS id_modulo, model.inactivo AS inactivo, model.id_categoria AS id_categoria,
							model.tipo AS tipo, model.url AS url, model.modulo AS modulo, model.cody AS cody, model.orden AS orden,
							model.archivo AS archivo, model.tabla AS tabla, model.icono AS icono,
							model.directorio AS directorio, model.inactivo AS inactivo,
							model.eliminado AS eliminado, relrol.id_rol AS id_rol
						FROM
							zoom_models AS model
							LEFT JOIN zoom__models__roles AS relrol ON model.id = relrol.id_modulo
						WHERE
								model.inactivo = 0
							AND id_rol         = $rol
							AND $appName       = 1
							$condicion
							AND model.inactivo = 0 AND model.eliminado = 0
							AND relrol.inactivo = 0 AND relrol.eliminado = 0
						ORDER BY model.tipo ASC, model.orden ASC ");
			$query->execute();
			if($query->rowCount() != 0)	{
					return $query->fetchAll();
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_data($tabla, $condicion, $fetchAll){
		try {
			$query = $this->dbh->prepare(" SELECT $tabla.* FROM $tabla WHERE 1=1 $condicion ");
			$query->execute();
			if($query->rowCount() != 0)	{
				if ($fetchAll == 1)	return $query->fetchAll();
				else				return $query->fetch();
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function insert_data_array($array, $tabla){
		try {
			$array_2 = [];
			$query 	= $this->dbh->prepare("SHOW COLUMNS FROM $tabla");
			$query->execute();
			$campos = $query->fetchAll();
			foreach($array as $key => $data){
				if($data != '' && $key != 'id'){
					foreach($campos as $campo_key => $campo_data){
						$existe = array_search($key, $campo_data);
						if($existe) {
							if($campo_data[1]== "text")		$array_2[$key] = (htmlspecialchars($data));
							else  							$array_2[$key] = $this->iFilter->process(($data));
							break;
						}
					}
				}
			}
			$array     = $array_2;
			$fields    = array_keys($array);
			$values    = array_values($array);
			$fieldlist = implode(',',$fields);
			$qs        = str_repeat("?,",count($fields)-1);
			$sql       = "INSERT INTO $tabla ($fieldlist) values($qs?)";
			$query     = $this->dbh->prepare($sql);
			if ($query->execute($values) === false) return 0;	/*var_dump($errorcode = $query->errorCode());*/
			else return $this->dbh->UltimoIDInsertado();
		} catch (PDOException $e) {
			$e->getMessage();
		}
	}

	public function update_data_array($array, $tabla, $campo, $value){
		try {
				$cant      = 1;
				$coma      = ", ";
				$fieldlist = "";
				$count     = count($array);
				$array_3   = array();
				$query 	= $this->dbh->prepare("SHOW COLUMNS FROM $tabla");
				$query->execute();
				$campos = $query->fetchAll();
				foreach($array as $key => $data){
					if($data != ''){
						foreach($campos as $campo_key => $campo_data){
							$existe = array_search($key, $campo_data);
							if($existe) {
								if("id" != $campo_key) {
									if($campo_data[1]== "text")			$array[$key] = (htmlspecialchars($data));
									else  								$array[$key] = $this->iFilter->process(($data));
									$array_3[$cant] = $array[$key];
									$fieldlist  .= $key." = ?".$coma;
									break;
								}
							}
						}
					}
					$cant++;
				}
				$fieldlist = trim($fieldlist, ', ');
				$sql	= "UPDATE $tabla SET $fieldlist WHERE $campo = ?";
				$query 	= $this->dbh->prepare($sql);
				$i = 1;
				foreach($array_3 as $key => $data){
					$query->bindValue($i, $data);
					$i++;
				}
				$query->bindValue($i, $value);
				if ($query->execute() === false) return 0;	/*var_dump($errorcode = $query->errorCode());*/
				else return 1;
		} catch (PDOException $e) {
			$e->getMessage();
		}
	}

	public function delete_on($tabla, $parametro, $id){
		try {
			$query = $this->dbh->prepare("DELETE FROM $tabla WHERE $parametro = ?");
			$query->bindParam(1,$id);
			if ($query->execute() === false) return 0;
			else 							 return 1;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_models($condicional, $fetchAll){
		try {
			$query = $this->dbh->prepare("
											SELECT model.id AS id, model.id_modulo AS id_modulo, model.id_categoria AS id_categoria, model.tipo AS tipo,
											model.cody AS cody, model.modulo AS modulo, model.orden AS orden, model.archivo AS archivo, model.tabla AS tabla,
											model.icono AS icono, model.directorio AS directorio, model.inactivo AS inactivo, model.eliminado AS eliminado,
											relrol.id_rol AS id_rol
											FROM zoom_models AS model
											LEFT JOIN zoom__models__roles AS relrol ON model.id = relrol.id_modulo
											WHERE model.inactivo = 0 && model.eliminado = 0
											&& relrol.inactivo = 0 && relrol.eliminado = 0
											".$condicional."
											");
			$query->execute();
			if($query->rowCount() != 0)	{
				if ($fetchAll == 1)	return $query->fetchAll();
				else				return $query->fetch();
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_projects($condicional, $fetchAll){
		try {
			$query = $this->dbh->prepare("
											SELECT proj.id AS id, proj.proyecto AS proyecto, proj.inactivo AS inactivo, proj.eliminado AS eliminado,
											relrol.id_rol AS id_rol
											FROM zoom_projects AS proj
											LEFT JOIN zoom__project__roles AS relrol ON proj.id = relrol.id_proyecto
											WHERE proj.inactivo = 0 AND proj.eliminado = 0
											AND relrol.inactivo = 0 AND relrol.eliminado = 0
											".$condicional."
											");
			$query->execute();
			if($query->rowCount() != 0)	{
				if ($fetchAll == 1)	return $query->fetchAll();
				else				return $query->fetch();
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_grupo_tests($condicional, $fetchAll){
		try {
			$query = $this->dbh->prepare("
											SELECT tests.id AS id, tests.nombre AS nombre, tests.descripcion AS descripcion, tests.id_grupopregunta AS id_grupopregunta, relrol.id AS id_rel
											FROM grw_tuc_p2b_tests AS tests
											LEFT JOIN grw_tuc_paquetes_tests AS relrol ON tests.id = relrol.id_test
											LEFT JOIN grw_tuc_paquetests AS multi ON multi.id = relrol.id_multitest
											WHERE relrol.inactivo = 0 AND relrol.eliminado = 0
											AND tests.inactivo = 0 AND tests.eliminado = 0
											AND multi.inactivo = 0 AND multi.eliminado = 0
											".$condicional."
											");
			$query->execute();
			if($query->rowCount() != 0)	{
				if ($fetchAll == 1)	return $query->fetchAll();
				else				return $query->fetch();
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_solution($condicional, $fetchAll){
		try {
			$query = $this->dbh->prepare("
											SELECT res.solucion AS solucion
											FROM grw_sol_p2p_estudio AS res
											LEFT JOIN grw_tuc_p2p_asignaciones AS asi ON asi.id = res.id_asignacion
											WHERE res.inactivo = 0 && res.eliminado = 0 && asi.inactivo = 0 && asi.eliminado = 0
											".$condicional."
											");
			$query->execute();
			if($query->rowCount() != 0)	{
				if ($fetchAll == 1)	return $query->fetchAll();
				else				return $query->fetch();
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_solution_empresa($condicional, $fetchAll){
		try {
			$query = $this->dbh->prepare("
			SELECT
			asi.id_evaluacion AS evaluacion,
			res.id AS id_resultado, res.id_comportamiento AS comportamiento,
			res.solucion AS solucion, res.solucion2 AS solucion2

			FROM grw_sol_p2b_estudio AS res

			LEFT JOIN grw_tuc_p2b_asignaciones AS asi ON asi.id = res.id_asignacion

			WHERE res.inactivo = 0 AND res.eliminado = 0 AND asi.inactivo = 0 AND asi.eliminado = 0

											".$condicional."
											");
			$query->execute();
			if($query->rowCount() != 0)	{
				if ($fetchAll == 1)	return $query->fetchAll();
				else				return $query->fetch();
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_solution_empresa_segmento($condicional, $fetchAll){
		try {
			$query = $this->dbh->prepare("
			SELECT
			asi.id_evaluacion AS evaluacion,
			res.id AS id_resultado, res.id_comportamiento AS comportamiento,

			perf.solucion AS perfil, trab.nombre AS nombre,

			res.solucion AS solucion, res.solucion2 AS solucion2

			FROM grw_sol_p2b_estudio AS res
			LEFT JOIN grw_tuc_p2b_asignaciones AS asi ON asi.id = res.id_asignacion
			LEFT JOIN zoom_users AS trab ON trab.id = asi.id_evaluador
			LEFT JOIN grw_tuc_p2b_sol_perfilado AS perf ON perf.id_trabajador = trab.id

			WHERE res.inactivo = 0 AND res.eliminado = 0 AND asi.inactivo = 0 AND asi.eliminado = 0

											".$condicional."
											");
			$query->execute();
			if($query->rowCount() != 0)	{
				if ($fetchAll == 1)	return $query->fetchAll();
				else				return $query->fetch();
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function permission($rol, $funtion){
		try {
			$query = $this->dbh->prepare(" SELECT * FROM zoom__models__roles WHERE id_rol = '$rol' AND id_modulo = '$funtion' AND inactivo = 0 AND eliminado = 0 ");
			$query->execute();
			if($query->rowCount() != 0)	{
				return true;
			} else return false;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}

	}

	public function url_seo($str){
		$before 	= array( 'àáâãäåòóôõöøèéêëðçìíîïùúûüñšž', '/[^a-z0-9\s]/', array('/\s/', '/--+/', '/---+/')	);
		$after 		= array( 'aaaaaaooooooeeeeeciiiiuuuunsz', '', '-' );
		$str 		= strtolower($str);
		$str 		= strtr($str, $before[0], $after[0]);
		$str 		= preg_replace($before[1], $after[1], $str);
		$str 		= trim($str);
		$str 		= preg_replace($before[2], $after[2], $str);
		return $str;
	}

	function moneda($valor){
		return "$".number_format($valor, 0, ',', '.');
	}

	function fecha($fecha){
		$fechaIn = explode(" ", $fecha);
		$fechaF = explode("-", $fechaIn[0]);
		return $fecha = $fechaF[2]."/".$fechaF[1]."/".$fechaF[0];
	}

	function fechaSinHora($fecha){
		$fechaF = explode("-", $fecha);
		return $fecha = $fechaF[2]."/".$fechaF[1]."/".$fechaF[0];
	}

	function verMes($mes){
		if($mes == 1)	$mes = "Enero";
		if($mes == 2)	$mes = "Febrero";
		if($mes == 3)	$mes = "Marzo";
		if($mes == 4)	$mes = "Abril";
		if($mes == 5)	$mes = "Mayo";
		if($mes == 6)	$mes = "Junio";
		if($mes == 7)	$mes = "Julio";
		if($mes == 8)	$mes = "Agosto";
		if($mes == 9)	$mes = "Septiembre";
		if($mes == 10)	$mes = "Octubre";
		if($mes == 11)	$mes = "Noviembre";
		if($mes == 12)	$mes = "Diciembre";
		return $mes;
	}

	function pulirFecha($fecha1, $fecha2){

		$dat1 = explode("-", $fecha1);
		$dat2 = explode("-", $fecha2);

		if($dat1[1] == $dat2[1]) 	return $dat1[2]." - ".$dat2[2]." ".substr($this->verMes($dat2[1]),0,3);
		else 						return $dat1[2]." ".substr($this->verMes($dat1[1]),0,3)." - ".$dat2[2]." ".substr($this->verMes($dat2[1]),0,3);

	}



	###############################################################################
	### ANTIGUO OLC
	###############################################################################

	public function get_answers_personas_empresas($condicion = ""){
		try {
			$query = $this->dbh->prepare("

				SELECT
				RES.id_asignacion,
				RES.id_comportamiento,
				COM.nombre AS Comportamiento,
				COM.id_competencia,
				COMPE.nombre AS Competencia,
				COMPE.id_categoria,
				CAT.nombre AS Categoria,
				CAT.id_test,
				TEST.nombre AS Test,
				ASIG.id_evaluador,
				TRA.nombre AS Trabajador,
				TRA.id_empresa,
				RES.solucion,
				RES.solucion2
				FROM grw_sol_p2b_estudio RES
				INNER JOIN grw_tuc_p2b_comportamientos COM ON COM.id = RES.id_comportamiento && COM.inactivo = 0 && COM.eliminado = 0
				INNER JOIN grw_tuc_p2b_competencias COMPE ON COMPE.id = COM.id_competencia && COMPE.inactivo = 0 && COMPE.eliminado = 0
				INNER JOIN grw_tuc_p2b_categorias CAT ON CAT.id = COMPE.id_categoria && CAT.inactivo = 0 && CAT.eliminado = 0
				INNER JOIN grw_tuc_p2b_tests TEST ON TEST.id = CAT.id_test && TEST.inactivo = 0 && TEST.eliminado = 0
				INNER JOIN grw_tuc_p2b_asignaciones ASIG ON ASIG.id = RES.id_asignacion && ASIG.inactivo = 0 && ASIG.eliminado = 0
				INNER JOIN zoom_users TRA ON TRA.id = ASIG.id_evaluador && TRA.inactivo = 0 && TRA.eliminado = 0
				INNER JOIN olc_empresas EMP ON EMP.id = TRA.id_empresa && EMP.inactivo = 0 && EMP.eliminado = 0
				WHERE RES.inactivo = 0 && RES.eliminado = 0 $condicion
			");

			$query->execute();
			if($query->rowCount() != 0)	{


				return $query->fetchAll();
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_segmentos_trabajadores($condicion = ""){
		try {
			$query = $this->dbh->prepare("

				SELECT
				PER.solucion id_opcion,
				OPT.nombre Opcion,
				PER.id_segmento,
				SEG.nombre Segmento,
				PER.id_trabajador,
				TRA.nombre Trabajador,
				EMP.id id_empresa,
				EMP.nombre Empresa
				FROM grw_tuc_p2b_sol_perfilado PER
				INNER JOIN grw_tuc_segmentaciones_opciones OPT ON OPT.id = PER.solucion && OPT.inactivo = 0 && OPT.eliminado = 0
				INNER JOIN grw_tuc_segmentaciones SEG ON SEG.id = PER.id_segmento && SEG.inactivo = 0 && SEG.eliminado = 0
				INNER JOIN zoom_users TRA ON TRA.id = PER.id_trabajador && TRA.inactivo = 0 && TRA.eliminado = 0
				INNER JOIN olc_empresas EMP ON EMP.id = TRA.id_empresa && EMP.inactivo = 0 && EMP.eliminado = 0
				INNER JOIN grw_tuc_p2b_asignaciones ASIG ON ASIG.id = PER.id_asignacion && ASIG.inactivo = 0 && ASIG.eliminado = 0

				WHERE PER.inactivo = 0 && PER.eliminado = 0 $condicion
				ORDER BY Segmento ASC
			");

			$query->execute();
			if($query->rowCount() != 0)	{
				return $query->fetchAll();
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_data_personas_empresas($condAnswers = "", $condSegm = ""){

		$data = [];

		if($segmentos =  $this->get_segmentos_trabajadores($condSegm));

		$segmentos_ord = [];
		$cond_tra = "";
		foreach ($segmentos as $key => $segmento) {
			$segmentos_ord[$segmento["id_trabajador"]][] = $segmento;
			if($segmento["id_trabajador"]){
				if($cond_tra != "") $cond_tra .= " || ";
				$cond_tra .= " TRA.id = ".$segmento["id_trabajador"]. " ";
			}
		}
		$cond_tra = ' AND ('.$cond_tra.') ';

		if($respuestas =  $this->get_answers_personas_empresas($cond_tra.$condAnswers)){

			// echo '<script>console.log('.$cond_tra.$condAnswers.');</script>';
			// echo '<script>console.log('.$cond_tra.');</script>';

			foreach ($respuestas as $key => $respuesta) {
				$data["categorias"][$respuesta["id_categoria"]]["id"] 													= $respuesta["id_categoria"];
				$data["categorias"][$respuesta["id_categoria"]]["nombre"] 												= $respuesta["Categoria"];
				$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["id"] 		= $respuesta["id_competencia"];
				$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["nombre"]	= $respuesta["Competencia"];
				$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["comportamientos"][$respuesta["id_comportamiento"]]["id"] 		= $respuesta["id_comportamiento"];
				$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["comportamientos"][$respuesta["id_comportamiento"]]["nombre"] 		= $respuesta["Comportamiento"];

				$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["comportamientos"][$respuesta["id_comportamiento"]]["soluciones"][1]["respuestas"][] = $respuesta["solucion"];
				$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["comportamientos"][$respuesta["id_comportamiento"]]["soluciones"][2]["respuestas"][] = $respuesta["solucion2"];

				if(isset($segmentos_ord[$respuesta["id_evaluador"]])){
					foreach ($segmentos_ord[$respuesta["id_evaluador"]] as $key2 => $segmento) {
						$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["comportamientos"][$respuesta["id_comportamiento"]]["soluciones"]["segmentos"][$segmento["id_segmento"]]["id"] 	= $segmento["id_segmento"];
						$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["comportamientos"][$respuesta["id_comportamiento"]]["soluciones"]["segmentos"][$segmento["id_segmento"]]["nombre"] = $segmento["Segmento"];
						$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["comportamientos"][$respuesta["id_comportamiento"]]["soluciones"]["segmentos"][$segmento["id_segmento"]]["opciones"][$segmento["id_opcion"]]["id"] 	= $segmento["id_opcion"];
						$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["comportamientos"][$respuesta["id_comportamiento"]]["soluciones"]["segmentos"][$segmento["id_segmento"]]["opciones"][$segmento["id_opcion"]]["nombre"] 	= $segmento["Opcion"];
						$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["comportamientos"][$respuesta["id_comportamiento"]]["soluciones"]["segmentos"][$segmento["id_segmento"]]["opciones"][$segmento["id_opcion"]]["soluciones"][1]["respuestas"][] 	= $respuesta["solucion"];
						$data["categorias"][$respuesta["id_categoria"]]["competencias"][$respuesta["id_competencia"]]["comportamientos"][$respuesta["id_comportamiento"]]["soluciones"]["segmentos"][$segmento["id_segmento"]]["opciones"][$segmento["id_opcion"]]["soluciones"][2]["respuestas"][] 	= $respuesta["solucion2"];
					}
				}

			}

		};

		return $data;

	}

	public function get_dataO($condAnswers = "", $condSegm = ""){

		$calculated = [];
		$calc 		= [];

		if($data = $this->get_data_personas_empresas($condAnswers, $condSegm)){

			foreach ($data["categorias"] as $key => $value) {

				$calculated[$key]["id"]  		= $value["id"];
				$calculated[$key]["nombre"]  	= $value["nombre"];


				foreach ($value["competencias"] as $key2 => $value2) {

					$calculated[$key]["competencias"][$key2]["id"]  			= $value2["id"];
					$calculated[$key]["competencias"][$key2]["nombre"]  		= $value2["nombre"];


					foreach ($value2["comportamientos"] as $key3 => $value3) {

						$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["id"]  			= $value3["id"];
						$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["nombre"]		= $value3["nombre"];


						if(isset($value3["soluciones"][1]["respuestas"])){
							foreach($value3["soluciones"][1]["respuestas"] as $key4 => $value4) {
								if(!isset($calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1])){
									$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1]["cantidad"] 		= 0;
									$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1]["sumatoria"] 		= 0;
									$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1]["promedio"] 		= 0;
								}
								$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1]["cantidad"] += 1;
								$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1]["sumatoria"] += $value4;
							}
							if($calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1]["cantidad"] > 0 && $calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1]["sumatoria"] > 0){
								$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1]["promedio"] = $calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1]["sumatoria"]/$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1]["cantidad"];
							}
						}
						if(isset($value3["soluciones"][2]["respuestas"])){
							foreach($value3["soluciones"][2]["respuestas"] as $key4 => $value4) {
								if(!isset($calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2])){
									$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2]["cantidad"] 		= 0;
									$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2]["sumatoria"] 		= 0;
									$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2]["promedio"] 		= 0;
								}
								$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2]["cantidad"] += 1;
								$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2]["sumatoria"] += $value4;
							}
							if($calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2]["cantidad"] > 0 && $calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2]["sumatoria"] > 0){
								$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2]["promedio"] = $calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2]["sumatoria"]/$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2]["cantidad"];
							}
						}

						// segmentos, opciones, soluciones, 1:respuestas, 2: respuestas,
						if(isset($value3["soluciones"]["segmentos"])){
							foreach($value3["soluciones"]["segmentos"] as $key4 => $value4) {
								$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["id"] 		= $value4["id"];
								$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["nombre"] 	= $value4["nombre"];

								if(isset($value4["opciones"])){
									foreach($value4["opciones"] as $key5 => $value5) {
										$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["id"] 		= $value5["id"];
										$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["nombre"] 	= $value5["nombre"];

										if(isset($value5["soluciones"][1]["respuestas"])){
											foreach($value5["soluciones"][1]["respuestas"] as $key6 => $value6) {
												if(!isset($calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][1])){
													$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][1]["cantidad"]	= 0;
													$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][1]["sumatoria"] 	= 0;
													$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][1]["promedio"]	= 0;
												}
												$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][1]["cantidad"] += 1;
												$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][1]["sumatoria"] += $value6;
											}
											if($calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][1]["cantidad"] > 0 && $calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][1]["sumatoria"] > 0){
												$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][1]["promedio"] = $calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][1]["sumatoria"]/$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][1]["cantidad"];
											}
										}
										if(isset($value5["soluciones"][2]["respuestas"])){
											foreach($value5["soluciones"][2]["respuestas"] as $key6 => $value6) {
												if(!isset($calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][2])){
													$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][2]["cantidad"]	= 0;
													$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][2]["sumatoria"] 	= 0;
													$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][2]["promedio"]	= 0;
												}
												$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][2]["cantidad"] += 1;
												$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][2]["sumatoria"] += $value6;
											}
											if($calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][2]["cantidad"] > 0 && $calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][2]["sumatoria"] > 0){
												$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][2]["promedio"] = $calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][2]["sumatoria"]/$calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["segmentos"][$key4]["opciones"][$key5]["calculos"][2]["cantidad"];
											}
										}

									}
								}


							}

						}

						if(!isset($calculated[$key]["competencias"][$key2]["calculos"][1])){
							$calculated[$key]["competencias"][$key2]["calculos"][1]["cantidad"]		= 0;
							$calculated[$key]["competencias"][$key2]["calculos"][1]["sumatoria"]	= 0;
							$calculated[$key]["competencias"][$key2]["calculos"][1]["promedio"]		= 0;
						}
						$calculated[$key]["competencias"][$key2]["calculos"][1]["cantidad"] += 1;
						$calculated[$key]["competencias"][$key2]["calculos"][1]["sumatoria"] += $calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][1]["promedio"];

						if(!isset($calculated[$key]["competencias"][$key2]["calculos"][2])){
							$calculated[$key]["competencias"][$key2]["calculos"][2]["cantidad"]		= 0;
							$calculated[$key]["competencias"][$key2]["calculos"][2]["sumatoria"]	= 0;
							$calculated[$key]["competencias"][$key2]["calculos"][2]["promedio"]		= 0;
						}
						$calculated[$key]["competencias"][$key2]["calculos"][2]["cantidad"] += 1;
						$calculated[$key]["competencias"][$key2]["calculos"][2]["sumatoria"] += $calculated[$key]["competencias"][$key2]["comportamientos"][$key3]["calculos"][2]["promedio"];


					}

					if($calculated[$key]["competencias"][$key2]["calculos"][1]["cantidad"] > 0 && $calculated[$key]["competencias"][$key2]["calculos"][1]["sumatoria"] > 0){
						$calculated[$key]["competencias"][$key2]["calculos"][1]["promedio"] = $calculated[$key]["competencias"][$key2]["calculos"][1]["sumatoria"]/$calculated[$key]["competencias"][$key2]["calculos"][1]["cantidad"];
					}

					if(!isset($calculated[$key]["calculos"][1])){
						$calculated[$key]["calculos"][1]["cantidad"] 		= 0;
						$calculated[$key]["calculos"][1]["sumatoria"] 		= 0;
						$calculated[$key]["calculos"][1]["promedio"] 		= 0;
					}
					$calculated[$key]["calculos"][1]["cantidad"] += 1;
					$calculated[$key]["calculos"][1]["sumatoria"] += $calculated[$key]["competencias"][$key2]["calculos"][1]["promedio"];

					if($calculated[$key]["competencias"][$key2]["calculos"][2]["cantidad"] > 0 && $calculated[$key]["competencias"][$key2]["calculos"][2]["sumatoria"] > 0){
						$calculated[$key]["competencias"][$key2]["calculos"][2]["promedio"] = $calculated[$key]["competencias"][$key2]["calculos"][2]["sumatoria"]/$calculated[$key]["competencias"][$key2]["calculos"][2]["cantidad"];
					}

					if(!isset($calculated[$key]["calculos"][2])){
						$calculated[$key]["calculos"][2]["cantidad"] 		= 0;
						$calculated[$key]["calculos"][2]["sumatoria"] 		= 0;
						$calculated[$key]["calculos"][2]["promedio"] 		= 0;
					}
					$calculated[$key]["calculos"][2]["cantidad"] += 1;
					$calculated[$key]["calculos"][2]["sumatoria"] += $calculated[$key]["competencias"][$key2]["calculos"][2]["promedio"];

				}

				if($calculated[$key]["calculos"][1]["cantidad"] > 0 && $calculated[$key]["calculos"][1]["sumatoria"] > 0){
					$calculated[$key]["calculos"][1]["promedio"] = $calculated[$key]["calculos"][1]["sumatoria"]/$calculated[$key]["calculos"][1]["cantidad"];
				}
				if($calculated[$key]["calculos"][2]["cantidad"] > 0 && $calculated[$key]["calculos"][2]["sumatoria"] > 0){
					$calculated[$key]["calculos"][2]["promedio"] = $calculated[$key]["calculos"][2]["sumatoria"]/$calculated[$key]["calculos"][2]["cantidad"];
				}

				if(!isset($calc["calculos"])){
					$calc["calculos"][1]["cantidad"] 		= 0;
					$calc["calculos"][1]["sumatoria"] 		= 0;
					$calc["calculos"][1]["promedio"] 		= 0;
					$calc["calculos"][2]["cantidad"] 		= 0;
					$calc["calculos"][2]["sumatoria"] 		= 0;
					$calc["calculos"][2]["promedio"] 		= 0;
				}

				$calc["calculos"][1]["cantidad"] += 1;
				$calc["calculos"][1]["sumatoria"] += $calculated[$key]["calculos"][1]["promedio"];
				$calc["calculos"][2]["cantidad"] += 1;
				$calc["calculos"][2]["sumatoria"] += $calculated[$key]["calculos"][2]["promedio"];

				echo '<script>console.log('.$calc["calculos"][1]["cantidad"].' +" --- "+ '.$calc["calculos"][1]["sumatoria"].');</script>';

			}

			if($calc["calculos"][1]["cantidad"] > 0 && $calc["calculos"][1]["sumatoria"] > 0){
				$calc["calculos"][1]["promedio"] = $calc["calculos"][1]["sumatoria"]/$calc["calculos"][1]["cantidad"];
			}
			if($calc["calculos"][2]["cantidad"] > 0 && $calc["calculos"][2]["sumatoria"] > 0){
				$calc["calculos"][2]["promedio"] = $calc["calculos"][2]["sumatoria"]/$calc["calculos"][2]["cantidad"];
			}

		}



		return [$calc, $calculated];

	}

	public function reorder_array($array, $campo){
		try {

			$temp = [];
			foreach ($array as $key => $value) $temp[$value[$campo]] = $value;
			return $temp;

		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

}