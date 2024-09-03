<?php

require_once 'connect/conexion.php';
require_once 'class.inputfilter.php';

$iFilter = new InputFilterion();

class Zoom{

	public static $instancia;
	public $dbh;
	public $iFilter;

	public function __construct(){
		$this->dbh     = Conexion::singleton_conexion();
		$this->iFilter = new InputFilterion();
	}

	public function RUN_SQL ( $TextQuery , $ReturnRecord = false ) {
		try {

			if(!$TextQuery) return 0;

			$query = $this->dbh->prepare($TextQuery);
			$query->execute();

			if($query->rowCount() != 0)	{
				if ( $ReturnRecord === false ) return $query->fetchAll();
				return $query->fetch();
			}else {
				return 0;
			}

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
				$query   = $this->dbh->prepare("SHOW COLUMNS FROM $tabla");
				$query->execute();
				$campos = $query->fetchAll();
				foreach($array as $key => $data){
					if($data != '' && $key != 'id'){
						foreach($campos as $campo_key => $campo_data){
							$existe = array_search($key, $campo_data);
							if($existe) {
								if($campo_data[1]== "text")		$array_2[$key] = (($data));
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
									if($campo_data[1]== "longtext" || $campo_data[1]== "text")	$array[$key] = (($data));
									else  														$array[$key] = $this->iFilter->process(($data));
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

	public function order_id_array($array){
		try {

			if(!$array) return 0;

			$temp = [];
			foreach ($array as $key => $value) $temp[$value["id"]] = $value;
			return $temp;

		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function order_array_by($array, $campo){
		try {

			if(!$array) return 0;

			$temp = [];
			foreach ($array as $key => $value) $temp[$value[$campo]] = $value;
			return $temp;

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


	###############################################################################
	### UTILS
	###############################################################################

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
		return "$".number_format($valor, 0, '.', ',');
	}

	function moneda_sin_decimal($valor){
		return number_format($valor, 0, '.', ',');
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

	public function verMes($mes){
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

	public function esEmail($email){
		$matches = null;
		return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $email, $matches));
	}

	public function interactividad_estado($id, $trabajador){

		$_return = array(
			"estado"		=> array(),
			"inter"			=> 0,
			"status_0"		=> 0,
			"status_1"		=> 0,
			"status_2"		=> 0,
		);


		if($inter = $this->get_data('grw_lel_dinamicas', ' AND id = '.$id.' AND inactivo = 0 AND eliminado = 0', 0)){

			$_return["interactividades"][$inter["id"]] = array(
				"id" 			=> $inter["id"],
				"nombre"		=> $inter["nombre"],
				"preg_totales"	=> 0,
				"resp_totales"	=> 0,
				"status"		=> 0,
			);

			$getPreguntas = $this->get_data('grw_lel_preguntas', ' AND id_dinamica = '.$inter["id"].' AND inactivo = 0 AND eliminado = 0', 1);
			if ($getPreguntas) {
				foreach ($getPreguntas as $pre) {
					$_return["interactividades"][$inter["id"]]["preguntas"][$pre["id"]] = array(
						"id" 		=> $pre["id"],
						"nombre"	=> $pre["nombre"],
						"resp_cont"	=> 0,
					);
					$respuestas = $this->get_data("grw_sol_act_encuestas", "AND id_pregunta = " . $pre["id"] . " AND id_trabajador = " . $trabajador . " AND eliminado = 0 ORDER BY id DESC ", 1);
					if ($respuestas) {
						foreach ($respuestas as $res) {
							$_return["interactividades"][$inter["id"]]["preguntas"][$pre["id"]]["respuestas"][$res["id"]] = array(
								"id" => $res["id"],
							);
							$_return["interactividades"][$inter["id"]]["preguntas"][$pre["id"]]["resp_cont"] += 1;
						}
					}
					$_return["interactividades"][$inter["id"]]["preg_totales"] += 1;
					$_return["interactividades"][$inter["id"]]["resp_totales"] += $_return["interactividades"][$inter["id"]]["preguntas"][$pre["id"]]["resp_cont"];

				}

				if($_return["interactividades"][$inter["id"]]["resp_totales"] == 0){
					$_return["interactividades"][$inter["id"]]["status"] = 0;
					$_return["status_0"] += 1;
				}else if($_return["interactividades"][$inter["id"]]["resp_totales"] < $_return["interactividades"][$inter["id"]]["preg_totales"]){
					$_return["interactividades"][$inter["id"]]["status"] = 2;
					$_return["status_2"] += 1;
				}else{
					$_return["interactividades"][$inter["id"]]["status"] = 1;
					$_return["status_1"] += 1;
				}

			}

			$inter = $_return["status_0"]+$_return["status_1"]+$_return["status_2"];
			$_return["inter"] = $inter;

			if($inter == $_return["status_0"]){
				$_return["estado"]["id"] 	= 0;
				$_return["estado"]["text"] 	= "Pendiente";
			}else if($inter == $_return["status_1"]){
				$_return["estado"]["id"] 	= 1;
				$_return["estado"]["text"] 	= "Finalizado";
			}else{
				$_return["estado"]["id"] 	= 2;
				$_return["estado"]["text"] 	= "Incompleto";
			}

			return $_return;

		} else return 0;

	}

	public function validaInteractividad($actividad, $trabajador){

		$_return = array(
			"estado"		=> array(),
			"inter"			=> 0,
			"status_0"		=> 0,
			"status_1"		=> 0,
			"status_2"		=> 0,
		);

		$interactividades = $this->get_data('grw_lel_dinamicas', ' AND id_actividad = '.$actividad.' AND inactivo = 0 AND eliminado = 0', 1);
		if($interactividades){
			foreach ($interactividades as $key => $inter) {

				$_return["interactividades"][$inter["id"]] = array(
					"id" 			=> $inter["id"],
					"nombre"		=> $inter["nombre"],
					"preg_totales"	=> 0,
					"resp_totales"	=> 0,
					"status"		=> 0,
				);

				$getPreguntas = $this->get_data('grw_lel_preguntas', ' AND id_dinamica = '.$inter["id"].' AND inactivo = 0 AND eliminado = 0', 1);
				if ($getPreguntas) {
					foreach ($getPreguntas as $pre) {
						$_return["interactividades"][$inter["id"]]["preguntas"][$pre["id"]] = array(
							"id" 		=> $pre["id"],
							"nombre"	=> $pre["nombre"],
							"resp_cont"	=> 0,
						);
						$respuestas = $this->get_data("grw_sol_act_encuestas", "AND id_pregunta = " . $pre["id"] . " AND id_trabajador = " . $trabajador . " AND eliminado = 0 ORDER BY id DESC ", 1);
						if ($respuestas) {
							foreach ($respuestas as $res) {
								$_return["interactividades"][$inter["id"]]["preguntas"][$pre["id"]]["respuestas"][$res["id"]] = array(
									"id" => $res["id"],
								);
								$_return["interactividades"][$inter["id"]]["preguntas"][$pre["id"]]["resp_cont"] += 1;
							}
						}
						$_return["interactividades"][$inter["id"]]["preg_totales"] += 1;
						$_return["interactividades"][$inter["id"]]["resp_totales"] += $_return["interactividades"][$inter["id"]]["preguntas"][$pre["id"]]["resp_cont"];

					}

					if($_return["interactividades"][$inter["id"]]["resp_totales"] == 0){
						$_return["interactividades"][$inter["id"]]["status"] = 0;
						$_return["status_0"] += 1;
					}else if($_return["interactividades"][$inter["id"]]["resp_totales"] < $_return["interactividades"][$inter["id"]]["preg_totales"]){
						$_return["interactividades"][$inter["id"]]["status"] = 2;
						$_return["status_2"] += 1;
					}else{
						$_return["interactividades"][$inter["id"]]["status"] = 1;
						$_return["status_1"] += 1;
					}
				}
			}

			$inter = $_return["status_0"]+$_return["status_1"]+$_return["status_2"];
			$_return["inter"] = $inter;

			if($inter == $_return["status_0"]){
				$_return["estado"]["id"] 	= 0;
				$_return["estado"]["text"] 	= "Pendiente";
			}else if($inter == $_return["status_1"]){
				$_return["estado"]["id"] 	= 1;
				$_return["estado"]["text"] 	= "Finalizado";
			}else{
				$_return["estado"]["id"] 	= 2;
				$_return["estado"]["text"] 	= "Incompleto";
			}

			return $_return;

		} else return 0;

	}

	public function obtenerRespuestas($pregunta, $tipo, $modo, $parametro){

		$_return = array();

		$respuestasP = $this->get_data("grw_lel_respuestas", " AND id_pregunta = " . $pregunta. " AND eliminado = 0 ORDER BY prioridad ASC, id ASC ", 1);
		if ($respuestasP) {
			foreach ($respuestasP as $res) {
				$_return["respuestas"][$res["id"]] = array(
					"id" 		=> $res["id"],
					"nombre" 	=> $res["nombre"],
					"correcta" 	=> $res["correcta"],
					"modo" 		=> $modo,
				);
			}
		}


		if($parametro == 0) $soluciones = $this->get_data("grw_sol_act_encuestas", "AND id_pregunta = ".$pregunta." AND eliminado = 0 ORDER BY id DESC ", 1);
		else				$soluciones = $this->get_respuestas_parametro(" AND sol.id_pregunta = ".$pregunta." ", 1, $parametro);
		if ($soluciones) {
			$_return["soluciones_totales"] = 0;
			$_return["tipo"] = $tipo;
			$_return["modo"] = $modo;
			foreach ($soluciones as $sol) {

				if($tipo == 1){
					if($modo == 1){

						if(!isset($_return["soluciones"][$sol["id_respuesta"]])) $_return["soluciones"][$sol["id_respuesta"]] = 0;
						$_return["soluciones"][$sol["id_respuesta"]] += 1;
						$_return["soluciones_totales"] += 1;

					}else if($modo == 2){

						if($sol["id_respuesta_multiple"] != ""){
							$ids = explode(",", $sol["id_respuesta_multiple"]);
							foreach($ids AS $id){
								if(!isset($_return["soluciones"][$id])) $_return["soluciones"][$id] = 0;
								$_return["soluciones"][$id] += 1;
							}
							$_return["soluciones_totales"] += 1;
						}

					}
				}else if($tipo == 2){
					if($modo == 3){

						if(!isset($_return["soluciones"][$sol["id_respuesta"]])) $_return["soluciones"][$sol["id_respuesta"]] = 0;
						$_return["soluciones"][$sol["id_respuesta"]] += 1;
						$_return["soluciones_totales"] += 1;

					}else if($modo == 4){

						if($sol["id_respuesta_multiple"] != ""){
							$ids = explode(",", $sol["id_respuesta_multiple"]);
							foreach($ids AS $id){
								if(!isset($_return["soluciones"][$id])) $_return["soluciones"][$id] = 0;
								$_return["soluciones"][$id] += 1;
							}
							$_return["soluciones_totales"] += 1;
						}

					}else if($modo == 5){

						if(!isset($_return["soluciones"])) $_return["soluciones"] = $sol["respuesta"];
						else $_return["soluciones"] .= "|".$sol["respuesta"];
						$_return["soluciones_totales"] += 1;

					}
				}

			}

			return $_return;

		} else return 0;

	}

	public function get_respuestas_parametro($condicion, $fetchAll, $parametro){
		try {
			$query = $this->dbh->prepare("
				SELECT sol.*
				FROM grw_sol_act_encuestas AS sol
				INNER JOIN grw_sol_seg_perfilado AS perfil ON perfil.id_trabajador = sol.id_trabajador && perfil.id_opcion = $parametro
				WHERE 1=1 $condicion
				ORDER BY sol.id
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

	public function obtenerRespuestasEncuestaAnonima($pregunta, $tipo, $modo, $parametro, $investigacion, $encuesta){

		$_return = array();

		$respuestasP = $this->get_data("grw_val_respuestas", " AND id_pregunta = " . $pregunta. " AND eliminado = 0 ORDER BY prioridad ASC, id ASC ", 1);
		if ($respuestasP) {
			foreach ($respuestasP as $res) {
				$_return["respuestas"][$res["id"]] = array(
					"id" 		=> $res["id"],
					"nombre" 	=> $res["nombre"],
					"valor" 	=> $res["valor"],
					"icono" 	=> $res["icono"],
					"correcta" 	=> $res["correcta"],
					"modo" 		=> $modo,
				);
			}
		}

		$soluciones = $this->get_data("grw_sol_val_anonima", " AND id_encuesta = '".$encuesta."' AND id_investigacion = $investigacion AND id_pregunta = ".$pregunta." AND eliminado = 0 ORDER BY id DESC ", 1);

		if ($soluciones) {
			$_return["soluciones_totales"] = 0;
			$_return["tipo"] = $tipo;
			$_return["modo"] = $modo;
			foreach ($soluciones as $sol) {

				if($tipo == 2){
					if($modo == 3){

						if(!isset($_return["soluciones"][$sol["id_respuesta"]])) $_return["soluciones"][$sol["id_respuesta"]] = 0;
						$_return["soluciones"][$sol["id_respuesta"]] += 1;
						$_return["soluciones_totales"] += 1;

					}else if($modo == 4){

						if($sol["id_respuesta_multiple"] != ""){
							$ids = explode(",", $sol["id_respuesta_multiple"]);
							foreach($ids AS $id){
								if(!isset($_return["soluciones"][$id])) $_return["soluciones"][$id] = 0;
								$_return["soluciones"][$id] += 1;
							}
							$_return["soluciones_totales"] += 1;
						}

					}else if($modo == 5){

						if(!isset($_return["soluciones"])) $_return["soluciones"] = $sol["respuesta"];
						else $_return["soluciones"] .= "|".$sol["respuesta"];
						$_return["soluciones_totales"] += 1;

					}
				}

			}

			return $_return;

		} else return 0;

	}

	public function obtenerRespuestasEncuestaListadoExterno($pregunta, $tipo, $modo, $parametro, $investigacion, $encuesta){

		$_return = array();

		$respuestasP = $this->get_data("grw_val_respuestas", " AND id_pregunta = " . $pregunta. " AND eliminado = 0 ORDER BY prioridad ASC, id ASC ", 1);
		if ($respuestasP) {
			foreach ($respuestasP as $res) {
				$_return["respuestas"][$res["id"]] = array(
					"id" 		=> $res["id"],
					"nombre" 	=> $res["nombre"],
					"valor" 	=> $res["valor"],
					"icono" 	=> $res["icono"],
					"correcta" 	=> $res["correcta"],
					"modo" 		=> $modo,
				);
			}
		}

		if($asignaciones = $this->get_data("grw_val_asignaciones", " AND id_encuesta = '".$encuesta."' AND id_investigacion = $investigacion AND completado = 1 AND eliminado = 0 ORDER BY id DESC ", 1)){

			$_return["soluciones_totales"] = 0;
			$_return["tipo"] = $tipo;
			$_return["modo"] = $modo;

			foreach ($asignaciones as $asignacion) {

				if ($solucion = $this->get_data("grw_sol_val_listaexterna", " AND id_asignacion = ".$asignacion["id"]." AND id_pregunta = '".$pregunta."' AND eliminado = 0 ORDER BY id ASC ", 0)) {



					// foreach ($soluciones as $sol) {

					$sol = $solucion;

					if($tipo == 2){

						if($modo == 3){

							if(!isset($_return["soluciones"][$sol["id_respuesta"]])) $_return["soluciones"][$sol["id_respuesta"]] = 0;
							$_return["soluciones"][$sol["id_respuesta"]] += 1;
							$_return["soluciones_totales"] += 1;

						}else if($modo == 4){

							if($sol["id_respuesta_multiple"] != ""){
								$ids = explode(",", $sol["id_respuesta_multiple"]);
								foreach($ids AS $id){
									if(!isset($_return["soluciones"][$id])) $_return["soluciones"][$id] = 0;
									$_return["soluciones"][$id] += 1;
								}
								$_return["soluciones_totales"] += 1;
							}

						}else if($modo == 5){

							if(!isset($_return["soluciones"])) $_return["soluciones"] = $sol["respuesta"];
							else $_return["soluciones"] .= "|".$sol["respuesta"];
							$_return["soluciones_totales"] += 1;

						}

					}

				}

			}

			return $_return;

		} else return 0;

	}

}