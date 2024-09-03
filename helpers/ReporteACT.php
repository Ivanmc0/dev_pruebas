<?php

    function BuildStructureACT ( $DataACT, $DataSolutionsACT ) {

        if ( !$DataACT ) return 0;

        $DataSolutionsACT['Encuestas'] = UnificarSoluciones($DataSolutionsACT['Encuestas']);

        $StructureEncuestas       = StructureACT ($DataACT['Encuestas'], $DataSolutionsACT['Encuestas']);
        // $StructureReconocimientos = StructureReconocimientos ($DataACT['Reconocimientos'] );
        //$StructureCampanias       = StructureCampanias ($DataACT['Campanias'] );

        return $StructureEncuestas  ;
    }

    function UnificarSoluciones ( $DataSolutionsACT ) {

        if(!$DataSolutionsACT) return 0;

        $SolucionesTemporal = array();
        foreach ( $DataSolutionsACT as $Solucion ) {
            if ( $Solucion['soluc_idrespuesta'] != ''  || $Solucion['soluc_resp_multiple'] != ''  ){
                if ($Solucion['soluc_idrespuesta'] != '' ) {
                    array_push ( $SolucionesTemporal, $Solucion );
                }else {
                    $IdMultiples = explode(',',$Solucion['soluc_resp_multiple']);
                    foreach ( $IdMultiples as $SolucionMultiple ) {
                        $Solucion['soluc_idrespuesta'] = $SolucionMultiple ;
                        array_push ( $SolucionesTemporal, $Solucion );
                    }
                }
            }
        }

        $soluciones = array();

        foreach ($SolucionesTemporal as $Solucion) {
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['id']                                                                                     = $Solucion['soluc_id'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['uuid']                                                                                   = $Solucion['soluc_uuid'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['nombre']                                                                                 = $Solucion['soluc_nom_respuesta'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['idrespuesta']                                                                            = $Solucion['soluc_idrespuesta'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['resp_multiple']                                                                          = $Solucion['soluc_resp_multiple'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['respuesta']                                                                              = $Solucion['soluc_respuesta'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['inactivo']                                                                               = $Solucion['soluc_inactivo'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['fecha']                                                                                  = $Solucion['soluc_fecha'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['id']                                                                      = $Solucion['user_id'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['uuid']                                                                    = $Solucion['user_uuid'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['identificacion']                                                          = $Solucion['user_identificacion'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['nombre']                                                                  = $Solucion['user_nombre'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['apellidos']                                                               = $Solucion['user_apellidos'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['email']                                                                   = $Solucion['user_email'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['inactivo']                                                                = $Solucion['user_inactivo'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['fecha']                                                                   = $Solucion['user_fecha'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['segmentaciones'][$Solucion['sgmntaciones_id']]['id']                      = $Solucion['sgmntaciones_id'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['segmentaciones'][$Solucion['sgmntaciones_id']]['uuid']                    = $Solucion['sgmntaciones_uiid'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['segmentaciones'][$Solucion['sgmntaciones_id']]['nombre']                  = $Solucion['sgmntaciones_nombre'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['segmentaciones'][$Solucion['sgmntaciones_id']]['inactivo']                = $Solucion['sgmntaciones_inactivo'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['segmentaciones'][$Solucion['sgmntaciones_id']]['segmento']['id']          = $Solucion['resp_user_sgmnto_id'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['segmentaciones'][$Solucion['sgmntaciones_id']]['segmento']['uuid']        = $Solucion['resp_user_sgmnto_uuid'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['segmentaciones'][$Solucion['sgmntaciones_id']]['segmento']['idparametro'] = $Solucion['resp_user_sgmnto_id_param'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['segmentaciones'][$Solucion['sgmntaciones_id']]['segmento']['idopcion']    = $Solucion['resp_user_sgmnto_id_opcion'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['segmentaciones'][$Solucion['sgmntaciones_id']]['segmento']['nombre']      = $Solucion['resp_user_opcion_nombre'];
            $soluciones[$Solucion['soluc_idrespuesta']][$Solucion['soluc_id']]['colaborador']['segmentaciones'][$Solucion['sgmntaciones_id']]['segmento']['inactivo']    = $Solucion['resp_user_sgmnto_inactivo'];
        }

        return $soluciones;

    }

    function StructureACT ( $DataACT, $DataSolutionsACT ) {

        $ACT = array();

        foreach ($DataACT as $registro) {

            $ACT['id']                                                                                    = $registro['actv_id'];
            $ACT['uuid']                                                                                  = $registro['actv_uuid'];
            $ACT['id_empresa']                                                                            = $registro['actv_id_empresa'];
            $ACT['nombre']                                                                                = $registro['actv_nombre'];
            $ACT['descripcion']                                                                           = $registro['actv_descripcion'];
            $ACT['inactivo']                                                                              = $registro['actv_inactivo'];
            $ACT['fecha']                                                                                 = $registro['actv_fecha'];
            $ACT['desde']                                                                                 = DateFront( $registro['proceso_desde'] );
            $ACT['hasta']                                                                                 = DateFront( $registro['proceso_hasta'] );
            $ACT['visible']                                                                               = $registro['proceso_visible'];

            $ACT['categoria']['id']                                                                       = $registro['categ_id'];
            $ACT['categoria']['uuid']                                                                     = $registro['categ_uuid'];
            $ACT['categoria']['nombre']                                                                   = $registro['categ_nombre'];
            $ACT['categoria']['inactivo']                                                                 = $registro['categ_inactivo'];
            $ACT['categoria']['fecha']                                                                    = $registro['categ_fecha'];
            $ACT['categoria']['id']                                                                       = $registro['categ_id'];

            $ACT['dinamicas'][$registro['dinam_id']]['id']                                                = $registro['dinam_id'];
            $ACT['dinamicas'][$registro['dinam_id']]['uuid']                                              = $registro['dinam_uuid'];
            $ACT['dinamicas'][$registro['dinam_id']]['nombre']                                            = $registro['dinam_nombre'];
            $ACT['dinamicas'][$registro['dinam_id']]['prioridad']                                         = $registro['dinam_prioridad'];
            $ACT['dinamicas'][$registro['dinam_id']]['inactivo']                                          = $registro['dinam_inactivo'];
            $ACT['dinamicas'][$registro['dinam_id']]['fecha']                                             = $registro['dinam_fecha'];
            $ACT['dinamicas'][$registro['dinam_id']]['fecha_cierre']                                      = $registro['dinam_fecha_cierre'];
            $ACT['dinamicas'][$registro['dinam_id']]['modelo']['id']                                      = $registro['modelo_id'];
            $ACT['dinamicas'][$registro['dinam_id']]['modelo']['uuid']                                    = $registro['modelo_uuid'];
            $ACT['dinamicas'][$registro['dinam_id']]['modelo']['nombre']                                  = $registro['modelo_nombre'];
            $ACT['dinamicas'][$registro['dinam_id']]['modelo']['inactivo']                                = $registro['modelo_inactivo'];
            $ACT['dinamicas'][$registro['dinam_id']]['modelo']['fecha']                                   = $registro['modelo_fecha'];
            $ACT['dinamicas'][$registro['dinam_id']]['tipo_modelo']['id']                                 = $registro['tpmodel_id'];
            $ACT['dinamicas'][$registro['dinam_id']]['tipo_modelo']['uuid']                               = $registro['tpmodel_uiid'];
            $ACT['dinamicas'][$registro['dinam_id']]['tipo_modelo']['nombre']                             = $registro['tpmodel_nombre'];
            $ACT['dinamicas'][$registro['dinam_id']]['tipo_modelo']['inactivo']                           = $registro['tpmodel_inactivo'];
            $ACT['dinamicas'][$registro['dinam_id']]['tipo_modelo']['fecha']                              = $registro['tpmodel_fecha'];
            $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['id']             = $registro['preg_id'];
            $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['uuid']           = $registro['preg_uuid'];
            $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['nombre']         = $registro['preg_nombre'];
            $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['prioridad']      = $registro['preg_prioridad'];
            $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['inactivo']       = $registro['preg_inactivo'];
            $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['fecha']          = $registro['preg_fecha'];
            $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['tipo']['id']     = $registro['tipo_preg_id'];
            $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['tipo']['uuid']   = $registro['tipo_preg_uuid'];
            $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['tipo']['nombre'] = $registro['tipo_preg_nombre'];

            if ( $registro['tipo_preg_id']  != 5 ) {

                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['id']        = $registro['resp_id'];
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['uuid']      = $registro['resp_uuid'];
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['nombre']    = $registro['resp_nombre'];
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['correcta']  = $registro['resp_correcta'];
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['valor']     = $registro['resp_valor'];
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['prioridad'] = $registro['resp_prioridad'];
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['inactivo']  = $registro['resp_inactivo'];
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['fecha']     = $registro['resp_fecha'];

                if(isset($DataSolutionsACT[$registro['resp_id']])){
                    $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['soluciones']  = $DataSolutionsACT[$registro['resp_id']];
                }else{
                    $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['soluciones'] = 0;
                }

                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['balance']['c_soluciones']     = 0;
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['balance']['c_solucionadores'] = 0;
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['balance']['correctas']        = 0;
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['respuestas'][$registro['resp_id']]['balance']['incorrectas']      = 0;

                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['balance']['c_soluciones']     = 0;
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['balance']['c_solucionadores'] = 0;
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['balance']['total']            = 0;
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['balance']['sumatoria']        = 0;
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['balance']['correctas']        = 0;
                $ACT['dinamicas'][$registro['dinam_id']]['preguntas'][$registro['preg_id']]['balance']['incorrectas']      = 0;

                $ACT['dinamicas'][$registro['dinam_id']]['balance']['sumatoria']        = 0;
                $ACT['dinamicas'][$registro['dinam_id']]['balance']['total']            = 0;
                $ACT['dinamicas'][$registro['dinam_id']]['balance']['c_preguntas']      = 0;
                $ACT['dinamicas'][$registro['dinam_id']]['balance']['c_solucionadores'] = 0;

                $ACT['balance']['sumatoria']        = 0;
                $ACT['balance']['total']            = 0;
                $ACT['balance']['c_dinamicas']      = 0;
                $ACT['balance']['c_solucionadores'] = 0;

            }
        }

        return BalancesACT ($ACT);

    }

    function BalancesACT ( &$ACT ) {

        if(!isset($ACT["dinamicas"])) return 0;

        foreach ($ACT["dinamicas"]  as $key => $dinamica) {
            $IdDinamica = $dinamica["id"];
            if($dinamica["preguntas"]){
                foreach ($dinamica["preguntas"] as $key => $pregunta) {
                    $IdPregunta = $pregunta['id'];
                    if ( isset ( $pregunta["respuestas"])) {
                        if($pregunta["respuestas"]){
                            foreach ($pregunta["respuestas"] as $key => $respuesta) {
                                $IdRespuesta = $respuesta['id'];
                                if($respuesta["soluciones"]){
                                    foreach ($respuesta["soluciones"] as $key => $solucion) {
                                        $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["sumatoria"] += $respuesta["valor"];
                                        $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["respuestas"][$IdRespuesta]["balance"]["c_soluciones"] += 1;
                                        $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["respuestas"][$IdRespuesta]["balance"]["solucionadores"][$solucion["colaborador"]["id"]] = 1;
                                        $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["solucionadores"][$solucion["colaborador"]["id"]] = 1;
                                        $ACT["dinamicas"][$IdDinamica]["balance"]["solucionadores"][$solucion["colaborador"]["id"]] = 1;
                                        $ACT["balance"]["solucionadores"][$solucion["colaborador"]["id"]] = 1;

                                        if($respuesta["correcta"] == 1){
                                            $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["correctas"] += 1;
                                        } else {
                                            $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["incorrectas"] += 1;
                                        }
                                    }

                                    $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["respuestas"][$IdRespuesta]["balance"]["c_solucionadores"] = count($ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["respuestas"][$IdRespuesta]["balance"]["solucionadores"]);

                                }
                            }
                            $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["c_solucionadores"] = isset($ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["solucionadores"]) ? count($ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["solucionadores"]) : 0;
                            $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["total"] = $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["c_solucionadores"] ?
                            $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["sumatoria"] / $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["c_solucionadores"] : 0;
                            $ACT["dinamicas"][$IdDinamica]["balance"]["sumatoria"] += $ACT["dinamicas"][$IdDinamica]["preguntas"][$IdPregunta]["balance"]["total"];
                            $ACT["dinamicas"][$IdDinamica]["balance"]["c_preguntas"] += 1;
                        }
                        $ACT["dinamicas"][$IdDinamica]["balance"]["c_solucionadores"] = isset($ACT["dinamicas"][$IdDinamica]["balance"]["solucionadores"]) ? count($ACT["dinamicas"][$IdDinamica]["balance"]["solucionadores"]) : 0;
                        $ACT["dinamicas"][$IdDinamica]["balance"]["total"]            = $ACT["dinamicas"][$IdDinamica]["balance"]["c_preguntas"] ?
                        $ACT["dinamicas"][$IdDinamica]["balance"]["sumatoria"] / $ACT["dinamicas"][$IdDinamica]["balance"]["c_preguntas"] : 0;
                        $ACT["balance"]["sumatoria"] += $ACT["dinamicas"][$IdDinamica]["balance"]["total"];
                        $ACT["balance"]["c_dinamicas"] += 1;
                    }else {
                        $ACT["dinamicas"][$IdDinamica]["balance"]["c_solucionadores"]  = 0;
                        $ACT["dinamicas"][$IdDinamica]["balance"]["total"]             = 0;
                        $ACT["dinamicas"][$IdDinamica]["balance"]["sumatoria"]         = 0;
                        $ACT["dinamicas"][$IdDinamica]["balance"]["c_preguntas"]       = 0;
                        $ACT["balance"]["sumatoria"]                                   = 0;
                        $ACT["balance"]["c_dinamicas"]                                 = 0;
                    }

                }
            }
        }

        $ACT["balance"]["c_solucionadores"] = isset($ACT["balance"]["solucionadores"]) ?  count($ACT["balance"]["solucionadores"]) : 0;
        $ACT["balance"]["total"]            = $ACT["balance"]["c_dinamicas"] ?
        $ACT["balance"]["sumatoria"] / $ACT["balance"]["c_dinamicas"] : 0;

        return $ACT;

    }

    function StructureCampanias ( $DataCampanias ) {
        if ( !$DataCampanias  ) return 0;
        $NewOrdered = array();
        foreach ($DataCampanias as $Registro ) {
            $IdActv                                                                              = $Registro['actvdad_id'];
            $IdDinm                                                                              = $Registro['dnmca_id'];
            $IdCamp                                                                              = $Registro['cmpnia_id'];
            $IdColab                                                                             = $Registro['cmpnia_id'];
            $NewOrdered['actividad'][$IdActv]['id']                                                           = $Registro['actvdad_id'];
            $NewOrdered['actividad'][$IdActv]['uuid']                                                         = $Registro['actvdad_uuid'];
            $NewOrdered['actividad'][$IdActv]['nombre']                                                       = $Registro['actvdad_nombre'];
            $NewOrdered['actividad'][$IdActv]['fecha']                                                        = $Registro['actvdad_fecha'];
            $NewOrdered['actividad'][$IdActv]['desde']                                                        = DateFront ( $Registro['proceso_desde']);
            $NewOrdered['actividad'][$IdActv]['hasta']                                                        = DateFront ( $Registro['proceso_hasta']);
            $NewOrdered['actividad'][$IdActv]['visible']                                                      = DateFront ( $Registro['proceso_visible']);
            $NewOrdered['actividad'][$IdActv]['dinamicas'][$IdDinm]['id']                                     = $Registro['dnmca_id'];
            $NewOrdered['actividad'][$IdActv]['dinamicas'][$IdDinm]['uuid']                                   = $Registro['dnmca_uuid'];
            $NewOrdered['actividad'][$IdActv]['dinamicas'][$IdDinm]['nombre']                                 = $Registro['dnmca_nombre'];
            $NewOrdered['actividad'][$IdActv]['dinamicas'][$IdDinm]['fecha']                                  = $Registro['dnmca_fecha'];
            $NewOrdered['actividad'][$IdActv]['dinamicas'][$IdDinm]['colaborador'][ $IdColab ]['id']          = $Registro['user_id'];
            $NewOrdered['actividad'][$IdActv]['dinamicas'][$IdDinm]['colaborador'][ $IdColab ]['uuid']        = $Registro['user_uuid'];
            $NewOrdered['actividad'][$IdActv]['dinamicas'][$IdDinm]['colaborador'][ $IdColab ]['nombre']      = FullName ( $Registro['user_nombres'], $Registro['user_apellidos']);
            $NewOrdered['actividad'][$IdActv]['dinamicas'][$IdDinm]['colaborador'][ $IdColab ]['comentarios'] = $Registro['cmpnia_comentarios'];
            $NewOrdered['actividad'][$IdActv]['dinamicas'][$IdDinm]['colaborador'][ $IdColab ]['fecha']       = DateFront($Registro['cmpnia_fecha']);
        }
        return $NewOrdered;
    }

    function StructureReconocimientos ( $DataReconocimientos ) {
        if ( !$DataReconocimientos ) return 0;
        $Rcncmntos = array();
        foreach ($DataReconocimientos  as $Registro ) {
            $IdAct                                                                                                             = $Registro['actvdad_id'];
            $IdDinam                                                                                                           = $Registro['dinamica_id'];
            $IdRcncedor                                                                                                        = $Registro['rcncdor_id'];
            $IdRcncido                                                                                                         = $Registro['rcncido_id'];
            $Rcncmntos['actividad'][$IdAct ]['id']                                                                             = $Registro['actvdad_id'];
            $Rcncmntos['actividad'][$IdAct ]['uuid']                                                                           = $Registro['actvdad_uuid'];
            $Rcncmntos['actividad'][$IdAct ]['nombre']                                                                         = $Registro['actvdad_nombre'];
            $Rcncmntos['actividad'][$IdAct ]['desde']                                                                          = DateFront ( $Registro['proceso_desde']);
            $Rcncmntos['actividad'][$IdAct ]['hasta']                                                                          = DateFront ( $Registro['proceso_hasta']);
            $Rcncmntos['actividad'][$IdAct ]['visible']                                                                        = DateFront ( $Registro['proceso_visible']);
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['id']                                                       = $Registro['dinamica_id'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['uuid']                                                     = $Registro['dinamica_uuid'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['nombre']                                                   = $Registro['dinamica_nombre'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocedores'][$IdRcncedor]['id']           = $Registro['rcncdor_id'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocedores'][$IdRcncedor]['uuid']         = $Registro['rcncdor_uuid'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocedor'][$IdRcncedor]['nombre']         = FullName ($Registro['rcncdor_nombres'], $Registro['rcncido_apellidos'] );
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocidos'][$IdRcncido ]['id']             = $Registro['rcncido_id'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocidos'][$IdRcncido ]['uuid']           = $Registro['rcncido_uuid'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocidos'][$IdRcncido ]['nombre']         = FullName($Registro['rcncido_nombres'] ,$Registro['rcncido_apellidos']) ;
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocimientos'][$IdRcncido ]['id']         = $Registro['rcncmnto_id'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocimientos'][$IdRcncido ]['uuid']       = $Registro['rcncmnto_uuid'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocimientos'][$IdRcncido ]['nombre']     = $Registro['rcncmnto_nombre'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocimientos'][$IdRcncido ]['comentario'] = $Registro['rcncido_comentario'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocimientos'][$IdRcncido ]['forma']      = $Registro['rcncmnto_forma'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocimientos'][$IdRcncido ]['color']      = $Registro['rcncmnto_color'];
            $Rcncmntos['actividad'][$IdAct ]['dinamica'][$IdDinam]['soluciones']['reconocimientos'][$IdRcncido ]['icono']      = $Registro['rcncmnto_icono'];
        }

        return  $Rcncmntos;
    }

?>