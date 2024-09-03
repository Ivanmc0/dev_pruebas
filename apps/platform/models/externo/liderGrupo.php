<?php  require_once ('../../appInit.php');

if($grupo = $_GROWI->GET("Platform", "getGrupos", $AddToQuery = ' AND GRU.uuid = "'.$_POST['g'].'" AND MIE.id_trabajador = '.$_POST['t'].' AND MIE.es_lider = 1 ', [], true )){

    $data = array(
        "empresa"    => $_POST["b"],
        "trabajador" => $_POST["t"],
        "filtro"     => $_POST["f"],
        "grupo"      => $_POST["g"],
        "actividad"  => $_POST["a"],
    );


    $act         = $_ZOOM->get_data("grw_lel_actividades", " AND id = '".$_POST["a"]."' AND eliminado = 0 ORDER BY id DESC ", 0);
    $miembros    = $_GROWI->GET("Platform", "getMiembrosGrupo", $AddToQuery = ' AND GRU.uuid = "'.$data["grupo"].'" ORDER BY MIE.es_lider DESC, USR.nombre ASC ', [] );
    $resolve     = [ "yes" => 0, "no"  => 0 ];

    $members = ['activos' => 0, 'lideres' => 0];
    if($miembros){
        foreach ($miembros as $key => $miembro) {
            if($miembro["lider"]) $members['lideres'] += 1;
            $members['activos'] += 1;
        }
    }

    $actividades = [];
    if($grupo_actividades = $_ZOOM->get_data("grw_lel_act_asignaciones", " AND id_grupo = '".$grupo["id"]."' AND eliminado = 0 ORDER BY id ASC ", 1)){
        foreach($grupo_actividades AS $rel_proceso){
            if($theProcess = $_ZOOM->get_data("grw_procesos", " AND id = '".$rel_proceso["id_alcance_proceso"]."' AND id_proceso_tipo = 3 AND asignaciones_actividad = 2 AND eliminado = 0 ORDER BY id DESC ", 0)){
                $actividades[$theProcess["id_proceso"]] = $_ZOOM->get_data("grw_lel_actividades", " AND id = '".$theProcess["id_proceso"]."' AND eliminado = 0 ORDER BY id DESC ", 0);
            }
        }
    }

    echo '
        <div class="bGrowi posA w100 bBS2 bCeee getH" style="top:0; left:0; z-index:3;">
            <div class="general1600">
                <div class="row align-items-end">
                    <div class="col-12 col-lg-7">
                        <div class="h60"></div>
                        <div class="h60"></div>
                        <div class="t18 colorccc ff1 mb10">Grupo corporativo</div>
                        <div class="colorVerde5 t60 ff4 mb10">'.$grupo["nombre"].'</div>
                        <div class="t30 colorfff ff2">'.$grupo["descripcion"].'.</div>
                        <div class="h40"></div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="row" style="margin-bottom:-40px;">
                            <div class="col-12 col-lg-6">
                                <div class="bShadow3 bfff rr15 bBene1 ofH">
                                    <div class="tab p15">
                                        <div class="tabIn">
                                            <div class="t16 ff3 colorGrowi mb5">Miembros</div>
                                            <div class="t50 ff4 colorGrowi">
                                                <span>'.$members['activos'].'</span>
                                            </div>
                                        </div>
                                        <div class="tabIn w80x">
                                            <div class="bShadow3 bfff rr15"><img src="'.$dominion.'resources/img/bene-1.png" /></div>
                                        </div>
                                    </div>
                                    <div class="bfff p1020">
                                        <div class="dIB bVerde5 colorfff p310 rr10 mR5">'.$members['lideres'].'</div>
                                        <div class="dIB">Líderes</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="bShadow3 bfff rr15 bBene2 ofH">
                                    <div class="tab p15">
                                        <div class="tabIn">
                                            <div class="t16 ff3 colorGrowi mb5">Procesos en curso</div>
                                            <div class="t50 ff4 colorGrowi">
                                                <span>0</span>
                                            </div>
                                        </div>
                                        <div class="tabIn w80x">
                                            <div class="bShadow3 bfff rr15"><img src="'.$dominion.'resources/img/bene-2.png" /></div>
                                        </div>
                                    </div>
                                    <div class="bfff p1020">
                                        <div class="dIB bMorado2 colorfff p310 rr10 mR5">0</div>
                                        <div class="dIB">Procesos totales</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="setH"></div>
    ';


    if($miembros){

        $miembros = SetPositionArray($miembros, "id");

        foreach ($miembros as $key => $miembro) {
            $miembros[$miembro["id"]]["solucion"] = 0;
            if($act){
                $respuesta1 = $_LELE->ZOOM->get_data("grw_sol_act_encuestas", " AND id_actividad = " . $data["actividad"] . " AND id_trabajador = " . $miembro["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id DESC ", 0);
                $respuesta2 = $_LELE->ZOOM->get_data("grw_sol_act_reconocimientos", " AND id_actividad = " . $data["actividad"] . " AND id_trabajador = " . $miembro["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id DESC ", 0);
                $respuesta3 = $_LELE->ZOOM->get_data("grw_sol_act_campanias", " AND id_actividad = " . $data["actividad"] . " AND id_trabajador = " . $miembro["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id DESC ", 0);

                if($respuesta1 || $respuesta2 || $respuesta3){
                    $miembros[$miembro["id"]]["solucion"] = 1;
                    $resolve["yes"] += 1;
                } else $resolve["no"] += 1;
            }
        }

        echo '
            <div class="general1600">
                <div class="ff1 t18 pLR20 color666 mb5">Seleccione un proceso para obtener más detalles</div>
                <select class="w100 dB p1530 t18 bShadow3 colorGrowi rr40 mb30" onchange="lele.liderGrupo('.$_SESSION["COMPANY"]["id"].', '.$_SESSION["WORKER"]["id"].', 0, this.value, \''.$grupo['uuid'].'\');">

                <option value="0">Sin selección</option>

        ';

        if($actividades){
            foreach ($actividades as $key => $actividad) {
                if($act && $act["id"] == $actividad["id"]) $r = "selected"; else $r = "";
                echo '<option value="'.$actividad["id"].'" '.$r.'>ACT | '.($actividad["nombre"]).'</option>';
            }
        }

        echo'
                </select>
            </div>
        ';

        if($act){

            $dinam = "";
            if($dinamicas = $_ZOOM->get_data("grw_lel_dinamicas", " AND id_actividad = '".$act["id"]."' AND eliminado = 0 ORDER BY id ASC ", 1)){
                $dinam .= '<div class="ff1 t14 pLR20 color666 mb5">Esta actividad contiene las siguientes Dinámicas</div>';
                $dinam .= '<select class="w100 dB p1020 t14 bShadow3 colorGrowi rr40" onchange="lele.liderGrupoDinamica('.$_SESSION["COMPANY"]["id"].', '.$_SESSION["WORKER"]["id"].', \''.$act['id'].'\', this.value, 0, \''.$grupo['uuid'].'\');">';
                $dinam .= '<option value="0">Sin selección</option>';
                if($dinamicas){
                    foreach ($dinamicas as $key => $dinamica) {
                        if(false == $dinamica["id"]) $r2 = "selected"; else $r2 = "";
                        $dinam .= '<option value="'.$dinamica["id"].'" '.$r2.'>'.($dinamica["nombre"]).'</option>';
                    }
                }
                $dinam .= '</select>';
            }

            echo '
                <div class="general1600">
                    <div class="bShadow3 bfff rr15 ofH mb30">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-8">
                                <div class="p2040">
                                    <div class="t14 ff3 color999 mb30">Leletog / Actividad</div>
                                    <div class="t24 ff3 colorGrowi mb10">'.$act["nombre"].'</div>
                                    <div class="t16 ff1 color666">'.$act["descripcion"].'</div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="bVerde5 p40 taC colorfff">
                                    <div class="tab">
                                        <div class="tabIn">
                                            <div class="ff2 t18 mb5">Participación</div>
                                            <div class="ff2 t40">'.$resolve["yes"].' / '.count($miembros).'</div>
                                        </div>
                                        <div class="tab40 taL">
                                            <div class="t60 ff4">'.round($resolve["yes"]/count($miembros)*100).'%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bBene1 p1530 ff1 color666">'.$dinam.'</div>
                    </div>
                </div>
            ';
        }

        echo '
            <div class="general1600">
                <div id="tabla_miembros_grupo">
                <div class="bShadow3 bfff rr15 ofH">
                    <div class="tab bVerde5 bS1 bCVerde colorfff t16 ff3 pAA10" style="z-index:5">
                        <div class="tabIn p20">Miembros</div>
                        <div class="tabIn w200x p20">Miembro desde</div>
                        <div class="tabIn w200x p20">Último acceso</div>
        ';

        if($act) echo '<div class="tabIn w120x taC">Acciones</div>';

        echo '
                        </div>
        ';


        foreach ($miembros as $key => $miembro) {

            $yes = false;
            if($miembro["solucion"]){
                $yes = true;
            }
            // if($rec = $_LELE->ZOOM->get_data("grw_sol_act_reconocimientos", " AND id_actividad = " . $data["actividad"] . " AND id_trabajador = " . $miembro["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id DESC ", 0)){
            //     $sol = '<i class="fas fa-check colorVerde"></i>';
            //     $yes = true;
            // }


            echo '
                <div class="tab bS1 bCeee" style="margin-top:-1px;">
                    <div class="tabIn p1020">
                        <div class="ff1 mb3">'.($miembro["nombre"]).'</div>
                        <div class="t12 color999">Cargo</div>
                    </div>

                    <div class="tabIn w200x p1020">
                        <div class="ff1">'.DateFront($miembro["fecha_miembro_ingreso"]).'</div>
                    </div>
                    <div class="tabIn w200x p1020">
                        <div class="ff1">'.DateFront($miembro["fecha_ultimo_ingreso"]).'</div>
                    </div>

            ';
            if($act){
                echo '<div class="tabIn w120x taC">';
                if($yes){
                    echo '
                        <div class="btn-2 btn-zxs" data-toggle="modal" data-target="#modalDetalleSolucion" onClick="lele.get_interactividades('.$data["actividad"].', '.$miembro["id"].', '.$data["empresa"].')">
                            <i class="las la-eye"></i>
                            <span>Ver Detalle</span>
                        </div>
                    ';
                }
                echo '</div>';
            }
            echo '
                </div>
            ';
        }

        echo '
                </div>
                </div>
            </div>
        ';


        echo '
            <div class="modal fade" id="modalDetalleSolucion" tabindex="-1" role="dialog" aria-labelledby="modalDetalleSolucionLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered rr0" role="document">
                    <div class="modal-content p30 m0 rr0 posR">

                    <style>.dIB.colorVerde.bS1.p1030.rr10.bCVerde.bHover3.cP { display:none; }</style>

                    <div class="posA wh30 rr30 bRojo colorfff t16 cP bHover" data-dismiss="modal" style="right:-10px; top:-10px;"><div class="vMM wh30"><i class="fas fa-times"></i></div></div>

                        <div id="rtn_actividad_detalle"></div>

                    </div>
                </div>
            </div>
        ';

    } else {
        echo '
            <div class="tab bS1" style="margin-top:-1px;">
                <div class="tabIn p1020">
                    <div class="ff1 mb3">No hay miembros en este grupo</div>
                </div>
            </div>
        ';
    }

}else {
    echo '
        <div class="tab bS1" style="margin-top:-1px;">
            <div class="tabIn p1020">
                <div class="ff1 mb3">No se encontró el grupo</div>
            </div>
        </div>
    ';
}


echo '<script>Ion.ionman();</script>';
?>