
<?php

function NewHash(){
    return hash('sha256', uniqid());
}

function MasMinutos($Minutos = 30){
    return date('Y-m-d H:i:s', strtotime("+$Minutos minutes"));
}

function SetUtf8($String){
    return mb_convert_encoding($String, 'UTF-8', 'ISO-8859-1');
}

function Redirect($url, $delay = 2500){
    echo '<script>setTimeout(function() { window.location.href = "' . $url . '"; }, ' . $delay . ')</script>';
}

function MsgOk ( $Message ) {
     echo "<div class='alert alert-success ff3'>$Message</div>";
}

function MsgError ( $Message, $die = 0) {
    echo "<div class='alert alert-danger ff2'>$Message</div>";
    if ($die) die;
}

function Logout() {
    require_once($_SESSION['_CLASS'] .'Cookies.php');
    $_COOKIES  = new Cookies();
    $_COOKIES->Destroy($_ENV['SESSION_ID_WORKER']);
    $_COOKIES->Destroy($_ENV['SESSION_ID_COMPANY']);
    session_destroy();
}

function SetPositionArray($array, $campo){
    if (!$array) return 0;
    try {

        $temp = [];
        foreach ($array as $key => $value) $temp[$value[$campo]] = $value;
        return $temp;

    }catch(PDOException $e){
        print "¡Error TryCatch!: " . $e->getMessage();
    }
}

function GetCategoriasFromActividades ( $Actividades ) {
    $Categorias = [];
    if(!$Actividades) return 0;
    foreach ($Actividades  as $dato) {
        $Categorias[] = [
            'id_categ' => $dato['id_categ'],
            'uuid_categ' => $dato['uuid_categ'],
            'nombre_categ' => $dato['nombre_categ']
        ];
    }
    return  $Categorias;
}

function GetEstado ( $Value ) {
    switch ($Value) {
        case 'pendiente':
            $respuesta= ['styles' => 'bNaranja colorfff', 'text' => 'Pendiente', 'icon' => 'las la-hourglass-half', ];  break;
       case 'finalizado':
            $respuesta= ['styles' => 'bVerde colorfff', 'text' => 'Completado', 'icon' => 'las la-check-double', ];     break;
        case 'Próximo':
            $respuesta= ['styles' => 'b666 colorfff', 'text' => 'Próximo', 'icon' => '', ];                             break;
        case 'En curso':
            $respuesta= ['styles' => 'bNaranja colorfff', 'text' => 'En curso', 'icon' => '', ];                        break;
        case 'Realizado':
            $respuesta= ['styles' => 'bVerde colorfff', 'text' => 'Completado', 'icon' => '', ];                        break;
        case 'Finalizado':
            $respuesta= ['styles' => 'bVerde colorfff', 'text' => 'Finalizado', 'icon' => '', ];                        break;
        case 'Vencido':
            $respuesta= ['styles' => 'bRojo colorfff', 'text' => 'Vencido', 'icon' => '', ];                            break;
        default:
            $respuesta= ['styles' => 'blue', 'text' => 'Sin estado', 'icon' => 'las la-hourglass-half',  ];             break;
    }
    return $respuesta;
}

function FormatFecha ( $Fecha ) {
    return date('d-m-Y', strtotime($Fecha ));
}

function FechaHoy () {
    return date('Y-m-d H:i:s');
}

function CountArray ( $Array, $Field, $Condicion ){
    $Result = 0;
    if ( ! $Array ) return 0;
    $Result = array_filter( $Array , function($item) use ($Field, $Condicion) {
        return $item[$Field] == $Condicion;
    });

    return $Result  ?  count (  $Result ) : 0;
}

function DateFront ( $Fecha, $Short = 0 ) {
    if ( !$Fecha) return '';
    $myDay   = date('d', strtotime($Fecha));
    $myMonth = MonthName(date('m', strtotime($Fecha)), $Short);
    $myYear  = date('Y', strtotime($Fecha));

    return $myMonth . ' ' . $myDay . ', ' . $myYear;

}

function MonthName ( $Month, $Short = 0) {

    if ($Short) {
        $Months = [
            '01' => 'Ene',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Abr',
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Ago',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dic',
        ];
    } else {
        $Months = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];
    }

    return $Months[$Month];
}

function PrimeraLetra ( $Value ) {
    if (!$Value  ) return '';

    return cTrim(ucwords(substr($Value ,0,1)));
}

function pintarLista($cadena) {
    // Verificamos si la cadena está vacía
    if (empty($cadena)) return;

    // Separamos la cadena en un array utilizando el carácter "-"
    $elementos = explode("-", $cadena);

    // Iniciamos la lista desordenada
    echo "<ul>\n";

    // Iteramos sobre cada elemento del array
    foreach ($elementos as $elemento) {
        // Eliminamos espacios en blanco al inicio y final del elemento
        $elemento = trim($elemento);

        // Si el elemento no está vacío, lo pintamos
        if (!empty($elemento)) {
            echo "\t<li>" . htmlspecialchars($elemento) . "</li>\n";
        }
    }

    // Cerramos la lista desordenada
    echo "</ul>\n";
}

function array_sort($array, $on, $order = SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

function cTrim( $value ) {
    if (!$value) return '';
    return trim( $value  );
}

function FullName ( $Nombres, $Apellidos ) {
    if ( !$Nombres) $Nombres        = '';
    if ( ! $Apellidos )  $Apellidos = '';
    return trim( $Nombres ) . ' ' . trim($Apellidos);
}

function FechaCumple (  $Mes, $Dia  ) {
    if ( !$Mes && !$Dia) return '';
    $Mes = $Mes < 10 ? '0'.$Mes : $Mes;
    $Dia = $Dia <10 ? '0'.$Dia  : $Dia ;
    return MonthName($Mes, 1 ) . ' ' .$Dia ;
}

function StateTime ($FechaHasta ){
    // 0 (Antes), 1 (Durante), 2 (Después)
    $Hoy   = strtotime( FechaHoy() );
    $Hasta = strtotime( $FechaHasta );

    return   ($Hoy < $Hasta) ? 0 : (($Hasta == $Hoy) ? 1 : 2);

}

function DebugToFile ( $Value, $AddEndToFile=false ) {
    $logDir        = $_SESSION['_ROOT']   . 'logs';
    $filePath      = $logDir  . DIRECTORY_SEPARATOR . 'debug.txt';
    $output        = var_export($Value, true) . PHP_EOL;            // Convertir el valor a una representación de cadena
    $AddEndToFile == true
            ? file_put_contents($filePath  , $output , FILE_APPEND)
            : file_put_contents($filePath  , $output ) ;
}