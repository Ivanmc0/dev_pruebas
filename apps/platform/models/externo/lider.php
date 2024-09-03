<?php  require_once ('../../appInit.php');


    $act = $_ZOOM->get_data("grw_lel_actividades", " AND uuid = '".$_POST["act"]."' AND eliminado = 0 ORDER BY id DESC ", 0);

    $data = array(
        "empresa"       => $_POST["b"],
        "trabajador"    => $_POST["t"],
        "filtro"        => $_POST["f"],
        "actividad"     => $act["id"],
        "actividad_uuid"     => $act["uuid"],
    );


    $trabajador_red = $_LELE->load_trabajador($data["empresa"], $data["trabajador"], 0, $data["actividad"]);

    $red_plana      = $_LELE->convert_red_list($trabajador_red);

    $plana          = $_LELE->plana_order($red_plana);


    $resolve        = array(
        "yes"   => 0,
        "no"    => 0,
    );

    $trus        = array();



    $thisMan = $_LELE->ZOOM->get_data("zoom_users", " AND id = '" . $data["trabajador"]."' AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id ASC ", 0);
    $thisCargo = $_LELE->ZOOM->get_data("grw_cargos", " AND id = " . $thisMan["id_cargo"]." AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id ASC ", 0);

    if($thisMan && $thisCargo){

        $cargosNiveles = $_LELE->ZOOM->get_data("grw_cargos", " AND nivel = " . $thisCargo["nivel"] . " AND id_organigrama = " . $thisCargo["id_organigrama"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id ASC ", 1);

        if($cargosNiveles){
            foreach ($cargosNiveles as $key => $cargosNivel) {
                //$selCargos = $_LELE->ZOOM->get_data("___olc_trabajadores_carg0", " AND id_cargo = " . $cargosNivel["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id ASC ", 1);
                if($selCargos = $_WORKERS->getCargo(" AND id_cargo = " . $cargosNivel["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0")){

                    foreach ($selCargos as $key => $tru) {
                        $trus[$tru["id_trabajador"]] = array(
                            "id"            => $tru["id_trabajador"],
                            "cargo_nombre"  => $cargosNivel["nombre"],
                            "lider"         => 1,
                        );
                        if($name = $_LELE->ZOOM->get_data("zoom_users", " AND id = " . $tru["id_trabajador"] . " AND eliminado = 0 ORDER BY id ASC ", 0)){
                            $trus[$tru["id_trabajador"]]["nombre"] = $name["nombre"];
                        }
                    }
                }
            }
        }
    }

    // echo '<pre>';
    // print_r($trus);
    // // print_r($plana);
    // // print_r($_SESSION);
    // print_r($plana[$data["trabajador"]]["cargo_id"]);
    // echo '</pre>';

    if($plana){
    foreach ($plana as $key => $trab) {
        $respuesta = $_LELE->ZOOM->get_data("grw_sol_act_encuestas", " AND id_actividad = " . $data["actividad"] . " AND id_trabajador = " . $trab["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id DESC ", 0);
        if($respuesta){
            $plana[$trab["id"]]["solucion"] = 1;
            $resolve["yes"] +=1;
        } else {
            $plana[$trab["id"]]["solucion"] = 0;
            $resolve["no"] +=1;
        }
        $respuesta = $_LELE->ZOOM->get_data("grw_sol_act_reconocimientos", " AND id_actividad = " . $data["actividad"] . " AND id_trabajador = " . $trab["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id DESC ", 0);
        if($respuesta){
            $plana[$trab["id"]]["solucion"] = 1;
            $resolve["yes"] +=1;
        } else {
            $plana[$trab["id"]]["solucion"] = 0;
            $resolve["no"] +=1;
        }
        $respuesta = $_LELE->ZOOM->get_data("grw_sol_act_campanias", " AND id_actividad = " . $data["actividad"] . " AND id_trabajador = " . $trab["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id DESC ", 0);
        if($respuesta){
            $plana[$trab["id"]]["solucion"] = 1;
            $resolve["yes"] +=1;
        } else {
            $plana[$trab["id"]]["solucion"] = 0;
            $resolve["no"] +=1;
        }
    }
    echo '
        <div class="row align-items-center mb30" style="z-index:5">
            <div class="col-12 col-lg-6">
                <div class="bVerde p40 taC colorfff">
                    <div class="tU mb20">Actividades realizadas en tu equipo</div>
                    <div class="t60 ff2">'.$resolve["yes"].'/'.count($plana).'</div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="ff2 color666 mb5">Filtro por Organigrama:</div>
                <select class="w100 dB p1020 bS1 rr5" onchange="lele.lider('.$data["empresa"].', this.value, 0, \''.$data["actividad_uuid"].'\');">
    ';
                $yo = 0;
                foreach ($trus as $key => $tru) {
                    if($tru["id"] != $_SESSION["WORKER"]["id"] && $yo == 0){
                        echo '<option value="'.$_SESSION["WORKER"]["id"].'">YO</option>';
                    }
                    if($tru["lider"]){
                        if($data["trabajador"] == $tru["id"]) $r = "selected"; else $r = "";
                        echo '<option value="'.$tru["id"].'" '.$r.'>'.($tru["cargo_nombre"]).' | '.($tru["nombre"]).'</option>';
                    }
                    $yo ++;
                }
                foreach ($plana as $key => $plan) {
                    if($plan["lider"] && $plan["id"] != $data["trabajador"]){
                        if($data["trabajador"] == $plan["id"]) $r = "selected"; else $r = "";
                        echo '<option value="'.$plan["id"].'" '.$r.'>'.($plan["cargo_nombre"]).' | '.($plan["nombre"]).'</option>';
                    }
                }
    echo'
                </select>
            </div>
        </div>
    ';

    echo '
        <div class="tab bVerde2 bS1 bCVerde colorfff ff3 p20" style="z-index:5">
            <div class="tabIn p20">COLABORADOR</div>
            <div class="tabIn taR pLR10">ROL</div>
            <div class="tabIn w50x taC"></div>
        </div>
    ';

    foreach ($plana as $key => $trab) {

        $yes = false;
        $sol = '<i class="fas fa-times colorRojo"></i>';
        if($trab["solucion"]){
            $sol = '<i class="fas fa-check colorVerde"></i>';
            $yes = true;
        }

        if($rec = $_LELE->ZOOM->get_data("grw_sol_act_reconocimientos", " AND id_actividad = " . $data["actividad"] . " AND id_trabajador = " . $trab["id"] . " AND id_empresa = " . $_SESSION["COMPANY"]["id"] . " AND eliminado = 0 ORDER BY id DESC ", 0)){
            $sol = '<i class="fas fa-check colorVerde"></i>';
            $yes = true;
        }


        echo '
            <div class="tab bS1" style="margin-top:-1px;">
                <div class="tabIn p1020">
                    <div class="ff1 mb3">'.($trab["nombre"]).'</div>
                    <div class="t12 color999">'.($trab["titulo"]).'</div>
                </div>
                <div class="tabIn  taR pLR10">
                    <div class="tInc color666">'.($trab["cargo_nombre"]).'</div>
                </div>
                <div class="tabIn w80x taC">
                    <div class="t14 ff0 mb3">'.$sol.'</div>
        ';
        if(true || $yes){
            echo '
                <div class="t10 aS ff0 cP" data-toggle="modal" data-target="#modalDetalleSolucion" onClick="lele.get_interactividades('.$data["actividad"].', '.$trab["id"].', '.$data["empresa"].')">


                    Detalle
                </div>
            ';
        }
        echo '
                </div>
            </div>
        ';
    }


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
    }

?>