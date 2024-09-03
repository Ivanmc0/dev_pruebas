<?php  require_once ('../../appInit.php');

if($grupo = $_GROWI->GET("Platform", "getGrupos", $AddToQuery = ' AND GRU.uuid = "'.$_POST['g'].'" AND MIE.id_trabajador = '.$_POST['t'].' AND MIE.es_lider = 1 ', [], true )){

    $data = array(
        "empresa"    => $_POST["b"],
        "trabajador" => $_POST["t"],
        "actividad"  => $_POST["a"],
        "dinamica"   => $_POST["d"],
        "pregunta"   => $_POST["p"],
        "grupo"      => $_POST["g"],
    );

    $act       = $_ZOOM->get_data("grw_lel_actividades", " AND id = '".$_POST["a"]."' AND eliminado = 0 ORDER BY id DESC ", 0);
    $dinamica  = $_ZOOM->get_data('grw_lel_dinamicas', ' AND id = '. $_POST["d"].' AND inactivo = 0 AND eliminado = 0', 0);
    $miembros  = $_GROWI->GET("Platform", "getMiembrosGrupo", $AddToQuery = ' AND GRU.uuid = "'.$data["grupo"].'" ORDER BY MIE.es_lider DESC, USR.nombre ASC ', [] );

    if($dinamica && $dinamica["id_modelo"] == 2){
        $insignias = SetPositionArray($_GROWI->GetCampos("grw_reconocimientos", "id, nombre, color, icono", ' id_empresa = '.$data["empresa"].' AND inactivo = 0 '), "id");
        $wrkrs     = SetPositionArray($_GROWI->GetCampos("zoom_users", "id, nombre", ' id_empresa = '.$data["empresa"].' AND inactivo = 0 '), "id");
    }

    $resolve  = [ "yes" => 0, "no"  => 0 ];

    $members = ['activos' => 0, 'lideres' => 0];
    if($miembros){
        foreach ($miembros as $key => $miembro) {
            if($miembro["lider"]) $members['lideres'] += 1;
            $members['activos'] += 1;
        }
    }

    if($act && $miembros){

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

        if($dinamica && $dinamica["id_modelo"] == 1){
            $preg = "";
            if($preguntas = $_ZOOM->get_data("grw_lel_preguntas", " AND id_dinamica = '".$dinamica["id"]."' AND eliminado = 0 ORDER BY id ASC ", 1)){
                $preg .= '<div class="ff1 t14 pLR20 color666 mb5">Esta Dinámica contiene las siguientes Preguntas</div>';
                $preg .= '<select class="w100 dB p1020 t14 bShadow3 colorGrowi rr40" onchange="lele.liderGrupoDinamica('.$_SESSION["COMPANY"]["id"].', '.$_SESSION["WORKER"]["id"].', \''.$act['id'].'\', \''.$dinamica['id'].'\',this.value, \''.$grupo['uuid'].'\');">';
                $preg .= '<option value="0">Sin selección</option>';
                foreach ($preguntas as $key => $pregunta) {
                    if($data["pregunta"] == $pregunta["id"]) $r3 = "selected"; else $r3 = "";
                    $preg .= '<option value="'.$pregunta["id"].'" '.$r3.'>'.($pregunta["nombre"]).'</option>';
                }
                $preg .= '</select>';

                echo '
                    <div class="bShadow3 bBene3 rr15 ofH mb30">
                        <div class="p1530 ff1 color666">'.$preg.'</div>
                    </div>
                ';
            }
        }


        echo '
            <div class="bShadow3 bfff rr15 ofH">
                <div class="tab bVerde5 bS1 bCVerde colorfff t16 ff3 pAA10" style="z-index:5">
                    <div class="tabIn p20">Miembros</div>
                    <div class="tabIn w300x p20">Respuesta</div>
                    <div class="tabIn w200x p20">Balance</div>
                    <div class="tabIn w120x taC">Acciones</div>
                </div>
        ';


        foreach ($miembros as $key => $miembro) {

            $yes = false;
            if($miembro["solucion"]){
                $yes = true;
            }

            $dica   = array();
            $result = "";
            $anws   = "";
            include "liderGrupoDinamica_process.php";

            echo '
                <div class="tab bS1 bCeee" style="margin-top:-1px;">
                    <div class="tabIn p1020">
                        <div class="ff1 mb3">'.($miembro["nombre"]).'</div>
                        <div class="t12 color999">Cargo</div>
                    </div>
            ';
            echo '<div class="tabIn w300x p1020"><div class="ff1">'.$anws.'</div></div>';
            echo '<div class="tabIn w200x p1020"><div class="ff1">'.$result.'</div></div>';
            echo '
                    <div class="tabIn w120x taC">
            ';
            if($yes){
                echo '
                    <div class="btn-2 btn-zxs" data-toggle="modal" data-target="#modalDetalleSolucion" onClick="lele.get_interactividades('.$data["actividad"].', '.$miembro["id"].', '.$data["empresa"].')">
                        <i class="las la-eye"></i>
                        <span>Ver Detalle</span>
                    </div>
                ';
            }
            echo '
                    </div>
                </div>
            ';
        }

        echo '
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