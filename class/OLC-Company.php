<?php

require_once $_SESSION['_CLASS'].'OLC.php';
require_once $_SESSION['_CLASS'].'OLC-Platform.php';

class Company extends Platform {

    public $_ZOOM;
    private $IdColaborador, $IdEmpresa;

    public function __construct(){
        $this->_ZOOM = new Zoom();
    }

    public function GetColaboratorsCumpleAnios  (  ) {
        $AddToQuery  = " AND (mes_cumple)= MONTH( NOW())  ORDER BY dia_cumple";

        return OrderCumpleanios ( $this->GetColaborators ( $AddToQuery ) );
    }

    public function GetColaborators ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
        $TextSQL = "
            SELECT
                USERS.id, USERS.uuid, USERS.id_empresa,
                USERS.nombre, USERS.nombres, USERS.apellidos, USERS.trato,
                USERS.identificacion, USERS.identificacion_tipo,
                USERS.telefono, USERS.celular, USERS.email,
                USERS.dia_cumple, USERS.mes_cumple, USERS.anio_cumple,
                USERS.inactivo, USERS.fecha,
                USERS.id_jefe,
                USERS.id_rol,
                IFNULL (( SELECT id FROM zoom_users WHERE id = USERS.id_jefe),0 ) as jefe_id,
                IFNULL (( SELECT uuid FROM zoom_users WHERE id = USERS.id_jefe),0 ) as jefe_uuid,
                IFNULL (( SELECT nombre FROM zoom_users WHERE id = USERS.id_jefe),'' ) as jefe_nombre,
                IFNULL (( SELECT apellidos FROM zoom_users WHERE id = USERS.id_jefe),'' ) as jefe_apellidos,
                IFNULL (( SELECT inactivo FROM zoom_users WHERE id = USERS.id_jefe),0 ) as jefe_inactivo,
                IFNULL (( SELECT id_cargo FROM zoom_users WHERE id = USERS.id_jefe),0 ) as jefe_idcargo,
                IFNULL (( SELECT id FROM grw_cargos WHERE id = jefe_idcargo),'') as jefe_cargo_id,
                IFNULL (( SELECT uuid FROM grw_cargos WHERE id = jefe_idcargo),'') as jefe_cargo_uuid,
                IFNULL (( SELECT nombre FROM grw_cargos WHERE id = jefe_idcargo),'') as jefe_cargo_nombre,
                IFNULL (( SELECT inactivo FROM grw_cargos WHERE id = jefe_idcargo),'') as jefe_cargo_inactivo,
                IFNULL (( SELECT id FROM grw_cargos WHERE id = USERS.id_cargo),'') as cargo_id,
                IFNULL (( SELECT uuid FROM grw_cargos WHERE id = USERS.id_cargo),'') as cargo_uuid,
                IFNULL (( SELECT nombre FROM grw_cargos WHERE id = USERS.id_cargo),'') as cargo_nombre,
                IFNULL (( SELECT inactivo FROM grw_cargos WHERE id = USERS.id_cargo),'') as cargo_inactivo
            FROM
                zoom_users AS USERS
            WHERE
                USERS.eliminado = 0
                $AddToQuery
        ";

        $Response = $this->_ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
        return  DataStructure ('Colaborators', $Response, $ReturnRecord);
    }

    public function GetOrganigramas ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
        $TextSQL = " SELECT id,  uuid,  id_empresa,  nombre,  inactivo , activo, fecha
                      FROM  grw_organigramas AS ORGANIGRAMAS
                     WHERE eliminado = 0  $AddToQuery ";
        $Response = $this->_ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
        return  DataStructure ('OrganigramasLeletog', $Response, $ReturnRecord);
    }

    public function GetSegmentacionesAdmin ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
        $TextSQL = " SELECT
                PARAME.id,  PARAME.uuid,  PARAME.id_empresa,  PARAME.nombre,  PARAME.inactivo,
                OPCIONES.id AS opc_id,  OPCIONES.uuid AS opc_uuid, OPCIONES.nombre AS opc_alias, PARAME.fecha, OPCIONES.inactivo AS opc_inactivo
            FROM grw_segmentaciones AS PARAME
            LEFT JOIN grw_segmentos AS OPCIONES  ON  PARAME.id = OPCIONES.id_parametro AND OPCIONES.eliminado = 0
            WHERE PARAME.eliminado = 0
            $AddToQuery
        ";

        $Response = $this->_ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );

        return  DataStructureSegmentacionesLeletog ( $Response, $ReturnRecord);
    }

    public function GetSegmentaciones ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
        $TextSQL = " SELECT
                PARAME.id,  PARAME.uuid,  PARAME.id_empresa,  PARAME.nombre,  PARAME.inactivo,
                OPCIONES.id AS opc_id,  OPCIONES.uuid AS opc_uuid, OPCIONES.nombre AS opc_alias, PARAME.fecha, OPCIONES.inactivo AS opc_inactivo
            FROM grw_segmentaciones AS PARAME
            INNER JOIN grw_segmentos AS OPCIONES  ON  PARAME.id = OPCIONES.id_parametro AND OPCIONES.eliminado = 0
            WHERE PARAME.eliminado = 0
            $AddToQuery
        ";

        $Response = $this->_ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );

        return  DataStructureSegmentacionesLeletog ( $Response, $ReturnRecord);
    }

    public function GetCargos ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
        $TextSQL = " SELECT CARGOS.id,  CARGOS.uuid,  CARGOS.id_empresa,  CARGOS.nombre,  CARGOS.nivel,  CARGOS.inactivo,
                        IFNULL( (SELECT id FROM grw_cargos as DEPEND WHERE DEPEND.id = CARGOS.id_cargo) , 0) AS dependiente_id,
                        IFNULL( (SELECT uuid FROM grw_cargos as DEPEND WHERE DEPEND.id = CARGOS.id_cargo) , 0) AS dependiente_uuid,
                        IFNULL( (SELECT nombre FROM grw_cargos as DEPEND WHERE DEPEND.id = CARGOS.id_cargo) , 0) AS dependiente_nombre,
                        IFNULL( (SELECT inactivo FROM grw_cargos as DEPEND WHERE DEPEND.id = CARGOS.id_cargo) , 0) AS dependiente_inactivo,
                        ORGANIG.id AS orgngrma_id,  ORGANIG.uuid AS orgngrma_uuid,  ORGANIG.nombre AS orgngrma_nombre, ORGANIG.inactivo AS orgngrma_inactivo, ORGANIG.activo
                    FROM
                        grw_cargos AS CARGOS INNER JOIN grw_organigramas AS ORGANIG 	ON  CARGOS.id_organigrama = ORGANIG.id
                    WHERE
                          CARGOS.eliminado = 0 AND ORGANIG.eliminado = 0   $AddToQuery ";

        $Response = $this->_ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
        return  DataStructure ('CargosLeletog',  $Response, $ReturnRecord);
    }

    public function GetGruposCorporativos ($AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {

        $TextSQL = "
            SELECT
                GRUPOS.id, GRUPOS.uuid, GRUPOS.id_empresa, GRUPOS.nom_grupo, GRUPOS.descrp_grupo, GRUPOS.slogan_grupo, GRUPOS.imagen, GRUPOS.inactivo, GRUPOS.fecha,
                IFNULL ( (SELECT COUNT(id) FROM grw_grupos_miembros WHERE id_grupo = GRUPOS.id ), 0) AS total_integrantes
            FROM
                grw_grupos AS GRUPOS
            WHERE
                GRUPOS.eliminado = 0
            $AddToQuery
        ";

        $Response = $this->_ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
        return  DataStructure ('GruposCorporativos', $Response, $ReturnRecord);

    }

    public function GetGruposCorporativosIntegrantes ($AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {

        $TextSQL = "
            SELECT
                USERS.id AS user_id,  USERS.uuid AS user_uuid, USERS.nombre AS user_nombre, USERS.inactivo AS user_inactivo,
                CARGOS.id AS cargos_id, CARGOS.uuid AS cargos_uuid, CARGOS.nombre AS cargos_nombre, CARGOS.inactivo AS cargos_inactivo,
                TRABAJ.id AS id, TRABAJ.uuid AS uuid, TRABAJ.inactivo AS inactivo, TRABAJ.es_lider AS lider, TRABAJ.id_grupo, TRABAJ.id_empresa, TRABAJ.fecha
            FROM
                grw_grupos_miembros AS TRABAJ
                INNER JOIN zoom_users AS USERS ON TRABAJ.id_trabajador = USERS.id
                LEFT JOIN grw_cargos AS CARGOS ON USERS.id_cargo = CARGOS.id
            WHERE 1=1
                AND TRABAJ.inactivo = 0 AND TRABAJ.eliminado = 0
                AND USERS.inactivo = 0 AND USERS.eliminado = 0
                $AddToQuery
        ";

        $Response = $this->_ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );
        return DataStructure ('GruposCorporativosIntegrantes', $Response, $ReturnRecord);
    }

    public function GetAdministrators ( $AddToQuery = '', $ParametersToQuery = [], $ReturnRecord = false ) {
        $TextSQL = " SELECT ROLES.id AS rol_id, ROLES.uuid AS rol_uuid, ROLES.rol AS rol_nom, ROLES.inactivo AS rol_iniactivo, ROLES.fecha AS rol_fecha,
                USER_ROLES.id AS user_roles_id, USER_ROLES.uuid AS user_roles_uuid, USER_ROLES.inactivo as user_roles_inactivo,USER_ROLES.fecha as user_roles_fecha,
                USERS.id , USERS.uuid, USERS.nombre,
                CARGOS.nombre as cargo
            FROM
                zoom__users__roles AS USER_ROLES
                INNER JOIN zoom_roles AS ROLES ON USER_ROLES.id_rol = ROLES.id
                INNER JOIN zoom_users AS USERS ON USER_ROLES.id_user = USERS.id
                INNER JOIN grw_cargos AS CARGOS ON USERS.id_cargo = CARGOS.id
            WHERE
                    ROLES.eliminado = 0
                AND USERS.eliminado = 0 AND USER_ROLES.eliminado = 0
                ".$AddToQuery."
        ";

        $Response = $this->_ZOOM->RUN_SQL( $TextSQL, $ReturnRecord );

        return  DataStructure ('AdministratorStructure', $Response, $ReturnRecord);

    }

    public function GetDatosPanelControl ( $IdEmpresa ) {

       if ( $this->FlagDataOpen ($IdEmpresa )) $this->VerifyDatos($IdEmpresa, '','' );  // Hay nuevos datos en la empresa?

        $TextSQL = " SELECT * FROM grw_datos_panelcontrol WHERE id_empresa = $IdEmpresa ";
        $Response = $this->_ZOOM->RUN_SQL ($TextSQL );
        return [
            '4110' => $Response[0]['_4110'] ,   // Colaboradores
            '4115' => $Response[0]['_4115'] ,   // Grupos
            '4143' => $Response[0]['_4143'] ,   // Segmentos
            '4130' => $Response[0]['_4130']  ,  // Organigramas
            '4211' => $Response[0]['_4211']  ,  // P2P
            '4215' => $Response[0]['_4215']  ,  // P2B
            '4310' => $Response[0]['_4310']  ,  // Actividades
            '4410' => $Response[0]['_4410']  ,  // Proyectos - Okrs
            '4510' => $Response[0]['_4510']  ,  // Valoraciones
        ];
    }

    public function GetCompany (  $Value ='', $Campo='id'  ) {

        $TextSQL = "
            SELECT id,  uuid, nombre,  proposito, subdominio,  nit,  descripcion,  web,  logo,  color,  logo2,  color2
            FROM  olc_empresas
            WHERE $Campo = '$Value' AND eliminado = 0 AND inactivo = 0
        ";
        $Company         = $this->_ZOOM->RUN_SQL ($TextSQL, true );
        $Apps            = $this->getAppsCompany($Company['id']);
        $Company['apps'] = $Apps ;

        return $Company;

    }

    public function CountWorkers ( $IdEmpresa = 0) {
        $TextSQL = " SELECT '4110' , count(*) as ids    FROM  zoom_users WHERE id_empresa = $IdEmpresa  AND inactivo = 0 AND eliminado = 0";
        $Response     = $this->_ZOOM->RUN_SQL ($TextSQL );
        return $Response[0]['ids'];
    }

    public function CountGroups ( $IdEmpresa ) {
        $TextSQL =" SELECT count(*) as grupos from grw_grupos where id_empresa = $IdEmpresa AND inactivo = 0 AND eliminado = 0";
        $Response     = $this->_ZOOM->RUN_SQL ($TextSQL );
        return   $Response[0]['grupos'] ;
    }

    public function CountOrganigramas ( $IdEmpresa ) {
        $TextSQL =" SELECT COUNT(*) as organigramas from grw_organigramas WHERE id_empresa = $IdEmpresa AND inactivo = 0 AND eliminado = 0";
        $Response     = $this->_ZOOM->RUN_SQL ($TextSQL );
        return   $Response[0]['organigramas'] ;
    }

    public function CountSegmentos ( $IdEmpresa ) {
        $TextSQL =" SELECT count(*) as segmentos from grw_segmentaciones where id_empresa = $IdEmpresa  AND inactivo = 0 AND eliminado = 0";
        $Response     = $this->_ZOOM->RUN_SQL ($TextSQL );
        return   $Response[0]['segmentos'] ;
    }

    /* crea un nuevo registro en old_empresas_datos */
    private function NewCompanyData ( $IdEmpresa, $Campo, $Valor ) {
        $TextSQL  ="INSERT INTO grw_datos_panelcontrol (id_empresa,_$Campo) values ( $IdEmpresa, $Valor )";
        $this->_ZOOM->RUN_SQL ($TextSQL );
    }

    /* Actualiza un campo de old_empresas_datos */
    private function UpdateCompanyData ( $IdEmpresa ,$Campo, $Valor ) {
        $TextSQL  ="UPDATE grw_datos_panelcontrol SET _$Campo =  $Valor WHERE id_empresa= $IdEmpresa";
        $this->_ZOOM->RUN_SQL ($TextSQL );
    }

    public function NewUpdateHasDatos ( $parametro ){
        $TextSQL = "UPDATE olc_empresas SET has_datos = '0' WHERE id = '$parametro' || uuid = '$parametro' ";
        $this->_ZOOM->RUN_SQL ($TextSQL );
    }

    /* Verifica la bandera de la empresa */
    public function VerifyDatos ($IdEmpresa = 0, $FechaIni='', $FechaFin='') {
        if ($FechaIni == '') $FechaIni = '2024-01-01 00:00:00'; ;
        if ($FechaFin == '') $FechaFin = '2024-12-31 23:59:59';

        $TextSQL = " SELECT id_empresa FROM grw_datos_panelcontrol WHERE id_empresa = $IdEmpresa";
        $Response =  $this->_ZOOM->RUN_SQL ($TextSQL, true );

        if ( !$Response) $this->NewCompanyData( $IdEmpresa, '4110', 0);

        $this->UpdateCompanyData( $IdEmpresa, '4110', $this->CountWorkers ($IdEmpresa  ));
        $this->UpdateCompanyData( $IdEmpresa, '4115', $this->CountGroups ($IdEmpresa  ));
        $this->UpdateCompanyData( $IdEmpresa, '4143', $this->CountSegmentos ($IdEmpresa  ));
        $this->UpdateCompanyData( $IdEmpresa, '4130', $this->CountOrganigramas ($IdEmpresa  ));
        /*----------------------------------------------------------------------------------------------------------------*/
        $gp_P2P = $this->GetProcess ('P2P', $IdEmpresa, $FechaIni, $FechaFin );
        $gp_P2B = $this->GetProcess ('P2B', $IdEmpresa, $FechaIni, $FechaFin );
        $gp_ACT = $this->GetProcess ('ACT', $IdEmpresa, $FechaIni, $FechaFin );
        $gp_PYT = $this->GetProcess ('PYT', $IdEmpresa, $FechaIni, $FechaFin );

        $this->UpdateCompanyData( $IdEmpresa, '4211', ($gp_P2P) ? COUNT($gp_P2P) : 0 );
        $this->UpdateCompanyData( $IdEmpresa, '4215', ($gp_P2B) ? COUNT($gp_P2B) : 0 );
        $this->UpdateCompanyData( $IdEmpresa, '4310', ($gp_ACT) ? COUNT($gp_ACT) : 0 );
        $this->UpdateCompanyData( $IdEmpresa, '4410', ($gp_PYT) ? COUNT($gp_PYT) : 0 );
        $this->UpdateCompanyData( $IdEmpresa, '4510', 0 );

        $TextSQL = "UPDATE olc_empresas SET has_datos = 1 WHERE id = $IdEmpresa";
        $this->_ZOOM->RUN_SQL ($TextSQL );

        $TextSQL = "UPDATE grw_datos_panelcontrol SET last_update = '".date('Y-m-d H:i:s')."' WHERE id_empresa = $IdEmpresa";
        return $this->_ZOOM->RUN_SQL ($TextSQL );

    }

    public function FlagDataOpen ($IdEmpresa = 0) {
        $AddQuery = $IdEmpresa > 0 ? " AND id = $IdEmpresa " : '' ;
        $TextSQL = " SELECT id FROM olc_empresas WHERE has_datos = 0 $AddQuery";
        return $this->_ZOOM->RUN_SQL ($TextSQL );
    }

    private function getAppsCompany ( $IdEmpresa ) {
       $TextSQL = " SELECT APPS.id, APPS.uuid,APPS.internal,APPS.app,APPS.`name`,APPS.description,APPS.keywords,APPS.imagen,APPS.logo,
	                APPS.logow,APPS.favicon,APPS.color,APPS.color2,APPS.url_dev,APPS.url_test,APPS.url_prod, AppsEmpresa.inactivo
                    FROM
                        olc_empresas AS EMPRESAS
                        INNER JOIN grw_apps AS AppsEmpresa ON EMPRESAS.id = AppsEmpresa.id_empresa
                        INNER JOIN olc_apps AS APPS ON AppsEmpresa.id_app = APPS.id
                    WHERE
                            EMPRESAS.eliminado = 0
                        AND EMPRESAS.inactivo  = 0
                        AND EMPRESAS.id        = $IdEmpresa
                        AND APPS.inactivo      = 0
                        AND APPS.eliminado     = 0 AND AppsEmpresa.inactivo =0 AND AppsEmpresa.eliminado = 0 " ;
        $Apps =    $this->_ZOOM->RUN_SQL ($TextSQL );

        if($Apps){
            foreach($Apps as $App) {
                $MisApps[ $App['app'] ] = $App['inactivo'] == 0 ? 1 : 0 ;
            }
        }else{
            $MisApps = 0;
        }

        return $MisApps;

    }

    public function ActiveCompanies (   ) {
        $TextSQL = " SELECT 	id,  uuid, nombre,  proposito, subdominio,  nit,  descripcion,  contacto1,  cargo1,  telefonos1,  email1, contacto2, cargo2,  telefonos2, email2,  web,  logo,  color,  logo2,  color2,  inactivo, eliminado, fecha
                FROM   olc_empresas
            WHERE  eliminado = 0 AND inactivo = 0 AND id<>1";
         return    $this->_ZOOM->RUN_SQL ($TextSQL );
    }

    /*Aplicaciones habilitadas para una empresa */
    private function MyAllowsApps ( $IdEmpresa = 0 ) {
        $TextSQL = "
            SELECT
                APPS.id,  APPS.uuid,  APPS.app,  APPS.`name`
            FROM grw_apps AS APPSCOMPANY
                INNER JOIN olc_apps AS APPS ON APPSCOMPANY.id_app = APPS.id
            WHERE
                APPSCOMPANY.id_empresa = $IdEmpresa AND APPSCOMPANY.inactivo = 0
                AND APPSCOMPANY.eliminado = 0
                AND APPS.inactivo = 0
                AND APPS.eliminado = 0
        ";
        $AllowApps = $this->_ZOOM->RUN_SQL ($TextSQL );
        return $this->VerifyAllowApps($AllowApps);
    }

    public function GetProcesses ( $IdEmpresa, $FechaIni, $FechaFin ) {
        $AllowApp = $this->MyAllowsApps($IdEmpresa); // Revisar las Apps a las que el usuario tiene permiso

        return [
            'tucoach'  => ( isset($AllowApp['tucoach'] ) && $AllowApp['tucoach']    ) ? [ 'P2P'      => $this->GetProcess ('P2P', $IdEmpresa, $FechaIni, $FechaFin ),
                                                                                          'P2B'      => $this->GetProcess ('P2B', $IdEmpresa, $FechaIni, $FechaFin ) ] : 0,
            'leletog'  => ( isset($AllowApp['leletog'] ) && $AllowApp['leletog']    ) ? [ 'ACT'      => $this->GetProcess ('ACT', $IdEmpresa, $FechaIni, $FechaFin )]  : 0,
            'okr'      => ( isset($AllowApp['okr']     ) && $AllowApp['okr']        ) ? [ 'PYT'      => $this->GetProcess ('PYT', $IdEmpresa, $FechaIni, $FechaFin )]  : 0,
            'valora'   => ( isset($AllowApp['valora']  ) && $AllowApp['valora']     ) ? [ 'VAL'      => $this->GetProcess ('VAL', $IdEmpresa, $FechaIni, $FechaFin )]  : 0,
            'academia' => ( isset($AllowApp['academia']) && $AllowApp['academia']   ) ? 1  : 0,
        ];
    }

    public function GetProcess ( $Tipo, $IdEmpresa , $FechaIni, $FechaFin, $condicion = '') {
       return $this->$Tipo($IdEmpresa, $FechaIni, $FechaFin, $condicion = '');
    }

    private function P2P ($IdEmpresa, $FechaIni, $FechaFin, $condicion = '') {
        $TextSQL =" SELECT 	APPS.id AS id_app, 	APPS.uuid AS uuid_app, 	APPS.app, 	APPS.`name` AS name_app,
                        TPROCESS.id AS id_proceso_tipo,  TPROCESS.uuid AS uuid_proceso_tipo, TPROCESS.nombre AS nombre_proceso_tipo,
                        P2P.id AS id_evaluacion, P2P.uuid AS uuid_evaluacion,  P2P.nombre AS nomevaluacion,
                        olc_alcances.nombre AS alcance, ALCANCES.fecha_desde AS desde, ALCANCES.fecha_hasta AS hasta
                    FROM
                        grw_procesos AS ALCANCES
                        INNER JOIN olc_alcances ON ALCANCES.permisos_reporte = olc_alcances.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCES.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_tuc_p2p_estudios AS P2P ON ALCANCES.id_proceso = P2P.id
                    WHERE
                       ALCANCES.id_proceso_tipo = 1  AND ALCANCES.fecha_desde >= '$FechaIni'  AND ALCANCES.fecha_hasta <= '$FechaFin'
					   AND P2P.id_empresa = $IdEmpresa AND P2P.inactivo = 0 AND P2P.eliminado = 0  AND ALCANCES.id_proceso_tipo = 1 ";
            return $this->_ZOOM->RUN_SQL ($TextSQL);
    }

    private function P2B ($IdEmpresa, $FechaIni, $FechaFin, $condicion = '') {
        $TextSQL =" SELECT DISTINCT APPS.id AS id_app, APPS.uuid AS uuid_app, APPS.app,  APPS.`name` AS name_app,
                        TPROCESS.id AS id_proceso_tipo, TPROCESS.uuid AS uuid_proceso_tipo, TPROCESS.nombre AS nombre_proceso_tipo,
                        EVAL.id AS id_evaluacion, EVAL.uuid AS uuid_evaluacion, EVAL.nombre AS nomevaluacion,
                        olc_alcances.nombre AS alcance, ALCANCES.fecha_desde AS desde, ALCANCES.fecha_hasta AS hasta
                    FROM
                        grw_procesos AS ALCANCES
                        INNER JOIN olc_alcances ON ALCANCES.permisos_reporte = olc_alcances.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCES.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_tuc_p2p_estudios AS EVAL ON ALCANCES.id_proceso = EVAL.id
                        INNER JOIN grw_tuc_p2b_asignaciones AS P2B ON P2B.id_evaluacion = EVAL.id
                    WHERE
                            ALCANCES.id_proceso_tipo = 2
                            AND ALCANCES.fecha_desde >= '$FechaIni'  AND ALCANCES.fecha_hasta <= '$FechaFin'
                            AND P2B.realizado = 0    AND EVAL.id_empresa = $IdEmpresa AND EVAL.inactivo = 0 AND  EVAL.eliminado = 0
                        ";
                return $this->_ZOOM->RUN_SQL ($TextSQL);
    }

    private function ACT ( $IdEmpresa, $FechaIni, $FechaFin, $condicion = '') {
        $TextSQL =" SELECT APPS.id AS id_app, APPS.uuid AS uuid_app, APPS.app, APPS.`name` AS name_app,
                        CATEG.id AS id_categ, CATEG.uuid AS uuid_categ, CATEG.nombre AS nombre_categ ,
                        ACTIVIDADES.id AS id_actividad, ACTIVIDADES.uuid AS uuid_actividad,  ACTIVIDADES.nombre AS nomactividad,  ACTIVIDADES.tipo,  ACTIVIDADES.asignados ,
                        TPROCESS.id AS id_proceso_tipo, TPROCESS.uuid AS uuid_proceso_tipo,  TPROCESS.nombre AS nombre_proceso_tipo, olc_alcances.nombre AS alcance
                    FROM
                        grw_procesos AS ALCANCES
                        INNER JOIN olc_alcances ON ALCANCES.permisos_reporte = olc_alcances.id
                        INNER JOIN grw_lel_actividades AS ACTIVIDADES ON ALCANCES.id_proceso = ACTIVIDADES.id
                        INNER JOIN olc_procesos AS TPROCESS ON ALCANCES.id_proceso_tipo = TPROCESS.id
                        INNER JOIN olc_apps AS APPS ON TPROCESS.id_app = APPS.id
                        INNER JOIN grw_lel_categorias AS CATEG ON ACTIVIDADES.id_categoria = CATEG.id
                    WHERE
                        ALCANCES.id_proceso_tipo = 3  AND ALCANCES.fecha_desde >= '$FechaIni'  AND ALCANCES.fecha_hasta <= '$FechaFin'  AND ACTIVIDADES.id_empresa = $IdEmpresa
                        AND ALCANCES.permisos_reporte = 1   AND ACTIVIDADES.inactivo = 0  AND ACTIVIDADES.eliminado = 0  AND CATEG.eliminado = 0  AND CATEG.inactivo = 0
        ";

        return $this->_ZOOM->RUN_SQL ($TextSQL);
    }

    private function PYT ($IdEmpresa, $FechaIni, $FechaFin, $condicion = '') {
        $TextSQL = " SELECT  APPS.id AS id_app, APPS.uuid AS uuid_app,  APPS.app, APPS.`name` AS name_app, TPROCESS.id AS id_proceso_tipo, TPROCESS.uuid AS uuid_proceso_tipo,
                        TPROCESS.nombre AS nombre_proceso_tipo, PROY.id AS idproyecto,  PROY.uuid AS uuid_proyecto,  PROY.nombre, ALCANCESPROCESOS.permisos_reporte,
                        ALCANCES.nombre AS nom_alcance,   ALCANCESPROCESOS.fecha_desde, ALCANCESPROCESOS.fecha_hasta, PROY.id_empresa,
                        PROY.id_responsable, PROY.id_semana_desde, PROY.id_semana_hasta,  PROY.tipo, PROY.descripcion, PROY.inactivo,  PROY.eliminado,
                        PROY.fecha,    PROY.nombre
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
                        AND PROY.eliminado = 0
                        AND PROY.id_empresa = $IdEmpresa ";


        return $this->_ZOOM->RUN_SQL ($TextSQL);
    }

    private function VAL () {
        return '0';
    }


}