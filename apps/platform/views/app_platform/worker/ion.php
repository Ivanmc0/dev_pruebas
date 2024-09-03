<?php

    $data_json       = json_decode(file_get_contents($_ENV["DIR"].'col.json'), true);
    $data            = [];
    $investigaciones = [
        0 => [
            'encuesta' => 11,
            'nombre'   => "Encuesta #1 - El impacto del líder",
            'inicio'   => '2024-08-26 00:00:00',
            'fin'      => '2024-09-02 23:59:59',
        ],
        1 => [
            'encuesta' => 12,
            'nombre'   => "Encuesta #2 - El impacto del líder",
            'inicio'   => '2024-09-09 00:00:00',
            'fin'      => '2024-09-12 23:59:59',
        ],
        2 => [
            'encuesta' => 13,
            'nombre'   => "Encuesta #3 - El impacto del líder",
            'inicio'   => '2024-09-23 00:00:00',
            'fin'      => '2024-09-27 23:59:59',
        ],
        3 => [
            'encuesta' => 14,
            'nombre'   => "Encuesta #4 - El impacto del líder",
            'inicio'   => '2024-10-07 00:00:00',
            'fin'      => '2024-10-11 23:59:59',
        ],
        4 => [
            'encuesta' => 15,
            'nombre'   => "Encuesta #5 - El impacto del líder",
            'inicio'   => '2024-10-21 00:00:00',
            'fin'      => '2024-10-25 23:59:59',
        ],
        5 => [
            'encuesta' => 16,
            'nombre'   => "Encuesta #6 - El impacto del líder",
            'inicio'   => '2024-11-05 00:00:00',
            'fin'      => '2024-11-08 23:59:59',
        ],
        6 => [
            'encuesta' => 17,
            'nombre'   => "Encuesta #7 - El impacto del líder",
            'inicio'   => '2024-11-18 00:00:00',
            'fin'      => '2024-11-22 23:59:59',
        ],
        7 => [
            'encuesta' => 18,
            'nombre'   => "Encuesta #8 - El impacto del líder",
            'inicio'   => '2024-12-02 00:00:00',
            'fin'      => '2024-12-06 23:59:59',
        ],
    ];

    $contador = 0;
    foreach ($data_json as $key => $dato) {

        if(!isset($data[$dato["JEFE"]])){
            $data[$dato["JEFE"]] = [
                'contador'      => $contador+=1,
                'id'            => trim($dato["JEFE"]),
                'nombre'        => trim($dato["JEFE INMEDIATO"]),
                'valoracion'    => [],
                'evento'        => [],
                'investigacion' => [],
                'lista'         => [],
                'colaboradores' => [],
            ];

            $data[$dato["JEFE"]]["lista"] = [
                'id_empresa' => 100100,
                'nombre'     => "NPS Líderes - ".trim($dato["JEFE"]).": ".trim($dato["JEFE INMEDIATO"]),
                'interna'    => 0,
                'fecha'      => date('Y-m-d H:i:s')
            ];
            $data[$dato["JEFE"]]["valoracion"] = [
                'id_empresa'  => 100100,
                'id_tipo'     => 2,
                'nombre'      => "NPS Líderes - ".trim($dato["JEFE"]).": ".trim($dato["JEFE INMEDIATO"]),
                'descripcion' => "Desafío: Experiencia del empleado",
                'fecha'       => date('Y-m-d H:i:s'),
            ];
            $data[$dato["JEFE"]]["evento"]= [
                'id_empresa'    => 100100,
                'id_valoracion' => 0,
                'id_arquetipo'  => 10,
                'id_x'          => 0,
                'id_y'          => 0,
                'nombre'        => "NPS Líderes - ".trim($dato["JEFE"]).": ".trim($dato["JEFE INMEDIATO"]),
                'descripcion'   => "Desafío: Experiencia del empleado",
                'fecha'         => date('Y-m-d H:i:s'),
            ];
            $data[$dato["JEFE"]]["investigacion"] = [
                'id_empresa'         => 100100,
                'id_valoracion'      => 0,
                'id_evento'          => 0,
                'id_publico'         => 2,
                'id_publico_listado' => 0,
                'id_encuesta'        => 0,
                'fecha'              => date('Y-m-d H:i:s'),
            ];
        }

        $data[$dato["JEFE"]]["colaboradores"][] = [
            'nombre'        => trim($dato["COLABORADOR"]),
            'cedula'        => trim($dato["CEDULA"]),
            'cargo'         => trim($dato["CARGO"]),
            'email'         => trim($dato["CORREO CORPORATIVO"]),
            'clasificacion' => trim($dato["CLASIFICACIÓN"]),
            'oficina'       => trim($dato["OFICINA"]),
            'area'          => trim($dato["AREA"]),
            'gerencia'      => trim($dato["GERENCIA"]),
        ];

    }

    foreach ($data as $lider) {

        // if($lider["contador"] >= 301 && $lider["contador"] <= 400){
        if(false && true){

            if($ll = $_ZOOM->get_data("grw_val_listas", " AND nombre LIKE '%".$lider["id"]."%' ", 0)){
                $lista_id = $ll["id"];
            }else{
                $lista_id = $_ZOOM->insert_data_array($lider["lista"], "grw_val_listas");
            }

            if($lista_id){

                echo "<hr>OK - Lista ".$lider["id"]." creada";

                foreach ($lider["colaboradores"] as $colaborador) {

                      $registro                       = [];
                      $registro["id_empresa"]         = 100100;
                      $registro["id_publico_listado"] = $lista_id;
                      $registro["nombre"]             = $colaborador['nombre'];
                      $registro["empresa"]            = 'Banco W';
                      $registro["cargo"]              = $colaborador['cargo'];
                      $registro["identificacion"]     = $colaborador['cedula'];
                      $registro["email"]              = $colaborador['email'];
                      $registro["fecha"]              = date('Y-m-d H:i:s');

                    if($_ZOOM->insert_data_array($registro, "grw_val_listasexternas_registros")){

                        echo "<br>OK - Registro ".$registro["email"]." en lista ".$lider["id"]." creada";

                    }

                }

                if($vv = $_ZOOM->get_data("grw_val_valoraciones", " AND nombre LIKE '%".$lider["id"]."%' ", 0)){
                    $valoracion_id = $vv["id"];
                }else{
                    $valoracion_id =  $_ZOOM->insert_data_array($lider["valoracion"], "grw_val_valoraciones");
                }

                if($valoracion_id){

                    $lider["evento"]["id_valoracion"] = $valoracion_id;

                    if($ee = $_ZOOM->get_data("grw_val_eventos", " AND nombre LIKE '%".$lider["id"]."%' ", 0)){
                        $evento_id = $ee["id"];
                    }else{
                        $evento_id =  $_ZOOM->insert_data_array($lider["evento"], "grw_val_eventos");
                    }

                    if($evento_id){

                        $lider["investigacion"]["id_valoracion"]      = $valoracion_id;
                        $lider["investigacion"]["id_evento"]          = $evento_id;
                        $lider["investigacion"]["id_publico_listado"] = $lista_id;

                        foreach ($investigaciones as $key => $investigacion) {

                            $lider["investigacion"]["id_encuesta"]  = $investigacion["encuesta"];
                            $lider["investigacion"]["nombre"]       = $investigacion["nombre"];
                            $lider["investigacion"]["fecha_inicio"] = $investigacion["inicio"];
                            $lider["investigacion"]["fecha_fin"]    = $investigacion["fin"];

                            if($investigacion_id = $_ZOOM->insert_data_array($lider["investigacion"], "grw_val_investigaciones")){

                                $asignacion = [
                                    'id_empresa'               => 100100,
                                    'id_valoracion'            => $valoracion_id,
                                    'id_evento'                => $evento_id,
                                    'id_investigacion'         => $investigacion_id,
                                    'id_encuesta'              => $investigacion["encuesta"],
                                    'id_val_lista'             => $lista_id,
                                    'id_listaexterna_registro' => 0,
                                    'fecha'                    => date('Y-m-d H:i:s'),
                                ];

                                if($miembros = $_ZOOM->get_data("grw_val_listasexternas_registros", " AND id_publico_listado = $lista_id AND fecha > '2024-08-28 16:00:00' ", 1)){
                                    foreach ($miembros as $miembro) {

                                        $asignacion["id_listaexterna_registro"] = $miembro["id"];

                                        if($_ZOOM->insert_data_array($asignacion, "grw_val_asignaciones")){

                                            //echo "OK - Asignación ".$lider["id"]." a ".$miembro["nombre"]." creada<br>";

                                        }

                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }


    // $r = [ 's' => 0, 'n' => [] ];

    // foreach ($data as $lider) {

    //     // if($_ZOOM->get_data("grw_val_listas", " AND nombre LIKE '%3087408%' ", 0)){

    //     $ll = $_ZOOM->get_data("grw_val_listas", " AND nombre LIKE '%".$lider["id"]."%' ", 0);
    //     $vv = $_ZOOM->get_data("grw_val_valoraciones", " AND nombre LIKE '%".$lider["id"]."%' ", 0);
    //     $ee = $_ZOOM->get_data("grw_val_eventos", " AND nombre LIKE '%".$lider["id"]."%' ", 0);

    //     if($ll && $vv && $ee){
    //         $r['s'] += 1;
    //     }else{
    //         $r['n'][] = $lider;
    //     }

    // }
    // Debug::Mostrar($r);

    echo "OK - ".count ($data)." jefes<hr>";

    echo "OK - Tengo los 8 IDs de las 8 encuestas NPS<hr>";

    echo "Crear listado externo: grw_val_listas<hr>";
    echo "Crear registros listado interno: grw_val_listasexternas_registros<hr>";

    echo "Crear valoración: grw_val_valoraciones<hr>";
    echo "Crear evento: grw_val_eventos<hr>";

    echo "Crear 8 investigaciones: grw_val_investigaciones<hr>";
    echo "Crear asignaciones: grw_val_asignaciones<hr>";

    echo '
            Encuesta 1: ago 26-30
            Encuesta 2: sep 09-12
            Encuesta 3: sep 23-27
            Encuesta 4: oct 07-11
            Encuesta 5: oct 21-25
            Encuesta 6: nov 05-08
            Encuesta 7: nov 18-22
            Encuesta 8: dic 02-06
            <hr>
    ';


    // Debug::Mostrar($data_json);
    Debug::Mostrar($data);



    die();




// echo md5('1144154383');
/*




die();

$AddToQuery = ' AND TRABAJ.id_grupo = 21 ORDER BY USERS.inactivo ASC, USERS.nombre ASC';

$listado = $_GROWI->GET('COMPANY', 'GetGruposCorporativosIntegrantes', $AddToQuery , ['empresa' => 'TRABAJ.id_empresa'], $ReturnRecord = false);

if($listado === 0) $listado = [];

Debug::Mostrar(($listado));


die();

$listado = $_GROWI->GET('LELE', 'GetActividades', $AddToQuery = " ORDER BY PROCESOS.fecha, inactivo ASC, nombre ASC ", ['empresa' => 'ACTIV.id_empresa'], $ReturnRecord = false);
Debug::Mostrar($listado);

die();


echo '<hr>';

$array = ['36862226','87719549','1082104224','1085907404','1087413160','1085275025','1085311100','1082105020','1085282968','1085896462','1004691454','12753038','13069511','36754268','87216818','1085335213','1085934720','36757499','1004549650','1087961479','1087027043','1085920181','12751985','1085280509','1085930811','1099708976'];
$array = ['1087194029','1059917332','1117509718','1123313305','86057937','1004617594','1087188734','1059908702','1120577992','1085318819','1193243959','34446077','1123204968','1059911789','1002840735','14702641','1123331258','1026143876','1085319099','1085690975','1010056229','1004189842','1120574827','1117514647','1088320880','1004619271','1007143353','1015410206','1087127664','97613575','1087122328','1058972768','1123200320','1120566620'];
$array = ['1062674136','1061537657','76319412','1083872619','69008752','1102854126','1062320527','34374916','10756949','34516242','94153905','1124852711','18128501','1061529451','1063298256','1063291660','1067280263','1066517573','1063298293','1130945854','98352836','18131109','1124862991','30505644','1124852808'];
$array = ['1121825618','1024531315','1002361511','1117837272','30506140','6801264','1117806641','1117493482','1117526507','1000574392','1104705001','86068249','1120353751','1117822666','1117962052','1121854059','1121416548','1006517655','1120367251','1121840651','1121953446','1116502265','1120360644','1077858123','1120366641','1120367053','1117840136','1120355298'];
$array = ['1086924561','1073241958','1130623918','1117546656','1061694534','1061782414','1117532039','1117485293','1061707596','40342786','1117553538','1121846812','1144159109','1117503898','16188291','1117489211','40342426','1117551448','1059904071','1117488643','1121917912','22810975','1117521257','1067886486','17357841','1117813587','34568770','40079439','73006973','40613501','1117973392'];
$array = ['48601063','31449772','1130947151','10486593','1085247589','1085297913','1085260845','87717899','10492401','10291423','1062296561','25707956','1086134571','1062329150','1062302570','1061738277','1085258146','25291434','1061752451','1085308077','1073235797','1124313290','1062319468','1061765293','34324548','1130604931','1061729633','1061535690','1085255332','1062315613'];


$array = ['80742857','17592798','4901210','1054541607','1017174739','91265023','53077605','67023379','29674584','13505698','29177977','1118291144','1143936634','1112225370','1113666760','1123621267','66951164','66828584','66756836','52182153','50980281'];
$array = ['25273303','1053778541','34609618','1121831743','52865766','1143252869','1110515935','78750744','1081592957','1102800745','1088009832','1075247390','1042440750','37122255','1070954085','1121853987','12745924','57438402','41946627','84092470','1076326749','1084254061','65557297'];
$array = ['16734701','86057937','1094164492','1116794414','1090407072','1090420211','1121846812','1116542388','1115078131','10696609','14624598','16929256','14473570','1077429786','1121840651','1093780427','1074418471','1116785832','1077440124','1100950458','16756119','1121900056','1100956947','16535585','1122117198'];
$array = ['66657383','1130677601','29284115','29707586','11206865','1130672259','66760765','31656654','38641698','43602483','1144044313','16986597','3087408','35534511','1130590191','1144151282','31424251','29231266','31533199','29820865','13542370','37390579','1151956185','7382760','35899554'];
$array = ['1107047799','46452481','1130586558','66762638','52433628','1113779822','94488367','1113656424','1115183773','66780416','94330737','94302627','53080789','94480494','1111748241','66841328','1113672771','1124004508','60394223','94480826','40334029','94441282','67028938','94151726','53178983'];
$array = ['80247144','88285859','1033748984','1022964690','1033692165','80810497','1037642027','91160617','1039695623','1035580968','1022948521','1036925934','86068249','1020741606','80111365','79963660','1096209184','63484380','1012318534','74187049','1033678375','80176083','1033789235','74347389','1014284293'];
$array = ['36862226','1057583920','12749920','30400577','6801264','1061707596','1070324716','1041176764','1049614621','1070945539','1052400304','1049613065','10290736','1143336237','1233511453','1047968631','36757499','9725548','6199790','34324548','12280501','14897594','1057589330','40613501','36295334'];
$array = ['42143623','1018440083','42144519','1097398845','1083872619','1059908702','1085275025','1085896462','87717899','94153905','1106785926','1081397988','1088283392','94473850','1081732092','1085319099','52712104','1105679625','53098233','1117813587','1105680747','1097392833','1088318169','1070621289','1105681390'];
$array = ['1113308229','76319412','40878179','1102854126','1117493482','1129521480','1120363018','1069492269','1052950074','1082913312','1052958057','1049639788','84095433','7633610','1117514647','1102816873','1082889645','1064994574','1130604931','1143426184','1081808459','1110491697','1064985676'];
$array = ['37860755','66880540','29663012','38551223','29705299','80048318','1094889311','94074037','9734830','52056207','80219300','31320188','1144044352','1052963307','12280401','1122126795','66786450','37013934','36490796','29127611','79796412','29127876','1110453912','50935707','29831770','1136885021','1102799167'];


$array = ['66932082','1010079388','1077865596','1087121586','52768847','34066459','80449381','1017176102','1022359604','1042441514','16539377','37182045','1054990722','64703787','1061693658','31656137','34616292','64702254','67022947','31434238','29179195','55068114','1023916443','39426522','1022410286'];
$array = ['1121871615','1147687848','1116783299','1042851409','1083871885','1100956414','1117504744','1130681592','1128059222','1069729094','1115062873','1113630257','1067942367','1084730805','1114834261','1083890797','1110589485','1107092356','1112225914','1120216922','1081513615','1143870593','1082964671','1073703836'];
$array = ['1111752871','1114878728','1143840329','31641008','29706261','1144050902','29775432','1113304166','5401594','1059911789','94428781','1144163162','66755931','1130588935','1113673005','1026574891','1112783883','1115069386','29674941','1111765768','16510543','1111817096','66948666','1143876833','1070943785','16234429','1130664900','1118289853','1000775322'];
$array = ['1081813411','1015440360','1077968369','1057578233','1077971046','1116782579','1052410216','1098676252','1014223706','1032389386','80797122','79762558','1073605776','1049639788','1022942962','37901218','1052390864','1030570043','1090431357','1006700223','1049603934','1193510355','1098787899','1024493058','1057588062','1031178368','1075681748','1016036731'];
$array = ['1117509718','1035915453','1061537657','1070617164','69008752','1120577992','1006782596','40342786','1079173141','93395767','1075255762','1078748746','1026143876','1120574827','43991336','1122139830','1121816867','1077868267','33751141','1067886486','17357841','1120360644','1081408607','1084256718','98589881','35604952','1083896544'];
$array = ['1089481400','1087419062','1085247589','12753038','36754268','31431426','1063160508','87216818','18614042','19601570','37279094','1094911660','18419273','1049324990','1085934720','1085258146','1044392797','25291434','1117524958','1061752451','1082917638','1082936279','1044909616','1081786189','1085930811','24587340','1110463684'];
$array = ['94499448','52718759','16936711','1112222816','1151934878','1144165144','1151940058','1144131212','1130675586','1015999360','29109265','94507146','1102811471','1144164385','67028010','1006202041','1130632109','1005705233','1144149325','1107069024','29118438','41957638','67001796'];
$array = ['94501667','1107104982','22669972','1113667368','1113675664','1143941363','14696794','1113639209','67017172','16553776','1144055671','1130679523','74084785','31565505','1107078572','31306290','31320703','1042434466','1143848977','1130614094','1144109037','29975649','31582798','52890053'];

array_push($array, 94397916, 235292, 1144137826);

echo count($array);
echo '<hr>';


$grupo = 20 + 8;

foreach ($array as $key => $ident) {

    if($col = $_ZOOM->get_data("zoom_users", " AND id_empresa = 100100 AND identificacion = '".$ident."' ", 0)){

        echo $col["nombre"];

        if($miembro = $_ZOOM->get_data("grw_grupos_miembros", " AND id_empresa = 100100 AND id_trabajador = '".$col["id"]."' AND id_grupo = $grupo AND eliminado = 0 ", 0)){

            echo '<span class="colorNaranja ff3">Ya es miembro</span>';

        }else{

            $daa = [
                'id_grupo' => $grupo,
                'id_trabajador' => $col["id"],
                'id_empresa' => 100100,
            ];

            $_ZOOM->insert_data_array($daa, "grw_grupos_miembros");

            echo '<span class="colorVerde ff3">Creado</span>';

        }

        echo '<hr>';

    }else{

        echo '<span class="colorRojo ff3">NO</span>';
        echo '<hr>';

    }

}

die();





// $listado = $_GROWI->GET('LELE', 'GetActividades', $AddToQuery = " ORDER BY PROCESOS.fecha, inactivo ASC, nombre ASC ", ['empresa' => 'ACTIV.id_empresa'], $ReturnRecord = false);

$colabs = $_ZOOM->get_data("zoom_users", " AND id_empresa = 100100 AND password = '' ", 1);

if($colabs){
    foreach ($colabs as $key => $col) {

        $arr = [
            'password' => md5($col["identificacion"]),
        ];

        $_ZOOM->update_data_array($arr, "zoom_users", "id", $col["id"]);

    }
}
Debug::Mostrar($colabs);



die();

$addon = " AND id_publico_listado = 7 ";


if($listado = $_ZOOM->get_data( "grw_val_listasinternas_registros", $addon." AND eliminado = 0 ORDER BY inactivo ASC, id ASC ", 1)){


    foreach($listado as $key => $dato){

        if($colab = $_GROWI->GET('COMPANY', 'GetColaborators', $AddToQuery = " AND USERS.id = ".$dato["id_trabajador"]."  ORDER BY inactivo ASC, nombre ASC ", ['empresa' => 'USERS.id_empresa'], $ReturnRecord = true) ){
            $listado["$key"]['nombre'] = $colab['nombre_completo'];
            $listado["$key"]['cargo'] = $colab['cargo']['nombre'];
            $listado["$key"]['identificacion'] = $colab['identificacion_completa'];

        }else{
            unset($listado["$key"]);
        }


    }


}



die();
*/


    $act = 302;

    $AddToQuery = " AND ACTIV.id = $act ";

    $backend = $_GROWI->GET(
        'LELE',
        'ReportACT',
        $AddToQuery,
        [
            'empresa' => 'ACTIV.id_empresa',
            'QuerySolutions'=> " AND SOLUC.id_actividad = $act "
        ],
        $ReturnRecord = false
    );



?>


<div class="content-body">
    <?php
        $id      = 1;
        $tablus  = "grw_lel_actividades";
        // $activity = $_ZOOM->get_data($tablus, " AND id = " . $id . " ORDER BY id DESC ", 0);

        $activity = $backend;

        if($activity) {

            // $trabajadores = SetPositionArray($_ZOOM->get_data("zoom_users", " AND id_empresa = " . $activity["id_empresa"] . " AND eliminado = 0 ORDER BY id ASC ", 1), 'id');
            // $reconocimientos = SetPositionArray($_ZOOM->get_data("grw_reconocimientos", " AND id_empresa = " . $activity["id_empresa"] . " AND eliminado = 0 ORDER BY id ASC ", 1), 'id');

            echo '<h4 class="tU t30 tB teal ">'.($activity["nombre"]).'</h4>';

            echo '<div class="tab bValora colorfff p10 mb20">';
            echo '<div class="tabIn t14 ff3">dinamicas: '.($activity["balance"]["c_dinamicas"])."</div>";
            echo '<div class="tabIn t14 ff3">Solucionadores: '.($activity["balance"]["c_solucionadores"])."</div>";
            echo '<div class="tabIn t14 ff3">sumatoria: '.($activity["balance"]["sumatoria"])."%</div>";
            echo '<div class="tabIn t14 ff3">Total: '.($activity["balance"]["total"])."%</div>";
            echo "</div>";

            // $tipos      = array();
            // $modos      = array();
            // $_tipos     = $_ZOOM->get_data("olc_modelos_tipos", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
            // foreach ($_tipos as $key => $_tipo) {
            //     $tipos[$_tipo["id"]]["id"]      = $_tipo["id"];
            //     $tipos[$_tipo["id"]]["nombre"]  = $_tipo["nombre"];
            // }
            // $_modos      = $_ZOOM->get_data("olc_preguntas_tipos", " AND inactivo = 0 AND eliminado = 0 ORDER BY id ASC ", 1);
            // foreach ($_modos as $key => $_modo) {
            //     $modos[$_modo["id"]]["id"]      = $_modo["id"];
            //     $modos[$_modo["id"]]["nombre"]  = $_modo["nombre"];
            // }

            // $listados   = $_ZOOM->get_data("grw_lel_dinamicas", " AND id_actividad = " . $id . " AND eliminado = 0 ORDER BY prioridad ASC ", 1);


            if($activity["dinamicas"]) {
                foreach($activity["dinamicas"] AS $dynamic){
    ?>
                    <div class="card">
                        <div class="card-content collapse show">

                            <div class="card-header bGray">
                                <div id="rtn_list" class="fR taR"></div>
                                <h4 class="card-title">
                                    <div class="tab">
                                        <div class="tabIn"><?= ($dynamic["nombre"]); ?></div>
                                        <div class="tabIn taR t14">
                                            <i>
                                                <?= $dynamic["modelo"]["nombre"]; ?>
                                                de tipo
                                                <?= $dynamic["tipo_modelo"]["nombre"]; ?>
                                            </i>
                                        </div>
                                    </div>

                                    <?php
                                        echo '<div class="tab bValora colorfff p10">';
                                        echo '<div class="tabIn t14 ff3">Preguntas: '.($dynamic["balance"]["c_preguntas"])."</div>";
                                        echo '<div class="tabIn t14 ff3">Sumatoria: '.($dynamic["balance"]["sumatoria"])."</div>";
                                        echo '<div class="tabIn t14 ff3">Solucionadores: '.($dynamic["balance"]["c_solucionadores"])."</div>";
                                        echo '<div class="tabIn t14 ff3">Total: '.($dynamic["balance"]["total"])."%</div>";
                                        echo "</div>";
                                    ?>
                                </h4>
                            </div>
                            <div class="card-body">

                                <?php
                                    if($dynamic["modelo"]["id"] == 3){

                                        if($aportes = $_ZOOM->get_data("grw_sol_act_campanias", " AND id_dinamica = ".$dynamic['id']." ORDER BY id DESC ", 1)){

                                            echo '<div style="max-height:400px; overflow:auto">';
                                            foreach($aportes AS $aporte){
                                                echo '<div class="tab bGray p20 mb5">';
                                                echo '<div class="tabIn w200x">'.$trabajadores[$aporte["id_trabajador"]]["nombre"].'</div>';
                                                echo '<div class="tabIn pLR20">'.$aporte["comentarios"].'</div>';
                                                echo '<div class="tabIn w100x taR">'.$aporte["fecha"].'</div>';
                                                echo '</div>';
                                            }
                                            echo '</div>';

                                        } else echo '<div class="taC tU t16 p10">No hay participaciones aún</div>';

                                    }else if($dynamic["modelo"]["id"] == 2){

                                        if($recos = $_ZOOM->get_data("grw_sol_act_reconocimientos", " AND id_dinamica = ".$dynamic['id']." ORDER BY id DESC ", 1)){

                                            $rcedores = [];
                                            $rcimientos = [];
                                            $rnocidos = [];
                                            $maxmos = $reconocimientos;

                                            echo '<div class="tB t16 mb10">Listado de Reconocimientos ('.(count($recos)).')</div>';
                                            echo '<div style="max-height:400px; overflow:auto">';
                                            echo '<div class="tab bGray p20 mb5">';
                                            echo '<div class="tabIn w150x"><div class="t12">Reconocedor</div></div>';
                                            echo '<div class="tabIn w150x"><div class="t12">Reconocimiento</div></div>';
                                            echo '<div class="tabIn w150x"><div class="t12">Reconocido</div></div>';
                                            echo '<div class="tabIn pLR20"><div class="t12">Justificación</div></div>';
                                            echo '<div class="tabIn w100x"><div class="t12">Fecha</div></div>';
                                            echo '</div>';

                                            foreach($recos AS $reco){
                                                if(isset($rcedores[$reco["id_trabajador"]])){
                                                    $rcedores[$reco["id_trabajador"]]["cantidad"]++;
                                                }else{
                                                    $rcedores[$reco["id_trabajador"]]["nombre"] = $trabajadores[$reco["id_trabajador"]]["nombre"];
                                                    $rcedores[$reco["id_trabajador"]]["cantidad"] = 1;
                                                }
                                                if(isset($rnocidos[$reco["id_reconocido"]])){
                                                    $rnocidos[$reco["id_reconocido"]]["cantidad"]++;
                                                }else{
                                                    $rnocidos[$reco["id_reconocido"]]["nombre"] = $trabajadores[$reco["id_reconocido"]]["nombre"];
                                                    $rnocidos[$reco["id_reconocido"]]["cantidad"] = 1;
                                                }
                                                if(isset($rcimientos[$reco["id_reconocimiento"]])){
                                                    $rcimientos[$reco["id_reconocimiento"]]["cantidad"]++;
                                                }else{
                                                    $rcimientos[$reco["id_reconocimiento"]]["nombre"] = $reconocimientos[$reco["id_reconocimiento"]]["nombre"];
                                                    $rcimientos[$reco["id_reconocimiento"]]["cantidad"] = 1;
                                                }

                                                foreach ($maxmos as $key => $maxmo) {
                                                    if($reco["id_reconocimiento"] == $maxmo["id"]){
                                                        if(isset($maxmos[$key]["trabajadores"][$reco["id_reconocido"]])){
                                                            $maxmos[$key]["trabajadores"][$reco["id_reconocido"]]["cantidad"]++;
                                                        }else{
                                                            $maxmos[$key]["trabajadores"][$reco["id_reconocido"]]["nombre"] = $trabajadores[$reco["id_reconocido"]]["nombre"];
                                                            $maxmos[$key]["trabajadores"][$reco["id_reconocido"]]["cantidad"] = 1;
                                                        }
                                                    }
                                                }

                                                echo '<div class="tab bGray p20 mb5">';
                                                echo '<div class="tabIn w150x">'.$trabajadores[$reco["id_trabajador"]]["nombre"].'</div>';
                                                echo '<div class="tabIn w150x">'.$reconocimientos[$reco["id_reconocimiento"]]["nombre"].'</div>';
                                                echo '<div class="tabIn w150x">'.$trabajadores[$reco["id_reconocido"]]["nombre"].'</div>';
                                                echo '<div class="tabIn pLR20">'.$reco["comentarios"].'</div>';
                                                echo '<div class="tabIn w100x taR">'.$reco["fecha"].'</div>';
                                                echo '</div>';
                                            }
                                            echo '</div>';

                                            echo '<div class="h30"></div>';


                                            echo '<div class="row">';

                                            echo '<div class="col-12 col-lg-3">';
                                            echo '<div class="tB t14 mb10">Top Reconocedores ('.(count($rcedores)).')</div>';
                                            echo '<div style="max-height:400px; overflow:auto">';
                                            echo '<div class="tab bGray p20 mb5">';
                                            echo '<div class="tabIn w150x"><div class="t12">Reconocedor</div></div>';
                                            echo '<div class="tabIn w100x taR"><div class="t12">Cantidad</div></div>';
                                            echo '</div>';
                                            $rcedores = array_sort($rcedores, 'cantidad', SORT_DESC);
                                            foreach($rcedores AS $rcedor){
                                                echo '<div class="tab bGray p20 mb5">';
                                                echo '<div class="tabIn w150x">'.$rcedor["nombre"].'</div>';
                                                echo '<div class="tabIn w100x taR">'.$rcedor["cantidad"].'</div>';
                                                echo '</div>';
                                            }
                                            echo '</div>';
                                            echo '</div>';

                                            echo '<div class="col-12 col-lg-3">';
                                            echo '<div class="tB t14 mb10">Top Reconocidos ('.(count($rnocidos)).')</div>';
                                            echo '<div style="max-height:400px; overflow:auto">';
                                            echo '<div class="tab bGray p20 mb5">';
                                            echo '<div class="tabIn w150x"><div class="t12">Reconocido</div></div>';
                                            echo '<div class="tabIn w100x taR"><div class="t12">Cantidad</div></div>';
                                            echo '</div>';
                                            $rnocidos = array_sort($rnocidos, 'cantidad', SORT_DESC);
                                            foreach($rnocidos AS $rnocido){
                                                echo '<div class="tab bGray p20 mb5">';
                                                echo '<div class="tabIn w150x">'.$rnocido["nombre"].'</div>';
                                                echo '<div class="tabIn w100x taR">'.$rnocido["cantidad"].'</div>';
                                                echo '</div>';
                                            }
                                            echo '</div>';
                                            echo '</div>';

                                            echo '<div class="col-12 col-lg-3">';
                                            echo '<div class="tB t14 mb10">Top Reconocimientos ('.(count($rcimientos)).')</div>';
                                            echo '<div style="max-height:400px; overflow:auto">';
                                            echo '<div class="tab bGray p20 mb5">';
                                            echo '<div class="tabIn w150x"><div class="t12">Reconocimiento</div></div>';
                                            echo '<div class="tabIn w100x taR"><div class="t12">Cantidad</div></div>';
                                            echo '</div>';
                                            $rcimientos = array_sort($rcimientos, 'cantidad', SORT_DESC);
                                            foreach($rcimientos AS $rcimiento){
                                                echo '<div class="tab bGray p20 mb5">';
                                                echo '<div class="tabIn w150x">'.$rcimiento["nombre"].'</div>';
                                                echo '<div class="tabIn w100x taR">'.$rcimiento["cantidad"].'</div>';
                                                echo '</div>';
                                            }
                                            echo '</div>';
                                            echo '</div>';

                                            echo '<div class="col-12 col-lg-3">';
                                            echo '<div class="tB t14 mb10">Top Colaboradores x Reconocimiento ('.(count($rcimientos)).')</div>';
                                            echo '<div style="max-height:400px; overflow:auto">';
                                            echo '<div class="tab bGray p20 mb5">';
                                            echo '<div class="tabIn w150x"><div class="t12">Reconocimiento</div></div>';
                                            echo '<div class="tabIn"><div class="t12">Reconocido</div></div>';
                                            echo '<div class="tabIn w100x taR"><div class="t12">Cantidad</div></div>';
                                            echo '</div>';
                                            foreach ($maxmos as $key => $maxmo) {
                                                if(isset($maxmo["trabajadores"])){
                                                    $maxmoOrd = array_sort($maxmo["trabajadores"], 'cantidad', SORT_DESC);
                                                    $print = 1;
                                                    foreach($maxmoOrd AS $max){
                                                        if($print > 0){
                                                            echo '<div class="tab bGray p1020 mb5 success">';
                                                            echo '<div class="tabIn w150x">'.$maxmo["nombre"].'</div>';
                                                            echo '<div class="tabIn">'.$max["nombre"].'</div>';
                                                            echo '<div class="tabIn w100x taR">'.$max["cantidad"].'</div>';
                                                            echo '</div>';
                                                            $print--;
                                                        }else{
                                                            echo '<div class="tab bGray p510 mb5">';
                                                            echo '<div class="tabIn t10 w150x pL10">'.$maxmo["nombre"].'</div>';
                                                            echo '<div class="tabIn t10 pLR10">'.$max["nombre"].'</div>';
                                                            echo '<div class="tabIn t10 w100x pR10 taR">'.$max["cantidad"].'</div>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }
                                            }
                                            echo '</div>';
                                            echo '</div>';



                                            echo '</div>';

                                        } else echo '<div class="taC tU t16 p10">No hay reconocimientos otorgados aún</div>';


                                    }else if($dynamic["modelo"]["id"] == 1){
                                ?>

                                <div class="">
                                    <?php
                                        // $getPreguntas = $_ZOOM->get_data('grw_lel_preguntas', ' AND id_dinamica = '.$dynamic["id"].' AND inactivo = 0 AND eliminado = 0', 1);
                                        if ($dynamic["preguntas"]) {
                                            foreach ($dynamic["preguntas"] as $question) {


                                                echo '<div class="tab beee p20">';
                                                echo '<div class="tabIn t18 ff3">'.($question["nombre"]);
                                                echo '<div class="tab bValora2 p10">';
                                                echo '<div class="tabIn t14 ff3">Correctas: '.($question["balance"]["correctas"])."</div>";
                                                echo '<div class="tabIn t14 ff3">Incorrectas: '.($question["balance"]["incorrectas"])."</div>";
                                                echo '<div class="tabIn t14 ff3">Soluciones: '.($question["balance"]["c_soluciones"])."</div>";
                                                echo '<div class="tabIn t14 ff3">Solucionadores: '.($question["balance"]["c_solucionadores"])."</div>";
                                                echo '<div class="tabIn t14 ff3">sumatoria: '.($question["balance"]["sumatoria"])."</div>";
                                                echo '<div class="tabIn t14 ff3">Total: '.($question["balance"]["total"])."%</div>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo '<div class="tabIn t14 ff3 taR"><i>'.($question["tipo"]["nombre"])."</i></div>";
                                                echo "</div>";

                                                if($question["tipo"]["id"] == 1){
                                                    if($question["respuestas"]){
                                                        foreach($question["respuestas"] AS $key => $answer){
                                                            // if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                            if($answer["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                            echo '<div class="tab bGray p1020 mb5">';
                                                            echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                            echo '<div class="tabIn taR pLR20">Soluciones: '.$answer["balance"]["c_soluciones"].'</div>';
                                                            echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }elseif($question["tipo"]["id"] == 2){
                                                    if($question["respuestas"]){
                                                        foreach($question["respuestas"] AS $key => $answer){
                                                            if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                            if($answer["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                            echo '<div class="tab bGray p1020 mb5">';
                                                            echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                            echo '<div class="tabIn taR pLR20">Soluciones: '.$answer["balance"]["c_soluciones"].'</div>';
                                                            echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }elseif($question["tipo"]["id"] == 3){
                                                    if($respuestas){
                                                        foreach($respuestas["respuestas"] AS $key => $answer){
                                                            if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                            echo '<div class="tab bGray p1020 mb5">';
                                                            echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                            echo '<div class="tabIn taR pL20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }elseif($question["tipo"]["id"] == 4){
                                                    if($respuestas){
                                                        foreach($respuestas["respuestas"] AS $key => $answer){
                                                            if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                            echo '<div class="tab bGray p1020 mb5">';
                                                            echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                            echo '<div class="tabIn taR pL20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }elseif($question["tipo"]["id"] == 5){

                                                    if(isset($respuestas["soluciones"])){
                                                        $txt = "";
                                                        $rad = explode("|", ($respuestas["soluciones"]));
                                                        foreach($rad AS $value) $txt .= '<div class="bS1 p510 t12 beee mb3">'.$value."</div>";
                                                    } else $txt = '<div class="taC tU t16 p10">Sin resultados</div>';

                                                    echo '<div class="tab bGray p20 mb5">';
                                                    echo '<div class="tabIn">'.$txt.'</div>';
                                                    echo '</div>';


                                                }

                                                /*
                                                $grupos = $_ZOOM->get_data("grw_segmentaciones", " AND ( id_empresa = ".$activity["id_empresa"].") AND eliminado = 0 ORDER BY id_empresa ASC, id ASC ", 1);
                                                if($grupos){
                                                    $cou1 = 1;
                                                    echo '<div class="bGray p20 mb30">';
                                                    echo '<div class="tB mb5">Soluciones por parámetros</div>';
                                                    echo '<ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified" id="" role="tablist">';
                                                    foreach ($grupos as $key => $grupo) {
                                                        $act1 = $cou1 == 1 ? "active" : "" ;
                                                        $act2 = $cou1 == 1 ? "true" : "false" ;
                                                        echo '
                                                            <li class="nav-item">
                                                                <a class="nav-link '.$act1.'" id="tabN1-'.$question["id"].'-'.$grupo["id"].'-tab" data-toggle="tab" href="#tabN1-'.$question["id"].'-'.$grupo["id"].'"
                                                                    role="tab" aria-controls="tabN1-'.$question["id"].'-'.$grupo["id"].'" aria-selected="'.$act2.'">'.($grupo["nombre"]).'</a>
                                                            </li>
                                                        ';
                                                        $cou1++;
                                                    }
                                                    echo '</ul><div class="tab-content bfff" id="">';
                                                    $cou1 = 1;
                                                    foreach ($grupos as $key => $grupo) {

                                                        $act3 = $cou1 == 1 ? "show active" : "" ;
                                                        echo '
                                                            <div class="tab-pane fade '.$act3.'" id="tabN1-'.$question["id"].'-'.$grupo["id"].'" role="tabpanel"
                                                                aria-labelledby="tabN1-'.$question["id"].'-'.$grupo["id"].'-tab">
                                                        ';
                                                        $parametros = $_ZOOM->get_data("grw_segmentos", " AND id_parametro = '".$grupo["id"]."' AND eliminado = 0 ORDER BY id ASC ", 1);
                                                        if($parametros){

                                                            $cou2 = 1;
                                                            echo '<ul class="nav nav-tabs nav-underline no-hover-bg" id="" role="tablist">';
                                                            foreach ($parametros as $key => $parametro) {

                                                                $act11 = $cou2 == 1 ? "active" : "" ;
                                                                $act22 = $cou2 == 1 ? "true" : "false" ;
                                                                echo '
                                                                    <li class="nav-item">
                                                                        <a class="nav-link '.$act11.'" id="tabN1-'.$question["id"].'-'.$grupo["id"].'-'.$parametro["id"].'-tab" data-toggle="tab" href="#tabN1-'.$question["id"].'-'.$grupo["id"].'-'.$parametro["id"].'"
                                                                            role="tab" aria-controls="tabN1-'.$question["id"].'-'.$grupo["id"].'-'.$parametro["id"].'" aria-selected="'.$act22.'">'.($parametro["nombre"]).'</a>
                                                                    </li>
                                                                ';
                                                                $cou2++;

                                                            }

                                                            echo '</ul><div class="tab-content bfff" id="">';

                                                            $cou2 = 1;

                                                            foreach ($parametros as $key => $parametro) {
                                                                $act33 = $cou2 == 1 ? "show active" : "" ;

                                                                echo '
                                                                    <div class="tab-pane fade '.$act33.'" id="tabN1-'.$question["id"].'-'.$grupo["id"].'-'.$parametro["id"].'" role="tabpanel"
                                                                        aria-labelledby="tabN1-'.$question["id"].'-'.$grupo["id"].'-'.$parametro["id"].'-tab">
                                                                ';

                                                                    $respuestas = $_ZOOM->obtenerRespuestas($question["id"], $dynamic["id_tipo"], $question["tipo"]["id"], $parametro["id"]);

                                                                    // echo '<div class="tab beee p20">';
                                                                    // echo '<div class="tabIn t18 ff3">'.($question["nombre"])."</div>";
                                                                    // echo '<div class="tabIn t14 ff3 taR"><i>'.($modos[$question["tipo"]["id"]]["nombre"])."</i></div>";
                                                                    // echo "</div>";

                                                                    if($question["tipo"]["id"] == 1){
                                                                        if($respuestas){
                                                                            foreach($respuestas["respuestas"] AS $key => $answer){
                                                                                if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                if($answer["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                                echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                                echo '<div class="tabIn taR pLR20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                                                echo '</div>';
                                                                            }
                                                                        } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                    }elseif($question["tipo"]["id"] == 2){
                                                                        if($respuestas){
                                                                            foreach($respuestas["respuestas"] AS $key => $answer){
                                                                                if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                if($answer["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                                echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                                echo '<div class="tabIn taR pLR20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                                                echo '</div>';
                                                                            }
                                                                        } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                    }elseif($question["tipo"]["id"] == 3){
                                                                        if($respuestas){
                                                                            foreach($respuestas["respuestas"] AS $key => $answer){
                                                                                if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                                echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                                echo '<div class="tabIn taR pL20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                echo '</div>';
                                                                            }
                                                                        } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                    }elseif($question["tipo"]["id"] == 4){
                                                                        if($respuestas){
                                                                            foreach($respuestas["respuestas"] AS $key => $answer){
                                                                                if(!isset($respuestas["soluciones"][$key])) $respuestas["soluciones"][$key] = 0;
                                                                                if($answer["correcta"]) $icon = "la la-check success"; else $icon = "la la-close danger";
                                                                                echo '<div class="tab bGray p1020 mb5">';
                                                                                echo '<div class="tabIn">'.($answer["nombre"]).'</div>';
                                                                                echo '<div class="tabIn taR pLR20">'.$respuestas["soluciones"][$key].' / '.$respuestas["soluciones_totales"].'</div>';
                                                                                echo '<div class="tabIn taC w30x"><i class="t14 '.$icon.'"></i></div>';
                                                                                echo '</div>';
                                                                            }
                                                                        } else echo '<div class="bfff taC p30 tB color999">No hay soluciones con este criterio de filtro</div>';
                                                                    }elseif($question["tipo"]["id"] == 5){
                                                                        echo '<div class="tab bGray p20 mb5">';
                                                                        echo '<div class="tabIn">';
                                                                        if(isset($respuestas["soluciones"])){
                                                                            $txt = "";
                                                                            $rad = explode("|", ($respuestas["soluciones"]));
                                                                            foreach($rad AS $value) $txt .= '<div class="bS1 p510 t12 beee mb3">'.$value."</div>";
                                                                            echo $txt;
                                                                        } else echo '<div class="taC tU t16 p10">Sin resultados</div>';
                                                                        echo '</div>';
                                                                        echo '</div>';
                                                                        // echo '<pre>';
                                                                        // print_r($respuestas);
                                                                        // echo '</pre>';
                                                                    }


                                                                echo '</div>';
                                                                $cou2++;
                                                            }
                                                            echo '</div>';
                                                        }
                                                        echo '</div>';
                                                        $cou1++;
                                                    }
                                                    echo '</div>';
                                                    echo '</div>';

                                                }
                                                */


                                            }
                                        }
                                    ?>
                                </div>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
    <?php
                }
            } else echo '<div class="taC p40 t24">No se puede establecer un balance aún!</div>';
        } else echo '<div class="taC p40 t24">¡No se encontró la configuración buscada!</div>';
    ?>

</div>
