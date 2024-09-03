<?php
	require_once 'connect/conexionCampai.php';
	require_once 'class.inputfilter.php';

	$iFilter = new InputFilterion();

	class Campai{

		public static $instancia;
		public $dbh;
		public $iFilter;

		public function __construct(){
			$this->dbh     = ConexionCampai::singleton_conexion();
			$this->iFilter = new InputFilterion();
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

	}

?>