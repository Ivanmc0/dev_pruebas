<?php

require_once($_SESSION['_CLASS'] .'OLC.php');

class Valora {

    private $_ZOOM;

    public function __construct(){
        $this->_ZOOM = new Zoom();
    }

    public function LoadJourney ($uuid_journey){

        $horizontal = $this->GetHorizontalData($uuid_journey);
        $vertical   = $this->GetVerticalData($uuid_journey);

        return $this->EstructureData($horizontal, $vertical);

    }

    public function GetHorizontalData ($uuid_journey) {

        $TextSQL = "SELECT
                val.id AS id_valoracion, val.nombre AS valoracion,
                eta.id AS id_etapa, eta.nombre AS etapa, eta.orden AS orden_etapa,
                fas.id AS id_fase, fas.nombre AS fase, fas.uuid AS uuid_fase, fas.orden AS orden_fase,
                sub.id AS id_subfase, sub.nombre AS subfase, sub.uuid AS uuid_subfase, sub.orden AS orden_subfase

            FROM grw_val_subfases AS sub

            INNER JOIN grw_val_fases AS fas ON fas.id = sub.id_fase AND fas.inactivo = 0 AND fas.eliminado = 0
            INNER JOIN grw_val_etapas AS eta ON eta.id = fas.id_etapa AND eta.inactivo = 0 AND eta.eliminado = 0
            INNER JOIN grw_val_valoraciones AS val ON val.id = fas.id_journey AND val.inactivo = 0 AND val.eliminado = 0 AND val.id_tipo = 1

            WHERE sub.inactivo = 0 AND sub.eliminado = 0
                AND val.uuid = '$uuid_journey'

            ORDER BY eta.orden ASC, fas.orden ASC, fas.id ASC, sub.orden ASC, sub.id ASC
        ";

        return $this->_ZOOM->RUN_SQL($TextSQL);

    }

    public function GetVerticalData ($uuid_journey) {

        $TextSQL = "SELECT
                val.id AS id_valoracion, val.nombre AS valoracion,
                ref.id AS id_referente, ref.nombre AS referente, ref.uuid AS uuid_referente, ref.orden AS orden_referente

            FROM grw_val_referentes AS ref

            INNER JOIN grw_val_valoraciones AS val ON val.id = ref.id_journey AND val.inactivo = 0 AND val.eliminado = 0 AND val.id_tipo = 1

            WHERE ref.inactivo = 0 AND ref.eliminado = 0
                AND val.uuid = '$uuid_journey'

            ORDER BY ref.private ASC, ref.orden ASC, ref.id ASC
        ";

        return $this->_ZOOM->RUN_SQL($TextSQL);

    }

    private function EstructureData ($horizontal, $vertical) {

        $estructura          = [];
        $estructura_vertical = [];

        if($horizontal) {
            foreach($horizontal as $row) {
                $estructura["id"]                                                                                           = $row["id_valoracion"];
                $estructura["nombre"]                                                                                       = $row["valoracion"];
                $estructura["etapas"][$row['id_etapa']]["id"]                                                               = $row['id_etapa'];
                $estructura["etapas"][$row['id_etapa']]["nombre"]                                                           = $row['etapa'];
                $estructura["etapas"][$row['id_etapa']]["orden"]                                                            = $row['orden_etapa'];
                $estructura["etapas"][$row['id_etapa']]["fases"][$row['id_fase']]["id"]                                     = $row['id_fase'];
                $estructura["etapas"][$row['id_etapa']]["fases"][$row['id_fase']]["uuid"]                                   = $row['uuid_fase'];
                $estructura["etapas"][$row['id_etapa']]["fases"][$row['id_fase']]["nombre"]                                 = $row['fase'];
                $estructura["etapas"][$row['id_etapa']]["fases"][$row['id_fase']]["orden"]                                  = $row['orden_fase'];
                $estructura["etapas"][$row['id_etapa']]["fases"][$row['id_fase']]["subfases"][$row['id_subfase']]["id"]     = $row['id_subfase'];
                $estructura["etapas"][$row['id_etapa']]["fases"][$row['id_fase']]["subfases"][$row['id_subfase']]["uuid"]   = $row['uuid_subfase'];
                $estructura["etapas"][$row['id_etapa']]["fases"][$row['id_fase']]["subfases"][$row['id_subfase']]["nombre"] = $row['subfase'];
                $estructura["etapas"][$row['id_etapa']]["fases"][$row['id_fase']]["subfases"][$row['id_subfase']]["orden"]  = $row['orden_subfase'];
            }
        }

        foreach ($estructura["etapas"] as $key => $etapa) {
            $cont = 0;
            $estructura["etapas"][$key]["columnas"] = 0;
            foreach ($etapa["fases"] as $key2 => $fase) {
                $estructura["etapas"][$key]["fases"][$key2]["columnas"] = 0;
                foreach ($fase["subfases"] as $key3 => $subfase) {
                    $estructura["etapas"][$key]["columnas"]++;
                    $estructura["etapas"][$key]["fases"][$key2]["columnas"]++;
                }
            }
        }

        if($vertical) {
            foreach($vertical as $row) {
                $estructura_vertical[$row['id_referente']]["id"]     = $row['id_referente'];
                $estructura_vertical[$row['id_referente']]["nombre"] = $row['referente'];
                $estructura_vertical[$row['id_referente']]["uuid"]   = $row['uuid_referente'];
                $estructura_vertical[$row['id_referente']]["orden"]  = $row['orden_referente'];
            }
            $estructura["referentes"] = $estructura_vertical;
        }

        return $estructura;

    }

    public function LoadEvents ($uuid_journey) {


        $events         = $this->GetEvents($uuid_journey);
        // $investigations = $this->GetInvetigations($uuid_journey);

        return 0;

        return [
            '1_2' => [
                1 =>"data del evento",
                2 =>"data del evento",
            ],
            '5_1' => [
                3 =>"data del evento",
            ],

        ];

    }

    public function GetEvent ($uuid) {

        if ($evento = $this->_ZOOM->get_data("grw_val_eventos", " AND uuid = '$uuid' AND eliminado = 0 ORDER BY id DESC ", 0)){
            return $this->GetEvents($evento["id_valoracion"]);
        } else return 0;

    }

    public function GetEvents ($conditions = '') {

        $estructura = [];

        $TextSQL = "SELECT
                eve.id AS id_evento, eve.nombre AS nombre_evento, eve.descripcion AS descripcion_evento, eve.uuid, eve.id_x, eve.id_y, eve.texto1, eve.texto2, eve.texto3, eve.texto4, eve.id_valoracion, eve.id_empresa,
                inv.id AS id_investigacion, inv.uuid AS uuid_investigacion, inv.nombre AS nombre_investigacion, inv.descripcion AS descripcion_investigacion, inv.id_publico_listado, inv.id_publico,
                arq.id AS id_arquetipo, arq.nombre AS nombre_arquetipo, arq.cita, arq.id_color, arq.descr_demo_edad, arq.descr_demo_genero, arq.descr_demo_socioeconomico, arq.descr_demo_ubicacion, arq.descr_demo_otro, arq.descr_psico_intereses, arq.descr_psico_valores, arq.descr_psico_estilovida, arq.descr_psico_personalidad, arq.descr_psico_otro, arq.motivaciones, arq.comportamiento_compra, arq.desafios, arq.objetivos, arq.influencias, arq.ejemplos, arq.canales,
                enc.id AS id_encuesta, enc.nombre AS nombre_encuesta,
                pub.id AS id_publico_listado, pub.nombre AS nombre_publico_listado,
                col.nombre AS color

            FROM grw_val_investigaciones AS inv

            RIGHT JOIN grw_val_eventos AS eve ON inv.id_evento = eve.id
            LEFT JOIN grw_arquetipos AS arq ON arq.id = eve.id_arquetipo AND arq.inactivo = 0 AND arq.eliminado = 0
            LEFT JOIN grw_val_encuestas AS enc ON enc.id = inv.id_encuesta AND enc.inactivo = 0 AND enc.eliminado = 0
            LEFT JOIN grw_val_listas AS pub ON pub.id = inv.id_publico_listado AND pub.inactivo = 0 AND pub.eliminado = 0
            LEFT JOIN olc_colores AS col ON col.id = arq.id_color AND col.inactivo = 0 AND col.eliminado = 0

            WHERE $conditions
            AND eve.eliminado = 0
            -- AND inv.eliminado = 0

            ORDER BY eve.id_arquetipo ASC, eve.id ASC

        ";

        if($eventos = $this->_ZOOM->RUN_SQL($TextSQL)){

            $id_journey = $eventos[0]["id_valoracion"];
            $id_empresa = $eventos[0]["id_empresa"];

            $arcs = [];
            // if($arquetipos = $this->GetArquetipos(" inv.id_valoracion = '$id_journey' ")){
            //     foreach ($arquetipos as $arquetipo) {
            //         $arcs[$arquetipo["id_investigacion"]][$arquetipo["id_arquetipo"]]["id"]     = $arquetipo["id_arquetipo"];
            //         $arcs[$arquetipo["id_investigacion"]][$arquetipo["id_arquetipo"]]["nombre"] = $arquetipo["nombre"];
            //         $arcs[$arquetipo["id_investigacion"]][$arquetipo["id_arquetipo"]]["color"]  = $arquetipo["color"];
            //     }
            // }

            foreach ($eventos as $evento) {

                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["id"]                                     = $evento["id_evento"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["uuid"]                                   = $evento["uuid"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["nombre"]                                 = $evento["nombre_evento"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["descripcion"]                            = $evento["descripcion_evento"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["id"]                        = $evento["id_arquetipo"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["nombre"]                    = $evento["nombre_arquetipo"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["cita"]                      = $evento["cita"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["id_color"]                  = $evento["id_color"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["color"]                     = $evento["color"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["descr_demo_edad"]           = $evento["descr_demo_edad"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["descr_demo_genero"]         = $evento["descr_demo_genero"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["descr_demo_socioeconomico"] = $evento["descr_demo_socioeconomico"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["descr_demo_ubicacion"]      = $evento["descr_demo_ubicacion"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["descr_demo_otro"]           = $evento["descr_demo_otro"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["descr_psico_intereses"]     = $evento["descr_psico_intereses"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["descr_psico_valores"]       = $evento["descr_psico_valores"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["descr_psico_estilovida"]    = $evento["descr_psico_estilovida"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["descr_psico_personalidad"]  = $evento["descr_psico_personalidad"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["descr_psico_otro"]          = $evento["descr_psico_otro"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["motivaciones"]              = $evento["motivaciones"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["comportamiento_compra"]     = $evento["comportamiento_compra"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["desafios"]                  = $evento["desafios"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["objetivos"]                 = $evento["objetivos"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["influencias"]               = $evento["influencias"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["ejemplos"]                  = $evento["ejemplos"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["arquetipo"]["canales"]                   = $evento["canales"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["texto1"]                                 = $evento["texto1"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["texto2"]                                 = $evento["texto2"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["texto3"]                                 = $evento["texto3"];
                $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["texto4"]                                 = $evento["texto4"];

                if($evento["id_investigacion"] != ""){
                    $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["investigaciones"][$evento["id_investigacion"]]["id"]                     = $evento["id_investigacion"];
                    $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["investigaciones"][$evento["id_investigacion"]]["uuid"]                   = $evento["uuid_investigacion"];
                    $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["investigaciones"][$evento["id_investigacion"]]["nombre"]                 = $evento["nombre_investigacion"];
                    $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["investigaciones"][$evento["id_investigacion"]]["descripcion"]            = $evento["descripcion_investigacion"];
                    $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["investigaciones"][$evento["id_investigacion"]]["id_publico_listado"]     = $evento["id_publico_listado"];
                    $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["investigaciones"][$evento["id_investigacion"]]["id_encuesta"]            = $evento["id_encuesta"];
                    $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["investigaciones"][$evento["id_investigacion"]]["nombre_encuesta"]        = $evento["nombre_encuesta"];
                    $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["investigaciones"][$evento["id_investigacion"]]["id_publico"]             = $evento["id_publico"];
                    $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["investigaciones"][$evento["id_investigacion"]]["id_publico_listado"]     = $evento["id_publico_listado"];
                    $estructura[$evento["id_x"]."_".$evento["id_y"]]["eventos"][$evento["id_evento"]]["investigaciones"][$evento["id_investigacion"]]["nombre_publico_listado"] = $evento["nombre_publico_listado"];
                }

            }

            return $estructura;

        }

        return 0;

    }

    private function GetArquetipos ($conditions = '') {

        $TextSQL = "SELECT
                rel.id_investigacion,
                arq.id AS id_arquetipo,
                arq.nombre,
                arq.descripcion,
                col.nombre AS color
            FROM
                grw_val__arquetipos_investigaciones AS rel
                INNER JOIN grw_arquetipos AS arq ON rel.id_arquetipo = arq.id
                INNER JOIN grw_val_investigaciones AS inv ON rel.id_investigacion = inv.id
                LEFT JOIN olc_colores AS col ON arq.id_color = col.id AND col.inactivo = 0 AND col.eliminado = 0
            WHERE $conditions
                AND arq.inactivo = 0 AND arq.eliminado = 0
                AND rel.inactivo = 0 AND rel.eliminado = 0
                AND inv.inactivo = 0 AND inv.eliminado = 0
        ";

        return $this->_ZOOM->RUN_SQL($TextSQL);

    }


    public function ReportInvestigacion ($AddToQuery, $ParametersToQuery, $ReturnRecord) {

		$TextSQL = "
            SELECT
                INV.id investigacion_id, INV.uuid investigacion_uuid, INV.nombre investigacion_nombre, INV.descripcion investigacion_descripcion, INV.fecha_fin investigacion_fecha_fin, INV.fecha_inicio investigacion_fecha_inicio, INV.id_publico_listado investigacion_lista_id, PUB.id investigacion_id_publico, PUB.nombre investigacion_publico,
                VAL.id valoracion_id, VAL.uuid valoracion_uuid, VAL.nombre valoracion_nombre, VAL.descripcion valoracion_descripcion,
                EVE.id evento_id, EVE.uuid evento_uuid, EVE.nombre evento_nombre, EVE.descripcion evento_descripcion,
                ARQ.nombre arquetipo_nombre, ARQ.id_color arquetipo_color,
                ENC.id encuesta_id, ENC.uuid encuesta_uuid, ENC.nombre encuesta_nombre, ENC.descripcion encuesta_descripcion, T_ENC.id encuesta_id_tipo, T_ENC.nombre encuesta_tipo,
                IFNULL (( SELECT nombre FROM grw_val_listas WHERE id = INV.id_publico_listado ), 0 ) AS lista_nombre
            FROM
                grw_val_investigaciones AS INV
                INNER JOIN grw_val_valoraciones AS VAL ON INV.id_valoracion = VAL.id
                INNER JOIN grw_val_eventos AS EVE ON INV.id_evento = EVE.id
                LEFT JOIN grw_arquetipos AS ARQ ON EVE.id_arquetipo = ARQ.id
                LEFT JOIN olc_publicos AS PUB ON INV.id_publico = PUB.id
                INNER JOIN grw_val_encuestas AS ENC ON INV.id_encuesta = ENC.id
                LEFT JOIN olc_encuestas AS T_ENC ON ENC.id_tipo = T_ENC.id
            WHERE INV.inactivo = 0 && INV.eliminado = 0
                && VAL.inactivo = 0 && VAL.eliminado = 0
                && EVE.inactivo = 0 && EVE.eliminado = 0
                && ENC.inactivo = 0 && ENC.eliminado = 0
                $AddToQuery
        ";

        $result          = $this->_ZOOM->RUN_SQL($TextSQL, $ReturnRecord);
        $result_ordenado = DataStructure("ReportInvestigacion", $result, $ReturnRecord);

        if($result_ordenado["id_lista"] != 0){

            $result_ordenado["id_lista"] = $result_ordenado["id_publico"];

        }


		return $result_ordenado;

    }

    public function SolucionesAnonimas ($AddToQuery, $ParametersToQuery, $ReturnRecord) {

		$TextSQL = "
            SELECT
                SOL.id, SOL.uuid, SOL.id_anonimo, SOL.id_pregunta, SOL.id_respuesta, SOL.respuesta, SOL.id_respuesta_multiple
            FROM
                grw_sol_val_anonima AS SOL
            WHERE
                SOL.inactivo = 0 && SOL.eliminado = 0
                $AddToQuery
        ";

        return SolucionesAnonimas($this->_ZOOM->RUN_SQL($TextSQL, $ReturnRecord));

    }


}