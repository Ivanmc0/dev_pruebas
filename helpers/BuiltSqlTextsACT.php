<?php

	function SqlTextEncuestasEvaluativas ( $AddToQuery) {
		$TextSQL = "
		SELECT
			ACTIV.id as actv_id, ACTIV.uuid as actv_uuid, ACTIV.nombre as actv_nombre, ACTIV.descripcion as actv_descripcion, ACTIV.id_categoria as actv_idcategoria, ACTIV.id_empresa as actv_id_empresa, ACTIV.inactivo as actv_inactivo, ACTIV.fecha as actv_fecha,
			CATEG.id AS categ_id, CATEG.uuid AS categ_uuid, CATEG.nombre AS categ_nombre, CATEG.inactivo AS categ_inactivo, CATEG.fecha AS categ_fecha,
			DINAM.id AS dinam_id, DINAM.uuid AS dinam_uuid, DINAM.prioridad AS dinam_prioridad, DINAM.nombre AS dinam_nombre, DINAM.re_fecha_cierre AS dinam_fecha_cierre, DINAM.inactivo AS dinam_inactivo, 	DINAM.fecha AS dinam_fecha,
			MODEL.id AS modelo_id, MODEL.uuid AS modelo_uuid, MODEL.nombre AS modelo_nombre, MODEL.inactivo AS modelo_inactivo, MODEL.fecha AS modelo_fecha, MODEL_TIPO.id AS tpmodel_id, MODEL_TIPO.uuid AS tpmodel_uiid, MODEL_TIPO.nombre AS tpmodel_nombre,
			MODEL_TIPO.inactivo AS tpmodel_inactivo, MODEL_TIPO.fecha AS tpmodel_fecha,
			PREG.id AS preg_id, PREG.uuid AS preg_uuid, PREG.nombre AS preg_nombre, PREG.prioridad AS preg_prioridad, PREG.inactivo AS preg_inactivo, PREG.fecha AS preg_fecha, PREG.id_dinamica ,
			RESP.id AS resp_id, RESP.uuid AS resp_uuid, RESP.nombre AS resp_nombre, RESP.correcta AS resp_correcta, PREG.id_dinamica ,
			RESP.prioridad AS resp_prioridad, RESP.inactivo AS resp_inactivo, RESP.fecha AS resp_fecha , RESP.valor as resp_valor,
			TIPOPREG.id AS tipo_preg_id,	TIPOPREG.uuid AS tipo_preg_uuid, TIPOPREG.id_tipo AS tipo_preg_id_tipo, TIPOPREG.nombre AS tipo_preg_nombre, TIPOPREG.fecha AS tipo_preg_fecha,
			PROCESOS.fecha_desde AS proceso_desde,  PROCESOS.fecha_hasta AS proceso_hasta, PROCESOS.visible AS proceso_visible
		FROM
			grw_lel_actividades AS ACTIV
			INNER JOIN grw_lel_categorias AS CATEG ON ACTIV.id_categoria = CATEG.id
			INNER JOIN grw_lel_dinamicas AS DINAM ON ACTIV.id = DINAM.id_actividad
			INNER JOIN olc_modelos AS MODEL ON DINAM.id_modelo = MODEL.id
			INNER JOIN olc_modelos_tipos AS MODEL_TIPO ON DINAM.id_tipo = MODEL_TIPO.id
			INNER JOIN grw_lel_preguntas AS PREG ON DINAM.id = PREG.id_dinamica
			INNER JOIN grw_lel_respuestas AS RESP ON PREG.id = RESP.id_pregunta
			INNER JOIN olc_preguntas_tipos AS TIPOPREG ON PREG.id_modo = TIPOPREG.id
			INNER JOIN grw_procesos AS PROCESOS ON ACTIV.id = PROCESOS.id_proceso
		WHERE
			MODEL_TIPO.id = 1  AND ACTIV.eliminado = 0  AND CATEG.eliminado = 0  AND DINAM.eliminado = 0  AND MODEL.eliminado = 0
			AND PREG.eliminado = 0 AND RESP.eliminado = 0 AND PROCESOS.id_proceso_tipo = 3
			-- AND PROCESOS.asignaciones_actividad = 1

			$AddToQuery

		UNION

			SELECT
				ACTIV.id as actv_id, ACTIV.uuid as actv_uuid, ACTIV.nombre as actv_nombre, ACTIV.descripcion as actv_descripcion, ACTIV.id_categoria as actv_idcategoria, ACTIV.id_empresa as actv_id_empresa, ACTIV.inactivo as actv_inactivo, ACTIV.fecha as actv_fecha,
				CATEG.id AS categ_id, CATEG.uuid AS categ_uuid, CATEG.nombre AS categ_nombre, CATEG.inactivo AS categ_inactivo, CATEG.fecha AS categ_fecha,
				DINAM.id AS dinam_id, DINAM.uuid AS dinam_uuid, DINAM.prioridad AS dinam_prioridad, DINAM.nombre AS dinam_nombre, DINAM.re_fecha_cierre AS dinam_fecha_cierre, DINAM.inactivo AS dinam_inactivo, 	DINAM.fecha AS dinam_fecha,
				MODEL.id AS modelo_id, MODEL.uuid AS modelo_uuid, MODEL.nombre AS modelo_nombre, MODEL.inactivo AS modelo_inactivo, MODEL.fecha AS modelo_fecha, MODEL_TIPO.id AS tpmodel_id, MODEL_TIPO.uuid AS tpmodel_uiid, MODEL_TIPO.nombre AS tpmodel_nombre,
				MODEL_TIPO.inactivo AS tpmodel_inactivo, MODEL_TIPO.fecha AS tpmodel_fecha,
				PREG.id AS preg_id, PREG.uuid AS preg_uuid, PREG.nombre AS preg_nombre, PREG.prioridad AS preg_prioridad, PREG.inactivo AS preg_inactivo, PREG.fecha AS preg_fecha, PREG.id_dinamica ,
				RESP.id AS resp_id, RESP.uuid AS resp_uuid, RESP.nombre AS resp_nombre, RESP.correcta AS resp_correcta, PREG.id_dinamica ,
				RESP.prioridad AS resp_prioridad, RESP.inactivo AS resp_inactivo, RESP.fecha AS resp_fecha , RESP.valor as resp_valor,
				TIPOPREG.id AS tipo_preg_id,	TIPOPREG.uuid AS tipo_preg_uuid, TIPOPREG.id_tipo AS tipo_preg_id_tipo, TIPOPREG.nombre AS tipo_preg_nombre, TIPOPREG.fecha AS tipo_preg_fecha,
				PROCESOS.fecha_desde AS proceso_desde,  PROCESOS.fecha_hasta AS proceso_hasta, PROCESOS.visible AS proceso_visible
			FROM
				grw_lel_actividades AS ACTIV
				INNER JOIN grw_lel_categorias AS CATEG ON ACTIV.id_categoria = CATEG.id
				INNER JOIN grw_lel_dinamicas AS DINAM ON ACTIV.id = DINAM.id_actividad
				INNER JOIN olc_modelos AS MODEL ON DINAM.id_modelo = MODEL.id
				INNER JOIN olc_modelos_tipos AS MODEL_TIPO ON DINAM.id_tipo = MODEL_TIPO.id
				INNER JOIN grw_lel_preguntas AS PREG ON DINAM.id = PREG.id_dinamica
				INNER JOIN grw_lel_respuestas AS RESP ON PREG.id = RESP.id_pregunta
				INNER JOIN olc_preguntas_tipos AS TIPOPREG ON PREG.id_modo = TIPOPREG.id
				INNER JOIN grw_procesos AS PROCESOS ON ACTIV.id = PROCESOS.id_proceso
				INNER JOIN grw_lel_act_asignaciones AS ASIGNACIONES ON ASIGNACIONES.id_alcance_proceso = PROCESOS.id
			WHERE
				MODEL_TIPO.id = 1  AND ACTIV.eliminado = 0  AND CATEG.eliminado = 0  AND DINAM.eliminado = 0  AND MODEL.eliminado = 0
				AND PREG.eliminado = 0 AND RESP.eliminado = 0 AND PROCESOS.id_proceso_tipo = 3
				-- AND PROCESOS.asignaciones_actividad = 1
				$AddToQuery
		";

		return $TextSQL;
	}




	function SqlTextReconocimientos ( $AddToQuery ) {
		$IdTrabjador = $_SESSION['WORKER']['id'];
		$TextSQL = "SELECT RCNCMNTOS.id AS rcncmnto_id, RCNCMNTOS.uuid AS rcncmnto_uuid, RCNCMNTOS.nombre AS rcncmnto_nombre, RCNCMNTOS.forma AS rcncmnto_forma, RCNCMNTOS.color AS rcncmnto_color, RCNCMNTOS.icono AS rcncmnto_icono, RCNCMNTOS.inactivo AS rcncmnto_inactivo,
						RCNCMNTOS.fecha AS rcncmnto_fecha, RCNCEDORES.id AS rcncdor_id, RCNCEDORES.uuid AS rcncdor_uuid, RCNCEDORES.nombres AS rcncdor_nombres, RCNCEDORES.apellidos AS rcncdor_apellidos, USERS_RCNCIDOS.id AS rcncido_id, USERS_RCNCIDOS.uuid AS rcncido_uuid,
						USERS_RCNCIDOS.nombres AS rcncido_nombres, USERS_RCNCIDOS.apellidos AS rcncido_apellidos, RCNCDOS.comentarios AS rcncido_comentario, ACTIV.id AS actvdad_id, ACTIV.uuid AS actvdad_uuid, ACTIV.nombre AS actvdad_nombre,
						DINAMICAS.id AS dinamica_id, DINAMICAS.uuid AS dinamica_uuid, DINAMICAS.nombre AS dinamica_nombre ,
						PROCESOS.fecha_desde AS proceso_desde, PROCESOS.fecha_hasta AS proceso_hasta, PROCESOS.visible AS proceso_visible
					FROM
						grw_reconocimientos AS RCNCMNTOS
						INNER JOIN grw_sol_act_reconocimientos AS RCNCDOS ON RCNCMNTOS.id = RCNCDOS.id_reconocimiento
						INNER JOIN zoom_users AS RCNCEDORES ON RCNCDOS.id_trabajador = RCNCEDORES.id
						INNER JOIN grw_lel_actividades AS ACTIV ON RCNCDOS.id_actividad = ACTIV.id
						INNER JOIN grw_lel_dinamicas AS DINAMICAS ON RCNCDOS.id_dinamica = DINAMICAS.id
						INNER JOIN zoom_users AS USERS_RCNCIDOS ON RCNCDOS.id_reconocido = USERS_RCNCIDOS.id
						INNER JOIN grw_procesos AS PROCESOS ON ACTIV.id = PROCESOS.id_proceso
					WHERE
						RCNCMNTOS.eliminado = 0  AND RCNCEDORES.eliminado = 0  AND RCNCDOS.eliminado = 0  AND DINAMICAS.eliminado = 0
						AND PROCESOS.asignaciones_actividad = 1  $AddToQuery
					UNION
					SELECT RCNCMNTOS.id AS rcncmnto_id, RCNCMNTOS.uuid AS rcncmnto_uuid, RCNCMNTOS.nombre AS rcncmnto_nombre, RCNCMNTOS.forma AS rcncmnto_forma, RCNCMNTOS.color AS rcncmnto_color, RCNCMNTOS.icono AS rcncmnto_icono, RCNCMNTOS.inactivo AS rcncmnto_inactivo,
						RCNCMNTOS.fecha AS rcncmnto_fecha, RCNCEDORES.id AS rcncdor_id, RCNCEDORES.uuid AS rcncdor_uuid, RCNCEDORES.nombres AS rcncdor_nombres, RCNCEDORES.apellidos AS rcncdor_apellidos, USERS_RCNCIDOS.id AS rcncido_id, USERS_RCNCIDOS.uuid AS rcncido_uuid,
						USERS_RCNCIDOS.nombres AS rcncido_nombres, USERS_RCNCIDOS.apellidos AS rcncido_apellidos, RCNCDOS.comentarios AS rcncido_comentario, ACTIV.id AS actvdad_id, ACTIV.uuid AS actvdad_uuid, ACTIV.nombre AS actvdad_nombre,
						DINAMICAS.id AS dinamica_id, DINAMICAS.uuid AS dinamica_uuid, DINAMICAS.nombre AS dinamica_nombre ,
						PROCESOS.fecha_desde AS proceso_desde, PROCESOS.fecha_hasta AS proceso_hasta, PROCESOS.visible AS proceso_visible
					FROM
						grw_reconocimientos AS RCNCMNTOS
						INNER JOIN grw_sol_act_reconocimientos AS RCNCDOS ON RCNCMNTOS.id = RCNCDOS.id_reconocimiento
						INNER JOIN zoom_users AS RCNCEDORES ON RCNCDOS.id_trabajador = RCNCEDORES.id
						INNER JOIN grw_lel_actividades AS ACTIV ON RCNCDOS.id_actividad = ACTIV.id
						INNER JOIN grw_lel_dinamicas AS DINAMICAS ON RCNCDOS.id_dinamica = DINAMICAS.id
						INNER JOIN zoom_users AS USERS_RCNCIDOS ON RCNCDOS.id_reconocido = USERS_RCNCIDOS.id
						INNER JOIN grw_procesos AS PROCESOS ON ACTIV.id = PROCESOS.id_proceso
						INNER JOIN grw_lel_act_asignaciones AS ASIGNACIONES ON ASIGNACIONES.id_alcance_proceso = PROCESOS.id
					WHERE
						RCNCMNTOS.eliminado = 0  AND RCNCEDORES.eliminado = 0  AND RCNCDOS.eliminado = 0  AND DINAMICAS.eliminado = 0
						AND PROCESOS.asignaciones_actividad = 1 AND ASIGNACIONES.id_trabajador = $IdTrabjador   $AddToQuery	";
		return $TextSQL ;
	}

	function SqlTextCampanias ( $AddToQuery ) {
		$IdTrabjador = $_SESSION['WORKER']['id'];
		$TextSQL = "SELECT 	ACTIV.id AS actvdad_id, ACTIV.uuid AS actvdad_uuid, ACTIV.nombre AS actvdad_nombre,	ACTIV.fecha AS actvdad_fecha,DINAMICA.id AS dnmca_id,DINAMICA.uuid AS dnmca_uuid,DINAMICA.nombre AS dnmca_nombre,
					DINAMICA.fecha AS dnmca_fecha,USERS.id AS user_id,USERS.uuid AS user_uuid,USERS.nombres AS user_nombres,USERS.apellidos AS user_apellidos,CAMPANIA.id AS cmpnia_id,CAMPANIA.uuid AS cmpnia_uuid,
					CAMPANIA.comentarios AS cmpnia_comentarios,	CAMPANIA.fecha AS cmpnia_fecha , PROCESOS.fecha_desde AS proceso_desde, PROCESOS.fecha_hasta AS proceso_hasta, PROCESOS.id_proceso_tipo AS proceso_tipo , PROCESOS.visible as proceso_visible
				FROM
					grw_sol_act_campanias AS CAMPANIA
					INNER JOIN grw_lel_actividades AS ACTIV ON CAMPANIA.id_actividad = ACTIV.id
					INNER JOIN grw_lel_dinamicas AS DINAMICA ON CAMPANIA.id_dinamica = DINAMICA.id
					INNER JOIN zoom_users AS USERS ON CAMPANIA.id_trabajador = USERS.id
					INNER JOIN grw_procesos AS PROCESOS ON ACTIV.id = PROCESOS.id_proceso
				WHERE
					ACTIV.eliminado = 0  AND DINAMICA.eliminado = 0  AND USERS.eliminado = 0 AND CAMPANIA.eliminado = 0  AND PROCESOS.asignaciones_actividad = 1   $AddToQuery
				UNION
				SELECT 	ACTIV.id AS actvdad_id, ACTIV.uuid AS actvdad_uuid, ACTIV.nombre AS actvdad_nombre,	ACTIV.fecha AS actvdad_fecha,DINAMICA.id AS dnmca_id,DINAMICA.uuid AS dnmca_uuid,DINAMICA.nombre AS dnmca_nombre,
					DINAMICA.fecha AS dnmca_fecha,USERS.id AS user_id,USERS.uuid AS user_uuid,USERS.nombres AS user_nombres,USERS.apellidos AS user_apellidos,CAMPANIA.id AS cmpnia_id,CAMPANIA.uuid AS cmpnia_uuid,
					CAMPANIA.comentarios AS cmpnia_comentarios,	CAMPANIA.fecha AS cmpnia_fecha , PROCESOS.fecha_desde AS proceso_desde, PROCESOS.fecha_hasta AS proceso_hasta, PROCESOS.id_proceso_tipo AS proceso_tipo , PROCESOS.visible as proceso_visible
				FROM
					grw_sol_act_campanias AS CAMPANIA
					INNER JOIN grw_lel_actividades AS ACTIV ON CAMPANIA.id_actividad = ACTIV.id
					INNER JOIN grw_lel_dinamicas AS DINAMICA ON CAMPANIA.id_dinamica = DINAMICA.id
					INNER JOIN zoom_users AS USERS ON CAMPANIA.id_trabajador = USERS.id
					INNER JOIN grw_procesos AS PROCESOS ON ACTIV.id = PROCESOS.id_proceso
					INNER JOIN grw_lel_act_asignaciones AS ASIGNACIONES ON ASIGNACIONES.id_alcance_proceso = PROCESOS.id
				WHERE
					ACTIV.eliminado = 0  AND DINAMICA.eliminado = 0  AND USERS.eliminado = 0 AND CAMPANIA.eliminado = 0  AND PROCESOS.asignaciones_actividad = 1  AND ASIGNACIONES.id_trabajador = $IdTrabjador $AddToQuery";
		return $TextSQL ;
	}


	function SqlTextEncuestasInvestigativas ( $AddToQuery ) {
		//Abiertas con y sin respuestas
		$IdTrabjador = $_SESSION['WORKER']['id'];
        $TextSQL  = " SELECT
				ACTIV.id as actv_id, ACTIV.uuid as actv_uuid, ACTIV.nombre as actv_nombre, ACTIV.descripcion as actv_descripcion, ACTIV.id_categoria as actv_idcategoria, ACTIV.id_empresa as actv_id_empresa, ACTIV.inactivo as actv_inactivo, ACTIV.fecha as actv_fecha,
				CATEG.id AS categ_id, CATEG.uuid AS categ_uuid, CATEG.nombre AS categ_nombre, CATEG.inactivo AS categ_inactivo, CATEG.fecha AS categ_fecha,
				DINAM.id AS dinam_id, DINAM.uuid AS dinam_uuid, DINAM.prioridad AS dinam_prioridad, DINAM.nombre AS dinam_nombre, DINAM.re_fecha_cierre AS dinam_fecha_cierre, DINAM.inactivo AS dinam_inactivo, 	DINAM.fecha AS dinam_fecha,
				MODEL.id AS modelo_id, MODEL.uuid AS modelo_uuid, MODEL.nombre AS modelo_nombre, MODEL.inactivo AS modelo_inactivo, MODEL.fecha AS modelo_fecha, MODEL_TIPO.id AS tpmodel_id, MODEL_TIPO.uuid AS tpmodel_uiid, MODEL_TIPO.nombre AS tpmodel_nombre,
				MODEL_TIPO.inactivo AS tpmodel_inactivo, MODEL_TIPO.fecha AS tpmodel_fecha,
				PREG.id AS preg_id, PREG.uuid AS preg_uuid, PREG.nombre AS preg_nombre, PREG.prioridad AS preg_prioridad, PREG.inactivo AS preg_inactivo, PREG.fecha AS preg_fecha, PREG.id_dinamica ,
				0 AS resp_id, '' AS resp_uuid, '' AS resp_nombre, -1 AS resp_correcta, PREG.id_dinamica ,
				0 AS resp_prioridad, 0 AS resp_inactivo, '' AS resp_fecha , 0 as resp_valor	,
				TIPOPREG.id AS tipo_preg_id,	TIPOPREG.uuid AS tipo_preg_uuid, TIPOPREG.id_tipo AS tipo_preg_id_tipo, TIPOPREG.nombre AS tipo_preg_nombre, TIPOPREG.fecha AS tipo_preg_fecha,
				PROCESOS.fecha_desde AS proceso_desde,  PROCESOS.fecha_hasta AS proceso_hasta, PROCESOS.visible AS proceso_visible
			FROM
				grw_lel_actividades AS ACTIV
				INNER JOIN grw_lel_categorias AS CATEG ON ACTIV.id_categoria = CATEG.id
				INNER JOIN grw_lel_dinamicas AS DINAM ON ACTIV.id = DINAM.id_actividad
				INNER JOIN olc_modelos AS MODEL ON DINAM.id_modelo = MODEL.id
				INNER JOIN olc_modelos_tipos AS MODEL_TIPO ON DINAM.id_tipo = MODEL_TIPO.id
				INNER JOIN grw_lel_preguntas AS PREG ON DINAM.id = PREG.id_dinamica
				INNER JOIN olc_preguntas_tipos AS TIPOPREG ON PREG.id_modo = TIPOPREG.id
				INNER JOIN grw_procesos AS PROCESOS ON ACTIV.id = PROCESOS.id_proceso
			WHERE
				MODEL_TIPO.id = 2  AND ACTIV.eliminado = 0  AND CATEG.eliminado = 0  AND DINAM.eliminado = 0  AND MODEL.eliminado = 0  AND PREG.eliminado = 0 AND PROCESOS.id_proceso_tipo = 3
				AND  PROCESOS.asignaciones_actividad = 1 $AddToQuery
			UNION
				SELECT ACTIV.id as actv_id, ACTIV.uuid as actv_uuid, ACTIV.nombre as actv_nombre, ACTIV.descripcion as actv_descripcion, ACTIV.id_categoria as actv_idcategoria, ACTIV.id_empresa as actv_id_empresa, ACTIV.inactivo as actv_inactivo, ACTIV.fecha as actv_fecha,
					CATEG.id AS categ_id, CATEG.uuid AS categ_uuid, CATEG.nombre AS categ_nombre, CATEG.inactivo AS categ_inactivo, CATEG.fecha AS categ_fecha,
					DINAM.id AS dinam_id, DINAM.uuid AS dinam_uuid, DINAM.prioridad AS dinam_prioridad, DINAM.nombre AS dinam_nombre, DINAM.re_fecha_cierre AS dinam_fecha_cierre, DINAM.inactivo AS dinam_inactivo, 	DINAM.fecha AS dinam_fecha,
					MODEL.id AS modelo_id, MODEL.uuid AS modelo_uuid, MODEL.nombre AS modelo_nombre, MODEL.inactivo AS modelo_inactivo, MODEL.fecha AS modelo_fecha, MODEL_TIPO.id AS tpmodel_id, MODEL_TIPO.uuid AS tpmodel_uiid, MODEL_TIPO.nombre AS tpmodel_nombre,
					MODEL_TIPO.inactivo AS tpmodel_inactivo, MODEL_TIPO.fecha AS tpmodel_fecha,
					PREG.id AS preg_id, PREG.uuid AS preg_uuid, PREG.nombre AS preg_nombre, PREG.prioridad AS preg_prioridad, PREG.inactivo AS preg_inactivo, PREG.fecha AS preg_fecha, PREG.id_dinamica ,
					RESP.id AS resp_id, RESP.uuid AS resp_uuid, RESP.nombre AS resp_nombre, RESP.correcta AS resp_correcta, PREG.id_dinamica ,
					RESP.prioridad AS resp_prioridad, RESP.inactivo AS resp_inactivo, RESP.fecha AS resp_fecha , RESP.valor as resp_valor,
					TIPOPREG.id AS tipo_preg_id,	TIPOPREG.uuid AS tipo_preg_uuid, TIPOPREG.id_tipo AS tipo_preg_id_tipo, TIPOPREG.nombre AS tipo_preg_nombre, TIPOPREG.fecha AS tipo_preg_fecha,
					PROCESOS.fecha_desde AS proceso_desde,  PROCESOS.fecha_hasta AS proceso_hasta, PROCESOS.visible AS proceso_visible
				FROM
					grw_lel_actividades AS ACTIV
					INNER JOIN grw_lel_categorias AS CATEG ON ACTIV.id_categoria = CATEG.id
					INNER JOIN grw_lel_dinamicas AS DINAM ON ACTIV.id = DINAM.id_actividad
					INNER JOIN olc_modelos AS MODEL ON DINAM.id_modelo = MODEL.id
					INNER JOIN olc_modelos_tipos AS MODEL_TIPO ON DINAM.id_tipo = MODEL_TIPO.id
					INNER JOIN grw_lel_preguntas AS PREG ON DINAM.id = PREG.id_dinamica
					INNER JOIN grw_lel_respuestas AS RESP ON PREG.id = RESP.id_pregunta
					INNER JOIN olc_preguntas_tipos AS TIPOPREG ON PREG.id_modo = TIPOPREG.id
					INNER JOIN grw_procesos AS PROCESOS ON ACTIV.id = PROCESOS.id_proceso
				WHERE
					MODEL_TIPO.id = 2  AND ACTIV.eliminado = 0  AND CATEG.eliminado = 0  AND DINAM.eliminado = 0  AND MODEL.eliminado = 0  AND PREG.eliminado = 0
					AND RESP.eliminado = 0  AND PROCESOS.id_proceso_tipo = 3 AND  PROCESOS.asignaciones_actividad = 1 $AddToQuery
				UNION
				SELECT
				ACTIV.id as actv_id, ACTIV.uuid as actv_uuid, ACTIV.nombre as actv_nombre, ACTIV.descripcion as actv_descripcion, ACTIV.id_categoria as actv_idcategoria, ACTIV.id_empresa as actv_id_empresa, ACTIV.inactivo as actv_inactivo, ACTIV.fecha as actv_fecha,
				CATEG.id AS categ_id, CATEG.uuid AS categ_uuid, CATEG.nombre AS categ_nombre, CATEG.inactivo AS categ_inactivo, CATEG.fecha AS categ_fecha,
				DINAM.id AS dinam_id, DINAM.uuid AS dinam_uuid, DINAM.prioridad AS dinam_prioridad, DINAM.nombre AS dinam_nombre, DINAM.re_fecha_cierre AS dinam_fecha_cierre, DINAM.inactivo AS dinam_inactivo, 	DINAM.fecha AS dinam_fecha,
				MODEL.id AS modelo_id, MODEL.uuid AS modelo_uuid, MODEL.nombre AS modelo_nombre, MODEL.inactivo AS modelo_inactivo, MODEL.fecha AS modelo_fecha, MODEL_TIPO.id AS tpmodel_id, MODEL_TIPO.uuid AS tpmodel_uiid, MODEL_TIPO.nombre AS tpmodel_nombre,
				MODEL_TIPO.inactivo AS tpmodel_inactivo, MODEL_TIPO.fecha AS tpmodel_fecha,
				PREG.id AS preg_id, PREG.uuid AS preg_uuid, PREG.nombre AS preg_nombre, PREG.prioridad AS preg_prioridad, PREG.inactivo AS preg_inactivo, PREG.fecha AS preg_fecha, PREG.id_dinamica ,
				0 AS resp_id, '' AS resp_uuid, '' AS resp_nombre, -1 AS resp_correcta, PREG.id_dinamica ,
				0 AS resp_prioridad, 0 AS resp_inactivo, '' AS resp_fecha , 0 as resp_valor	,
				TIPOPREG.id AS tipo_preg_id,	TIPOPREG.uuid AS tipo_preg_uuid, TIPOPREG.id_tipo AS tipo_preg_id_tipo, TIPOPREG.nombre AS tipo_preg_nombre, TIPOPREG.fecha AS tipo_preg_fecha,
				PROCESOS.fecha_desde AS proceso_desde,  PROCESOS.fecha_hasta AS proceso_hasta, PROCESOS.visible AS proceso_visible
			FROM
				grw_lel_actividades AS ACTIV
				INNER JOIN grw_lel_categorias AS CATEG ON ACTIV.id_categoria = CATEG.id
				INNER JOIN grw_lel_dinamicas AS DINAM ON ACTIV.id = DINAM.id_actividad
				INNER JOIN olc_modelos AS MODEL ON DINAM.id_modelo = MODEL.id
				INNER JOIN olc_modelos_tipos AS MODEL_TIPO ON DINAM.id_tipo = MODEL_TIPO.id
				INNER JOIN grw_lel_preguntas AS PREG ON DINAM.id = PREG.id_dinamica
				INNER JOIN olc_preguntas_tipos AS TIPOPREG ON PREG.id_modo = TIPOPREG.id
				INNER JOIN grw_procesos AS PROCESOS ON ACTIV.id = PROCESOS.id_proceso
				INNER JOIN grw_lel_act_asignaciones AS ASIGNACIONES ON ASIGNACIONES.id_alcance_proceso = PROCESOS.id
			WHERE
				MODEL_TIPO.id = 2  AND ACTIV.eliminado = 0  AND CATEG.eliminado = 0  AND DINAM.eliminado = 0  AND MODEL.eliminado = 0  AND PREG.eliminado = 0 AND PROCESOS.id_proceso_tipo = 3  AND ASIGNACIONES.id_trabajador = $IdTrabjador  $AddToQuery
			UNION
				SELECT ACTIV.id as actv_id, ACTIV.uuid as actv_uuid, ACTIV.nombre as actv_nombre, ACTIV.descripcion as actv_descripcion, ACTIV.id_categoria as actv_idcategoria, ACTIV.id_empresa as actv_id_empresa, ACTIV.inactivo as actv_inactivo, ACTIV.fecha as actv_fecha,
					CATEG.id AS categ_id, CATEG.uuid AS categ_uuid, CATEG.nombre AS categ_nombre, CATEG.inactivo AS categ_inactivo, CATEG.fecha AS categ_fecha,
					DINAM.id AS dinam_id, DINAM.uuid AS dinam_uuid, DINAM.prioridad AS dinam_prioridad, DINAM.nombre AS dinam_nombre, DINAM.re_fecha_cierre AS dinam_fecha_cierre, DINAM.inactivo AS dinam_inactivo, 	DINAM.fecha AS dinam_fecha,
					MODEL.id AS modelo_id, MODEL.uuid AS modelo_uuid, MODEL.nombre AS modelo_nombre, MODEL.inactivo AS modelo_inactivo, MODEL.fecha AS modelo_fecha, MODEL_TIPO.id AS tpmodel_id, MODEL_TIPO.uuid AS tpmodel_uiid, MODEL_TIPO.nombre AS tpmodel_nombre,
					MODEL_TIPO.inactivo AS tpmodel_inactivo, MODEL_TIPO.fecha AS tpmodel_fecha,
					PREG.id AS preg_id, PREG.uuid AS preg_uuid, PREG.nombre AS preg_nombre, PREG.prioridad AS preg_prioridad, PREG.inactivo AS preg_inactivo, PREG.fecha AS preg_fecha, PREG.id_dinamica ,
					RESP.id AS resp_id, RESP.uuid AS resp_uuid, RESP.nombre AS resp_nombre, RESP.correcta AS resp_correcta, PREG.id_dinamica ,
					RESP.prioridad AS resp_prioridad, RESP.inactivo AS resp_inactivo, RESP.fecha AS resp_fecha , RESP.valor as resp_valor,
					TIPOPREG.id AS tipo_preg_id,	TIPOPREG.uuid AS tipo_preg_uuid, TIPOPREG.id_tipo AS tipo_preg_id_tipo, TIPOPREG.nombre AS tipo_preg_nombre, TIPOPREG.fecha AS tipo_preg_fecha,
					PROCESOS.fecha_desde AS proceso_desde,  PROCESOS.fecha_hasta AS proceso_hasta, PROCESOS.visible AS proceso_visible
				FROM
					grw_lel_actividades AS ACTIV
					INNER JOIN grw_lel_categorias AS CATEG ON ACTIV.id_categoria = CATEG.id
					INNER JOIN grw_lel_dinamicas AS DINAM ON ACTIV.id = DINAM.id_actividad
					INNER JOIN olc_modelos AS MODEL ON DINAM.id_modelo = MODEL.id
					INNER JOIN olc_modelos_tipos AS MODEL_TIPO ON DINAM.id_tipo = MODEL_TIPO.id
					INNER JOIN grw_lel_preguntas AS PREG ON DINAM.id = PREG.id_dinamica
					INNER JOIN grw_lel_respuestas AS RESP ON PREG.id = RESP.id_pregunta
					INNER JOIN olc_preguntas_tipos AS TIPOPREG ON PREG.id_modo = TIPOPREG.id
					INNER JOIN grw_procesos AS PROCESOS ON ACTIV.id = PROCESOS.id_proceso
					INNER JOIN grw_lel_act_asignaciones AS ASIGNACIONES ON ASIGNACIONES.id_alcance_proceso = PROCESOS.id
				WHERE
					MODEL_TIPO.id = 2  AND ACTIV.eliminado = 0  AND CATEG.eliminado = 0  AND DINAM.eliminado = 0  AND MODEL.eliminado = 0  AND PREG.eliminado = 0
					AND RESP.eliminado = 0  AND PROCESOS.id_proceso_tipo = 3 AND ASIGNACIONES.id_trabajador = $IdTrabjador  $AddToQuery
				";
        return $TextSQL ;

    }

?>