<?php

require_once $_SESSION['_CLASS'].'OLC.php';
require_once $_SESSION['_CLASS'].'OLC-Platform.php';

class Workers extends Platform {

    public $_ZOOM;

    public function __construct(){
        $this->_ZOOM = new Zoom();
    }

    //------------------------------------------------------------------------------------------------------------------------------------------------------------
    // DASHBOARD
    //------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function MyDashBoardTuCoach ( $IdTrabajador ) {
        $TextSQL = "SELECT
                ESTUDIO.id AS estudio_id, ESTUDIO.uuid AS estudio_uuid, ESTUDIO.nombre AS estudio_nombre, ESTUDIO.fecha AS estudio_fecha, ESTUDIO.duracion as estudio_duracion, ASIGN.id AS asign_id,
                ASIGN.uuid AS asign_uuid, ASIGN.realizado AS asign_realizado, ASIGN.fecha AS asign_fecha, EVALUADOR.id AS evaluador_id,  EVALUADOR.nombres AS evaluador_nombres,
                EVALUADOR.apellidos AS evaluador_apellidos, EVALUADO.id as evaluado_id, EVALUADO.nombres AS evaluado_nombres, EVALUADO.apellidos AS evaluado_apellidos, ALCANCE.fecha_desde AS alcance_desde ,
                ALCANCE.fecha_hasta AS alcance_fecha_hasta, ALCANCE.id_proceso_tipo AS alcance_id_proceso_tipo, ALCANCE.visible AS alcance_visible ,
                PERFILES.id AS perfil_id, PERFILES.uuid AS perfil_uuid, PERFILES.nombre AS perfil_nombre
            FROM
                grw_tuc_p2p_asignaciones AS ASIGN
                INNER JOIN zoom_users AS EVALUADOR ON ASIGN.id_evaluador = EVALUADOR.id
                INNER JOIN grw_tuc_p2p_estudios AS ESTUDIO ON ASIGN.id_evaluacion = ESTUDIO.id
                INNER JOIN zoom_users AS EVALUADO ON EVALUADO.id = ASIGN.id_evaluado
                INNER JOIN grw_procesos AS ALCANCE ON ESTUDIO.id = ALCANCE.id_proceso
                INNER JOIN grw_perfiles AS PERFILES ON ASIGN.id_perfil = PERFILES.id
            WHERE
                EVALUADOR.id = $IdTrabajador
                AND ALCANCE.id_proceso_tipo = 1 AND  ESTUDIO.eliminado = 0 AND ESTUDIO.inactivo = 0
                AND ASIGN.eliminado = 0 AND ASIGN.inactivo = 0
                AND EVALUADOR.eliminado = 0 AND EVALUADOR.inactivo = 0
                AND ALCANCE.eliminado = 0 AND ALCANCE.inactivo = 0 AND ALCANCE.visible  = 1
            UNION
                SELECT   ESTUDIO.id AS estudio_id, ESTUDIO.uuid AS estudio_uuid, ESTUDIO.nombre AS estudio_nombre, ESTUDIO.fecha AS estudio_fecha, ESTUDIO.duracion as estudio_duracion, ASIGN.id AS asign_id,
                    ASIGN.uuid AS asign_uuid, ASIGN.realizado AS asign_realizado, ASIGN.fecha AS asign_fecha, EVALUADOR.id AS evaluador_id,  EVALUADOR.nombres AS evaluador_nombres,
                    EVALUADOR.apellidos AS evaluador_apellidos, 	0 AS evaluado_id, '' AS evaluado_nombres, '' AS evaluado_apellidos, ALCANCE.fecha_desde AS alcance_desde ,
                    ALCANCE.fecha_hasta AS alcance_fecha_hasta, ALCANCE.id_proceso_tipo AS alcance_id_proceso_tipo, ALCANCE.visible AS alcance_visible ,
                    0 AS perfil_id, ''AS perfil_uuid, '' AS perfil_nombre
                FROM
                    grw_tuc_p2b_asignaciones AS ASIGN
                    INNER JOIN zoom_users AS EVALUADOR ON ASIGN.id_evaluador = EVALUADOR.id
                    INNER JOIN grw_tuc_p2b_estudios AS ESTUDIO ON ASIGN.id_evaluacion = ESTUDIO.id
                    INNER JOIN grw_procesos AS ALCANCE ON ESTUDIO.id = ALCANCE.id_proceso

                WHERE
                    EVALUADOR.id = $IdTrabajador
                    AND ALCANCE.id_proceso_tipo = 2 AND  ESTUDIO.eliminado = 0 AND ESTUDIO.inactivo = 0
                    AND ASIGN.eliminado = 0 AND ASIGN.inactivo = 0
                    AND EVALUADOR.eliminado = 0 AND EVALUADOR.inactivo = 0
                    AND ALCANCE.eliminado = 0 AND ALCANCE.inactivo = 0 AND ALCANCE.visible  = 1 ";

        $P2p =  $this->_ZOOM->RUN_SQL ($TextSQL);
        return OrderMyDashBoardTuCoach ( $P2p );
    }

    public function MyDashBoardValora ( $IdTrabajador ) {
      $TextSQL = "SELECT INVESTIGACIONES.id AS invstgcnes_id, INVESTIGACIONES.uuid AS invstgcnes_uuid, INVESTIGACIONES.nombre AS invstgcnes_nombre, ENCUESTAS.id AS encuestas_id, ENCUESTAS.uuid AS encuestas_iuuid,
                    ENCUESTAS.nombre AS encuestas_nombre, PROCESOS.fecha_desde AS procesos_fecha_desde, PROCESOS.fecha_hasta AS procesos_fecha_hasta, ASIGNACIONES.id_trabajador AS asgncones_id,
                    ASIGNACIONES.completado AS asgncones_completado, VALORACIONES.id AS vlrcones_id, VALORACIONES.uuid AS vlrcones_uuid,  VALORACIONES.nombre AS vlrcones_nombre ,	ENCUESTAS.descripcion as encuestas_descripcion, ENCUESTAS.introduccion as encuestas_introduccion,
                    EVENTOS.id AS evento_id, EVENTOS.uuid AS evento_uuid, EVENTOS.nombre AS evento_nombre
                FROM
                    grw_val_asignaciones AS ASIGNACIONES
                    INNER JOIN grw_procesos AS PROCESOS
                    INNER JOIN grw_val_investigaciones AS INVESTIGACIONES ON ASIGNACIONES.id_investigacion = INVESTIGACIONES.id
                    INNER JOIN grw_val_encuestas AS ENCUESTAS ON ASIGNACIONES.id_encuesta = ENCUESTAS.id
                    INNER JOIN grw_val_valoraciones AS VALORACIONES ON ASIGNACIONES.id_valoracion = VALORACIONES.id
                    AND PROCESOS.id_proceso = VALORACIONES.id INNER JOIN grw_val_eventos AS EVENTOS ON ASIGNACIONES.id_evento = EVENTOS.id
                WHERE
                    ASIGNACIONES.id_trabajador = $IdTrabajador
                    AND PROCESOS.id_proceso_tipo = 5 AND PROCESOS.visible = 1 AND INVESTIGACIONES.eliminado = 0 AND ENCUESTAS.eliminado = 0  AND ASIGNACIONES.eliminado = 0 AND VALORACIONES.eliminado = 0";
        return  OrderValoraciones ( $this->_ZOOM->RUN_SQL ($TextSQL) );
    }

    public function MyDashBoardLeletog ( $IdTrabajador) {
        $TextSQL ="SELECT DISTINCT ACTIVIDADES.id AS idactividad, ACTIVIDADES.uuid AS uuid_actividad, ACTIVIDADES.nombre AS nomactividad, ACTIVIDADES.id_empresa, TPROCESS.id AS id_proceso_tipo,
                    TPROCESS.uuid AS uuid_proceso_tipo, TPROCESS.nombre AS nombre_proceso_tipo, PROCESOS.fecha_desde, PROCESOS.fecha_hasta, PROCESOS.asignaciones_actividad, PROCESOS.visible,
                    CATEG.id AS id_categ, CATEG.uuid AS uuid_categ, CATEG.nombre AS nombre_categ,
                    IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id ), 0 ) AS interactividades,
                    IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 1 ), 0 ) AS encuestas, IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_encuestas WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador  ), 0 ) AS encuestas_ok, IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 2 ), 0 ) AS reconocimientos, IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_reconocimientos WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador  ), 0 ) AS reconocimientos_ok, IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 3 ), 0 ) AS campanas,
                    IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_campanias WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador  ), 0 ) AS campanas_ok, MODELOS.id AS modelo_id, MODELOS.uuid AS modelo_uuid, MODELOS.nombre AS modelo_nombre ,
                    DINAMICAS.id as dinamica_id , DINAMICAS.uuid as dinamica_uuid, DINAMICAS.nombre  as dinamica_nombre
                FROM
                    grw_procesos AS PROCESOS
                    INNER JOIN grw_lel_actividades AS ACTIVIDADES ON PROCESOS.id_proceso = ACTIVIDADES.id
                    INNER JOIN olc_procesos AS TPROCESS ON PROCESOS.id_proceso_tipo = TPROCESS.id
                    INNER JOIN grw_lel_categorias AS CATEG ON ACTIVIDADES.id_categoria = CATEG.id
                    INNER JOIN grw_lel_dinamicas AS DINAMICAS ON DINAMICAS.id_actividad = ACTIVIDADES.id
                    INNER JOIN zoom_users AS USERS ON ACTIVIDADES.id_empresa = USERS.id_empresa
                    INNER JOIN olc_modelos AS MODELOS ON DINAMICAS.id_modelo = MODELOS.id
                WHERE
                    ACTIVIDADES.inactivo = 0  AND PROCESOS.id_proceso_tipo = 3  AND ACTIVIDADES.eliminado = 0  AND USERS.id =  $IdTrabajador   AND USERS.inactivo = 0
                    AND USERS.eliminado = 0   AND PROCESOS.visible = 1  AND DINAMICAS.inactivo = 0  AND DINAMICAS.eliminado = 0  AND PROCESOS.asignaciones_actividad = 1

                UNION

                    SELECT DISTINCT ACTIVIDADES.id AS idactividad, ACTIVIDADES.uuid AS uuid_actividad, ACTIVIDADES.nombre AS nomactividad, ACTIVIDADES.id_empresa, TPROCESS.id AS id_proceso_tipo,
                        TPROCESS.uuid AS uuid_proceso_tipo, TPROCESS.nombre AS nombre_proceso_tipo, PROCESOS.fecha_desde, PROCESOS.fecha_hasta, PROCESOS.asignaciones_actividad, PROCESOS.visible,
                        CATEG.id AS id_categ, CATEG.uuid AS uuid_categ, CATEG.nombre AS nombre_categ,
                        IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id ), 0 ) AS interactividades,
                        IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 1 ), 0 ) AS encuestas, IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_encuestas WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador   ), 0 ) AS encuestas_ok, IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 2 ), 0 ) AS reconocimientos, IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_reconocimientos WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador   ), 0 ) AS reconocimientos_ok, IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 3 ), 0 ) AS campanas,
                        IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_campanias WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador   ), 0 ) AS campanas_ok, MODELOS.id AS modelo_id, MODELOS.uuid AS modelo_uuid, MODELOS.nombre AS modelo_nombre ,
                        DINAMICAS.id as dinamica_id , DINAMICAS.uuid as dinamica_uuid, DINAMICAS.nombre  as dinamica_nombre
                    FROM
                        grw_procesos AS PROCESOS
                        INNER JOIN grw_lel_actividades AS ACTIVIDADES ON PROCESOS.id_proceso = ACTIVIDADES.id
                        INNER JOIN olc_procesos AS TPROCESS ON PROCESOS.id_proceso_tipo = TPROCESS.id
                        INNER JOIN grw_lel_categorias AS CATEG ON ACTIVIDADES.id_categoria = CATEG.id
                        INNER JOIN grw_lel_dinamicas AS DINAMICAS ON DINAMICAS.id_actividad = ACTIVIDADES.id
                        INNER JOIN zoom_users AS USERS ON ACTIVIDADES.id_empresa = USERS.id_empresa
                        INNER JOIN olc_modelos AS MODELOS ON DINAMICAS.id_modelo = MODELOS.id
                        INNER JOIN grw_lel_act_asignaciones AS ASIGNACIONES ON ASIGNACIONES.id_alcance_proceso = PROCESOS.id
                    WHERE
                        ACTIVIDADES.inactivo = 0  AND PROCESOS.id_proceso_tipo = 3  AND ACTIVIDADES.eliminado = 0  AND USERS.id =  $IdTrabajador    AND USERS.inactivo = 0
                        AND USERS.eliminado = 0   AND PROCESOS.visible = 1  AND DINAMICAS.inactivo = 0  AND DINAMICAS.eliminado = 0  AND PROCESOS.asignaciones_actividad = 2
                        AND ASIGNACIONES.id_trabajador = $IdTrabajador  and ASIGNACIONES.inactivo =0 AND ASIGNACIONES.eliminado = 1

                UNION

                    SELECT DISTINCT ACTIVIDADES.id AS idactividad, ACTIVIDADES.uuid AS uuid_actividad, ACTIVIDADES.nombre AS nomactividad, ACTIVIDADES.id_empresa, TPROCESS.id AS id_proceso_tipo,
                                        TPROCESS.uuid AS uuid_proceso_tipo, TPROCESS.nombre AS nombre_proceso_tipo, PROCESOS.fecha_desde, PROCESOS.fecha_hasta, PROCESOS.asignaciones_actividad, PROCESOS.visible,
                                        CATEG.id AS id_categ, CATEG.uuid AS uuid_categ, CATEG.nombre AS nombre_categ,
                                        IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id ), 0 ) AS interactividades,
                                        IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 1 ), 0 ) AS encuestas, IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_encuestas WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador   ), 0 ) AS encuestas_ok, IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 2 ), 0 ) AS reconocimientos, IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_reconocimientos WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador   ), 0 ) AS reconocimientos_ok, IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 3 ), 0 ) AS campanas,
                                        IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_campanias WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador   ), 0 ) AS campanas_ok, MODELOS.id AS modelo_id, MODELOS.uuid AS modelo_uuid, MODELOS.nombre AS modelo_nombre ,
                                        DINAMICAS.id as dinamica_id , DINAMICAS.uuid as dinamica_uuid, DINAMICAS.nombre  as dinamica_nombre
                    FROM
                        grw_procesos AS PROCESOS
                        INNER JOIN grw_lel_actividades AS ACTIVIDADES ON PROCESOS.id_proceso = ACTIVIDADES.id
                        INNER JOIN olc_procesos AS TPROCESS ON PROCESOS.id_proceso_tipo = TPROCESS.id
                        INNER JOIN grw_lel_categorias AS CATEG ON ACTIVIDADES.id_categoria = CATEG.id
                        INNER JOIN grw_lel_dinamicas AS DINAMICAS ON DINAMICAS.id_actividad = ACTIVIDADES.id
                        INNER JOIN zoom_users AS USERS ON ACTIVIDADES.id_empresa = USERS.id_empresa
                        INNER JOIN olc_modelos AS MODELOS ON DINAMICAS.id_modelo = MODELOS.id
                        INNER JOIN grw_lel_act_asignaciones ON PROCESOS.id = grw_lel_act_asignaciones.id_alcance_proceso
                        INNER JOIN grw_grupos AS GRUPOS ON grw_lel_act_asignaciones.id_grupo = GRUPOS.id
                        INNER JOIN grw_grupos_miembros AS MIEMBROS ON MIEMBROS.id_grupo = GRUPOS.id
                    WHERE
                        ACTIVIDADES.inactivo = 0  AND PROCESOS.id_proceso_tipo = 3  AND ACTIVIDADES.eliminado = 0  AND USERS.id =  $IdTrabajador    AND USERS.inactivo = 0
                        AND USERS.eliminado = 0   AND PROCESOS.visible = 1  AND DINAMICAS.inactivo = 0  AND DINAMICAS.eliminado = 0  AND PROCESOS.asignaciones_actividad = 2
                        AND MIEMBROS.id_trabajador = $IdTrabajador AND  GRUPOS.eliminado = 0 AND GRUPOS.inactivo = 0 AND MIEMBROS.eliminado = 0 AND MIEMBROS.inactivo = 0 ";



            return  OrderMyActivities ( $this->_ZOOM->RUN_SQL ($TextSQL, false ));
    }

    public function MyDashBoardOKR () {

        return [
            'encurso'     => [],
            'finalizados' => [],
            'indicadores' => [ '1' => 0, '2' => 0, '3' => 0 ],
            'historial'   => 0
        ];

    }

    public function MyDashBoardValoras () {

        return [
            'encurso'     => [],
            'finalizados' => [],
            'indicadores' => [ '1' => 0, '2' => 0, '3' => 0 ],
            'historial'   => 0
        ];

    }


    //------------------------------------------------------------------------------------------------------------------------------------------------------------
    // LISTADO DE REPORTES
    //------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function ListadoReportesLeletog ( $IdTrabajador ) {
        $TextSQL = " SELECT
            DISTINCT ACTIVIDADES.id AS idactividad, ACTIVIDADES.uuid AS uuid_actividad, ACTIVIDADES.nombre AS nomactividad, ACTIVIDADES.id_empresa, TPROCESS.id AS id_proceso_tipo,
                TPROCESS.uuid AS uuid_proceso_tipo, TPROCESS.nombre AS nombre_proceso_tipo, PROCESOS.fecha_desde, PROCESOS.fecha_hasta, PROCESOS.asignaciones_actividad, PROCESOS.visible,
                CATEG.id AS id_categ, CATEG.uuid AS uuid_categ, CATEG.nombre AS nombre_categ,
                IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id ), 0 ) AS interactividades,
                IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 1 ), 0 ) AS encuestas, IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_encuestas WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador  ), 0 ) AS encuestas_ok, IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 2 ), 0 ) AS reconocimientos, IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_reconocimientos WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador  ), 0 ) AS reconocimientos_ok, IFNULL (( SELECT COUNT( id ) FROM grw_lel_dinamicas AS INTERACTIVIDADES WHERE INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 3 ), 0 ) AS campanas,
                IFNULL (( SELECT COUNT( DISTINCT id_dinamica ) FROM grw_sol_act_campanias WHERE id_actividad = ACTIVIDADES.id AND id_trabajador =  $IdTrabajador  ), 0 ) AS campanas_ok, MODELOS.id AS modelo_id, MODELOS.uuid AS modelo_uuid, MODELOS.nombre AS modelo_nombre ,
                DINAMICAS.id as dinamica_id , DINAMICAS.uuid as dinamica_uuid, DINAMICAS.nombre  as dinamica_nombre
            FROM
                grw_procesos AS PROCESOS
                INNER JOIN grw_lel_actividades AS ACTIVIDADES ON PROCESOS.id_proceso = ACTIVIDADES.id
                INNER JOIN olc_procesos AS TPROCESS ON PROCESOS.id_proceso_tipo = TPROCESS.id
                INNER JOIN grw_lel_categorias AS CATEG ON ACTIVIDADES.id_categoria = CATEG.id
                INNER JOIN grw_lel_dinamicas AS DINAMICAS ON DINAMICAS.id_actividad = ACTIVIDADES.id
                INNER JOIN zoom_users AS USERS ON ACTIVIDADES.id_empresa = USERS.id_empresa
                INNER JOIN olc_modelos AS MODELOS ON DINAMICAS.id_modelo = MODELOS.id
            WHERE
                ACTIVIDADES.inactivo = 0  AND PROCESOS.id_proceso_tipo = 3  AND ACTIVIDADES.eliminado = 0  AND USERS.id =  $IdTrabajador   AND USERS.inactivo = 0
                AND USERS.eliminado = 0   AND PROCESOS.visible = 1  AND DINAMICAS.inactivo = 0  AND DINAMICAS.eliminado = 0  AND PROCESOS.permisos_reporte = 1";


        return  OrderMyActivities ( $this->_ZOOM->RUN_SQL ($TextSQL, false ));

    }

    public function ListadoReportesTuCoach ( $IdTrabajador ) {
        return 0;
    }

    public function ListadoReportesValora ( $IdTrabajador ) {
        return 0;
    }

    public function ListadoReportesOKR ( $IdTrabajador ) {
        return 0;
    }

    //------------------------------------------------------------------------------------------------------------------------------------------------------------
    // RECONOCIMIENTOS
    //------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function MisReconocimientos ( $IdTrabajador) {
        $TextSQL="SELECT  SOLUC_RCNCMNTOS.id AS soluc_rcncmntos_id, SOLUC_RCNCMNTOS.uuid AS soluc_rcncmntos_uuid,  SOLUC_RCNCMNTOS.id_trabajador AS soluc_rcncmntos_id_reconocedor,
                        SOLUC_RCNCMNTOS.id_reconocido AS soluc_rcncmntos_id_reconocido,  SOLUC_RCNCMNTOS.id_reconocimiento AS soluc_rcncmntos_id_reconocimiento,
                        SOLUC_RCNCMNTOS.id_actividad AS soluc_rcncmntos_id_actividad,  SOLUC_RCNCMNTOS.id_dinamica AS soluc_rcncmntos_dinamica,
                        SOLUC_RCNCMNTOS.fecha AS soluc_rcncmntos_fecha,
                        ( SELECT COUNT( DISTINCT id_reconocimiento ) FROM grw_sol_act_reconocimientos WHERE id_reconocido = 20313 GROUP BY SOLUC_RCNCMNTOS.id_reconocimiento ) AS total_reconocimientos, RCNCMTOS.id AS rcncmntos_id, RCNCMTOS.uuid AS rcncmntos_uuid,  RCNCMTOS.nombre AS rcncmntos_nombre,
                        SOLUC_RCNCMNTOS.comentarios AS soluc_rcncmntos_comentarios, RCNCMTOS.forma AS rcncmntos_forma, RCNCMTOS.color AS rcncmntos_color,
                        RCNCMTOS.icono AS rcncmntos_icono,RCNCDOR.id AS rcncdor_id,RCNCDOR.uuid AS rcncdor_uuid,
                        RCNCDOR.nombres AS rcncdor_nombres,  RCNCDOR.apellidos AS rcncdor_apellidos
                    FROM
                        grw_sol_act_reconocimientos AS SOLUC_RCNCMNTOS
                        INNER JOIN grw_reconocimientos AS RCNCMTOS ON SOLUC_RCNCMNTOS.id_reconocimiento = RCNCMTOS.id
                        INNER JOIN zoom_users AS RCNCDOR ON SOLUC_RCNCMNTOS.id_trabajador = RCNCDOR.id
                    WHERE
                        SOLUC_RCNCMNTOS.eliminado = 0 AND RCNCMTOS.eliminado = 0 AND RCNCDOR.eliminado = 0 AND SOLUC_RCNCMNTOS.id_reconocido = $IdTrabajador
                        ORDER BY SOLUC_RCNCMNTOS.fecha DESC";
                 return  OrderMyReconocimientos ( $this->_ZOOM->RUN_SQL ($TextSQL, false ));

    }

    public function MiReconocimiento ( $IdTrabajador, $IdReconocimiento ) {
        $TextSQL="SELECT SOLUC_RCNCMNTOS.id as soluc_id ,RCNCMTOS.id AS rcncmntos_id, SOLUC_RCNCMNTOS.fecha AS soluc_rcncmntos_fecha, RCNCMTOS.uuid AS rcncmntos_uuid, RCNCMTOS.nombre AS rcncmntos_nombre,
        SOLUC_RCNCMNTOS.comentarios AS soluc_rcncmntos_comentarios, RCNCMTOS.forma AS rcncmntos_forma,
        RCNCMTOS.color AS rcncmntos_color, RCNCMTOS.icono AS rcncmntos_icono, RCNCDOR.id AS rcncdor_id,
        RCNCDOR.uuid AS rcncdor_uuid,  RCNCDOR.nombres AS rcncdor_nombres, RCNCDOR.apellidos AS rcncdor_apellidos,
        ACTVDDES.id AS actividad_id,   ACTVDDES.uuid AS actividad_uuid, ACTVDDES.nombre AS actividad_nombre,
        DINAMICAS.id AS dinamica_id, DINAMICAS.uuid AS dinamica_uuid,  DINAMICAS.nombre AS dinamica_nombre
        FROM
            grw_sol_act_reconocimientos AS SOLUC_RCNCMNTOS
            INNER JOIN grw_reconocimientos AS RCNCMTOS ON SOLUC_RCNCMNTOS.id_reconocimiento = RCNCMTOS.id
            INNER JOIN zoom_users AS RCNCDOR ON SOLUC_RCNCMNTOS.id_trabajador = RCNCDOR.id
            INNER JOIN grw_lel_actividades AS ACTVDDES ON SOLUC_RCNCMNTOS.id_actividad = ACTVDDES.id
            INNER JOIN grw_lel_dinamicas AS DINAMICAS ON SOLUC_RCNCMNTOS.id_dinamica = DINAMICAS.id
        WHERE
            SOLUC_RCNCMNTOS.eliminado = 0 AND RCNCMTOS.eliminado = 0 AND RCNCDOR.eliminado = 0  AND SOLUC_RCNCMNTOS.id_reconocido = $IdTrabajador
        AND
            (
                SOLUC_RCNCMNTOS.id_reconocimiento =  $IdReconocimiento
                OR
                RCNCMTOS.uuid = $IdReconocimiento

            )";

        return OrderMyReconocimiento ( $this->_ZOOM->RUN_SQL ($TextSQL, false ));
    }

    //------------------------------------------------------------------------------------------------------------------------------------------------------------
    // PROCESS
    //------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function GetProcesses ( $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin ) {

        $AllowApp = $this->MyAllowsApps($IdTrabajador); // Revisar las Apps a las que el usuario tiene permiso

        return [
            'tucoach'  => ( isset($AllowApp['tucoach']) && $AllowApp['tucoach']    ) ?  $this->TuCoachResumen ( $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin )  : 0,
            'leletog'  => ( isset($AllowApp['leletog']) && $AllowApp['leletog']    ) ?  $this->LeletogResumen ( $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin )  : 0,
            'okr'      => ( isset($AllowApp['okr']) && $AllowApp['okr']        ) ?      $this->OkrsResumen ( $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin )  : 0,
            'valora'   => ( isset($AllowApp['valora']) && $AllowApp['valora']     ) ?   $this->ValoraResumen ( $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin )  : 0,
            'academia' => ( isset($AllowApp['academia']) && $AllowApp['academia']   ) ? 1 : 0,

        ];



    }

    public function GetProcess ( $Tipo, $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin) {
        return $this->$Tipo($IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin);
    }

    //------------------------------------------------------------------------------------------------------------------------------------------------------------
    // OTRAS FUNCIONES
    //------------------------------------------------------------------------------------------------------------------------------------------------------------

    private function TuCoachResumen ( $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin  ){

        $Estudios = $this->MyDashBoardTuCoach(  $IdTrabajador );

        if(!isset($Estudios['pendientes'])) $Estudios['pendientes'] = 0;

        $Result = [
            'asignadas'  => 0,
            'pendientes' => $Estudios['pendientes'],
            'realizadas' => 0
        ];

        return $Result ;
    }

    private function ValoraResumen ( $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin  ) {
        return $this->GetProcess ('VAL', $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin ) ;
    }

    private function OkrsResumen ( $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin  ){

        $Result = [ 'asignadas' => 0, 'pendientes' => 0, 'realizadas' => 0 ];

        if($Okrs = $this->GetProcess ('PYT', $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin )){

            $Result = [
                'asignadas' => $Okrs['pyts_resumen']['asignadas'],
                'pendientes' =>  $Okrs['pyts_resumen']['pendientes'],
                'realizadas' => $Okrs['pyts_resumen']['realizadas']
            ];

        }

        return $Result;
    }

    private function LeletogResumen ( $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin ) {
        $Result = [ 'asignadas' => 0, 'pendientes' => 0, 'realizadas' => 0 ];

        $data = $this->MyDashBoardLeletog( $IdTrabajador ) ;

         if($data  ){
            $Result = [
                'asignadas'  => 0,
                'pendientes' => $data['pendientes'],
                'realizadas' => 0
            ];

        }
        return $Result;
    }

    private function P2P ($IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin) {
        $TextSQL =" SELECT DISTINCT 	APPS.id AS id_app, 	APPS.uuid AS uuid_app, 	APPS.app, 	APPS.`name` AS name_app, 	ALCANCE.id AS permisos_reporte, 	ALCANCE.nombre AS nom_alcance, 	TPROCESS.id AS id_proceso_tipo,
                        TPROCESS.uuid AS uuid_proceso_tipo, 	TPROCESS.nombre AS nombre_proceso_tipo, 	P2P.id AS id_evaluacion, 	P2P.uuid AS uuid_evaluacion, 	P2P.nombre AS nomevaluacion, 	P2PAsig.id_evaluador, 	P2PAsig.id_evaluado,
                        IFNULL (( SELECT nombres FROM zoom_users AS USERS WHERE USERS.id = P2PAsig.id_evaluado ), 0 ) AS nom_evaluado,
                        IFNULL (( SELECT uuid FROM zoom_users AS USERS WHERE USERS.id = P2PAsig.id_evaluado ), 0 ) AS uuid_evaluado,
                        P2PAsig.realizado , P2P.id_empresa,  ALCANCESPROCESO.fecha_desde,  ALCANCESPROCESO.fecha_hasta
                    FROM
                        grw_procesos AS ALCANCESPROCESO
                        INNER JOIN olc_alcances AS ALCANCE ON ALCANCESPROCESO.permisos_reporte = ALCANCE.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROCESO.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_tuc_p2p_estudios AS P2P ON ALCANCESPROCESO.id_proceso = P2P.id
                        INNER JOIN grw_tuc_p2p_asignaciones AS P2PAsig ON P2PAsig.id_evaluacion = P2P.id
                    WHERE
                            ALCANCESPROCESO.id_proceso_tipo = 1 AND ALCANCESPROCESO.fecha_desde >= '$FechaIni'   AND ALCANCESPROCESO.fecha_hasta <= '$FechaFin'
                        AND P2PAsig.id_evaluador            = $IdTrabajador  AND ALCANCE.id       = 1
                        AND P2P.eliminado                   = 0 AND P2P.inactivo                  = 0
                        AND P2PAsig.eliminado               = 0 AND P2PAsig.inactivo              = 0
                        AND APPS.eliminado                  = 0 AND APPS.inactivo                 = 0
                        AND ALCANCESPROCESO.visible        = 1
                UNION

                        SELECT DISTINCT 	APPS.id AS id_app, 	APPS.uuid AS uuid_app, 	APPS.app, 	APPS.`name` AS name_app, 	ALCANCE.id AS permisos_reporte, 	ALCANCE.nombre AS nom_alcance, 	TPROCESS.id AS id_proceso_tipo,
                        TPROCESS.uuid AS uuid_proceso_tipo, 	TPROCESS.nombre AS nombre_proceso_tipo, 	P2P.id AS id_evaluacion, 	P2P.uuid AS uuid_evaluacion, 	P2P.nombre AS nomevaluacion, 	P2PAsig.id_evaluador, 	P2PAsig.id_evaluado,
                        IFNULL (( SELECT nombres FROM zoom_users AS USERS WHERE USERS.id = P2PAsig.id_evaluado ), 0 ) AS nom_evaluado,
                        IFNULL (( SELECT uuid FROM zoom_users AS USERS WHERE USERS.id = P2PAsig.id_evaluado ), 0 ) AS uuid_evaluado,
                        P2PAsig.realizado , P2P.id_empresa,  ALCANCESPROCESO.fecha_desde,  ALCANCESPROCESO.fecha_hasta
                    FROM
                        grw_procesos AS ALCANCESPROCESO
                        INNER JOIN olc_alcances AS ALCANCE ON ALCANCESPROCESO.permisos_reporte = ALCANCE.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROCESO.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_tuc_p2p_estudios AS P2P ON ALCANCESPROCESO.id_proceso = P2P.id
                        INNER JOIN grw_tuc_p2p_asignaciones AS P2PAsig ON P2PAsig.id_evaluacion = P2P.id
                        INNER JOIN grw_procesos_miembros AS GRUPTRABAJ ON GRUPTRABAJ.id_alcance_proceso = ALCANCESPROCESO.id
                    WHERE
                        ALCANCESPROCESO.id_proceso_tipo = 1 AND ALCANCESPROCESO.fecha_desde >= '$FechaIni'  AND ALCANCESPROCESO.fecha_hasta <= '$FechaFin'  AND P2PAsig.id_evaluador = $IdTrabajador
                        AND ALCANCE.id = 1 AND GRUPTRABAJ.id_trabajador = $IdTrabajador AND ALCANCESPROCESO.visible        = 1
                        AND P2P.eliminado                   = 0 AND P2P.inactivo                  = 0
                        AND P2PAsig.eliminado               = 0 AND P2PAsig.inactivo              = 0
                        AND APPS.eliminado                  = 0 AND APPS.inactivo                 = 0
                UNION

                        SELECT DISTINCT 	APPS.id AS id_app, 	APPS.uuid AS uuid_app, 	APPS.app, 	APPS.`name` AS name_app, 	ALCANCE.id AS permisos_reporte, 	ALCANCE.nombre AS nom_alcance, 	TPROCESS.id AS id_proceso_tipo,
                        TPROCESS.uuid AS uuid_proceso_tipo, 	TPROCESS.nombre AS nombre_proceso_tipo, 	P2P.id AS id_evaluacion, 	P2P.uuid AS uuid_evaluacion, 	P2P.nombre AS nomevaluacion, 	P2PAsig.id_evaluador, 	P2PAsig.id_evaluado,
                        IFNULL (( SELECT nombres FROM zoom_users AS USERS WHERE USERS.id = P2PAsig.id_evaluado ), 0 ) AS nom_evaluado,
                        IFNULL (( SELECT uuid FROM zoom_users AS USERS WHERE USERS.id = P2PAsig.id_evaluado ), 0 ) AS uuid_evaluado,
                        P2PAsig.realizado , P2P.id_empresa,  ALCANCESPROCESO.fecha_desde,  ALCANCESPROCESO.fecha_hasta
                    FROM
                        grw_procesos AS ALCANCESPROCESO
                        INNER JOIN olc_alcances AS ALCANCE ON ALCANCESPROCESO.permisos_reporte = ALCANCE.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROCESO.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_tuc_p2p_estudios AS P2P ON ALCANCESPROCESO.id_proceso = P2P.id
                        INNER JOIN grw_tuc_p2p_asignaciones AS P2PAsig ON P2PAsig.id_evaluacion = P2P.id
                        INNER JOIN grw_procesos_miembros AS GRUPTRABAJ ON GRUPTRABAJ.id_alcance_proceso = ALCANCESPROCESO.id
                    WHERE
                        ALCANCESPROCESO.id_proceso_tipo = 1  AND ALCANCESPROCESO.fecha_desde >= '$FechaIni'  AND ALCANCESPROCESO.fecha_hasta <= '$FechaFin'   AND P2PAsig.id_evaluador = $IdTrabajador  AND ALCANCE.id = 1
                        AND GRUPTRABAJ.id_grupo
                        AND ALCANCESPROCESO.visible        = 1
                        AND P2P.eliminado                   = 0 AND P2P.inactivo                  = 0
                        AND P2PAsig.eliminado               = 0 AND P2PAsig.inactivo              = 0
                        AND APPS.eliminado                  = 0 AND APPS.inactivo                 = 0
                        IN ( SELECT DISTINCT GRUPOS.id_grupo  FROM  grw_grupos_miembros AS GRUPOS  WHERE GRUPOS.id_trabajador = $IdTrabajador  AND GRUPOS.inactivo = 0   AND GRUPOS.eliminado = 0)    ";

           $Response =  $this->_ZOOM->RUN_SQL ($TextSQL);

           return P2pOrdered ( $Response );
    }

    private function P2B ($IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin) {
        $TextSQL ="SELECT 	APPS.id AS id_app, 	APPS.uuid AS uuid_app, 	APPS.app, 	APPS.`name` AS name_app, 	TPROCESS.id AS id_proceso_tipo,	TPROCESS.uuid AS uuid_proceso_tipo,	TPROCESS.nombre AS nombre_proceso_tipo, 	EVAL.id AS id_evaluacion,
                    EVAL.uuid AS uuid_evaluacion, EVAL.nombre AS nomevaluacion, P2B.realizado, ALCANCESPROCESOS.fecha_desde, ALCANCESPROCESOS.fecha_hasta, ALCANCES.id AS permisos_reporte, ALCANCES.nombre AS nom_alcance , EVAL.id_empresa
                        FROM
                        grw_procesos AS ALCANCESPROCESOS
                        INNER JOIN olc_alcances AS ALCANCES ON ALCANCESPROCESOS.permisos_reporte = ALCANCES.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROCESOS.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_tuc_p2p_estudios AS EVAL ON ALCANCESPROCESOS.id_proceso = EVAL.id
                        INNER JOIN grw_tuc_p2b_asignaciones AS P2B ON P2B.id_evaluacion = EVAL.id
                        WHERE
                        ALCANCESPROCESOS.id_proceso_tipo = 2 AND P2B.realizado = 0 AND ALCANCES.id = 1
                        AND ALCANCESPROCESOS.fecha_desde >= '$FechaIni'
                        AND ALCANCESPROCESOS.fecha_hasta <= '$FechaFin'
                        AND P2B.id_evaluador = $IdTrabajador AND ALCANCESPROCESOS.visible        = 1
                        AND EVAL.eliminado = 0 AND EVAL.inactivo = 0
                        AND P2B.eliminado = 0 AND P2B.inactivo = 0
                        AND APPS.eliminado = 0 AND APPS.inactivo = 0

                    UNION
                        SELECT 	APPS.id AS id_app, 	APPS.uuid AS uuid_app, 	APPS.app, 	APPS.`name` AS name_app, 	TPROCESS.id AS id_proceso_tipo,	TPROCESS.uuid AS uuid_proceso_tipo,	TPROCESS.nombre AS nombre_proceso_tipo, 	EVAL.id AS id_evaluacion,
                                EVAL.uuid AS uuid_evaluacion, EVAL.nombre AS nomevaluacion, P2B.realizado, ALCANCESPROCESOS.fecha_desde, ALCANCESPROCESOS.fecha_hasta, ALCANCES.id AS permisos_reporte, ALCANCES.nombre AS nom_alcance , EVAL.id_empresa
                        FROM
                        grw_procesos AS ALCANCESPROCESOS
                        INNER JOIN olc_alcances AS ALCANCES ON ALCANCESPROCESOS.permisos_reporte = ALCANCES.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROCESOS.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_tuc_p2p_estudios AS EVAL ON ALCANCESPROCESOS.id_proceso = EVAL.id
                        INNER JOIN grw_tuc_p2b_asignaciones AS P2B ON P2B.id_evaluacion = EVAL.id
                        INNER JOIN grw_procesos_miembros AS GRUPTRABAJ ON GRUPTRABAJ.id_alcance_proceso = ALCANCESPROCESOS.id
                        WHERE
                        ALCANCESPROCESOS.id_proceso_tipo = 2 AND P2B.realizado = 0 AND ALCANCES.id = 1
                        AND ALCANCESPROCESOS.fecha_desde >= '$FechaIni'
                        AND ALCANCESPROCESOS.fecha_hasta <= '$FechaFin'
                        AND P2B.id_evaluador = $IdTrabajador
                        AND EVAL.eliminado = 0 AND EVAL.inactivo = 0
                        AND P2B.eliminado = 0 AND P2B.inactivo = 0
                        AND APPS.eliminado = 0 AND APPS.inactivo = 0
                        AND GRUPTRABAJ.id_trabajador = $IdTrabajador AND ALCANCESPROCESOS.visible        = 1
                    UNION
                        SELECT 	APPS.id AS id_app, 	APPS.uuid AS uuid_app, 	APPS.app, 	APPS.`name` AS name_app, 	TPROCESS.id AS id_proceso_tipo,	TPROCESS.uuid AS uuid_proceso_tipo,	TPROCESS.nombre AS nombre_proceso_tipo, 	EVAL.id AS id_evaluacion,
                                EVAL.uuid AS uuid_evaluacion, EVAL.nombre AS nomevaluacion, P2B.realizado, ALCANCESPROCESOS.fecha_desde, ALCANCESPROCESOS.fecha_hasta, ALCANCES.id AS permisos_reporte, ALCANCES.nombre AS nom_alcance , EVAL.id_empresa
                        FROM
                        grw_procesos AS ALCANCESPROCESOS
                        INNER JOIN olc_alcances AS ALCANCES ON ALCANCESPROCESOS.permisos_reporte = ALCANCES.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROCESOS.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_tuc_p2p_estudios AS EVAL ON ALCANCESPROCESOS.id_proceso = EVAL.id
                        INNER JOIN grw_tuc_p2b_asignaciones AS P2B ON P2B.id_evaluacion = EVAL.id
                        INNER JOIN grw_procesos_miembros AS GRUPTRABAJ ON GRUPTRABAJ.id_alcance_proceso = ALCANCESPROCESOS.id
                        WHERE
                        ALCANCESPROCESOS.id_proceso_tipo = 2 AND P2B.realizado = 0 AND ALCANCES.id = 1
                        AND ALCANCESPROCESOS.fecha_desde >= '$FechaIni'
                        AND ALCANCESPROCESOS.fecha_hasta <= '$FechaFin'
                        AND P2B.id_evaluador = $IdTrabajador
                        AND GRUPTRABAJ.id_grupo
                        AND EVAL.eliminado                   = 0 AND EVAL.inactivo = 0
                        AND P2B.eliminado                    = 0 AND P2B.inactivo  = 0
                        AND APPS.eliminado                   = 0 AND APPS.inactivo = 0
                        AND ALCANCESPROCESOS.visible        = 1
                        IN ( SELECT DISTINCT GRUPOS.id_grupo  FROM  grw_grupos_miembros AS GRUPOS
                            WHERE GRUPOS.id_trabajador = $IdTrabajador  AND GRUPOS.inactivo = 0   AND GRUPOS.eliminado = 0) "  ;
                $Response =  $this->_ZOOM->RUN_SQL ($TextSQL);
                return P2bOrdered ( $Response );

    }

    private function ACT ( $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin ) {

        $TextSQL ="SELECT DISTINCT  APPS.id AS id_app,  APPS.uuid AS uuid_app,  APPS.app,  APPS.`name` AS name_app, ACTIVIDADES.id AS idactividad,  TPROCESS.id AS id_proceso_tipo,
                        TPROCESS.uuid AS uuid_proceso_tipo, TPROCESS.nombre AS nombre_proceso_tipo,  ACTIVIDADES.uuid AS uuid_actividad, ACTIVIDADES.nombre AS nomactividad,
                        ALCANCESPROC.permisos_reporte, ALCANCES.nombre AS nom_alcance, ALCANCESPROC.fecha_desde,  ALCANCESPROC.fecha_hasta, CATEG.id AS id_categ,
                        CATEG.uuid AS uuid_categ,  CATEG.nombre AS nombre_categ, ACTIVIDADES.id_empresa ,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id),0) AS interactividades,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 1 ),0) AS encuestas,
                        IFNULL ((  SELECT COUNT(DISTINCT id_dinamica ) FROM  grw_sol_act_encuestas WHERE id_actividad = ACTIVIDADES.id AND id_trabajador = $IdTrabajador ) , 0) AS encuestas_ok ,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 2 ),0) AS reconocimientos,
                        IFNULL (( SELECT COUNT(DISTINCT id_dinamica ) FROM  grw_sol_act_reconocimientos              WHERE id_actividad = ACTIVIDADES.id AND id_trabajador = $IdTrabajador ) , 0) AS reconocimientos_ok,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 3 ),0) AS campanas,
                        IFNULL (( SELECT COUNT(DISTINCT id_dinamica ) FROM  grw_sol_act_campanias                     WHERE id_actividad = ACTIVIDADES.id AND id_trabajador = $IdTrabajador ) , 0) AS campanas_ok
                    FROM
                        grw_procesos AS ALCANCESPROC
                        INNER JOIN olc_alcances AS ALCANCES ON ALCANCESPROC.permisos_reporte = ALCANCES.id
                        INNER JOIN grw_lel_actividades AS ACTIVIDADES ON ALCANCESPROC.id_proceso = ACTIVIDADES.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROC.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_lel_categorias AS CATEG ON ACTIVIDADES.id_categoria = CATEG.id
                        INNER JOIN grw_lel_dinamicas AS INTERACTIV ON INTERACTIV.id_actividad = ACTIVIDADES.id
                        INNER JOIN zoom_users AS USERS ON ACTIVIDADES.id_empresa = USERS.id_empresa
                    WHERE
                        ALCANCESPROC.fecha_desde >= '$FechaIni'  AND ALCANCESPROC.fecha_hasta <= '$FechaFin'
                        AND ACTIVIDADES.inactivo = 0    AND ALCANCESPROC.id_proceso_tipo = 3    AND ACTIVIDADES.eliminado = 0
                        AND USERS.id = $IdTrabajador    AND USERS.inactivo = 0                  AND USERS.eliminado = 0
                        AND ALCANCES.id = 1             AND ALCANCES.inactivo = 0               AND ALCANCES.eliminado = 0
                        AND ALCANCESPROC.visible        = 1
                        AND INTERACTIV.inactivo = 0 AND INTERACTIV.eliminado = 0
                        AND APPS.eliminado                   = 0 AND APPS.inactivo = 0

                UNION

                SELECT DISTINCT  APPS.id AS id_app,  APPS.uuid AS uuid_app,  APPS.app,  APPS.`name` AS name_app, ACTIVIDADES.id AS idactividad,  TPROCESS.id AS id_proceso_tipo,
                        TPROCESS.uuid AS uuid_proceso_tipo, TPROCESS.nombre AS nombre_proceso_tipo,  ACTIVIDADES.uuid AS uuid_actividad, ACTIVIDADES.nombre AS nomactividad,
                        ALCANCESPROC.permisos_reporte, ALCANCES.nombre AS nom_alcance, ALCANCESPROC.fecha_desde,  ALCANCESPROC.fecha_hasta, CATEG.id AS id_categ,
                        CATEG.uuid AS uuid_categ,  CATEG.nombre AS nombre_categ, ACTIVIDADES.id_empresa ,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id),0) AS interactividades,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 1 ),0) AS encuestas,
                        IFNULL ((  SELECT COUNT(DISTINCT id_dinamica ) FROM  grw_sol_act_encuestas WHERE id_actividad = ACTIVIDADES.id AND id_trabajador = $IdTrabajador ) , 0) AS encuestas_ok ,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 2 ),0) AS reconocimientos,
                        IFNULL (( SELECT COUNT(DISTINCT id_dinamica ) FROM  grw_sol_act_reconocimientos              WHERE id_actividad = ACTIVIDADES.id AND id_trabajador = $IdTrabajador ) , 0) AS reconocimientos_ok,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 3 ),0) AS campanas,
                        IFNULL (( SELECT COUNT(DISTINCT id_dinamica ) FROM  grw_sol_act_campanias                     WHERE id_actividad = ACTIVIDADES.id AND id_trabajador = $IdTrabajador ) , 0) AS campanas_ok
                    FROM
                        grw_procesos AS ALCANCESPROC
                        INNER JOIN olc_alcances AS ALCANCES ON ALCANCESPROC.permisos_reporte = ALCANCES.id
                        INNER JOIN grw_lel_actividades AS ACTIVIDADES ON ALCANCESPROC.id_proceso = ACTIVIDADES.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROC.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_lel_categorias AS CATEG ON ACTIVIDADES.id_categoria = CATEG.id
                        INNER JOIN grw_lel_dinamicas AS INTERACTIV ON INTERACTIV.id_actividad = ACTIVIDADES.id
                        INNER JOIN zoom_users AS USERS ON ACTIVIDADES.id_empresa = USERS.id_empresa
                        INNER JOIN grw_procesos_miembros AS GRUPTRABAJ ON GRUPTRABAJ.id_alcance_proceso = ALCANCESPROC.id
                    WHERE
                        ALCANCESPROC.fecha_desde >= '$FechaIni'  AND ALCANCESPROC.fecha_hasta <= '$FechaFin'
                        AND ACTIVIDADES.inactivo = 0    AND ALCANCESPROC.id_proceso_tipo = 3    AND ACTIVIDADES.eliminado = 0
                        AND USERS.inactivo = 0                  AND USERS.eliminado = 0
                        AND ALCANCES.id = 2             AND ALCANCES.inactivo = 0               AND ALCANCES.eliminado = 0
                        AND INTERACTIV.inactivo = 0 AND INTERACTIV.eliminado = 0
                        AND APPS.eliminado                   = 0 AND APPS.inactivo = 0
                        AND GRUPTRABAJ.id_trabajador = $IdTrabajador AND ALCANCESPROC.visible        = 1


                UNION

                SELECT DISTINCT  APPS.id AS id_app,  APPS.uuid AS uuid_app,  APPS.app,  APPS.`name` AS name_app, ACTIVIDADES.id AS idactividad,  TPROCESS.id AS id_proceso_tipo,
                        TPROCESS.uuid AS uuid_proceso_tipo, TPROCESS.nombre AS nombre_proceso_tipo,  ACTIVIDADES.uuid AS uuid_actividad, ACTIVIDADES.nombre AS nomactividad,
                        ALCANCESPROC.permisos_reporte, ALCANCES.nombre AS nom_alcance, ALCANCESPROC.fecha_desde,  ALCANCESPROC.fecha_hasta, CATEG.id AS id_categ,
                        CATEG.uuid AS uuid_categ,  CATEG.nombre AS nombre_categ, ACTIVIDADES.id_empresa ,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id),0) AS interactividades,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 1 ),0) AS encuestas,
                        IFNULL ((  SELECT COUNT(DISTINCT id_dinamica ) FROM  grw_sol_act_encuestas WHERE id_actividad = ACTIVIDADES.id AND id_trabajador = $IdTrabajador ) , 0) AS encuestas_ok ,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 2 ),0) AS reconocimientos,
                        IFNULL (( SELECT COUNT(DISTINCT id_dinamica ) FROM  grw_sol_act_reconocimientos              WHERE id_actividad = ACTIVIDADES.id AND id_trabajador = $IdTrabajador ) , 0) AS reconocimientos_ok,
                        IFNULL (( SELECT COUNT( id)                         FROM grw_lel_dinamicas AS INTERACTIVIDADES   WHERE  INTERACTIVIDADES.id_actividad = ACTIVIDADES.id AND INTERACTIVIDADES.id_modelo = 3 ),0) AS campanas,
                        IFNULL (( SELECT COUNT(DISTINCT id_dinamica ) FROM  grw_sol_act_campanias                     WHERE id_actividad = ACTIVIDADES.id AND id_trabajador = $IdTrabajador ) , 0) AS campanas_ok
                    FROM
                        grw_procesos AS ALCANCESPROC
                        INNER JOIN olc_alcances AS ALCANCES ON ALCANCESPROC.permisos_reporte = ALCANCES.id
                        INNER JOIN grw_lel_actividades AS ACTIVIDADES ON ALCANCESPROC.id_proceso = ACTIVIDADES.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROC.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_lel_categorias AS CATEG ON ACTIVIDADES.id_categoria = CATEG.id
                        INNER JOIN grw_lel_dinamicas AS INTERACTIV ON INTERACTIV.id_actividad = ACTIVIDADES.id
                        INNER JOIN zoom_users AS USERS ON ACTIVIDADES.id_empresa = USERS.id_empresa
                        INNER JOIN grw_procesos_miembros AS GRUPTRABAJ ON GRUPTRABAJ.id_alcance_proceso = ALCANCESPROC.id
                    WHERE
                        ALCANCESPROC.fecha_desde >= '$FechaIni'  AND ALCANCESPROC.fecha_hasta <= '$FechaFin'
                        AND ACTIVIDADES.inactivo = 0    AND ALCANCESPROC.id_proceso_tipo = 3    AND ACTIVIDADES.eliminado = 0
                        AND USERS.inactivo = 0                  AND USERS.eliminado = 0
                        AND ALCANCES.id = 2             AND ALCANCES.inactivo = 0               AND ALCANCES.eliminado = 0
                        AND GRUPTRABAJ.id_grupo     AND ALCANCESPROC.visible        = 1
                        AND INTERACTIV.inactivo = 0 AND INTERACTIV.eliminado = 0 AND APPS.inactivo = 0 AND APPS.eliminado = 0

                            IN ( SELECT DISTINCT GRUPOS.id_grupo  FROM  grw_grupos_miembros AS GRUPOS
                                WHERE GRUPOS.id_trabajador = $IdTrabajador   AND GRUPOS.inactivo = 0   AND GRUPOS.eliminado = 0) ";

                $Response =  $this->_ZOOM->RUN_SQL ($TextSQL);

                return  ActOrdered ( $Response, $FechaIni, $FechaFin );
    }

    public function PYT ( $IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin ) {

        $TextSQL = "  SELECT  APPS.id AS id_app, APPS.uuid AS uuid_app,  APPS.app, APPS.`name` AS name_app, TPROCESS.id AS id_proceso_tipo, TPROCESS.uuid AS uuid_proceso_tipo,
                            TPROCESS.nombre AS nombre_proceso_tipo, PROY.id AS idproyecto,  PROY.uuid AS uuid_proyecto,  PROY.nombre, ALCANCESPROCESOS.permisos_reporte,
                            ALCANCES.nombre AS nom_alcance,   ALCANCESPROCESOS.fecha_desde, ALCANCESPROCESOS.fecha_hasta, PROY.id_empresa,
                            PROY.id_responsable, PROY.id_semana_desde, PROY.id_semana_hasta,  PROY.tipo, PROY.descripcion, PROY.inactivo,  PROY.eliminado,
                            PROY.fecha,
                            IFNULL(( SELECT nombres FROM zoom_users WHERE zoom_users.id = PROY.id_responsable),0) as nom_responsable,
							IFNULL(( SELECT uuid FROM zoom_users WHERE zoom_users.id = PROY.id_responsable),0) as uuid_responsable
                        FROM
                            grw_procesos AS ALCANCESPROCESOS
                            INNER JOIN olc_alcances AS ALCANCES ON ALCANCESPROCESOS.permisos_reporte = ALCANCES.id
                            INNER JOIN grw_okr_proyectos AS PROY ON ALCANCESPROCESOS.id_proceso = PROY.id
                            INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROCESOS.id_proceso_tipo = TPROCESS.id
                            INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        WHERE
                            ALCANCESPROCESOS.id_proceso_tipo = 4
                            AND ALCANCESPROCESOS.fecha_desde >= '$FechaIni'
                            AND ALCANCESPROCESOS.fecha_hasta <= '$FechaFin'
                            AND PROY.id_empresa = $IdEmpresa AND ALCANCES.id = 1
                            AND ALCANCESPROCESOS.visible = 1
                            AND PROY.eliminado = 0 AND PROY.inactivo = 0
                            AND APPS.inactivo = 0 AND APPS.eliminado = 0
                    UNION
                    SELECT  APPS.id AS id_app, APPS.uuid AS uuid_app,  APPS.app, APPS.`name` AS name_app, TPROCESS.id AS id_proceso_tipo, TPROCESS.uuid AS uuid_proceso_tipo,
                            TPROCESS.nombre AS nombre_proceso_tipo, PROY.id AS idproyecto,  PROY.uuid AS uuid_proyecto,  PROY.nombre, ALCANCESPROCESOS.permisos_reporte,
                            ALCANCES.nombre AS nom_alcance,   ALCANCESPROCESOS.fecha_desde, ALCANCESPROCESOS.fecha_hasta, PROY.id_empresa,
                            PROY.id_responsable, PROY.id_semana_desde, PROY.id_semana_hasta,  PROY.tipo, PROY.descripcion, PROY.inactivo,  PROY.eliminado,
                            PROY.fecha ,
                            IFNULL(( SELECT nombres FROM zoom_users WHERE zoom_users.id = PROY.id_responsable),0) as nom_responsable,
							IFNULL(( SELECT uuid FROM zoom_users WHERE zoom_users.id = PROY.id_responsable),0) as uuid_responsable
                        FROM
                            grw_procesos AS ALCANCESPROCESOS
                            INNER JOIN olc_alcances AS ALCANCES ON ALCANCESPROCESOS.permisos_reporte = ALCANCES.id
                            INNER JOIN grw_okr_proyectos AS PROY ON ALCANCESPROCESOS.id_proceso = PROY.id
                            INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROCESOS.id_proceso_tipo = TPROCESS.id
                            INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                            INNER JOIN grw_procesos_miembros AS GRUPTRABAJ ON GRUPTRABAJ.id_alcance_proceso = ALCANCESPROCESOS.id
                        WHERE
                            ALCANCESPROCESOS.id_proceso_tipo = 4
                            AND ALCANCESPROCESOS.fecha_desde >= '$FechaIni'
                            AND ALCANCESPROCESOS.fecha_hasta <= '$FechaFin'
                            AND PROY.id_empresa = $IdEmpresa
                            AND ALCANCESPROCESOS.visible = 1
                            AND PROY.eliminado = 0 AND PROY.inactivo = 0
                            AND APPS.inactivo = 0 AND APPS.eliminado = 0
                             AND ALCANCES.id = 2  AND GRUPTRABAJ.id_trabajador = $IdTrabajador

                    UNION
                    SELECT  APPS.id AS id_app, APPS.uuid AS uuid_app,  APPS.app, APPS.`name` AS name_app, TPROCESS.id AS id_proceso_tipo, TPROCESS.uuid AS uuid_proceso_tipo,
                            TPROCESS.nombre AS nombre_proceso_tipo, PROY.id AS idproyecto,  PROY.uuid AS uuid_proyecto,  PROY.nombre, ALCANCESPROCESOS.permisos_reporte,
                            ALCANCES.nombre AS nom_alcance,   ALCANCESPROCESOS.fecha_desde, ALCANCESPROCESOS.fecha_hasta, PROY.id_empresa,
                            PROY.id_responsable, PROY.id_semana_desde, PROY.id_semana_hasta,  PROY.tipo, PROY.descripcion, PROY.inactivo,  PROY.eliminado,
                            PROY.fecha ,
                            IFNULL(( SELECT nombres FROM zoom_users WHERE zoom_users.id = PROY.id_responsable),0) as nom_responsable,
							IFNULL(( SELECT uuid FROM zoom_users WHERE zoom_users.id = PROY.id_responsable),0) as uuid_responsable
                        FROM
                            grw_procesos AS ALCANCESPROCESOS
                            INNER JOIN olc_alcances AS ALCANCES ON ALCANCESPROCESOS.permisos_reporte = ALCANCES.id
                            INNER JOIN grw_okr_proyectos AS PROY ON ALCANCESPROCESOS.id_proceso = PROY.id
                            INNER JOIN olc_procesos AS TPROCESS ON ALCANCESPROCESOS.id_proceso_tipo = TPROCESS.id
                            INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                            INNER JOIN grw_procesos_miembros AS GRUPTRABAJ ON GRUPTRABAJ.id_alcance_proceso = ALCANCESPROCESOS.id
                        WHERE
                            ALCANCESPROCESOS.id_proceso_tipo = 4 AND ALCANCESPROCESOS.fecha_desde >= '$FechaIni' AND ALCANCESPROCESOS.fecha_hasta <= '$FechaFin' AND PROY.id_empresa = $IdEmpresa
                            AND ALCANCES.id = 2 	AND  GRUPTRABAJ.id_grupo
                            AND PROY.inactivo = 0 AND PROY.eliminado = 0 AND APPS.inactivo = 0 AND APPS.eliminado = 0
                            AND ALCANCESPROCESOS.visible = 1
                            IN ( SELECT DISTINCT GRUPOS.id_grupo  FROM  grw_grupos_miembros AS GRUPOS
                                WHERE GRUPOS.id_trabajador = $IdTrabajador  AND GRUPOS.inactivo = 0   AND GRUPOS.eliminado = 0)  " ;

            $Response    = $this->_ZOOM->RUN_SQL ($TextSQL);
            return  PytsOrdered ( $Response, $FechaIni, $FechaFin );
    }

    private function VAL ($IdEmpresa, $IdTrabajador, $FechaIni, $FechaFin) {

        $TextSQL = "
            SELECT
                ASG.id, ASG.uuid, ASG.completado,
                ENC.id id_encuesta, ENC.uuid uuid_encuesta, ENC.nombre nombre_encuesta

            FROM grw_val_asignaciones ASG
                INNER JOIN grw_val_encuestas ENC ON ENC.id = ASG.id_encuesta
                INNER JOIN zoom_users USR ON USR.id = ASG.id_trabajador
                INNER JOIN grw_val_listas LST ON LST.id = ASG.id_val_lista
                INNER JOIN grw_val_investigaciones INV ON INV.id = ASG.id_investigacion
                INNER JOIN grw_val_eventos EVN ON EVN.id = ASG.id_evento
                INNER JOIN grw_val_valoraciones VAL ON VAL.id = ASG.id_valoracion

            WHERE ASG.inactivo = 0 AND ASG.eliminado = 0
                AND ENC.inactivo = 0 AND ENC.eliminado = 0
                AND USR.inactivo = 0 AND USR.eliminado = 0
                AND LST.inactivo = 0 AND LST.eliminado = 0
                AND INV.inactivo = 0 AND INV.eliminado = 0
                AND EVN.inactivo = 0 AND EVN.eliminado = 0
                AND VAL.inactivo = 0 AND VAL.eliminado = 0

                AND ASG.id_empresa = $IdEmpresa AND ASG.id_trabajador = $IdTrabajador
        " ;

        $Response = $this->_ZOOM->RUN_SQL ($TextSQL);
        return ValsOrdered ( $Response, $FechaIni, $FechaFin );

    }

    /* Aplicaciones habilitadas para un trabajador */
    private function MyAllowsApps ( $IdTrabajador = 0 ) {
        $TextSQL ="SELECT  APPS.id,  APPS.uuid,  APPS.app,  APPS.`name`   FROM grw_apps AS APPSCOMPANY
	                INNER JOIN zoom_users AS USERS ON  APPSCOMPANY.id_empresa = USERS.id_empresa
	                INNER JOIN olc_apps AS APPS
                    ON  APPSCOMPANY.id_app = APPS.id
                WHERE
                    USERS.id = $IdTrabajador
                    AND 	APPSCOMPANY.inactivo = 0  AND 	APPSCOMPANY.eliminado = 0
                    AND 	APPS.inactivo        = 0  AND 	APPS.eliminado = 0
                    AND 	USERS.inactivo       = 0  AND 	USERS.eliminado =0" ;
        $AllowApps = $this->_ZOOM->RUN_SQL ($TextSQL );
        return $this->VerifyAllowApps( $AllowApps);

    }

    /* Consulta posición de un trabajador . Cargo y Jefe WHERE TRABJCARGO.id_trabajador = " . $Worker['id'] . " */
    public function MiPosicion ( &$Worker ){

        $Worker = $this->VerifyMiPosicion ($Worker );
        $Worker['posicion_ok'] = 0;
        if ( $Worker['cargo'] != 0  && ($Worker['nom_jefe'] != 0 || $Worker['id_jefe'] == -1 )) $Worker['posicion_ok'] = 1;

        return $Worker['posicion_ok'];
    }

    private function VerifyMiPosicion ( &$Worker ){

        if ( !isset( $Worker['nom_jefe']) || $Worker['cargo'] == 0 ) {

            $Uiid = $Worker['uuid'];
            $TextSQL ="SELECT id_jefe,  IFNULL (( SELECT nombre from grw_cargos where grw_cargos.id = zoom_users.id_cargo),0) as cargo,
                        IFNULL (( SELECT nombres from zoom_users AS JEFES where JEFES.id = zoom_users.id_jefe),0) as nom_jefe
                            FROM zoom_users  WHERE (zoom_users.uuid = '$Uiid' )";
            $Response           = $this->_ZOOM->RUN_SQL ($TextSQL );
            $Worker['nom_jefe'] = $Response[0]['nom_jefe'] ;
            $Worker['id_jefe']  = $Response[0]['id_jefe'] ;
            $Worker['cargo']    = $Response[0]['cargo'] ;
        };

        return $Worker;
    }

    /* Consulta posición de un trabajador . Cargo y Jefe */
    public function MiSegmentacion ( &$Worker ) {


        $TextSQL = "SELECT DISTINCT SGMNTCNES.id AS id_param,  SGMNTCNES.uuid AS uuid_params,   SGMNTCNES.nombre AS nom_param,
                        IFNULL (( SELECT id_opcion FROM grw_sol_seg_perfilado AS PERFIL WHERE PERFIL.id_parametro = SGMNTCNES.id AND PERFIL.id_trabajador = " . $Worker['id'] . " AND PERFIL.inactivo = 0 AND PERFIL.eliminado = 0 ), 0 ) AS id_opcion,
                        IFNULL (( SELECT nombre FROM grw_segmentos AS SEGMENTOS WHERE SEGMENTOS.id = id_opcion AND SEGMENTOS.inactivo = 0 AND SEGMENTOS.eliminado = 0 ), 0 ) AS nom_opcion,
                        IFNULL (( SELECT COUNT(id) FROM grw_segmentos  WHERE grw_segmentos.id_parametro = SGMNTCNES.id),0) cant_segmentos
                    FROM
                        grw_segmentaciones AS SGMNTCNES
                    WHERE
                        SGMNTCNES.id_empresa = " . $Worker['id_empresa'] . "  AND   SGMNTCNES.inactivo = 0 AND  SGMNTCNES.eliminado = 0";

        $Response = $this->_ZOOM->RUN_SQL ($TextSQL );

        if($Response){

            $FilterResponse = array_filter($Response, function($item) { // Eliminar las segmentaciones que no tienen segmentos
                return $item['cant_segmentos'] != 0;
            });
            $Response  = array_values($FilterResponse);

        }

        $Worker['segmentacion']    = $Response ;

        $SegmentacionCompleta      = CountArray ( $Worker['segmentacion'], 'id_opcion', '0') ;

        $Worker['segmentacion_ok'] = $SegmentacionCompleta === 0 ? 1 : 0 ;


        return $Worker['segmentacion_ok'];
    }

    /* Verificación de si el trabajador tiene el perfil completo */
    public function PerfilCompleto ( &$Worker ) {

        return [
            'posicion'      => $this->MiPosicion( $Worker ),
            'segmentacion'  => $this->MiSegmentacion( $Worker ),
        ];
    }

    public function getCargo ( $condicion, $lista=false ) {
        $TextSQL = "SELECT id, uuid, id as id_trabajador, nombre, id_empresa, id_jefe, id_cargo,  inactivo,  eliminado
                        FROM zoom_users AS USERS
                    WHERE 1=1   $condicion  ORDER BY id DESC ";
        return $this->_ZOOM->RUN_SQL ($TextSQL, $lista );
    }

    public function ExistsCompanyEmail ( $Email ) {
        $TextSQL = "SELECT id   FROM zoom_users  WHERE email = '$Email' ";
        $Response =  $this->_ZOOM->RUN_SQL ($TextSQL, false );
        if ( $Response ) return true ;
        return false;
    }

    public function ExistsCompanyIdentication ( $Identificacion, $Empresa ) {
        $TextSQL = "SELECT id   FROM zoom_users  WHERE identificacion = '$Identificacion'  AND id_empresa = $Empresa ";
        $Response =  $this->_ZOOM->RUN_SQL ($TextSQL, false );
        if ( $Response ) return true ;
        return false;
    }

    public function AmI_Administrator ( $id_user ) {
        $TextSQL = "SELECT id_user   FROM zoom__users__roles  WHERE id_user = $id_user ";
        $Response =  $this->_ZOOM->RUN_SQL ($TextSQL, false );
        if ( $Response ) return true ;
        return false;
    }

}