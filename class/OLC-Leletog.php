<?php

require_once 'OLC.php';
require_once $_SESSION['_CLASS'] . 'OLC-Workers.php';

class Lele {

	public $ZOOM;
	public $CARGOS;
	public $PERFILES;
	public $PERFILES_OP;
	public $PLANA;
	public $WORKERS;

	public function __construct(){
		$this->ZOOM = new Zoom();
		$this->WORKERS = new Workers();
		if(isset($_SESSION["COMPANY"]["id"])){
			$this->CARGOS 		= $this->set_cargos($_SESSION["COMPANY"]["id"]);
			$this->PERFILES 	= $this->set_perfiles($_SESSION["COMPANY"]["id"]);
			$this->PERFILES_OP	= $this->set_perfiles_op($_SESSION["COMPANY"]["id"]);
			$this->PLANA 		= array();
		}
	}

//------------------------------------------------------------------------------------------------------------------------------------------------------------

	public function ReportACT ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {


		$Encuestas      = [];
		$Investigativas = [];
		$Evaluativas    = $this->InfoEncuestasEvaluativas( $AddToQuery, $ParametersToQuery, $ReturnRecord );

		// $Investigativas = $this->InfoEncuestasInvestigativas( $AddToQuery, $ParametersToQuery, $ReturnRecord );

		if ( $Investigativas  &&  $Evaluativas )  $Encuestas  = array_merge($Investigativas, $Evaluativas) ;
		if ( $Investigativas  &&  !$Evaluativas ) $Encuestas  = $Investigativas ;
		if ( !$Investigativas &&  $Evaluativas )  $Encuestas  = $Evaluativas  ;

		$MyACT = [
			'Encuestas'       => $Encuestas,
			// 'Reconocimientos' => $this->InfoReconocimientos( $AddToQuery, $ParametersToQuery, $ReturnRecord ),
			'Reconocimientos' => 0,
			// 'Campanias'       => $this->InfoCampanias( $AddToQuery, $ParametersToQuery, $ReturnRecord )
			'Campanias'       => 0,
		];
		if(!$MyACT['Encuestas'] && !$MyACT['Reconocimientos']   && !$MyACT['Campanias']) return 0;

		$MySolutions ['Encuestas'] = $MyACT['Encuestas'] ? $this->ReporteEncuestasSoluciones( $ParametersToQuery['QuerySolutions'], $ReturnRecord ) : 0;

		return BuildStructureACT ($MyACT, $MySolutions);

	}

	public function InfoEncuestasInvestigativas ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
		$TextSQL = SqlTextEncuestasInvestigativas( $AddToQuery);
		return $this->ZOOM->RUN_SQL ( $TextSQL, $ReturnRecord );
	}

	public function InfoEncuestasEvaluativas ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
		$TextSQL = SqlTextEncuestasEvaluativas( $AddToQuery);
		return $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
	}

	public function InfoReconocimientos ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
		$TextSQL = SqlTextReconocimientos ( $AddToQuery );
		return $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
	}

	public function InfoCampanias ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
		$TextSQL = SqlTextCampanias ( $AddToQuery );
		return $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
	}

	public function ReporteEncuestasSoluciones ( $QuerySolutions, $ReturnRecord = false ) {
		$TextSQL  = "SELECT
				ACT.uuid AS actividad_uuid,
				SOLUC.id AS soluc_id, SOLUC.uuid AS soluc_uuid, SOLUC.id_trabajador AS soluc_idtrabajador, SOLUC.id_respuesta AS soluc_idrespuesta, SOLUC.id_respuesta_multiple AS soluc_resp_multiple, SOLUC.respuesta AS soluc_respuesta, SOLUC.inactivo AS 	soluc_inactivo,
				SOLUC.fecha AS soluc_fecha, SOLUC.id_pregunta AS soluc_id_pregunta, 	SOLUC.id_actividad, 	SOLUC.id_dinamica,
				IFNULL (( SELECT nombre FROM grw_lel_respuestas WHERE id = SOLUC.id_respuesta ), '' ) AS soluc_nom_respuesta,
				USERS.id AS user_id, USERS.uuid AS user_uuid, USERS.id_jefe AS user_id_jefe, USERS.id_cargo AS user_id_cargo, USERS.identificacion AS user_identificacion,  USERS.nombres AS user_nombre,
				USERS.apellidos AS user_apellidos, USERS.email AS user_email, USERS.inactivo AS user_inactivo, USERS.fecha AS user_fecha, SGMNTCNES.id AS sgmntaciones_id, SGMNTCNES.uuid AS sgmntaciones_uiid,
				SGMNTCNES.nombre AS sgmntaciones_nombre, SGMNTCNES.inactivo AS sgmntaciones_inactivo, SGMNTCNES.fecha AS sgmntaciones_fecha, USER_SEGM.id AS resp_user_sgmnto_id, USER_SEGM.uuid AS resp_user_sgmnto_uuid,
				USER_SEGM.id_parametro AS resp_user_sgmnto_id_param, USER_SEGM.id_opcion AS resp_user_sgmnto_id_opcion,
				IFNULL (( SELECT nombre FROM grw_segmentaciones WHERE grw_segmentaciones.id = USER_SEGM.id_parametro ), '' ) AS resp_user_sgmnto_nombre,
				IFNULL (( SELECT nombre FROM grw_segmentos WHERE grw_segmentos.id = USER_SEGM.id_opcion ), '' ) AS resp_user_opcion_nombre,
				USER_SEGM.inactivo AS resp_user_sgmnto_inactivo, USER_SEGM.fecha AS resp_user_sgmnto_fecha, SGMNTO_OPCIONES.id AS sgmnto_opc_id, SGMNTO_OPCIONES.uuid AS sgmnto_opc_uuid, SGMNTO_OPCIONES.nombre AS sgmnto_opc_nombre,
				SGMNTO_OPCIONES.inactivo AS sgmnto_opc_inactivo, SGMNTO_OPCIONES.fecha AS sgmnto_opc_fecha
				FROM
					grw_sol_act_encuestas AS SOLUC
					INNER JOIN grw_lel_actividades AS ACT ON SOLUC.id_actividad = ACT.id
					INNER JOIN zoom_users AS USERS ON SOLUC.id_trabajador = USERS.id
					INNER JOIN grw_sol_seg_perfilado AS USER_SEGM ON USERS.id = USER_SEGM.id_trabajador
					INNER JOIN grw_segmentaciones AS SGMNTCNES ON USER_SEGM.id_parametro = SGMNTCNES.id
					INNER JOIN grw_segmentos AS SGMNTO_OPCIONES ON SGMNTCNES.id = SGMNTO_OPCIONES.id_parametro
			WHERE
				SOLUC.eliminado = 0  AND USERS.eliminado = 0  AND USER_SEGM.eliminado = 0
				AND SGMNTCNES.eliminado = 0  AND SGMNTO_OPCIONES.eliminado = 0
				$QuerySolutions";

		return $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );

 	}

//------------------------------------------------------------------------------------------------------------------------------------------------------------

	public function GetPreguntas ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
		$TextSQL  = "SELECT PREGS.id AS preg_id, PREGS.uuid AS preg_uuid, PREGS.id_dinamica AS preg_id_dinamica, PREGS.nombre AS preg_nombre, PREGS.prioridad AS preg_prioridad, PREGS.inactivo AS preg_inactivo,
						PREGS.fecha AS preg_fecha, olc_preguntas_tipos.id as preg_tipo_id, olc_preguntas_tipos.uuid  as preg_tipo_uiid,
						olc_preguntas_tipos.nombre  as preg_tipo_nombre
					FROM
						grw_lel_preguntas AS PREGS 	INNER JOIN 	olc_preguntas_tipos ON  PREGS.id_modo = olc_preguntas_tipos.id
					WHERE
						PREGS.eliminado = 0  $AddToQuery  " ;

		return $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
	}

	public function GetCategorias ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
		$TextSQL  = "SELECT CATEG.id,  CATEG.uuid,  CATEG.id_empresa,  CATEG.nombre,  CATEG.inactivo, CATEG.fecha
						FROM grw_lel_categorias AS CATEG
						WHERE CATEG.eliminado = 0  $AddToQuery ";
		$Response = $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
		return  DataStructure ('CategoriasLeletog', $Response, $ReturnRecord);
	}

	public function GetReconocimientos ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
		$TextSQL  = "SELECT  RECONOC.id,  RECONOC.uuid,  RECONOC.id_empresa,  RECONOC.nombre,  RECONOC.forma,  RECONOC.color,  RECONOC.icono,  RECONOC.inactivo, RECONOC.fecha
					FROM  grw_reconocimientos AS RECONOC
					WHERE RECONOC.eliminado = 0  $AddToQuery ";
		$Response = $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
		return  DataStructure ('ReconocimientosLeletog', $Response, $ReturnRecord);
	}

	public function GetInterActividades ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
		$TextSQL  = "SELECT  ACTIV_MODELOS.id,  ACTIV_MODELOS.uuid,  ACTIV_MODELOS.id_empresa, 	ACTIV_MODELOS.nombre, ACTIV_MODELOS.inactivo, MODELOS.id AS modelo_id, MODELOS.uuid AS 	modelo_uuid,
						MODELOS.nombre AS modelo_nombre,  MODELOS.inactivo AS modelo_inactivo,  TIPOS.id AS tipo_id,  TIPOS.uuid AS tipo_uuid, TIPOS.nombre AS tipo_nombre, TIPOS.inactivo AS tipo_inactivo ,
						ACTIVI.id AS activi_id, ACTIVI.uuid AS activ_uuid, ACTIVI.nombre AS activ_nombre, ACTIVI.inactivo AS activ_inactivo, CATEG.id AS categ_id, CATEG.uuid AS categ_uuid, CATEG.nombre AS categ_nombre,
						CATEG.inactivo AS categ_inactivo , ACTIV_MODELOS.prioridad
					FROM  grw_lel_dinamicas AS ACTIV_MODELOS
						INNER JOIN olc_modelos_tipos AS TIPOS ON ACTIV_MODELOS.id_tipo = TIPOS.id
						INNER JOIN olc_modelos AS MODELOS ON ACTIV_MODELOS.id_modelo = MODELOS.id
						INNER JOIN grw_lel_actividades AS ACTIVI ON ACTIV_MODELOS.id_actividad = ACTIVI.id
						INNER JOIN grw_lel_categorias AS CATEG ON ACTIVI.id_categoria = CATEG.id
						WHERE ACTIV_MODELOS.eliminado = 0  AND MODELOS.eliminado = 0 AND TIPOS.eliminado = 0  AND ACTIVI.eliminado = 0 AND CATEG.eliminado = 0  $AddToQuery ";
		$Response = $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
		return  DataStructure ('InterActividadesLeletog', $Response, $ReturnRecord);
	}

	public function GetSegmento ($AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
		$TextSQL  = "SELECT OPCIONES.id,  OPCIONES.uuid,  OPCIONES.nombre,  OPCIONES.inactivo,  OPCIONES.id_empresa,
							PARAMETROS.id AS param_id,  PARAMETROS.uuid AS param_uuid,  PARAMETROS.nombre AS param_nombre,
							PARAMETROS.inactivo AS param_inactivo
					FROM
						grw_segmentos AS OPCIONES INNER JOIN grw_segmentaciones AS PARAMETROS
						ON 	OPCIONES.id_parametro = PARAMETROS.id
					WHERE OPCIONES.eliminado = 0 	AND PARAMETROS.eliminado = 0  $AddToQuery ";
		$Response = $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
		return  DataStructure ('SegmentoLeletog', $Response, $ReturnRecord);
	}

	public function GetRespuestasLeletog ($AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
		$TextSQL  = "SELECT RSPTAS.id, RSPTAS.uuid, RSPTAS.nombre, RSPTAS.id_empresa, RSPTAS.correcta, RSPTAS.inactivo,RSPTAS.valor,RSPTAS.prioridad,
						PRGNTAS.id AS pregun_id, PRGNTAS.uuid AS pregun_uuid, PRGNTAS.id_empresa AS pregun_id_empresa, PRGNTAS.nombre AS pregun_nombre, PRGNTAS.inactivo AS pregun_inactivo
					FROM grw_lel_respuestas AS RSPTAS 	INNER JOIN grw_lel_preguntas AS PRGNTAS ON RSPTAS.id_pregunta = PRGNTAS.id
					WHERE  RSPTAS.eliminado = 0 	AND PRGNTAS.eliminado = 0  $AddToQuery ";
		$Response = $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );

		return  DataStructure ('RespuestasLeletog', $Response, $ReturnRecord);
	}

	public function GetPreguntasLeletog ($AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
		$TextSQL  = "SELECT PREG.id, PREG.uuid, PREG.id_empresa, PREG.nombre, PREG.inactivo, RESPU.id AS rspta_id, RESPU.uuid AS rspta_uuid, RESPU.id_pregunta AS rspta_id_pregunta, PREG.id_dinamica, PREG.prioridad ,
			RESPU.nombre AS rspta_nombre, RESPU.correcta AS rspta_correcta, RESPU.inactivo AS rspta_inactivo,
							TIPO.id AS tipo_id, TIPO.uuid AS tipo_uuid, TIPO.nombre AS tipo_nombre, TIPO.inactivo AS tipo_inactivo, INTERACTIV.id AS interactiv_id, INTERACTIV.uuid AS interactiv_uuid, INTERACTIV.nombre AS interactiv_nombre, INTERACTIV.inactivo AS interactiv_inactivo,
							ACTIV.id AS activ_id, ACTIV.uuid AS activ_uuid, ACTIV.nombre AS activ_nombre, ACTIV.inactivo AS activ_inactivo, CATEG.id AS categ_id, CATEG.uuid AS categ_uuid, CATEG.nombre AS categ_nombre, CATEG.inactivo AS categ_inactivo, MODELO.id AS modelo_id,
							MODELO.uuid AS modelo_uuid, MODELO.nombre AS modelo_nombre, MODELO.inactivo AS modelo_inactivo,
							MODO.id AS modo_id, MODO.uuid AS modo_uuid, MODO.nombre AS modo_nombre, MODO.inactivo AS modo_inactivo
						FROM
							grw_lel_preguntas AS PREG
							INNER JOIN grw_lel_respuestas AS RESPU ON PREG.id = RESPU.id_pregunta
							INNER JOIN olc_preguntas_tipos AS TIPO ON PREG.id_modo = TIPO.id
							INNER JOIN grw_lel_dinamicas AS INTERACTIV ON PREG.id_dinamica = INTERACTIV.id
							INNER JOIN olc_modelos AS MODELO ON INTERACTIV.id_modelo = MODELO.id
							INNER JOIN grw_lel_actividades AS ACTIV ON INTERACTIV.id_actividad = ACTIV.id
							INNER JOIN grw_lel_categorias AS CATEG ON ACTIV.id_categoria = CATEG.id
							INNER JOIN olc_modelos_tipos AS MODO ON INTERACTIV.id_tipo = MODO.id
						WHERE
							 PREG.eliminado = 0  AND RESPU.eliminado = 0 AND TIPO.eliminado = 0 AND INTERACTIV.eliminado = 0 AND CATEG.eliminado = 0 AND MODELO.eliminado = 0 AND MODO.eliminado = 0  $AddToQuery ";

		$Response = $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
		return  DataStructurePreguntasLeletog (  $Response, $ReturnRecord);
	}

	public function GetActividades ($AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
        $TextSQL  = "SELECT  ACTIV.id, ACTIV.uuid, ACTIV.id_empresa, ACTIV.nombre, ACTIV.inactivo, CATEG.id AS categ_id, CATEG.uuid AS categ_uuid,
			CATEG.id_empresa AS categ_id_empresa, ACTIV.fecha, CATEG.nombre AS categ_nombre, CATEG.inactivo AS categ_inactivo,
			PROCESOS.id AS actprocess_id, PROCESOS.uuid AS actprocess_uuid, PROCESOS.inactivo AS actprocess_inactivo,
			ACTIV.nombre AS actprocess_nombre, PROCESOS.fecha_desde, PROCESOS.fecha_hasta, PROCESOS.visible,PROCESOS.fecha,
			PROCESOS.launch, APPS.id AS app_id, APPS.uuid AS app_uuid, APPS.app AS app_app, APPS.`name` AS app_nombre,
			APPS.inactivo AS app_inactivo, ACTIV.descripcion, PROCESOS.permisos_reporte, PROCESOS.asignaciones_actividad,
			CASE
					WHEN PROCESOS.asignaciones_actividad = 0 THEN 'Nadie'
					WHEN PROCESOS.asignaciones_actividad = 1 THEN 'Todos'
					WHEN PROCESOS.asignaciones_actividad = 2 THEN 'Específico'
					ELSE 'No asignado'
				END AS asignaciones_actividad_nombre,

			CASE
					WHEN PROCESOS.permisos_reporte = 0 THEN 'Nadie'
					WHEN PROCESOS.permisos_reporte = 1 THEN 'Todos'
					WHEN PROCESOS.permisos_reporte = 2 THEN 'Específico'
					ELSE 'No asignado'
				END AS permisos_reporte_nombre


		FROM
			grw_lel_actividades AS ACTIV
			INNER JOIN grw_lel_categorias AS CATEG ON ACTIV.id_categoria = CATEG.id
			INNER JOIN grw_procesos AS PROCESOS ON ACTIV.id = PROCESOS.id_proceso
			INNER JOIN olc_procesos AS TIPOSPROCESO ON PROCESOS.id_proceso_tipo = TIPOSPROCESO.id
			INNER JOIN olc_apps AS APPS ON TIPOSPROCESO.id_app = APPS.id
		WHERE
			PROCESOS.id_proceso_tipo = 3  AND ACTIV.eliminado = 0  AND CATEG.eliminado = 0  AND PROCESOS.eliminado = 0  $AddToQuery ";

		$Response = $this->ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );

		return  DataStructure ('Actividades', $Response, $ReturnRecord);
    }

	public function CompanyHasOrgnigramaPrincipal ( $IdEmpresa, $IsPrincipal ) {
		$TextSQL  = " SELECT id FROM grw_organigramas WHERE id_empresa = $IdEmpresa AND activo = 1";
		$Response =  $this->ZOOM->RUN_SQL( $TextSQL, false );
		if ( $Response  &&  $IsPrincipal ) return true;
		return false ;
	}

//------------------------------------------------------------------------------------------------------------------------------------------------------------

	public function set_perfiles($empresa){
		try {
			$regs = $this->ZOOM->get_data("grw_segmentaciones", " AND ( id_empresa = $empresa) AND inactivo = 0 AND eliminado = 0 ORDER BY id_empresa ASC, nombre ASC ", 1);
			if($regs){
				foreach ($regs as $key => $reg) {
					$setion[$reg["id"]] = array(
						"id" 			=> $reg["id"],
						"nombre" 		=> ($reg["nombre"]),
						"especifico"	=> $reg["id_empresa"],
					);
				}
				return $setion;
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function set_perfiles_op($empresa){
		try {
			$regs = $this->ZOOM->get_data("grw_segmentos", " AND ( id_empresa = $empresa) AND inactivo = 0 AND eliminado = 0 ORDER BY id_empresa ASC, id ASC ", 1);
			if($regs){
				foreach ($regs as $key => $reg) {
					$setion[$reg["id"]] = array(
						"id" 			=> $reg["id"],
						"nombre" 		=> ($reg["nombre"]),
						"parametro"		=> $reg["id_parametro"],
					);
				}
				return $setion;
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function set_cargos($empresa){
		try {
			$cargs = $this->ZOOM->get_data("grw_cargos", " AND id_empresa = $empresa AND inactivo = 0 AND eliminado = 0 ORDER BY nivel ASC ", 1);
			if($cargs){
				foreach ($cargs as $key => $carg) {
					$setion[$carg["id"]] = array(
						"id" 			=> $carg["id"],
						"nombre" 		=> $carg["nombre"],
						"nivel" 		=> $carg["nivel"],
						"padre" 		=> $carg["id_cargo"],
					);
				}
				return $setion;
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}
#---------------------------------------------------------------------------------------------------------------------------

	public function get_red_organization($empresa, $workers){
		try {
			$org = $this->ZOOM->get_data("grw_organigramas", " AND id_empresa = ".$empresa." AND activo = 1 AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
			if($org){
				$cargos = $this->get_red_cargo(" AND id_cargo = -1 ", $empresa, $workers);
				return $cargos;
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_red_cargo($cond, $empresa, $workers){
		try {
			$cargos = $this->ZOOM->get_data("grw_cargos", $cond." AND id_empresa = ".$empresa." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
			if($cargos){
				foreach ($cargos as $key => $cargo) {
					$cargion[$cargo["id"]] = array(
						"id" 			=> $cargo["id"],
						"nombre" 		=> ($cargo["nombre"]),
						"padre" 		=> $cargo["id_cargo"],
					);
					if($workers && ($trabs = $this->get_trabajadores_cargo(" AND id_cargo = '".$cargo["id"]."' ", $empresa, 0))) $cargion[$cargo["id"]]["trabajadores"] = $trabs;
					if($hijos = $this->get_red_cargo(" AND id_cargo = '".$cargo['id']."' ", $empresa, $workers)) $cargion[$cargo["id"]]["hijos"] = $hijos;
				}
				return $cargion;
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_trabajadores_cargo($cond, $empresa){
		try {
			$cargos = $this->ZOOM->get_data("zoom_users", $cond." AND id_empresa = ".$empresa." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
			// $cargos = $this->WORKERS->getCargo( $cond." AND id_empresa = ".$empresa." AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ");

			if($cargos){
				foreach ($cargos as $key => $cargo) {
					$cargion[$cargo["id"]] = $this->get_trabajador($cargo['id']);
				}
				return $cargion;
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_trabajador($id_trabajador){
		try {

			$trabaj = $this->ZOOM->get_data("zoom_users", " AND id = $id_trabajador AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);
			if($trabaj){
				$return = array(
					"id" 			=> $trabaj["id"],
					"nombre" 		=> ($trabaj["nombre"]),
					"identificacion" 		=> ($trabaj["identificacion"]),
					"titulo" 		=> ($trabaj["cargo"]),
					"email" 			=> ($trabaj["email"]),
				);
				return $return;
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

#---------------------------------------------------------------------------------------------------------------------------

	public function load_boss($empresa){
		try {
			$trabajadores = $this->ZOOM->get_data("zoom_users", " AND id_empresa = $empresa AND inactivo = 0 AND eliminado = 0 ORDER BY boss DESC, nombre ASC ", 1);
			if($trabajadores){
				$return = [];
				foreach ($trabajadores as $key => $trabajador) {
					// call functions...
				}
				return $return;
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function load_trabajador($empresa, $id_trabajador, $id_perfilado){
		try {

			if($id_perfilado) {}

			$trabajador = $this->ZOOM->get_data("zoom_users", " AND id_empresa = $empresa AND id = $id_trabajador AND inactivo = 0 AND eliminado = 0 ORDER BY nombre ASC ", 0);

			if($trabajador){
				$return = [];
				$return[$trabajador["id"]] = array(
					"id" 			=> $trabajador["id"],
					"view" 			=> 1,
					"nombre" 		=> ($trabajador["nombre"]),
					"identificacion" 		=> $trabajador["identificacion"],
					"titulo" 		=> ($trabajador["cargo"]),
					"email"			=> ($trabajador["email"]),
				);


				//$rol = $this->ZOOM->get_data("___olc_trabajadores_carg0", " AND id_empresa = $empresa AND id_trabajador = '".$trabajador["id"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 0);

				// $rol = $this->WORKERS->getCargo( " AND id_empresa = $empresa AND id = '".$trabajador["id"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ");

				if($trabajador["id_jefe"] != 0) $return[$trabajador["id"]]["jefe"] = $trabajador["id_jefe"];
				if($trabajador["id_cargo"] != 0) $return[$trabajador["id"]]["cargo"] = $trabajador["id_cargo"];

				if($perfilData = $this->get_perfil($trabajador["id"], $empresa)) $return[$trabajador["id"]]["perfil"] = $perfilData;


				//$colaboradores = $this->ZOOM->get_data("___olc_trabajadores_carg0", " AND id_empresa = $empresa AND id_jefe = '".$trabajador["id"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);
				$colaboradores = $this->ZOOM->get_data("zoom_users", " AND id_empresa = $empresa AND id_jefe = '".$trabajador["id"]."' AND inactivo = 0 AND eliminado = 0 ORDER BY id DESC ", 1);

				if($colaboradores){
					foreach ($colaboradores as $key => $colaborador) {
						if($newTrab = $this->load_trabajador($empresa, $colaborador["id"], $id_perfilado)){
							$return[$trabajador["id"]]["colaboradores"][$colaborador["id"]] = $newTrab[$colaborador["id"]];
						}
					}
				}

				return $return;
			} else return 0;

		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_perfil($trabajador, $empresa){

		try {

			$__PERFILES 	= $this->set_perfiles($empresa);
			$__PERFILES_OP	= $this->set_perfiles_op($empresa);

			$perfiles = $this->ZOOM->get_data("grw_sol_seg_perfilado", " AND id_trabajador = $trabajador AND id_empresa = $empresa AND inactivo = 0 AND eliminado = 0 ", 1);
			if($perfiles){
				foreach ($perfiles as $key => $perfil) {
					$rr[$perfil["id_opcion"]] = array(
						"id_parametro"	=> $perfil["id_parametro"],
						"pregunta"		=> $__PERFILES[$perfil["id_parametro"]]["nombre"],
						"id_opcion"		=> $perfil["id_opcion"],
						"respuesta"		=> $__PERFILES_OP[$perfil["id_opcion"]]["nombre"],
					);
				}

				return $rr;
			} else return 0;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

#---------------------------------------------------------------------------------------------------------------------------

	public function convert_red_list($red){
		try {
			foreach ($red as $key => $value) {
				array_push($this->PLANA, $this->get_one($value));
				if(isset($value["colaboradores"])) $this->convert_red_list($value["colaboradores"]);
			}
			return $this->PLANA;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function get_one($one){
		try {
			$array = array(
				"view"           => $one["view"],
				"id"             => $one["id"],
				"nombre"         => $one["nombre"],
				"identificacion" => $one["identificacion"],
				"titulo"         => $one["titulo"],
				"email"          => $one["email"],
				"lider"          => 0,
			);
			if(isset($one["colaboradores"])) 	$array["lider"]				= 1;
			if(isset($one["jefe"])) 			$array["jefe"]				= $one["jefe"];
			if(isset($one["cargo"])) 			$array["cargo_id"]			= $one["cargo"]["id"];
			if(isset($one["cargo"])) 			$array["cargo_nombre"]		= $one["cargo"]["nombre"];
			if(isset($one["cargo"])) 			$array["cargo_nivel"]		= $one["cargo"]["nivel"];
			if(isset($one["cargo"])) 			$array["cargo_padre"]		= $one["cargo"]["padre"];
			if(isset($one["perfil"])) 			$array["perfil"] 			= $one["perfil"];
			return $array;
		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function plana_order($red_plana){

		try {

			if(isset($red_plana['cargo_nivel'])) {
				$columns = array_column($red_plana, 'cargo_nivel');
				array_multisort($columns, SORT_ASC, $red_plana);
			}

			$array = array();
			foreach($red_plana as $plana) {
				$array[$plana["id"]] = $plana;
			}

			return $array;

		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

#---------------------------------------------------------------------------------------------------------------------------

	public function validation_perfil($id_trabajador, $id_empresa){
		try {

			$__PERFILES 	= $this->set_perfiles($id_empresa);


			if($profiles = $this->get_perfil($id_trabajador, $id_empresa)){

				if(count($__PERFILES) == count($profiles)) return $profiles;
				else return 0;

			} else return 0;

		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function validation_cargo($id_trabajador){
		try {
			//$consulta = $this->ZOOM->get_data("___olc_trabajadores_carg0", " AND id_trabajador = $id_trabajador AND inactivo = 0 AND eliminado = 0 ", 0);
			$consulta = $this->WORKERS->getCargo( " AND id = $id_trabajador AND inactivo = 0 AND eliminado = 0 ", true);

			if($consulta){

				// $__CARGOS = $this->set_cargos($consulta["id_empresa"]);
				$__CARGOS = $this->ZOOM->get_data("grw_cargos", " AND id_empresa = ".$consulta['id_empresa']." AND inactivo = 0 AND eliminado = 0 ORDER BY nivel ASC ", 1);

				$data = array();
				$data["id"] = $consulta["id"];
				if($consulta["id_cargo"] != '0') $data["cargo"]	= $__CARGOS[$consulta["id_cargo"]];
				if($consulta["id_jefe"] != '0'){
					if($consulta["id_jefe"] == -1){
						$data["jefe"] 	= array(
							"id"			=> -1,
							"nombre"		=> "Sin Jefe",
							"identificacion"		=> 0,
							"cargo"			=> "No tiene superior",
							"email"			=> 0,
						);
					}else{
						$jefe = $this->ZOOM->get_data("zoom_users", " AND id = ".$consulta["id_jefe"]." AND inactivo = 0 AND eliminado = 0 ", 0);
						if($jefe){
							$data["jefe"] 	= array(
								"id"			=> $jefe["id"],
								"nombre"		=> $jefe["nombre"],
								"identificacion"		=> $jefe["identificacion"],
								"cargo"			=> $jefe["cargo"],
								"email"			=> $jefe["email"],
							);
						}
					}
				}

				return $data;
			} else return 0;

		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

	public function busquedaEnLista($lista, $id){
		try {

			$lista = str_replace(' ', '', $lista);
			$lista = explode(",", $lista);

			if (in_array($id, $lista)) return true;
			else return false;

		}catch(PDOException $e){
			print "¡Error TryCatch!: " . $e->getMessage();
		}
	}

}