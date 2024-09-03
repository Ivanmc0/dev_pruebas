<?php

    if($mud = $_PLATFORM->PermissionValidationModel ($app, $geton[3], true)){
        if($registro = $_ZOOM->get_data("grw_val_valoraciones", " AND uuid = '".$geton[4]."' AND id_empresa = ".$_SESSION['COMPANY']['id']." AND eliminado = 0 ", 0)){
            if($process = $_ZOOM->get_data("grw_procesos", " AND id_proceso_tipo = 5 AND id_proceso = ".$registro["id"]." AND eliminado = 0 ", 0)){

                $id_rol     = $_SESSION["ADMIN"]['id'];
                $fath       = 0;
                $condicion  = " AND model.id_modulo = ".$mud['id'];
                $misBotones = '';

?>
    <div id="JourneyTop"></div>

    <div class="tab mb30">
        <div class="tabIn w50x">
            <div class="" onclick="window.history.back()">
                <div class="wh50 rr50 t30 bHover2"><div class="vMM rr50"><i class="las la-arrow-left"></i></div></div>
            </div>
        </div>
        <div class="tabIn pL20">
            <div class="t30 color000 ff1">Configurando tu Journey</div>
        </div>
        <div class="tabIn taR">
            <div id="JourneyDownClic" class="dIB wh40 bMorado2 colorfff rr50 apuntador t24 ff3 bShadow2 bHover cP" destino="JourneyDown" style="top:20px; right:20px; z-index:30; position:-absolute">
                <div class="vMM">
                    <i class="las la-arrow-down"></i>
                </div>
            </div>
        </div>
    </div>





    <div class="cloud bGrowi2 mb30">
        <div class="tab mb30">
            <?php
                echo '
                    <div class="tabIn w150x taC" style="vertical-align:top;">
                        <div class="dIB">
                            <div onclick="Crudion.Run(\'event-fd58f497-1c61-11ef-938f-b42e99a5cf9a\', \'builder-journey\', \'fd58f497-1c61-11ef-938f-b42e99a5cf9a\', \''.$registro['uuid'].'\', 0, 1)"
                                class="btn-2 btn-zs">
                                <i class=""><i class="las la-edit"></i></i>
                                <span>Editar</span>
                            </div>
                            <div id="rtn-event-fd58f497-1c61-11ef-938f-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                        </div>
                    </div>
                ';
            ?>
            <div class="tabIn" style="vertical-align:top;">
                <div class="t24 ff4 color000 mb5"><?= $registro['nombre']; ?></div>
                <div class="t18 ff1 color666"><?= $registro['descripcion']; ?></div>
            </div>
        </div>

        <div class="row">

            <div class="col-12 col-lg-4">
                <div class="tabAll bfff rr15 p20">
                    <div class="tabIn">
                        <div class="t18 ff3 colorGrowi mb5">Arquetipos</div>
                        <div class="ofA" style="max-height:100px;">
                            <?php
                                if($arquetipos = $_ZOOM->get_data("grw_val__arquetipos_valoraciones", " AND id_valoracion = ".$registro["id"]." AND id_empresa = ".$_SESSION['COMPANY']['id']." AND eliminado = 0 ", 1)){
                                    echo '<div class="row m0 p0">';
                                    foreach ($arquetipos as $key => $arquetipoid) {
                                        if($arquetipo = $_ZOOM->get_data("grw_arquetipos", " AND id = ".$arquetipoid["id_arquetipo"]." AND id_empresa = ".$_SESSION['COMPANY']['id']." AND eliminado = 0 ", 0)){
                                            if($color = $_ZOOM->get_data("olc_colores", " AND id = ".$arquetipo["id_color"]." AND eliminado = 0 ", 0)) $arquetipo['color'] = $color['nombre'];
                                            echo '<div class="col-12 col-lg-6 m0 p0 p3">';
                                            include 'app_valora/components/arquetipo.php';
                                            echo '</div>';
                                        }
                                    }
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="tabAll bfff rr15 p20">
                    <div class="tabIn w100x"><div class="bGrowi2 colorGrowi t50 wh80 rr50"><div class="vMM"><i class="las la-compass"></i></div></div></div>
                    <div class="tabIn">
                        <div class="t18 ff3 colorGrowi mb5">Expectativas</div>
                        <div class="t14 ff0 p3 color666 ofA" style="max-height:100px;"><?= $registro['expectativas']; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="tabAll bfff rr15 p20">
                    <div class="tabIn w100x" ><div class="bGrowi2 colorGrowi t50 wh80 rr50"><div class="vMM"><i class="las la-smile-beam"></i></div></div></div>
                    <div class="tabIn">
                        <div class="t18 ff3 colorGrowi mb5">Escenarios</div>
                        <div class="t14 ff0 p3 color666 ofA" style="max-height:100px;"><?= $registro['escenarios']; ?></div>
                    </div>
                </div>
            </div>

        </div>
    </div>



<?php

        $eventos = $_VALORA->GetEvents('eve.id_valoracion = '.$registro["id"]);

  

        if($strJourney = $_VALORA->LoadJourney($registro['uuid'])){

            echo '<div class="jCloudJourneyScroll">';
            echo '<div class="cloud jCloudJourney">';
            echo '<div class="jJourney">';
            echo '<table class="tablion table table-hover">';

            echo '<thead>';
            echo '<tr>';
            echo '
            <th class="jEtapas jVertical jGeneral"><div class="jVerticalArrow"><div class="jVerticalArrowIn"><div class="jVerticalArrowA"></div></div></div>
                <div class="fR jGeneralDiv" style="margin:-2px">
                    <div onclick="Crudion.Run(\'event-1a9f8fe4-228d-11ef-9911-b42e99a5cf9a\', \'builder-journey\', \'1a9f8fe4-228d-11ef-9911-b42e99a5cf9a\', \''.$registro['uuid'].'\', \''.$registro["id"].'\', 1)"
                        class="btn-1 btn-zxxxs">
                        <i class=""><i class="las la-plus-circle"></i></i>
                        <span style="">Crear</span>
                    </div>
                    <div id="rtn-event-1a9f8fe4-228d-11ef-9911-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                </div>
                Etapas
            </th>
            ';
            if (isset($strJourney["etapas"])) {
                foreach ($strJourney["etapas"] as $key => $etapa) {
                    echo '<th class="jEtapas jEtapa'.$key.'" colspan="'.$etapa["columnas"].'">'.$etapa["nombre"].'</th>';
                }
            }
            echo '</tr>';

            echo '<tr>';
            echo '
                <th class="jFases jVertical jGeneral">
                    <div class="jVerticalArrow"><div class="jVerticalArrowIn"><div class="jVerticalArrowA"></div></div></div>
                    Fases
                </th>
            ';
            if (isset($strJourney["etapas"])) {
                foreach ($strJourney["etapas"] as $key => $etapa) {
                    if (isset($etapa["fases"])) {
                        foreach ($etapa["fases"] as $key2 => $fase) {
                            echo '
                                <th class="jFases jFase'.$key.' jGeneral" colspan="'.$fase["columnas"].'">
                                    <div class="fR jGeneralDiv" style="margin:-3px 0 -10px">
                                        <div class="dIB">
                                            <div onclick="Crudion.Run(\'event-77f031a0-228d-11ef-9911-b42e99a5cf9a\', \'builder-journey\', \'77f031a0-228d-11ef-9911-b42e99a5cf9a\', \''.$registro['uuid'].'\', \''.$fase["id"].'\', 1)"
                                                class="btn-1 btn-zxxxs">
                                                <i class=""><i class="las la-plus-circle"></i></i>
                                            </div>
                                            <div id="rtn-event-77f031a0-228d-11ef-9911-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                                        </div>
                                        <div class="dIB">
                                            <div onclick="Crudion.Run(\'event-1aa7236f-228d-11ef-9911-b42e99a5cf9a\', \'builder-journey\', \'1aa7236f-228d-11ef-9911-b42e99a5cf9a\', \''.$fase['uuid'].'\', 0, 1)"
                                                class="btn-2 btn-zxxxs">
                                                <i class=""><i class="las la-edit"></i></i>
                                            </div>
                                            <div id="rtn-event-1aa7236f-228d-11ef-9911-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                                        </div>
                                        <div class="dIB">
                                            <div onclick="Crudion.Run(\'event-1aad7989-228d-11ef-9911-b42e99a5cf9a\', \'builder-journey\', \'1aad7989-228d-11ef-9911-b42e99a5cf9a\', \''.$fase['uuid'].'\', 0, 1)"
                                                class="btn-3 btn-zxxxs">
                                                <i class=""><i class="las la-trash"></i></i>
                                            </div>
                                            <div id="rtn-event-1aad7989-228d-11ef-9911-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                                        </div>
                                    </div>
                                    '.($fase["nombre"]).'
                                    <div class="onlyAd ff1 t12">Orden. '.($fase["orden"]).'</div>
                                </th>
                            ';
                        }
                    }
                }
            }
            echo '</tr>';
            echo '<tr>';
            echo '<th class="jSubfases jVertical"><div class="jVerticalArrow"><div class="jVerticalArrowIn"><div class="jVerticalArrowA"></div></div></div>Subfases</th>';
            if (isset($strJourney["etapas"])) {
                foreach ($strJourney["etapas"] as $key => $etapa) {
                    if (isset($etapa["fases"])) {
                        foreach ($etapa["fases"] as $key2 => $fase) {
                            if (isset($fase["subfases"])) {
                                foreach ($fase["subfases"] as $key3 => $subfase) {
                                    echo '
                                        <th class="jSubfases jSubfase'.$key.' jGeneral">

                                            <div class="fR jGeneralDiv" style="margin:-3px 0 -10px">
                                                <div class="dIB">
                                                    <div onclick="Crudion.Run(\'event-77f4e028-228d-11ef-9911-b42e99a5cf9a\', \'builder-journey\', \'77f4e028-228d-11ef-9911-b42e99a5cf9a\', \''.$subfase['uuid'].'\', 0, 1)"
                                                        class="btn-2 btn-zxxxs">
                                                        <i class=""><i class="las la-edit"></i></i>
                                                    </div>
                                                    <div id="rtn-event-77f4e028-228d-11ef-9911-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                                                </div>
                                                <div class="dIB">
                                                    <div onclick="Crudion.Run(\'event-77fc99c5-228d-11ef-9911-b42e99a5cf9a\', \'builder-journey\', \'77fc99c5-228d-11ef-9911-b42e99a5cf9a\', \''.$subfase['uuid'].'\', 0, 1)"
                                                        class="btn-3 btn-zxxxs">
                                                        <i class=""><i class="las la-trash"></i></i>
                                                    </div>
                                                    <div id="rtn-event-77fc99c5-228d-11ef-9911-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                                                </div>
                                            </div>

                                            '.($subfase["nombre"]).'
                                            <div class="onlyAd ff1 t12">Orden. '.($subfase["orden"]).'</div>
                                        </th>
                                    ';
                                }
                            }
                        }
                    }
                }
            }
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            if (isset($strJourney["referentes"])){
                foreach ($strJourney["referentes"] as $key => $referente) {
                    echo '<tr>';
                    echo '
                    <td class="jVertical jGeneral" style="vertical-align:top">
                        <div class="jVerticalArrow"><div class="jVerticalArrowIn"><div class="jVerticalArrowA"></div></div></div>
                        <div class="fR jGeneralDiv" style="margin:-3px 0 -10px">
                            <div class="dIB">
                                <div onclick="Crudion.Run(\'event-e5f04337-228d-11ef-9911-b42e99a5cf9a\', \'builder-journey\', \'e5f04337-228d-11ef-9911-b42e99a5cf9a\', \''.$fase['uuid'].'\', 0, 1)"
                                    class="btn-2 btn-zxxxs">
                                    <i class=""><i class="las la-edit"></i></i>
                                </div>
                                <div id="rtn-event-e5f04337-228d-11ef-9911-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                            </div>
                            <div class="dIB">
                                <div onclick="Crudion.Run(\'event-e5f8c1b7-228d-11ef-9911-b42e99a5cf9a\', \'builder-journey\', \'e5f8c1b7-228d-11ef-9911-b42e99a5cf9a\', \''.$fase['uuid'].'\', 0, 1)"
                                    class="btn-3 btn-zxxxs">
                                    <i class=""><i class="las la-trash"></i></i>
                                </div>
                                <div id="rtn-event-e5f8c1b7-228d-11ef-9911-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                            </div>
                        </div>
                        '.($referente["nombre"]).'
                        <div class="onlyAd ff1 t12">Orden. '.($referente["orden"]).'</div>
                    </td>
                    ';
                    foreach ($strJourney["etapas"] as $key => $etapa) {
                        foreach ($etapa["fases"] as $key2 => $fase) {
                            foreach ($fase["subfases"] as $key3 => $subfase) {
                                echo '<td style="vertical-align:top" class="tdEvent" style="vertical-align:middle">';
                                echo '<div class="jMomentum">';
                                if(isset($eventos[$subfase["id"].'_'.$referente["id"]])){
                                    $x       = $subfase["id"];
                                    $y       = $referente["id"];
                                    $momento = $eventos[$x.'_'.$y]["eventos"];
                                    foreach ($momento as $evento) {
                                        include 'app_valora/components/evento.php';
                                    }
                                }else{
                                    echo '<div class="tdEventDivAlt t12 ff2 taC color999 mt10 mb5">Sin eventos</div>';
                                }
                                echo '

<div class="h30">
    <div class="dB taC tdEventDiv">
        <div onclick="Crudion.Run(\'event-1ca11d35-1dcc-11ef-9353-b42e99a5cf9a\', \'builder-journey\', \'1ca11d35-1dcc-11ef-9353-b42e99a5cf9a\', \''.$registro['uuid'].'\', \''.$registro["id"].','.$subfase["id"].','.$referente["id"].'\', 1)"
            class="btn-1 btn-zxxxs">
            <i class=""><i class="las la-plus-circle"></i></i>
            <span style="">Evento</span>
        </div>
        <div id="rtn-event-1ca11d35-1dcc-11ef-9353-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
    </div>
</div>
                                ';
                                echo '</div>';
                                echo '</td>';
                            }
                        }
                    }
                    echo '</tr>';
                }
            }

            echo '
                <tr>
                    <td>
                        <div class="jGeneralDiv p5">
                            <div onclick="Crudion.Run(\'event-e5ec019e-228d-11ef-9911-b42e99a5cf9a\', \'builder-journey\', \'e5ec019e-228d-11ef-9911-b42e99a5cf9a\', \''.$registro['uuid'].'\', \''.$registro["id"].'\', 1)"
                                class="btn-1 btn-zxs">
                                <i class=""><i class="las la-plus-circle"></i></i>
                                <span>Crear Referente</span>
                            </div>
                            <div id="rtn-event-e5ec019e-228d-11ef-9911-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                        </div>
                    </td>
                </tr>
            ';

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '</div>';

        }else {
            echo '

                <div class="general pAA60">
                <div class="alert alert-success taC t24 mb30" role="alert">
                    Primeros pasos para configurar tu Journey.
                </div>
            ';


            echo '
                <div class="cloud mb30">
                    <div class="tab">
                        <div class="tabIn">
                            <div class="t18 ff3 color000 mb10">La primera Fase y Subfase</div>
                            <div class="t14 ff1 color666"></div>
                        </div>
                        <div class="tabIn taR">
                            <div class="dIB tdEventDiv">
                                <div onclick="Crudion.Run(\'event-47bdfb00-228d-11ef-9911-b42e99a5cf9a\', \'builder-journey\', \'47bdfb00-228d-11ef-9911-b42e99a5cf9a\', \''.$registro['uuid'].'\', \''.$registro["id"].'\', 1)"
                                    class="btn-1 btn-zs">
                                    <i class=""><i class="las la-plus-circle"></i></i>
                                    <span style="">Crear primera Fase y Subfase</span>
                                </div>
                                <div id="rtn-event-47bdfb00-228d-11ef-9911-b42e99a5cf9a" style="width:0; height:0; overflow:hidden"></div>
                            </div>
                        </div>
                    </div>
                </div>
            ';

            echo '</div>';

        }
?>













    <?php
        if(isset($botoneshabilitados['84d020b8-1c63-11ef-938f-b42e99a5cf9a'])){
            $boton = $botoneshabilitados['84d020b8-1c63-11ef-938f-b42e99a5cf9a'];
            $size = 'zs';
            $perz = '';
            include '../views/components/boton_builder.php';
        }
    ?>

</div>

<?php
            } else {
                echo '<div class="p50 taC t30 ff0 tU">No se encontró o se eliminó el registro que busca</div>';
                echo '<script>setTimeout(function(){ history.back(); }, 2000);</script>';
            }

        } else {
            echo '<div class="p50 taC t30 ff0 tU">No se encontró o se eliminó el registro que busca</div>';
            echo '<script>setTimeout(function(){ history.back(); }, 2000);</script>';
        }

    } else  echo '<div class="p50 taC t30 ff0 tU">No posee permisos para cargar esta sección</div>';

?>

<div id="JourneyDown"></div>