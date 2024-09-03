<?php

use Phpfastcache\CacheManager;

require_once($_SESSION['_CLASS'] .'OLC.php');
require_once($_SESSION['_CLASS'] .'OLC-Leletog.php');
require_once($_SESSION['_CLASS'] .'OLC-Tucoach.php');
require_once($_SESSION['_CLASS'] .'OLC-Okr.php');
require_once($_SESSION['_CLASS'] .'OLC-Company.php');

class Platform {

    private $_LELE;
    private $_OKR;
    private $_TUCOACH;
    public $_CACHE;
    public $_ZOOM;
    public $COMPANY;

    public function __construct(){
        $this->_LELE     = new Lele();
        $this->_ZOOM     = new Zoom();
        $this->_TUCOACH  = new Tucoach();
        $this->_OKR      = new OKR();
        $this->COMPANY   = new Company();

    }

    public function getGrupos ( $AddToQuery, $ParametersToQuery, $ReturnRecord ){

        $TextSQL = "
            SELECT
                GRU.nom_grupo nombre, GRU.descrp_grupo descripcion, GRU.fecha, GRU.uuid uuid, GRU.id,
                MIE.id_empresa, MIE.id_trabajador, MIE.es_lider lider

            FROM grw_grupos GRU
            INNER JOIN grw_grupos_miembros MIE ON MIE.id_grupo = GRU.id

            WHERE GRU.inactivo = 0 && GRU.eliminado = 0
                AND MIE.inactivo = 0 && MIE.eliminado = 0
                " . $AddToQuery ."
        ";

        $result = $this->_ZOOM->RUN_SQL($TextSQL, $ReturnRecord);

        return $result;

    }

    public function getMiembrosGrupo ( $AddToQuery, $ParametersToQuery, $ReturnRecord ){

        $TextSQL = "
            SELECT
                USR.id, USR.uuid, USR.identificacion, USR.identificacion_tipo, USR.nombre, USR.ultimo_ingreso AS fecha_ultimo_ingreso,
                GRU.nom_grupo, GRU.descrp_grupo,
                MIE.es_lider AS lider, MIE.fecha AS fecha_miembro_ingreso

            FROM grw_grupos_miembros AS MIE
                INNER JOIN	grw_grupos AS GRU ON MIE.id_grupo = GRU.id
                INNER JOIN	zoom_users AS USR ON USR.id = MIE.id_trabajador

            WHERE MIE.inactivo = 0 AND MIE.eliminado = 0
                AND GRU.inactivo = 0 AND GRU.eliminado = 0
                AND USR.inactivo = 0 AND USR.eliminado = 0
                " . $AddToQuery ."
        ";

        $result = $this->_ZOOM->RUN_SQL($TextSQL, $ReturnRecord);

        return $result;

    }

    public function PermissionValidationModel ($app, $model, $panel = false) {
        $id_colaborador = $_SESSION["WORKER"]['id'];
        $id_empresa     = $_SESSION["COMPANY"]['id'];
        if($panel){
            $id_rol  = $_SESSION["ADMIN"]['id'];
            $TextSQL = "
                SELECT
                    MUD.id, MUD.uuid, MUD.titulo, MUD.descripcion, MUD.icono, MUD.cody, MUD.url, MUD.modulo AS nombre, MUD.directorio, MUD.archivo, MUD.tipo
                FROM
                    zoom__models__roles AS REL
                    INNER JOIN zoom_users AS USR
                    INNER JOIN zoom_models AS MUD ON MUD.id = REL.id_modulo
                    INNER JOIN zoom__users__roles AS ADM ON USR.id = ADM.id_user AND REL.id_rol = ADM.id_rol
                    INNER JOIN zoom_roles AS ROL ON REL.id_rol = ROL.id AND ADM.id_rol = ROL.id
                WHERE
                        MUD.inactivo   = 0 AND MUD.eliminado = 0 AND MUD.$app = 1
                    AND REL.inactivo   = 0 AND REL.eliminado = 0
                    AND USR.inactivo   = 0 AND USR.eliminado = 0
                    AND ADM.inactivo   = 0 AND ADM.eliminado = 0
                    AND ROL.inactivo   = 0 AND ROL.eliminado = 0
                    AND USR.id         = $id_colaborador
                    AND USR.id_empresa = $id_empresa
                    AND ROL.id         = $id_rol
                    AND (MUD.cody = '$model' || MUD.uuid = '$model')
            ";
        }else{
            $id_rol  = $_SESSION["WORKER"]['id_rol'];
            $TextSQL = "
                SELECT
                    MUD.id, MUD.uuid, MUD.titulo, MUD.descripcion, MUD.icono, MUD.cody, MUD.url, MUD.modulo AS nombre, MUD.directorio, MUD.archivo, MUD.tipo
                FROM
                    zoom__models__roles AS REL
                    INNER JOIN zoom_users AS USR
                    INNER JOIN zoom_models AS MUD ON MUD.id = REL.id_modulo
                    INNER JOIN zoom_roles AS ROL ON REL.id_rol = ROL.id AND USR.id_rol = ROL.id
                WHERE
                        MUD.inactivo   = 0 AND MUD.eliminado = 0 AND MUD.$app = 1
                    AND REL.inactivo   = 0 AND REL.eliminado = 0
                    AND USR.inactivo   = 0 AND USR.eliminado = 0
                    AND ROL.inactivo   = 0 AND ROL.eliminado = 0
                    AND USR.id         = $id_colaborador
                    AND USR.id_empresa = $id_empresa
                    AND ROL.id         = $id_rol
                    AND (MUD.cody = '$model' || MUD.uuid = '$model')
            ";
        }
        return $this->_ZOOM->RUN_SQL($TextSQL, true);
    }

    public function VerifyAllowApps (  $AllowApps) {
        $Apps = $this->getApps();
        if (!$Apps || !$AllowApps) return 0;

        $respuesta = array();
        foreach ($Apps as $app) {
             $permitida = false;
               foreach ($AllowApps as $allowApp) {
                    if ($app['app'] === $allowApp['app']) {
                        $permitida = true;
                        break;
                    }
                    }
                $respuesta[$app['app']] = $permitida;

            }
        return $respuesta;
    }

    public function getApps ( ) {
       $TextSQL = "SELECT id,  uuid,  internal,  app,  `name`,  description,  keywords,  imagen,  logo,
	                    logow, favicon,  color,  color2,  url_dev,  url_test,  url_prod
                FROM
                    olc_apps AS APPS
                    WHERE APPS.inactivo =0
                    AND APPS.eliminado = 0
                    ORDER BY APPS.id" ;
           $Apps =    $this->_ZOOM->RUN_SQL ($TextSQL );
           return SetPositionArray($Apps, 'app' );
    }

    public function RolesUsuario ( $id_trabajador ){

        $TextSQL = "
            SELECT
                ROLES.id, ROLES.uuid, ROLES.rol AS nombre
            FROM zoom__users__roles AS USERS
                INNER JOIN zoom_roles AS ROLES ON USERS.id_rol = ROLES.id
            WHERE
                ROLES.inactivo = 0 AND ROLES.eliminado = 0
                AND USERS.id_user = " . $id_trabajador ."
        ";
        return SetPositionArray($this->_ZOOM->RUN_SQL ($TextSQL), 'id');

    }

    public function SetNewPasswodIsOk ( $NewPassWord, $Token ) {

        $HowIsToken = self::VerifyToken ( $Token);
        if (in_array($HowIsToken, array("TokenNoValido", "TokenPerdioVigencia"))) return $HowIsToken;

        $PassNew = md5($NewPassWord);
        $TextSQL ="UPDATE zoom_users SET password ='$PassNew ' WHERE recovery_token = '$Token '";
        $this->_ZOOM->RUN_SQL ($TextSQL, true );
        $TextSQL ="UPDATE zoom_users SET recovery_token ='', recovery_limit=NULL WHERE recovery_token = '$Token '";
        $this->_ZOOM->RUN_SQL ($TextSQL, true );
        return 'PasswordUpdated';
    }

    private function VerifyToken ( $Token ) {

        $ahora = date('Y-m-d H:i:s');
        $TextSQL = "SELECT uuid, recovery_limit, TIMESTAMPDIFF(MINUTE, '$ahora', recovery_limit) AS tiempo_limite  FROM zoom_users WHERE ( recovery_token = '$Token' )";
        $User = $this->_ZOOM->RUN_SQL ($TextSQL, true);

        if ($User===0)                    return "TokenNoValido";
        if ($User['tiempo_limite'] < 0 )  return "TokenPerdioVigencia";
        return $User;

    }

    public function SetTokenRecoveryPassword ( $Uuid ) {
        $RecoveryToken = NewHash();
        $Limit = MasMinutos(30);
        $TextSQL = "UPDATE zoom_users SET
                        recovery_token = '$RecoveryToken',
                        recovery_limit = '$Limit' WHERE uuid = '$Uuid'
                        ";
        $this->_ZOOM->RUN_SQL ($TextSQL, true );

        return $RecoveryToken;
    }

    public function VerifyUser ( $Identificacion , $Email   ) {
        $Email          = $this->_ZOOM->iFilter->process(trim($Email ));
        $Identificacion = $this->_ZOOM->iFilter->process(trim( $Identificacion  ));
        $TextSQL = "SELECT id, id_rol,id_empresa, id_jefe, id_cargo,usuario,identificacion,nombre,telefono,email,uuid,cargo,inactivo,eliminado,fecha
                           FROM zoom_users WHERE ( identificacion ='$Identificacion' )
                                           AND email = '$Email' AND inactivo = 0 AND eliminado = 0";

        $Reponse =  $this->_ZOOM->RUN_SQL ($TextSQL, true );
        return $Reponse ;
    }

	public function Login ($user, $password, $id_empresa = '' ){
        $user     = $this->_ZOOM->iFilter->process(trim( $user ));
        $password = $this->_ZOOM->iFilter->process(trim( $password ));
        $password = md5($password  );
        $TextSQL  = "SELECT id, uuid   FROM zoom_users WHERE ( usuario = '$user' OR identificacion = '$user' OR email = '$user' )
                       AND password = '$password' AND id_empresa = $id_empresa AND inactivo = 0 AND eliminado = 0";

        $IsLogIn =  $this->_ZOOM->RUN_SQL ($TextSQL, true );

        if ( !$IsLogIn  ) return 0;

        $this->SetLastLogin (  $IsLogIn['id']) ; // Setear la fecha y hora del último logueo del usuario

        $AddToQuery        = " AND USERS.uuid='" . $IsLogIn['uuid'] ."'";
        $ParametersToQuery = ['empresa' => 'USERS.id_empresa'];
        $IsLogIn           = $this->COMPANY->GetColaborators($AddToQuery , $ParametersToQuery, true ) ;
        return $IsLogIn ;
	}

    private function SetLastLogin ( $IdTrabajador ) {
        $TextSQL ="UPDATE zoom_users SET ultimo_ingreso = '".date('Y-m-d H:i:s')."' WHERE id = $IdTrabajador "  ;
        $this->_ZOOM->RUN_SQL ($TextSQL, true );
    }

    public function getOpcionesUsuario ($rol, $app, $condicion = '') {
        if($OpcionesMenuTotales = $this->_TUCOACH->getOpcionesPorRol( $rol, $app, $condicion )) return self::ConstruirArbol( $OpcionesMenuTotales );
        else return 0;
    }

    public function VerifyLoginSupport ( $PostRequest, $UsuarioSoporte ) {
        if ( !isset( $PostRequest['uuid-empresa'] )) return;
        $uuidEmpresa =  $PostRequest['uuid-empresa'];
        $TextSQL ="SELECT olc_empresas.id AS empresa_id, olc_empresas.uuid AS empresa_uuid, olc_empresas.nombre AS empresa_nombre, zoom_users.nombres AS user_nombre, zoom_users.apellidos AS user_apellido,
                    zoom_roles.id AS rol_id, zoom_roles.rol AS rol_nombre , zoom_users.id as user_id, zoom_users.uuid  as user_uuid
                FROM
                    zoom__users__roles
                    INNER JOIN zoom_roles ON zoom__users__roles.id_rol = zoom_roles.id
                    INNER JOIN zoom_users ON zoom__users__roles.id_user = zoom_users.id
                    INNER JOIN olc_empresas ON zoom_users.id_empresa = olc_empresas.id
                WHERE zoom_roles.id = 120  AND olc_empresas.uuid = '$uuidEmpresa' LIMIT 1" ;
            $Response =  $this->_ZOOM->RUN_SQL ($TextSQL, true );
        if ( !$Response ) return 0;

        $_SESSION['COMPANY']['id']        = $Response['empresa_id'];
        $AddToQuery                       = " AND USERS.uuid='" . $Response['user_uuid'] ."'";
        $ParametersToQuery                = ['empresa' => 'USERS.id_empresa'];
        $thisUser                         = $this->COMPANY->GetColaborators($AddToQuery , $ParametersToQuery, true ) ;

        $_SESSION["WORKER"]            = $thisUser;
        $_SESSION['WORKER']['nombre']  = $UsuarioSoporte ['nombre_corto'];
        $_SESSION['WORKER']["cargo"]   = $UsuarioSoporte ['cargo']['nombre'];
        $_SESSION['WORKER']["sigla"]   = $UsuarioSoporte ['sigla'] ;
        $_SESSION['WORKER']['email']   = $UsuarioSoporte ['datos_contacto']['correo'] ;
        $_SESSION['WORKER']['celular'] = $UsuarioSoporte ['datos_contacto']['celular'] ;

        // log transacciones
        $_SESSION["WORKER"]['support'] = $UsuarioSoporte;
    }

    private function ConstruirArbol($filas, $padre = 0) {
        $arbol = array();
        foreach ($filas as $fila) {
            if ($fila['id_modulo'] == $padre) {
                $hijos = self::ConstruirArbol($filas, $fila['id']);
                if (!empty($hijos)) {
                    $fila['hijos'] = $hijos;
                }
                $arbol[] = $fila;
            }
        }
        return $arbol;
    }

    private function GenerarHTML ($elementos, $nivel = 0){
        $html = '<ul>';
        foreach ($elementos as $elemento) {
            $html .= '<li>' . str_repeat('&nbsp;', $nivel * 2) . $elemento['modulo'];
            if (!empty($elemento['hijos'])) {
                $html .= self::GenerarHTML($elemento['hijos'], $nivel + 1);
            }
            $html .= '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

}